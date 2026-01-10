@extends('landing-page')

@section('content')

<style>
    /* --- CSS Authentication Page --- */
    :root {
        --primary-dark: #ff7aa2;
        --bg-soft: #fff9fb;
    }

    .auth-section {
        padding: 60px 0;
        background: linear-gradient(180deg, #fff 0%, var(--bg-soft) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .auth-card {
        background: #fff;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }

    /* Bagian Kiri (Visual) */
    .auth-visual {
        background: url('https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center center no-repeat;
        background-size: cover;
        position: relative;
        min-height: 500px;
        /* Sedikit lebih tinggi untuk akomodasi form panjang */
    }

    .auth-visual::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(85, 194, 218, 0.4), rgba(255, 158, 187, 0.9));
    }

    .visual-content {
        position: relative;
        z-index: 2;
        color: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        text-align: center;
    }

    /* Form Elements */
    .form-control {
        border-radius: 12px;
        padding: 12px;
        background-color: #fcfcfc;
        border: 1px solid #eee;
    }

    .form-control:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(85, 194, 218, 0.25);
    }

    .btn-auth {
        background: var(--primary-color);
        color: white;
        padding: 14px;
        border-radius: 50px;
        font-weight: 700;
        width: 100%;
        border: none;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(255, 158, 187, 0.4);
    }

    .btn-auth:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .auth-toggle-link {
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    /* Child Card Style (Kotak Data Anak) */
    .child-entry {
        background-color: #f8f9fa;
        border: 1px dashed #ccc;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    .btn-remove-child {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #ff6b6b;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-card">
                    <div class="row g-0">

                        <div class="col-lg-5 auth-visual d-none d-lg-block">
                            <div class="visual-content">
                                <h3 class="fw-bold mb-3">Satu Akun untuk Semua Buah Hati</h3>
                                <p class="mb-4 opacity-90">"Punya anak kembar atau kakak beradik? Daftarkan semuanya dalam satu akun Bunda."</p>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                        <i class="fas fa-users text-warning"></i>
                                    </div>
                                    <div class="text-start">
                                        <small class="d-block fw-bold lh-1">Multi-Profile</small>
                                        <small style="font-size: 10px;">Kelola banyak anak</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 bg-white p-4 p-md-5 d-flex align-items-center">

                            <div id="login-box" class="w-100 fade-in">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold" style="color:var(--secondary-color)">Masuk Member</h2>
                                    <p class="text-muted small">Kelola jadwal spa kakak & adik disini.</p>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">No. WhatsApp</label>
                                        <input type="text" class="form-control" placeholder="0812...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password / PIN</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0" id="passwordInput" placeholder="Password">
                                            <span class="input-group-text bg-white border-start-0 text-muted">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-auth mb-4" onclick="alert('Login Berhasil!')">Masuk Sekarang</button>
                                    <div class="text-center border-top pt-3">
                                        <p class="text-muted small mb-0">Belum punya akun? <span onclick="switchForm('register')" class="auth-toggle-link">Daftar Akun Baru</span></p>
                                    </div>
                                </form>
                            </div>

                            <div id="register-box" class="w-100 fade-in d-none">
                                <div class="text-center mb-3">
                                    <h2 class="fw-bold" style="color:var(--secondary-color)">Daftar Keluarga</h2>
                                    <p class="text-muted small">Isi data Bunda sekali, data anak bisa banyak.</p>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Nama Bunda</label>
                                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small"> Alamat Bunda</label>
                                        <input type="text" class="form-control" placeholder="Alamat Lengkap">
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label text-muted small">WhatsApp</label>
                                            <input type="tel" class="form-control" placeholder="08...">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Buat Password / PIN</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control border-end-0" id="passwordInput" placeholder="Minimal 6 karakter">
                                                <span class="input-group-text bg-white border-start-0 text-muted">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-3">

                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label text-primary fw-bold small mb-0"><i class="fas fa-baby me-1"></i> Data Buah Hati</label>
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="addChildRow()">
                                            <i class="fas fa-plus me-1"></i> Tambah Anak
                                        </button>
                                    </div>

                                    <div id="children-container">
                                        <div class="child-entry" id="child-row-1">
                                            <div class="row">
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Nama Anak 1">
                                                </div>
                                                <div class="col-5">
                                                    <input type="date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <small class="text-muted d-block mb-3" style="font-size:11px;">*Klik "Tambah Anak" jika Bunda memiliki anak kembar/lebih dari satu.</small>

                                    <button type="button" class="btn btn-auth mb-3" onclick="alert('Pendaftaran Keluarga Berhasil!')">Daftar Sekarang</button>

                                    <div class="text-center border-top pt-3">
                                        <p class="text-muted small mb-0">Sudah punya akun? <span onclick="switchForm('login')" class="auth-toggle-link">Masuk Disini</span></p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // 1. Switch Login <-> Register
    function switchForm(target) {
        const loginBox = document.getElementById('login-box');
        const registerBox = document.getElementById('register-box');

        if (target === 'register') {
            loginBox.classList.add('d-none');
            registerBox.classList.remove('d-none');
        } else {
            registerBox.classList.add('d-none');
            loginBox.classList.remove('d-none');
        }
    }

    // 2. Logic Tambah Anak (Dynamic Form)
    let childCount = 1;

    function addChildRow() {
        childCount++;
        const container = document.getElementById('children-container');

        // Buat elemen div baru
        const newRow = document.createElement('div');
        newRow.className = 'child-entry fade-in';
        newRow.id = 'child-row-' + childCount;

        // Isi HTML (Input Nama & Tanggal Lahir + Tombol Hapus)
        newRow.innerHTML = `
            <button type="button" class="btn-remove-child" onclick="removeChildRow(${childCount})">
                <i class="fas fa-times"></i>
            </button>
            <div class="row">
                <div class="col-7">
                    <input type="text" class="form-control form-control-sm" placeholder="Nama Anak ${childCount}">
                </div>
                <div class="col-5">
                    <input type="date" class="form-control form-control-sm">
                </div>
            </div>
        `;

        // Masukkan ke dalam container
        container.appendChild(newRow);
    }

    // 3. Logic Hapus Anak
    function removeChildRow(id) {
        const row = document.getElementById('child-row-' + id);
        if (row) {
            row.remove();
        }
    }
</script>

@endsection