@extends('landing-page')

@section('content')

<style>
    /* Style Khusus Halaman Sukses */
    :root {
        --bg-soft: #fff9fb;
    }

    .success-section {
        min-height: 80vh;
        /* Hampir full screen */
        background: linear-gradient(180deg, #fff 0%, var(--bg-soft) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-card {
        background: white;
        border-radius: 30px;
        padding: 50px 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        text-align: center;
        max-width: 500px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    /* Animasi Centang */
    .check-icon-wrapper {
        width: 100px;
        height: 100px;
        background: #e0f8e9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        position: relative;
    }

    .check-icon {
        font-size: 50px;
        color: #2ecc71;
        animation: scaleUp 0.5s ease-out;
    }

    @keyframes scaleUp {
        0% {
            transform: scale(0);
        }

        80% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Dekorasi Confetti (Opsional / Background) */
    .decoration-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 0;
        opacity: 0.1;
    }

    .dec-1 {
        width: 150px;
        height: 150px;
        background: var(--primary-color);
        top: -50px;
        left: -50px;
    }

    .dec-2 {
        width: 100px;
        height: 100px;
        background: var(--secondary-color);
        bottom: -30px;
        right: -30px;
    }

    .btn-home {
        background: var(--secondary-color);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-home:hover {
        background: #3eaec6;
        color: white;
        transform: translateY(-2px);
    }

    .btn-wa {
        border: 2px solid #25D366;
        color: #25D366;
        background: transparent;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-wa:hover {
        background: #25D366;
        color: white;
    }
</style>

<section class="success-section">
    <div class="container d-flex justify-content-center">

        <div class="success-card">
            <div class="decoration-circle dec-1"></div>
            <div class="decoration-circle dec-2"></div>

            <div class="position-relative z-1">
                <div class="check-icon-wrapper">
                    <i class="fas fa-check check-icon"></i>
                </div>

                <h2 class="mb-3" style="font-family: 'Quicksand', sans-serif; font-weight: 700; color: #333;">Booking Berhasil!</h2>

                <p class="text-muted mb-4">
                    Terima kasih Bunda, jadwal perawatan si kecil telah kami terima.
                    Admin kami akan segera menghubungi via WhatsApp untuk konfirmasi jam kedatangan.
                </p>

                <div class="bg-light p-3 rounded-4 mb-4 text-start small text-muted">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Kode Booking:</span>
                        <span class="fw-bold text-dark">#BIP8821</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Status:</span>
                        <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
                    <a href="https://wa.me/6281234567890" class="btn-wa w-100">
                        <i class="fab fa-whatsapp me-2"></i> Chat Admin Sekarang
                    </a>
                    <a href="{{ url('/') }}" class="btn-home w-100">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection