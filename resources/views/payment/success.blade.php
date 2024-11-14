<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/success.css') }}" rel="stylesheet">
    <title>Thanh toán thành công</title>
</head>
<body>
    <div class="container">
        <h1>Thanh toán thành công!</h1>
        <h3>Cảm ơn bạn đã mua hàng. Dưới đây là các sản phẩm bạn đã thanh toán:</h3>

        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>${{ number_format($product->pivot->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Tổng tiền: ${{ number_format($payment->amount, 2) }}</p>

   
        <div id="refund-message" style="color: red; margin-top: 10px;"></div>

        <!-- Form Refund -->
        <form action="{{ route('payment.refund', ['payment' => $payment->id]) }}" method="POST" onsubmit="event.preventDefault(); refundPayment();">
            @csrf
            <button type="submit">Yêu cầu hoàn tiền</button>
        </form>

        <div class="button-container">
            <a href="{{ route('home') }}" class="btn">Quay lại trang chủ</a>
        </div>
    </div>

    <script>
        function refundPayment() {
            fetch('{{ route("payment.refund", ["payment" => $payment->id]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ payment_id: '{{ $payment->id }}' })
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('refund-message');
                if (data.message) {
                    messageDiv.style.color = 'green';
                    messageDiv.textContent = data.message; // Thông báo hoàn tiền thành công
                } else if (data.error) {
                    messageDiv.style.color = 'red';
                    messageDiv.textContent = data.error;
                }
            })
            .catch(error => {
                const messageDiv = document.getElementById('refund-message');
                messageDiv.style.color = 'red';
                messageDiv.textContent = 'Có lỗi xảy ra khi yêu cầu hoàn tiền.';
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
