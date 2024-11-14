{{-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng nhập</title>
    <link href="{{ asset('css/japan.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <img src="{{ asset('images/avatar.jpg') }}" alt="Lock Icon" width="50" height="50">
        <h1>Đăng nhập</h1>

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger"> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('status'))
            <ul>
                <li class="text-danger"> {{ session('status') }}</li>
            </ul>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <!-- Form đăng nhập Laravel -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
            </div>

            <div class="form-group password-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
                <span class="password-toggle" onclick="togglePassword('password', this)">
                    <img src="{{ asset('images/eye1.png') }}" alt="Toggle Password Visibility">
                </span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

                <button type="submit">Đăng nhập
                    <img src="{{ asset('images/icon.png') }}" alt="Submit icon">
                </button>
        </form>
        <div class="links">
            <a href="{{ route('register') }}">Đăng ký</a>
            <a href="{{ route('password.forgot') }}">Quên mật khẩu?</a>
        </div>
    </div>

    <script>
        function togglePassword(id, toggleIcon) {
            const input = document.getElementById(id);
            const img = toggleIcon.querySelector('img');
            if (input.type === "password") {
                input.type = "text";
                img.src = "{{ asset('images/eye2.png') }}";
            } else {
                input.type = "password";
                img.src = "{{ asset('images/eye1.png') }}";
            }
        }
    </script>
</body>

</html> --}}
<?php
phpinfo();
?>
