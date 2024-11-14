<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/japan.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <style>
        .error {
            border: 2px solid red;
        }
        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert .close {
            cursor: pointer;
            color: #000;
            opacity: 0.5;
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- Alert Thông báo nếu tồn tại trong session -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
            {{ session('error') }}
            <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('register') }}" method="POST" id="user-form" enctype="multipart/form-data">
            @csrf

            <img src="{{ asset('images/avatar.jpg') }}" alt="Lock Icon" width="50" height="50">
            <h1>Đăng ký</h1>

            <div class="form-group">
                <label for="full_name">Tên</label>
                <input type="text" id="first-name" name="name" placeholder="Tên" required>
                <span class="error-message">Vui lòng nhập họ và tên.</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="abc@gmail.com" required>
                <span class="error-message">Vui lòng nhập Email hợp lệ.</span>
            </div>

            <div class="form-group password-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
                <span class="error-message">Vui lòng nhập mật khẩu có ít nhất 6 ký tự.</span>
                <span class="password-toggle" onclick="togglePassword('password', this)">
                    <img src="{{ asset('images/eye1.png') }}" alt="Toggle Password Visibility">
                </span>
            </div>

            <div class="form-group password-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm-password" name="password_confirmation" placeholder="********" required>
                <span class="error-message">Vui lòng xác nhận mật khẩu.</span>
                <span class="password-toggle" onclick="togglePassword('confirm-password', this)">
                    <img src="{{ asset('images/eye1.png') }}" alt="Toggle Password Visibility">
                </span>
            </div>

            <button type="submit">Đăng ký
                <img src="{{ asset('images/icon.png') }}" alt="Submit icon">
            </button>
        </form>
        <div class="links">
            <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('user-form');
            const inputs = form.querySelectorAll('input[required]');

            // Kiểm tra trường khi người dùng rời khỏi
            inputs.forEach(input => {
                input.addEventListener('blur', function () {
                    validateField(input);
                });
            });

            // Hàm kiểm tra một trường cụ thể
            function validateField(input) {
                const errorMessage = input.nextElementSibling;
                const value = input.value.trim();
                let isValid = true;

                if (!value) {
                    input.classList.add('error');
                    errorMessage.innerText = 'Trường này là bắt buộc.';
                    errorMessage.style.display = 'block';
                    isValid = false;
                } else {
                    if (input.type === 'password' && value.length < 6) {
                        input.classList.add('error');
                        errorMessage.innerText = 'Mật khẩu phải có ít nhất 6 ký tự.';
                        errorMessage.style.display = 'block';
                        isValid = false;
                    } else if (input.type === 'email' && !validateEmail(value)) {
                        input.classList.add('error');
                        errorMessage.innerText = 'Vui lòng nhập Email hợp lệ.';
                        errorMessage.style.display = 'block';
                        isValid = false;
                    } else {
                        input.classList.remove('error');
                        errorMessage.style.display = 'none';
                    }
                }
                return isValid;
            }

            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            form.addEventListener('submit', function (event) {
                let isValid = true;
                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin hợp lệ trước khi đăng ký.');
                }
            });

            // Tự động ẩn alert sau 5 giây
            $(document).ready(function() {
        // Ẩn thông báo thành công sau 5 giây
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 5000); // 5000 milliseconds = 5 seconds

        // Ẩn thông báo lỗi sau 5 giây
        setTimeout(function() {
            $('#error-alert').fadeOut('slow');
        }, 5000); // 5000 milliseconds = 5 seconds
    });
        });
    </script>
</body>
</html>
