<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Biper Spa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
        }

        .brand-logo {
            color: #55c2da;
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 30px;
            display: block;
            text-align: center;
            text-decoration: none;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            background: #f8f9fa;
            border: 1px solid #eee;
        }

        .btn-primary {
            background: #55c2da;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
        }

        .btn-primary:hover {
            background: #3eaec6;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <a href="#" class="brand-logo">Biper Admin</a>

        <h5 class="fw-bold mb-1">Selamat Datang Kembali</h5>
        <p class="text-muted small mb-4">Silakan login untuk mengelola dashboard.</p>

        <form>
            <div class="mb-3">
                <label class="form-label small text-muted">Email Address</label>
                <input type="email" class="form-control" placeholder="admin@biperspa.com">
            </div>
            <div class="mb-4">
                <label class="form-label small text-muted">Password</label>
                <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <a href="{{ route('pageAdminDashboard') }}" class="btn btn-primary">Login Dashboard</a>
        </form>

        <div class="text-center mt-4">
            <a href="#" class="text-muted small text-decoration-none">Lupa Password? Hubungi IT Support.</a>
        </div>
    </div>

</body>

</html>