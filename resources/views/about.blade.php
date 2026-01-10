@extends('landing-page')

@section('content')

<style>
    /* Header Gradient (Konsisten dengan halaman Layanan) */
    .page-header {
        background: linear-gradient(135deg, var(--secondary-color), #3eaec6);
        color: white;
        padding: 80px 0;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi Background Header */
    .page-header::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    /* Team Card Styles */
    .team-card {
        border: none;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: 0.3s;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        text-align: center;
        padding: 30px 20px;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(85, 194, 218, 0.15);
    }

    .team-img-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        border-radius: 50%;
        padding: 5px;
        border: 2px dashed var(--primary-color);
    }

    .team-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .badge-medis {
        background-color: #eefbfd;
        color: var(--secondary-color);
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 10px;
    }

    /* Stats Section */
    .stats-section {
        background-color: var(--primary-color);
        background-image: linear-gradient(45deg, var(--primary-color), #ffb7ce);
        color: white;
        border-radius: 30px;
        padding: 50px;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0;
        font-family: 'Quicksand', sans-serif;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Gallery Grid */
    .gallery-img {
        border-radius: 15px;
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: 0.3s;
        cursor: pointer;
    }

    .gallery-img:hover {
        transform: scale(1.03);
        filter: brightness(0.9);
    }
</style>

<header class="page-header text-center">
    <div class="container position-relative z-1">
        <h1 class="display-5 mb-3">Tentang Biper Spa</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">
            Kami percaya setiap sentuhan adalah bentuk komunikasi cinta antara orang tua dan buah hati.
        </p>
    </div>
</header>

<section class="container mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bidan Professional" class="img-fluid rounded-4 shadow-lg">
                <div class="position-absolute bg-white p-3 rounded-4 shadow d-none d-md-block" style="bottom: -20px; right: -20px; max-width: 200px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-certificate text-warning fs-1 me-3"></i>
                        <small class="fw-bold text-dark lh-sm">Certified Baby Spa Therapist</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-5">
            <h5 class="text-uppercase text-muted small fw-bold spacing-1 mb-3">Cerita Kami</h5>
            <h2 class="mb-4" style="color:var(--secondary-color)">Lebih dari Sekadar Spa, Ini Tentang Tumbuh Kembang</h2>
            <p class="text-secondary">
                Biper Baby Spa didirikan pada tahun 2019 oleh Bidan [Nama Pendiri], berawal dari keprihatinan akan kurangnya layanan perawatan bayi yang menggabungkan <strong>standar medis</strong> dengan <strong>kenyamanan rumah</strong>.
            </p>
            <p class="text-secondary mb-4">
                Kami bukan sekadar tempat pijat bayi. Kami adalah mitra orang tua dalam memantau motorik kasar & halus si kecil. Seluruh terapis kami berlatar belakang kesehatan (Bidan & Perawat) yang telah tersertifikasi khusus dalam *Pediatric Massage*.
            </p>
            <div class="d-flex gap-4">
                <div>
                    <i class="fas fa-check-circle text-success mb-2 fs-4"></i>
                    <h6 class="fw-bold">Higenis</h6>
                </div>
                <div>
                    <i class="fas fa-heart text-danger mb-2 fs-4"></i>
                    <h6 class="fw-bold">Penuh Cinta</h6>
                </div>
                <div>
                    <i class="fas fa-user-nurse text-primary mb-2 fs-4"></i>
                    <h6 class="fw-bold">Medis</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="stats-section shadow">
        <div class="row text-center g-4">
            <div class="col-md-4 border-end border-white border-opacity-25">
                <div class="stat-number">5+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
            <div class="col-md-4 border-end border-white border-opacity-25">
                <div class="stat-number">2.5k</div>
                <div class="stat-label">Bayi Bahagia</div>
            </div>
            <div class="col-md-4">
                <div class="stat-number">10+</div>
                <div class="stat-label">Terapis Medis</div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light py-5 mb-5">
    <div class="container">
        <div class="section-title mb-5">
            <h2>Tim Medis Kami</h2>
            <p>Ditangani langsung oleh Bidan & Perawat Profesional</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="team-img" alt="Bidan">
                    </div>
                    <span class="badge-medis">Senior Midwife</span>
                    <h5>Bd. Sarah, S.Keb</h5>
                    <p class="small text-muted mb-0">Spesialis Prenatal Yoga & Baby Gym</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="team-img" alt="Perawat">
                    </div>
                    <span class="badge-medis">Pediatric Nurse</span>
                    <h5>Ns. Rani, S.Kep</h5>
                    <p class="small text-muted mb-0">Spesialis Terapi Batuk Pilek</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="https://randomuser.me/api/portraits/women/33.jpg" class="team-img" alt="Terapis">
                    </div>
                    <span class="badge-medis">Certified Therapist</span>
                    <h5>Bd. Linda, A.Md.Keb</h5>
                    <p class="small text-muted mb-0">Spesialis Baby Massage</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="section-title mb-4">
        <h2>Fasilitas Kami</h2>
        <p>Ruangan bersih, steril, dan nyaman untuk Ibu & Bayi</p>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Kolam Renang Bayi" class="gallery-img">
        </div>
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Ruang Pijat" class="gallery-img">
        </div>
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Ruang Tunggu" class="gallery-img">
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="row align-items-center bg-white border rounded-4 overflow-hidden shadow-sm">
        <div class="col-lg-6 p-5">
            <h3 class="mb-3">Kunjungi Kami</h3>
            <p class="text-muted mb-4">Kami berlokasi di pusat kota dengan akses parkir yang luas dan nyaman.</p>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i> Jl. Mawar Indah No. 12, Surabaya</li>
                <li class="mb-2"><i class="fas fa-envelope text-primary me-2"></i> hello@biperspa.com</li>
                <li><i class="fas fa-clock text-warning me-2"></i> Buka Setiap Hari (08.00 - 17.00)</li>
            </ul>
            <a href="https://wa.me/6281234567890" class="btn btn-reservasi">Reservasi Tempat</a>
        </div>
        <div class="col-lg-6 p-0">
            <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid w-100 h-100 object-fit-cover" alt="Map Location" style="min-height: 300px;">
        </div>
    </div>
</section>

@endsection