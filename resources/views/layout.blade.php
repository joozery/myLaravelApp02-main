<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="32x32">


    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS App.css -->
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">


    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(to bottom, white, #4caf50);
            padding: 20px;
            color: black;
        }

        .sidebar img {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            height: auto;
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            margin: 10px 0;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: linear-gradient(to right, #a4ff7d, #0a8b24);
            color: white;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar .active {
            background-color: #4caf50;
            color: white;
        }

        .main-content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
                <h2 style="font-weight:bold; text-align:center
                ">ระบบจัดการอู่</h2>

                <!-- เพิ่มอะไหล่ -->
                <a href="{{ route('spare_parts.create') }}" class="active">
                    <i class="fas fa-plus-circle"></i> เพิ่มอะไหล่
                </a>

                <!-- ดูข้อมูลอะไหล่ -->
                <a href="{{ route('spare_parts.index') }}">
                    <i class="fas fa-car"></i> ดูข้อมูลอะไหล่
                </a>

                <!-- ฟอร์มการเบิกอะไหล่จากอู่ -->
                <a href="{{ route('withdraw_form') }}">
                    <i class="fas fa-clipboard-list"></i> ฟอร์มการเบิกของ
                </a>

                <!-- ดูประวัติการเบิกของและดูไฟล์ PDF -->
                <a href="{{ route('withdraw_history') }}">
                    <i class="fas fa-file"></i> ดูประวัติการเบิก
                </a>

                <!-- ปุ่ม Logout -->
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sparePartForm').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('image');
            const file = fileInput.files[0];

            if (file) {
                const sizeInMB = file.size / 1024 / 1024; // ขนาดไฟล์เป็น MB
                if (sizeInMB > 2) { // ถ้าไฟล์เกิน 2MB
                    event.preventDefault(); // หยุดการส่งฟอร์ม
                    document.getElementById('error-message').textContent = 'รูปภาพต้องมีขนาดไม่เกิน 2MB';
                    alert('รูปภาพต้องมีขนาดไม่เกิน 2MB');
                } else {
                    document.getElementById('error-message').textContent = ''; // เคลียร์ข้อความผิดพลาด
                }
            }
        });
    </script>
</body>

</html>