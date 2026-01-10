@extends('landing-page')

@section('content')

<style>
    /* --- CSS Khusus Halaman Detail --- */
    :root {
        --bg-soft: #f4f7f6;
    }

    body {
        background-color: var(--bg-soft);
    }

    .detail-section {
        padding: 50px 0;
        min-height: 85vh;
    }

    /* TICKET CARD DESIGN */
    .ticket-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }

    /* Bagian Atas: Header Status */
    .ticket-header {
        padding: 25px;
        text-align: center;
        color: white;
        position: relative;
    }

    /* Status Color Variants */
    .status-confirmed {
        background: linear-gradient(135deg, #55c2da, #3eaec6);
    }

    /* Biru Teal */
    .status-pending {
        background: linear-gradient(135deg, #f39c12, #f1c40f);
    }

    /* Kuning/Orange */
    .status-cancelled {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    /* Merah */

    .booking-code {
        font-family: 'Courier New', monospace;
        letter-spacing: 2px;
        font-weight: 800;
        font-size: 1.5rem;
        margin-top: 10px;
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 8px;
        display: inline-block;
    }

    /* Bagian Tengah: Detail Info */
    .ticket-body {
        padding: 30px;
    }

    .info-group {
        margin-bottom: 20px;
    }

    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #999;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
    }

    .info-value i {
        width: 20px;
        color: var(--secondary-color);
    }

    /* Garis Putus-putus Pemisah */
    .ticket-divider {
        border-top: 2px dashed #eee;
        margin: 20px -30px;
        /* Melebar keluar padding */
        position: relative;
    }

    /* Efek "Sobekan Kertas" (Semi-circle) di pinggir */
    .ticket-divider::before,
    .ticket-divider::after {
        content: '';
        position: absolute;
        top: -10px;
        width: 20px;
        height: 20px;
        background-color: var(--bg-soft);
        /* Warna background body */
        border-radius: 50%;
    }

    .ticket-divider::before {
        left: -10px;
    }

    .ticket-divider::after {
        right: -10px;
    }

    /* Bagian Bawah: Total & QR */
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--secondary-color);
    }

    .qr-area {
        text-align: center;
        margin-top: 30px;
    }

    .qr-img {
        width: 120px;
        height: 120px;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 10px;
    }

    /* Action Buttons (Floating di mobile atau di bawah tiket) */
    .action-buttons {
        max-width: 600px;
        margin: 20px auto 0;
        display: flex;
        gap: 10px;
    }
</style>

<section class="detail-section">
    <div class="container">

        <div class="d-flex justify-content-center mb-4">
            <a href="{{ url('/riwayat') }}" class="text-decoration-none text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
            </a>
        </div>

        <div class="ticket-card">

            <div class="ticket-header status-confirmed">
                <div class="mb-1"><i class="fas fa-check-circle fa-2x"></i></div>
                <h5 class="fw-bold mb-2">Booking Terkonfirmasi</h5>
                <div class="booking-code">#BIP-8821</div>
            </div>

            <div class="ticket-body">

                <div class="text-center mb-4">
                    <h3 class="fw-bold mb-1" style="color:var(--primary-dark);">Baby Spa Complete</h3>
                    <p class="text-muted">Paket Lengkap (Massage + Swim + Gym)</p>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="info-label">Tanggal</div>
                        <div class="info-value"><i class="far fa-calendar-alt"></i> 12 Okt 2024</div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-label">Jam</div>
                        <div class="info-value"><i class="far fa-clock"></i> 10:00 WIB</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Lokasi</div>
                        <div class="info-value"><i class="fas fa-map-marker-alt"></i> Klinik Pusat</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Terapis</div>
                        <div class="info-value"><i class="fas fa-user-nurse"></i> Bd. Linda</div>
                    </div>
                </div>

                <div class="mt-4 p-3 rounded-3" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-baby fa-2x text-muted opacity-50"></i>
                        </div>
                        <div>
                            <div class="info-label mb-0">Data Anak</div>
                            <div class="fw-bold text-dark">Arkan (6 Bulan)</div>
                            <small class="text-muted">Keluhan: Sedikit batuk pilek</small>
                        </div>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <div class="price-section">
                    <div class="info-label mb-3">Rincian Pembayaran</div>

                    <div class="price-row">
                        <span class="text-muted">Baby Spa Complete</span>
                        <span>Rp 250.000</span>
                    </div>
                    <div class="price-row">
                        <span class="text-muted">Diskon Member (10%)</span>
                        <span class="text-success">-Rp 25.000</span>
                    </div>
                    <div class="price-row">
                        <span class="text-muted">Biaya Admin</span>
                        <span>Rp 0</span>
                    </div>

                    <div class="total-row">
                        <span>Total Bayar</span>
                        <span>Rp 225.000</span>
                    </div>

                    <div class="mt-2 text-end">
                        <span class="badge bg-light text-dark border"><i class="fas fa-wallet me-1"></i> Bayar di Kasir</span>
                    </div>
                </div>

                <div class="qr-area">
                    <p class="small text-muted mb-2">Tunjukkan QR Code ini saat kedatangan</p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BIP-8821" alt="QR Code" class="qr-img">
                </div>

            </div>
        </div>

        <div class="action-buttons">
            <a href="https://wa.me/6281234567890" class="btn btn-outline-success w-100 py-3 fw-bold rounded-4">
                <i class="fab fa-whatsapp me-2"></i> Hubungi Admin
            </a>
            <button class="btn btn-light w-100 py-3 fw-bold rounded-4 border" onclick="window.print()">
                <i class="fas fa-download me-2"></i> Simpan Tiket
            </button>
        </div>

    </div>
</section>

@endsection