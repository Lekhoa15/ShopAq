<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email</title>
</head>
<body>
    <h1>Xin chào {{ $user->name }}</h1>
    <p>Vui lòng xác thực địa chỉ email của bạn bằng cách nhấp vào liên kết bên dưới:</p>
    <a href="{{ $verificationUrl }}">Xác thực Email</a>
</body>
</html>
