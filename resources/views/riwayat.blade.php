@extends('landing-page')

@section('content')

<style>
    :root {
        --bg-soft: #f8f9fa;
    }

    body {
        background-color: var(--bg-soft);
    }

    /* Header Profile Singkat */
    .profile-header {
        background: white;
        padding: 40px 0 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 30px;
    }

    .avatar-circle {
        width: 80px;
        height: 80px;
        background: var(--primary-color);
        color: white;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 20px;
        border: 4px solid #fff9fb;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Tabs Styling */
    .nav-pills-custom .nav-link {
        color: #777;
        background: white;
        border: 1px solid #eee;
        margin-right: 10px;
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 600;
        transition: 0.3s;
    }

    .nav-pills-custom .nav-link.active {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
        box-shadow: 0 4px 10px rgba(85, 194, 218, 0.3);
    }

    /* Booking Card Item */
    .booking-item {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #eee;
        transition: 0.3s;
        position: relative;
        overflow: hidden;
    }

    .booking-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        border-color: var(--primary-color);
    }

    /* Garis warna di kiri kartu untuk penanda status */
    .booking-item.status-pending {
        border-left: 5px solid #ffc107;
    }

    .booking-item.status-confirmed {
        border-left: 5px solid #2ecc71;
    }

    .booking-item.status-completed {
        border-left: 5px solid #95a5a6;
    }

    /* Date Box UI */
    .date-box {
        background: var(--bg-soft);
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        min-width: 80px;
    }

    .date-day {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
        color: var(--secondary-color);
    }

    .date-month {
        font-size: 0.8rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #777;
    }

    /* Badges */
    .badge-status {
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .bg-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .bg-confirmed {
        background-color: #d4edda;
        color: #155724;
    }

    .bg-completed {
        background-color: #e2e3e5;
        color: #383d41;
    }
</style>

<div class="profile-header">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="avatar-circle">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h4 class="mb-1 fw-bold">Halo, Bunda Sarah!</h4>
                <p class="text-muted mb-0 small"><i class="fas fa-crown text-warning me-1"></i> Member ID: BIP-8821 • Poin: <strong>150</strong></p>
            </div>
            <div class="ms-auto d-none d-md-block">
                <a href="{{ url('/booking') }}" class="btn btn-outline-primary rounded-pill btn-sm">
                    <i class="fas fa-plus me-1"></i> Booking Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">

    <ul class="nav nav-pills nav-pills-custom mb-4" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button">
                Akan Datang (2)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button">
                Riwayat Selesai
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel">

            <div class="booking-item status-pending">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="date-box">
                            <div class="date-day">25</div>
                            <div class="date-month">JAN</div>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="mb-1 fw-bold">Baby Spa Complete</h5>
                        <p class="mb-1 text-muted small"><i class="fas fa-baby me-1"></i> Anak: <strong>Arkan (6 Bulan)</strong></p>
                        <p class="mb-0 text-muted small"><i class="far fa-clock me-1"></i> 10:00 WIB • Terapis: Bd. Linda</p>
                    </div>
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        <span class="badge-status bg-pending mb-2 d-inline-block">Menunggu Konfirmasi</span>
                        <br>
                        <a href="#" class="text-decoration-none small text-danger fw-bold">Batalkan?</a>
                    </div>
                </div>
            </div>

            <div class="booking-item status-confirmed">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="date-box">
                            <div class="date-day">02</div>
                            <div class="date-month">FEB</div>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="mb-1 fw-bold">Home Care (Panggil Rumah)</h5>
                        <p class="mb-1 text-muted small"><i class="fas fa-baby me-1"></i> Anak: <strong>Arkan & Mikha</strong></p>
                        <p class="mb-0 text-muted small"><i class="far fa-clock me-1"></i> 09:00 WIB • Terapis: Ns. Rani</p>
                    </div>
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        <span class="badge-status bg-confirmed mb-2 d-inline-block"><i class="fas fa-check me-1"></i> Terkonfirmasi</span>
                        <br>
                        <a href="https://wa.me/6281234567890" class="btn btn-sm btn-outline-success rounded-pill px-3">
                            <i class="fab fa-whatsapp"></i> Chat Admin
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="pills-history" role="tabpanel">

            <div class="booking-item status-completed">
                <div class="row align-items-center opacity-75">
                    <div class="col-auto">
                        <div class="date-box bg-light">
                            <div class="date-day text-muted">10</div>
                            <div class="date-month">DES</div>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="mb-1 fw-bold">Baby Massage</h5>
                        <p class="mb-1 text-muted small">Anak: Arkan</p>
                        <span class="text-success small"><i class="fas fa-star"></i> Selesai & Mendapat Poin</span>
                    </div>
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        <span class="badge-status bg-completed">Selesai</span>
                        <div class="mt-2">
                            <a href="#" class="btn btn-sm btn-light border rounded-pill">Booking Lagi</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection