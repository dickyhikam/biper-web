@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Booking</h4>
        <p class="text-muted small mb-0">Kelola semua jadwal perawatan masuk.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-white border shadow-sm"><i class="fas fa-file-export me-2"></i>Export Excel</button>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Booking Manual</button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Cari ID Booking / Nama...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary w-100">Filter</button>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-custom align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID Booking</th>
                        <th>Pelanggan (Ibu & Anak)</th>
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 fw-bold">#BIP-8821</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Sarah&background=random" class="avatar-sm">
                                <div>
                                    <h6 class="mb-0 fw-bold small">Bunda Sarah</h6>
                                    <small class="text-muted" style="font-size:11px;">Anak: Arkan</small>
                                </div>
                            </div>
                        </td>
                        <td>Baby Spa Complete</td>
                        <td>
                            <div class="fw-bold text-dark">12 Okt 2024</div>
                            <small class="text-muted">10:00 - 11:30</small>
                        </td>
                        <td><span class="badge bg-soft-warning text-warning border border-warning rounded-pill">Pending</span></td>
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-check text-success me-2"></i>Konfirmasi</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye text-primary me-2"></i>Detail</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-times me-2"></i>Batalkan</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="ps-4 fw-bold">#BIP-8822</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Rini&background=random" class="avatar-sm">
                                <div>
                                    <h6 class="mb-0 fw-bold small">Bunda Rini</h6>
                                    <small class="text-muted" style="font-size:11px;">Anak: Mikha</small>
                                </div>
                            </div>
                        </td>
                        <td>Home Care</td>
                        <td>
                            <div class="fw-bold text-dark">12 Okt 2024</div>
                            <small class="text-muted">13:00 - 15:00</small>
                        </td>
                        <td><span class="badge bg-soft-success text-success border border-success rounded-pill">Confirmed</span></td>
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-check-double text-primary me-2"></i>Selesai</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye text-primary me-2"></i>Detail</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3">
        <nav>
            <ul class="pagination justify-content-end mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

@endsection