@extends('landing-page')

@section('content')

<style>
    /* Variabel Lokal */
    :root {
        --primary-dark: #ff7aa2;
        --gold-color: #d4af37;
        /* Warna Emas untuk Member */
        --bg-soft: #fff9fb;
    }

    /* Section Background */
    .booking-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #fff 0%, var(--bg-soft) 100%);
    }

    /* Card Utama */
    .booking-card {
        background: #fff;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #eee;
    }

    /* Tab Switcher Custom (Agar beda dengan halaman Layanan) */
    .nav-pills-booking .nav-link {
        color: #888;
        font-weight: 600;
        border-radius: 0;
        padding: 20px;
        background-color: #f8f9fa;
        border-bottom: 3px solid transparent;
        transition: 0.3s;
    }

    .nav-pills-booking .nav-link:hover {
        background-color: #f0f0f0;
    }

    .nav-pills-booking .nav-link.active {
        background-color: #fff;
        color: var(--secondary-color);
        border-bottom: 3px solid var(--secondary-color);
        border-top: none;
    }

    /* Form Styles */
    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #eee;
        background-color: #fcfcfc;
    }

    .form-control:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(85, 194, 218, 0.25);
    }

    /* Tombol Submit */
    .btn-submit {
        background: var(--secondary-color);
        color: white;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        border: none;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #3EA6BF;
        transform: translateY(-2px);
    }

    /* Visual Kartu Member (Sebelah Kiri) */
    .member-card-visual {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(255, 158, 187, 0.4);
    }

    .member-card-visual::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
    }

    .chip {
        width: 50px;
        height: 35px;
        background: linear-gradient(135deg, #ffd700, #b8860b);
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    /* List Keuntungan */
    .benefit-item i {
        width: 40px;
        height: 40px;
        background: #eefbfd;
        color: var(--secondary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 15px;
    }
</style>

<header class="text-center py-5">
    <div class="container">
        <h1 class="display-5 mb-3">Booking Perawatan <span style="color:var(--primary-color)">Si Kecil</span></h1>
        <p class="text-muted lead">Gabung menjadi <strong>Biper Mom's Member</strong> untuk dapatkan diskon prioritas & poin reward.</p>

        <button class="btn btn-outline-secondary rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-crown me-2 text-warning"></i>Sudah punya akun? Login Member
        </button>
    </div>
</header>

<section class="booking-section pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="booking-card">
                    <div class="row g-0">

                        <div class="col-md-5 bg-light p-4 d-flex flex-column justify-content-center align-items-center text-center border-end">
                            <div class="member-card-visual w-100 text-start mb-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="chip"></div>
                                    <i class="fas fa-spa fa-2x opacity-50"></i>
                                </div>
                                <h5 class="mb-0 mt-2">BIPER MEMBER</h5>
                                <small class="opacity-75">Mom's & Baby Club</small>
                                <div class="mt-4 font-monospace fs-5">0000 0000 0000</div>
                            </div>

                            <div class="text-start w-100">
                                <h6 class="fw-bold mb-3">Keuntungan Member:</h6>
                                <div class="benefit-item d-flex align-items-center mb-2">
                                    <i class="fas fa-percent"></i>
                                    <span>Diskon 10% setiap treatment</span>
                                </div>
                                <div class="benefit-item d-flex align-items-center mb-2">
                                    <i class="fas fa-gift"></i>
                                    <span>Poin Reward dapat ditukar</span>
                                </div>
                                <div class="benefit-item d-flex align-items-center">
                                    <i class="fas fa-user-md"></i>
                                    <span>Prioritas pilih Terapis</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <ul class="nav nav-pills-booking nav-fill mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-member-tab" data-bs-toggle="pill" data-bs-target="#pills-member" type="button">
                                        <i class="fas fa-user-check me-2"></i>Saya Member
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-guest-tab" data-bs-toggle="pill" data-bs-target="#pills-guest" type="button">
                                        <i class="fas fa-user me-2"></i>Tamu Baru
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content p-4 pt-0" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-member" role="tabpanel">
                                    <form>
                                        <div class="alert alert-info py-2 small border-0 bg-info-subtle mb-3">
                                            <i class="fas fa-info-circle me-1"></i> Masukkan ID/HP, data lain terisi otomatis.
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Nomor HP / ID Member</label>
                                            <input type="text" class="form-control" placeholder="Contoh: 08123456789">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Pilih Layanan</label>
                                            <select class="form-select">
                                                <option selected>Pilih Treatment...</option>
                                                <option>Baby Spa Complete (Rp 250k)</option>
                                                <option>Baby Massage (Rp 100k)</option>
                                                <option>Mom Massage (Rp 150k)</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label text-muted small">Tanggal & Jam</label>
                                            <input type="datetime-local" class="form-control">
                                        </div>
                                        <button type="button" class="btn-submit" onclick="window.location.href='{{ route('pageBookingSuccess') }}'">
                                            Booking Sekarang <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-guest" role="tabpanel">
                                    <form>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label text-muted small">Nama Ibu</label>
                                                <input type="text" class="form-control" placeholder="Nama Lengkap">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label text-muted small">Nama Bayi</label>
                                                <input type="text" class="form-control" placeholder="Nama Dedek">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Nomor WhatsApp</label>
                                            <input type="tel" class="form-control" placeholder="08...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Pilih Layanan</label>
                                            <select class="form-select">
                                                <option selected>Pilih Treatment...</option>
                                                <option>Baby Spa Complete</option>
                                                <option>Homecare (Panggil ke Rumah)</option>
                                            </select>
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label small text-muted" for="flexCheckDefault">
                                                Saya ingin mendaftar jadi member (Gratis)
                                            </label>
                                        </div>
                                        <button type="button" class="btn-submit" onclick="window.location.href='{{ route('pageBookingSuccess') }}'">
                                            Lanjut ke WhatsApp <i class="fab fa-whatsapp ms-2"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Login Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg" placeholder="Email / No. HP">
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control form-control-lg" placeholder="PIN / Password">
                    </div>
                    <button type="button" class="btn btn-submit mb-3">Masuk</button>
                    <p class="text-center text-muted small">Belum punya akun? <a href="{{ route('pageRegister') }}" class="text-decoration-none" style="color:var(--primary-color)">Daftar disini</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection