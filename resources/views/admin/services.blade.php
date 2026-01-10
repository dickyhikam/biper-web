@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Layanan & Harga</h4>
        <p class="text-muted small mb-0">Atur daftar menu perawatan.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        <i class="fas fa-plus me-2"></i>Tambah Layanan
    </button>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1544126592-807ade215a0b?ixlib=rb-4.0.3&w=500&q=80" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;" alt="Service">
                <span class="badge bg-primary position-absolute top-0 end-0 m-3">Baby</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">Baby Massage</h5>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted small mb-3">Pijat relaksasi seluruh tubuh bayi untuk merangsang motorik.</p>
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <div>
                        <small class="text-muted d-block">Harga</small>
                        <span class="fw-bold text-dark">Rp 100.000</span>
                    </div>
                    <div>
                        <small class="text-muted d-block text-end">Durasi</small>
                        <span class="fw-bold text-dark"><i class="far fa-clock me-1"></i> 45 Mnt</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?ixlib=rb-4.0.3&w=500&q=80" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;" alt="Service">
                <span class="badge bg-info position-absolute top-0 end-0 m-3">Mom</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">Prenatal Massage</h5>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted small mb-3">Pijat khusus ibu hamil untuk mengurangi pegal punggung.</p>
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <div>
                        <small class="text-muted d-block">Harga</small>
                        <span class="fw-bold text-dark">Rp 150.000</span>
                    </div>
                    <div>
                        <small class="text-muted d-block text-end">Durasi</small>
                        <span class="fw-bold text-dark"><i class="far fa-clock me-1"></i> 60 Mnt</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tambah Layanan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nama Layanan</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small text-muted">Kategori</label>
                            <select class="form-select">
                                <option>Baby Treatment</option>
                                <option>Mom Care</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small text-muted">Durasi (Menit)</label>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Harga (Rp)</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Deskripsi Singkat</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection