<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="../../css/japan.css">
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('password.reset') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="user@gmail.com" required>
                @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
            </div>
            <div class="form-group">
                <label for="verification_code">Mã xác nhận :</label>
                <input type="text" id="verification_code" name="verification_code" placeholder="abgf123" required>
                @error('verification_code')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="new-password">Mật khẩu mới</label>
                <input type="password" id="new-password" name="new_password" placeholder="********" required>
                @error('verification_code')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu mới</label>
                <input type="password" id="confirm-password" name="new_password_confirmation" placeholder="********" required>
                @error('verification_code')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit">Đặt lại mật khẩu
                <img src="../../images/icon.png" alt="Submit icon">
            </button>
        </form>
        <div class="links">
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</body>
</html>
