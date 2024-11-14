<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="{{ asset('css/japan.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <img src="../../images/avatar.jpg" alt="Lock Icon" width="50" height="50">
        <h1>Quên Mật Khẩu</h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
            </div>
            <button type="submit">Gửi yêu cầu
                <img src="../../images/icon.png" alt="Submit icon">
            </button>
        </form>
        <div class="links">
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</body>
</html>
