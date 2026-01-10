@extends('landing-page')

@section('content')

<header class="page-header text-center">
    <div class="container">
        <h1 class="display-5">Menu Layanan</h1>
        <p class="lead opacity-75">Pilih Layanan terbaik untuk relaksasi Ibu & Buah Hati</p>
    </div>
</header>

<div class="container pb-5">

    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-baby-tab" data-bs-toggle="pill" data-bs-target="#pills-baby" type="button">Baby Treatment</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-mom-tab" data-bs-toggle="pill" data-bs-target="#pills-mom" type="button">Mom Care</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-package-tab" data-bs-toggle="pill" data-bs-target="#pills-package" type="button">Paket Hemat</button>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-baby" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-4 col-lg-3">
                    <div class="service-card d-flex flex-column">
                        <img src="https://images.unsplash.com/photo-1544126592-807ade215a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top rounded-top" alt="Baby Massage">
                        <div class="d-flex flex-column flex-grow-1 pt-3 text-start">
                            <h5>Baby Massage</h5>
                            <div class="service-meta"><i class="far fa-clock me-1"></i> 45 Menit</div>
                            <p class="small text-muted">Pijat seluruh tubuh untuk melancarkan peredaran darah & stimulasi motorik.</p>
                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-tag">Rp 100k</span>
                                </div>
                                <a href="{{ url('/booking') }}" class="btn btn-book-card">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="service-card d-flex flex-column">
                        <img src="https://images.unsplash.com/photo-1574482620266-b6b47c0b0a87?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top rounded-top" alt="Hydrotherapy">
                        <div class="d-flex flex-column flex-grow-1 pt-3 text-start">
                            <h5>Baby Hydrotherapy</h5>
                            <div class="service-meta"><i class="far fa-clock me-1"></i> 30 Menit</div>
                            <p class="small text-muted">Berenang dengan neck ring untuk melatih otot kaki dan relaksasi di air hangat.</p>
                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-tag">Rp 120k</span>
                                </div>
                                <a href="{{ url('/booking') }}" class="btn btn-book-card">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="service-card d-flex flex-column">
                        <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top rounded-top" alt="Pediatric">
                        <div class="d-flex flex-column flex-grow-1 pt-3 text-start">
                            <h5>Terapi Batuk Pilek</h5>
                            <div class="service-meta"><i class="far fa-clock me-1"></i> 45 Menit</div>
                            <p class="small text-muted">Pijat khusus area dada dan punggung serta terapi uap alami.</p>
                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-tag">Rp 110k</span>
                                </div>
                                <a href="{{ url('/booking') }}" class="btn btn-book-card">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-mom" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card d-flex flex-column">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top rounded-top" alt="Mom Massage">
                        <div class="d-flex flex-column flex-grow-1 pt-3 text-start">
                            <h5>Prenatal Massage (Hamil)</h5>
                            <div class="service-meta"><i class="far fa-clock me-1"></i> 60 Menit</div>
                            <p class="small text-muted">Mengurangi pegal punggung & kaki bengkak selama kehamilan.</p>
                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-tag">Rp 150k</span>
                                </div>
                                <a href="{{ url('/booking') }}" class="btn btn-book-card">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card d-flex flex-column">
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top rounded-top" alt="Lactation">
                        <div class="d-flex flex-column flex-grow-1 pt-3 text-start">
                            <h5>Pijat Laktasi (ASI)</h5>
                            <div class="service-meta"><i class="far fa-clock me-1"></i> 45 Menit</div>
                            <p class="small text-muted">Melancarkan sumbatan ASI dan perawatan payudara (Breast Care).</p>
                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-tag">Rp 130k</span>
                                </div>
                                <a href="{{ url('/booking') }}" class="btn btn-book-card">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-package" role="tabpanel">
            <div class="alert alert-info border-0 rounded-4 mb-4">
                <i class="fas fa-gift me-2"></i> <strong>Tips:</strong> Ambil paket bundling untuk harga lebih hemat hingga 20%!
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="service-card flex-row align-items-center p-2 text-start">
                        <div style="width: 120px; height: 120px; flex-shrink:0;">
                            <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=60" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="Bundle 1">
                        </div>
                        <div class="ps-3 flex-grow-1">
                            <h5 class="mb-1">Happy Baby Package</h5>
                            <small class="text-muted d-block mb-2">Massage + Hydrotherapy + Gym</small>
                            <div class="d-flex align-items-center mt-3">
                                <span class="price-tag me-3 fs-5">Rp 200k</span>
                                <s class="text-muted small me-auto">Rp 250k</s>
                                <a href="{{ url('/booking') }}" class="btn btn-sm btn-book-card px-3 w-auto">Pilih</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-card flex-row align-items-center p-2 text-start">
                        <div style="width: 120px; height: 120px; flex-shrink:0;">
                            <img src="https://images.unsplash.com/photo-1531983412531-1f49a365ffed?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=60" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="Bundle 2">
                        </div>
                        <div class="ps-3 flex-grow-1">
                            <h5 class="mb-1">Mom & Baby Bond</h5>
                            <small class="text-muted d-block mb-2">Baby Massage + Mom Postnatal Massage</small>
                            <div class="d-flex align-items-center mt-3">
                                <span class="price-tag me-3 fs-5">Rp 230k</span>
                                <s class="text-muted small me-auto">Rp 250k</s>
                                <a href="{{ url('/booking') }}" class="btn btn-sm btn-book-card px-3 w-auto">Pilih</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="price-table-section">
        <h4 class="mb-4 text-center">Daftar Harga Lengkap</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Layanan</th>
                        <th>Durasi</th>
                        <th class="text-end">Harga (Member)</th>
                        <th class="text-end">Harga (Normal)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Baby Massage</td>
                        <td>45 Min</td>
                        <td class="text-end text-success fw-bold">Rp 90k</td>
                        <td class="text-end">Rp 100k</td>
                    </tr>
                    <tr>
                        <td>Baby Hydrotherapy</td>
                        <td>30 Min</td>
                        <td class="text-end text-success fw-bold">Rp 108k</td>
                        <td class="text-end">Rp 120k</td>
                    </tr>
                    <tr>
                        <td>Prenatal Massage (Bumil)</td>
                        <td>60 Min</td>
                        <td class="text-end text-success fw-bold">Rp 135k</td>
                        <td class="text-end">Rp 150k</td>
                    </tr>
                    <tr>
                        <td>Home Care (Transport)</td>
                        <td>-</td>
                        <td class="text-end text-muted">Sesuai Jarak</td>
                        <td class="text-end">Mulai Rp 20k</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6281234567890" class="btn btn-reservasi btn-lg">
                <i class="fab fa-whatsapp me-2"></i> Tanya Admin
            </a>
        </div>
    </div>

</div>
@endsection