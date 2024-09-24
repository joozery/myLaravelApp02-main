<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="32x32">

    
    <title>Laravel 10 Custom Login and Registration - Register Page</title>

    

    <!-- Google Fonts (Prompt) -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Prompt', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .left-section {
            background: linear-gradient(to right, #a4ff7d, #0a8b24);
            color: white;
            padding: 40px;
            border-radius: 10px 0 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; /* จัดให้อยู่กลาง */
        }

        .left-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .left-section p {
            font-size: 1rem;
            margin-bottom: 10px;
            text-align: center; /* ข้อความอยู่กลาง */
        }

        .right-section {
            background-color: white;
            padding: 40px;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            height: 45px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            width: 100%;
            height: 45px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
            /* width: 150px; */
            margin-bottom: 20px;
        }

        /* จัดการให้โลโก้ขนาดเล็ก */
        .logo {
            width: 150px; /* กำหนดขนาดโลโก้ */
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row">
                    <!-- Left section -->
                    <div class="col-md-6 left-section">
                        <!-- เพิ่มโลโก้ -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                        <h2>ยินดีต้อนรับสู่ระบบจัดการอู่</h2>
                        <p>"ระบบจัดการอู่ SITTHA GARAGE เป็นโซลูชันที่ออกแบบมาเพื่อช่วยให้เจ้าของอู่และช่างสามารถบริหารจัดการงานซ่อมและควบคุมสต็อกอะไหล่ได้อย่างมีประสิทธิภาพ’ll love it too... I guarantee it."</p>
                        <p><strong>Patrick Kelly, Founder</strong></p>
                    </div>

                    <!-- Right section (Register form) -->
                    <div class="col-md-6 right-section">
                        <h3>Register</h3>

                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <!-- ชื่อ -->
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="First and last name" required>
                            </div>

                            <!-- อีเมล -->
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username (4-20 characters)" required>
                            </div>

                            <!-- รหัสผ่าน -->
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="Password" required>
                            </div>

                            <!-- ยืนยันรหัสผ่าน -->
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" minlength="6" required>
                            </div>

                            <!-- บทบาท -->
                            <div class="mb-3">
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Select role</option>
                                    <option value="แอดมิน">แอดมิน</option>
                                    <option value="พนักงานคลังอะไหล่">พนักงานคลังอะไหล่</option>
                                    <option value="เจ้าของอู่">เจ้าของอู่</option>
                                </select>
                            </div>

                            <!-- ปุ่มสมัครสมาชิก -->
                            <button type="submit" class="btn btn-primary">Create my account</button>

                            <!-- ลิงก์เข้าสู่ระบบ -->
                            <div class="login-link">
                                <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
