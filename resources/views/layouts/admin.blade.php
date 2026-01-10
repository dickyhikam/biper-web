<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Biper Spa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --admin-primary: #55c2da;
            /* Teal */
            --admin-dark: #34495e;
            --admin-bg: #f3f6f9;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--admin-bg);
            overflow-x: hidden;
        }

        /* SIDEBAR STYLE */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.03);
            z-index: 1000;
            transition: 0.3s;
        }

        .sidebar-header {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
        }

        .brand-logo {
            font-family: 'Quicksand', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--admin-primary);
            text-decoration: none;
        }

        .nav-link {
            padding: 15px 25px;
            color: #777;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #eefbfd;
            color: var(--admin-primary);
            border-right: 4px solid var(--admin-primary);
        }

        /* MAIN CONTENT STYLE */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: 0.3s;
        }

        /* TOPBAR STYLE */
        .topbar {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 30px;
        }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-stat {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Tables */
        .table-custom thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #999;
            font-weight: 600;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .table-custom tbody td {
            padding: 15px 10px;
            vertical-align: middle;
            color: #444;
            font-size: 0.95rem;
        }

        .avatar-sm {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        /* Status Badges */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .bg-soft-warning {
            background: #fff8dd;
            color: #f1c40f;
        }

        .bg-soft-success {
            background: #d1e7dd;
            color: #198754;
        }

        .bg-soft-danger {
            background: #f8d7da;
            color: #dc3545;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('pageAdminDashboard') }}" class="brand-logo"><i class="fas fa-baby-carriage me-2"></i>Biper Admin</a>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link active" href="{{ route('pageAdminDashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a>
            <a class="nav-link" href="{{ route('pageAdminBookings') }}"><i class="fas fa-calendar-check"></i> Data Booking <span class="badge bg-danger ms-auto rounded-pill">3</span></a>
            <a class="nav-link" href="{{ route('pageAdminMembers') }}"><i class="fas fa-users"></i> Data Member</a>
            <a class="nav-link" href="{{ route('pageAdminTerapis') }}"><i class="fas fa-user-nurse"></i> Terapis</a>
            <a class="nav-link" href="{{ route('pageAdminServices') }}"><i class="fas fa-spa"></i> Layanan & Harga</a>
            <a class="nav-link" href="{{ route('pageAdminLaporan') }}"><i class="fas fa-chart-line"></i> Laporan</a>
            <div class="mt-5 border-top pt-3">
                <a class="nav-link text-danger" href="{{ route('pageAdminLogin') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </div>

    <div class="main-content">

        <div class="topbar">
            <button class="btn btn-light d-lg-none" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
            <h5 class="m-0 fw-bold text-secondary d-none d-md-block">Overview</h5>

            <div class="d-flex align-items-center gap-3">
                <div class="position-relative cursor-pointer">
                    <i class="far fa-bell fs-5 text-secondary"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3 d-none d-md-block">
                        <small class="d-block fw-bold text-dark">Admin Sarah</small>
                        <small class="text-muted" style="font-size: 11px;">Super Admin</small>
                    </div>
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin" width="40" height="40" class="rounded-circle border">
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>

</html>