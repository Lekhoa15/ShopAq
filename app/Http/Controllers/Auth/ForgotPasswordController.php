<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForgotPasswordService;


class ForgotPasswordController extends Controller
{
    protected $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    // Hiển thị form nhập email để gửi mã xác nhận
    public function showForgotPassForm()
    {
        return view('login.forgot_passE');
    }

    // Gửi mã xác nhận qua email
  // Gửi mã xác nhận qua email
public function sendResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $response = $this->forgotPasswordService->sendResetCode($request);

    // Chuyển hướng đến form đặt lại mật khẩu với thông báo
    return redirect()->route('password.reset.form')->with('message', 'Mã xác nhận đã được gửi qua email.');
}


    // Hiển thị form đặt lại mật khẩu sau khi nhận mã xác nhận
    public function showForgotPasswordForm()
    {
        return view('login.forgot_password');
    }

    public function resetPassword(Request $request)
    {
        // Thực hiện xác thực đầu vào
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Gọi dịch vụ để đặt lại mật khẩu
        $response = $this->forgotPasswordService->resetPassword($request->all());

        // Kiểm tra phản hồi từ dịch vụ
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            // Nếu phản hồi là JsonResponse, chuyển hướng lại với thông báo
            return back()->withErrors(['verification_code' => $response->getData()->error])->withInput();
        }

        // Nếu không có lỗi, chuyển hướng về trang đăng nhập với thông báo thành công
        return redirect()->route('login')->with('status', 'Đổi mật khẩu thành công.');
    }
}
