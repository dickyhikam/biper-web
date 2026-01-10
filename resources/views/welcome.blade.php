@extends('landing-page')

@section('content')

<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">Sentuhan Cinta untuk <span style="color:var(--primary-color)">Buah Hati</span> Anda</h1>
                <p class="hero-text">
                    Layanan Spa Bayi & Mom Care profesional dengan Bidan & Perawat tersertifikasi.
                    Hadirkan kenyamanan dan tumbuh kembang optimal untuk si kecil.
                </p>
                <div class="d-flex gap-3 justify-content-lg-start justify-content-center">
                    <a href="#layanan" class="btn btn-reservasi btn-lg">Lihat Layanan</a>
                    <a href="https://wa.me/6281234567890" class="btn btn-outline-secondary btn-lg" style="border-radius:50px;">Konsultasi Gratis</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Baby Spa Happy" class="img-fluid hero-img-blob">
            </div>
        </div>
    </div>
</section>

<section id="layanan" class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>Layanan Unggulan Kami</h2>
            <p>Perawatan menyeluruh untuk Ibu dan Bayi</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h4>Baby Spa & Massage</h4>
                    <p class="text-muted">Pijat relaksasi bayi untuk merangsang motorik, meningkatkan nafsu makan, dan tidur lebih nyenyak.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h4>Mom Treatment</h4>
                    <p class="text-muted">Pijat ibu hamil (prenatal) dan pasca melahirkan (postnatal) untuk mengurangi pegal dan stres.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box">
                        <i class="fas fa-home"></i>
                    </div>
                    <h4>Home Care Service</h4>
                    <p class="text-muted">Layanan panggil ke rumah (Home Visit). Bidan kami yang datang, Bunda dan Bayi tetap nyaman di rumah.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentang" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Professional Midwife" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="mb-4" style="color:var(--secondary-color)">Kenapa Memilih Biper?</h2>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                        <div><strong>Tenaga Medis Profesional</strong><br>Ditangani langsung oleh Bidan & Perawat bersertifikat (Certified Baby Spa).</div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                        <div><strong>Higienis & Aman</strong><br>Peralatan steril dan bahan alami yang aman untuk kulit bayi sensitif.</div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                        <div><strong>Pelayanan Ramah</strong><br>Pendekatan penuh kasih sayang seperti merawat buah hati sendiri.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="cta-section text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2>Siap Memanjakan Si Kecil?</h2>
                <p class="mb-4 text-white-50">Jadwalkan kunjungan Anda sekarang atau pesan layanan Home Care kami.</p>
                <a href="https://wa.me/6281234567890" class="btn btn-light btn-lg text-primary rounded-pill fw-bold">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Kami via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@endsection