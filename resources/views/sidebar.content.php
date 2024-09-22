<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #4a47a3;
            padding: 20px;
            color: white;
        }

        .sidebar a, .sidebar button {
            color: white;
            text-decoration: none;
            margin: 10px 0;
            display: block;
        }

        .sidebar button {
            background-color: #dc3545;
            border: none;
            padding: 10px;
            width: 100%;
            text-align: left;
            color: white;
            font-size: 1rem;
            cursor: pointer;
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
                <h2 class="text-center">Dashboard</h2>

                <!-- เพิ่มอะไหล่ -->
                <a href="{{ url('/spare-parts/create') }}" class="btn btn-danger">เพิ่มอะไหล่</a>

                <!-- ดูข้อมูลอะไหล่รถ -->
                <a href="{{ url('/spare-parts') }}" class="btn btn-warning">ดูข้อมูลอะไหล่รถ</a>

                <!-- ปุ่ม Logout -->
                <form action="{{ route('logout') }}" method="POST" class="w-100 mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                <div class="row">
                    <!-- Sales Summary Cards -->
                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Today's Sales</h5>
                            <h2>$1k</h2>
                            <p>+8% from yesterday</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Total Orders</h5>
                            <h2>300</h2>
                            <p>+5% from yesterday</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>Product Sold</h5>
                            <h2>50</h2>
                            <p>+1.2% from yesterday</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-3">
                            <h5>New Customers</h5>
                            <h2>8</h2>
                            <p>+0.5% from yesterday</p>
                        </div>
                    </div>
                </div>

                <!-- Charts (Example with Chart.js) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <h5>Total Revenue</h5>
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card p-3">
                            <h5>Customer Satisfaction</h5>
                            <canvas id="satisfactionChart"></canvas>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example data for Chart.js
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Online Sales',
                    data: [12000, 19000, 30000, 5000, 20000, 30000, 40000],
                    backgroundColor: '#36a2eb'
                }, {
                    label: 'Offline Sales',
                    data: [5000, 7000, 20000, 15000, 10000, 20000, 30000],
                    backgroundColor: '#ff6384'
                }]
            },
        });

        const ctxSatisfaction = document.getElementById('satisfactionChart').getContext('2d');
        const satisfactionChart = new Chart(ctxSatisfaction, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Satisfaction Level',
                    data: [3, 4, 5, 3, 4, 5],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: true
                }]
            },
        });
    </script>
</body>

</html>
