<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo hoàn tiền</title>
</head>
<body>
    <h1>Thông báo hoàn tiền</h1>
    <p>Chúng tôi muốn thông báo rằng yêu cầu hoàn tiền của bạn đã được xử lý thành công.</p>
    <p><strong>Mã giao dịch:</strong> {{ $paymentId }}</p>
    <p><strong>Số tiền hoàn lại:</strong> ${{ number_format($paymentAmount, 2) }}</p>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
</body>
</html>
