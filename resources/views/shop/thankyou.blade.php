<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .thankyou-container {
            text-align: center;
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .thankyou-container h1 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #4CAF50;
        }

        .thankyou-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }

        .thankyou-container a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .thankyou-container a:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="thankyou-container">
        <h1>Cảm ơn bạn!</h1>
        <p>Chúng tôi đã nhận được thông tin liên hệ của bạn. Chúng tôi sẽ phản hồi sớm nhất có thể.</p>
        <a href="{{ route('home') }}">Quay lại trang chủ</a>
    </div>
</body>
</html>
