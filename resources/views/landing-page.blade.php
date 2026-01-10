<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biper Baby Spa - Perawatan Terbaik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- VARIABEL WARNA --- */
        :root {
            --primary-color: #FF9ebb;
            /* Soft Pink */
            --primary-hover: #ff85a9;
            --secondary-color: #55c2da;
            /* Calming Teal */
            --accent-color: #fff9eb;
            --text-dark: #333;
            --text-light: #777;
            --bg-light: #fdfdfd;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
        }

        /* --- NAVBAR MODERN (Dari Request Anda) --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 1.6rem;
            color: var(--secondary-color) !important;
            font-weight: 800;
        }

        .navbar-brand span {
            color: var(--primary-color);
        }

        .nav-item .nav-link {
            font-weight: 500;
            color: #555;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-item .nav-link:hover,
        .nav-item .nav-link.active {
            color: var(--primary-color);
        }

        /* Tombol Booking Nav */
        .btn-booking-nav {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 158, 187, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        .btn-booking-nav:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 158, 187, 0.6);
        }

        /* --- STYLE UNTUK KONTEN (HERO, SERVICE, ETC) --- */
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ffffff 100%);
            padding: 100px 0 60px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 3.5rem;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .hero-img-blob {
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Hero */
        .btn-reservasi {
            background-color: var(--primary-color);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-reservasi:hover {
            background-color: #ff85a9;
            color: white;
            transform: translateY(-2px);
        }

        /* Service Cards */
        .service-card {
            border: none;
            border-radius: 20px;
            background: #fff;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: var(--secondary-color);
            font-size: 2rem;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            color: var(--secondary-color);
            font-size: 2.5rem;
        }

        /* CTA Section */
        .cta-section {
            background-color: var(--secondary-color);
            color: white;
            padding: 60px 0;
            border-radius: 20px;
            margin-top: 50px;
        }

        .cta-section h2 {
            color: white;
        }

        /* Footer */
        footer {
            background-color: #f8f9fa;
            padding-top: 60px;
            margin-top: 80px;
        }

        .footer-brand {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--secondary-color);
        }

        .footer-brand span {
            color: var(--primary-color);
        }

        /* --- TAMBAHAN CSS UNTUK HALAMAN LAYANAN --- */

        /* Page Header (Background Biru di atas) */
        .page-header {
            background: linear-gradient(135deg, var(--secondary-color), #3eaec6);
            color: white;
            padding: 60px 0;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            margin-bottom: 40px;
        }

        /* Nav Pills (Tombol Tab Kategori) */
        .nav-pills .nav-link {
            background-color: white;
            color: var(--text-dark);
            border: 1px solid #eee;
            margin: 0 5px;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(255, 158, 187, 0.4);
        }

        /* Card Styles Khusus Layanan */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .price-tag {
            color: var(--secondary-color);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .service-meta {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        /* Tombol Booking di Card */
        .btn-book-card {
            background-color: var(--bg-light);
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
            padding: 8px 0;
        }

        .btn-book-card:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Price Table Section */
        .price-table-section {
            background-color: white;
            border-radius: 20px;
            padding: 40px;
            margin-top: 60px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.03);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-section {
                padding: 60px 0 40px 0;
                text-align: center;
            }

            .hero-img-blob {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-baby-carriage me-2"></i>Biper <span>Spa</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pageLayanan') }}">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pageAbout') }}">Tentang</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ url('/booking') }}" class="btn btn-booking-nav">
                            Booking Online <i class="fas fa-arrow-right ms-2 small"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container pb-4">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-brand mb-3">Biper <span>Spa Bayi</span></div>
                    <p class="text-muted small">Mitra kesehatan dan kebahagiaan untuk Ibu dan Buah Hati. Melayani dengan hati dan profesionalisme medis.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Jam Operasional</h5>
                    <ul class="list-unstyled text-muted small">
                        <li>Senin - Sabtu: 08.00 - 17.00</li>
                        <li>Minggu: Dengan Perjanjian</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Surabaya, Indonesia</li>
                        <li><i class="fas fa-phone me-2"></i> 0812-3456-7890</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted small">&copy; 2024 Biper Baby Spa. All Rights Reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>