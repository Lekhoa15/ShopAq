<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi biểu mẫu liên hệ</title>
</head>
<body>
    <h1>Gửi biểu mẫu liên hệ</h1>

    <p><strong>Họ và tên:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
    <p><strong>Nội dung:</strong> {{ $contact->message }}</p>
    <p><strong>Ghi chú:</strong> {{ $contact->subject }}</p>
    <h1>Cảm ơn bạn!</h1>
    <p>Chúng tôi đã nhận được thông tin liên hệ của bạn. Chúng tôi sẽ phản hồi sớm nhất có thể.</p>
</body>
</html>
