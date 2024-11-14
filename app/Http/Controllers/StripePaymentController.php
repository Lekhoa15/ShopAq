<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        // Thiết lập khóa bí mật của Stripe từ .env
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function checkout(Request $request)
    {
        try {
            // Khởi tạo Guzzle Client
            $client = new Client();

            // Lấy giỏ hàng từ session
            $cart = $request->session()->get('cart', []);
            if (empty($cart)) {
                return response()->json(['error' => 'Giỏ hàng trống']);
            }

            // Chuẩn bị các dòng sản phẩm (line_items) cho Stripe
            $lineItems = $this->getCartItems($cart);

            // Định nghĩa các URL thành công và hủy bỏ
            $successUrl = route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('payment.cancel');

            // Gửi yêu cầu POST đến Stripe để tạo Checkout session
            $response = $client->post('https://api.stripe.com/v1/checkout/sessions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('STRIPE_SECRET'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => $successUrl,
                    'cancel_url' => $cancelUrl,
                ]
            ]);

            // Giải mã dữ liệu trả về từ Stripe
            $data = json_decode($response->getBody()->getContents(), true);

            // Trả về session ID từ Stripe để tiếp tục quá trình thanh toán
            return response()->json(['id' => $data['id']]);

        } catch (\Exception $e) {
            Log::error('Stripe Checkout Error: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi tạo phiên thanh toán.']);
        }
    }

    // Phương thức chuyển giỏ hàng thành các dòng sản phẩm (line_items) cho Stripe
    private function getCartItems($cart)
    {
        $items = [];
        foreach ($cart as $id => $item) {
            $items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }
        return $items;
    }

    public function success(Request $request)
    {
        try {
            // Đảm bảo đã thiết lập khóa API Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Lấy session_id từ URL
            $sessionId = $request->get('session_id');
            Log::info('Received session_id: ' . $sessionId);

            // Kiểm tra session_id có hợp lệ không
            if (!$sessionId) {
                Log::error('Stripe success handler error: Missing session_id.');
                return view('payment.cancel', ['error' => 'Không tìm thấy thông tin thanh toán.']);
            }

            // Lấy thông tin session từ Stripe API sử dụng Guzzle
            $client = new Client();
            $response = $client->get('https://api.stripe.com/v1/checkout/sessions/' . $sessionId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('STRIPE_SECRET'),
                ]
            ]);

            $session = json_decode($response->getBody()->getContents());

            // Kiểm tra nếu session không tồn tại
            if (!$session) {
                Log::error('Stripe success handler error: Session not found for ID: ' . $sessionId);
                return view('payment.cancel', ['error' => 'Không thể tìm thấy phiên thanh toán.']);
            }

            // Lấy `payment_intent` để lưu vào cột `stripe_charge_id`
            $paymentIntentId = $session->payment_intent;
            $totalAmount = $session->amount_total / 100; // Chuyển từ cents sang dollars

            // Lưu thông tin thanh toán vào cơ sở dữ liệu
            $payment = new Payment();
            $payment->user_id = Auth::id();
            $payment->amount = $totalAmount;
            $payment->status = Payment::STATUS_COMPLETED; // Sử dụng enum trong model
            $payment->stripe_charge_id = $paymentIntentId;
            $payment->save();

            // Lưu sản phẩm đã mua vào bảng pivot
            $cart = $request->session()->get('cart', []);
            foreach ($cart as $id => $item) {
                $payment->products()->attach($id, [
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            // Xóa giỏ hàng sau khi thanh toán thành công
            $request->session()->forget('cart');

            // Trả về view thanh toán thành công và truyền biến $payment vào view
            return view('payment.success', compact('payment'));
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            Log::error('Stripe success handler error: ' . $e->getMessage());
            return view('payment.cancel', ['error' => 'Có lỗi xảy ra']);
        }
    }

    public function refund(Request $request, Payment $payment)
    {
        try {
            Log::info('Refund process initiated for payment ID: ' . $payment->id);

            // Kiểm tra stripe_charge_id
            if (!$payment->stripe_charge_id) {
                Log::error('Refund error: Missing stripe_charge_id for payment ID: ' . $payment->id);
                return response()->json(['error' => 'Không thể hoàn tiền: thiếu thông tin thanh toán.']);
            }

            Log::info('stripe_charge_id is available: ' . $payment->stripe_charge_id);

            // Khởi tạo Guzzle Client
            $client = new Client();

            // Gửi yêu cầu hoàn tiền tới Stripe
            $response = $client->post('https://api.stripe.com/v1/refunds', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('STRIPE_SECRET'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'payment_intent' => $payment->stripe_charge_id,
                ]
            ]);

            Log::info('Refund request sent to Stripe for payment ID: ' . $payment->id);

            // Kiểm tra kết quả trả về từ Stripe
            $refundData = json_decode($response->getBody()->getContents(), true);
            Log::info('Refund response from Stripe: ' . json_encode($refundData));

            // Kiểm tra trạng thái hoàn tiền
            if ($refundData && isset($refundData['status']) && $refundData['status'] === 'succeeded') {
                Log::info('Refund succeeded for payment ID: ' . $payment->id);

                // Cập nhật trạng thái thanh toán
                $payment->status = 'refunded';
                $payment->save();

                return response()->json(['message' => 'Hoàn tiền thành công!']);
            } else {
                Log::error('Refund failed: ' . json_encode($refundData));
                return response()->json(['error' => 'Yêu cầu hoàn tiền thất bại.']);
            }
        } catch (\Exception $e) {
            Log::error('Stripe Refund Error for payment ID: ' . $payment->id . ' - ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi yêu cầu hoàn tiền.']);
        }
    }

}
