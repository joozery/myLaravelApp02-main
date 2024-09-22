<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Custom Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f6f7;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Prompt', sans-serif; 
        }

        .login-container {
            display: flex;
            width: 900px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            padding: 40px;
            flex: 1;
        }

        .login-form h2 {
            margin-bottom: 30px;
        }

        .login-form input {
            margin-bottom: 20px;
        }

        .login-form .btn {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            border: none;
        }

        .login-form .btn:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }

        .login-form .remember-me {
            display: flex;
            align-items: center;
        }

        .login-form .forgot-password {
            text-align: right;
        }

        .login-welcome {
            flex: 1;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            padding: 40px;
            border-radius: 0 15px 15px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .login-welcome h2 {
            margin-bottom: 30px;
        }

        .login-welcome .btn {
            background-color: white;
            color: #ff4b2b;
            border: none;
        }

        .login-welcome .btn:hover {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- ฟอร์มล็อกอิน -->
        <div class="login-form">
            <h2>เข้าสู่ระบบอู่</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" name="username" class="form-control" placeholder="Username" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="remember-me mb-3">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label ms-2">จดจำรหัสของฉันไว้</label>
                </div>
                <div class="d-grid mb-3">
                    <button class="btn">เข้าสู่ระบบ</button>
                </div>
                <div class="forgot-password">
                    <a href="#">ลืมรหัสผ่าน</a>
                </div>
            </form>
        </div>
        
        <!-- ข้อความต้อนรับ -->
        <div class="login-welcome">
            <h2>ยินดีต้อนรับระบบอู่</h2>
            <p>คุณมีรหัสแล้วหรือยัง</p>
            <a href="#" class="btn">สมัครสมาชิก</a>
        </div>
    </div>
</body>

</html>
