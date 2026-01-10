@extends('layouts.admin')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div>
                <h6 class="text-muted small text-uppercase mb-1">Booking Hari Ini</h6>
                <h3 class="fw-bold mb-0">12</h3>
            </div>
            <div class="icon-stat bg-soft-warning text-warning">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div>
                <h6 class="text-muted small text-uppercase mb-1">Total Member</h6>
                <h3 class="fw-bold mb-0">842</h3>
            </div>
            <div class="icon-stat bg-soft-success text-success">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div>
                <h6 class="text-muted small text-uppercase mb-1">Pendapatan (Bln)</h6>
                <h3 class="fw-bold mb-0">15jt</h3>
            </div>
            <div class="icon-stat" style="background:#eefbfd; color:#55c2da;">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div>
                <h6 class="text-muted small text-uppercase mb-1">Perlu Konfirmasi</h6>
                <h3 class="fw-bold mb-0 text-danger">3</h3>
            </div>
            <div class="icon-stat bg-soft-danger text-danger">
                <i class="fas fa-exclamation-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Booking Terbaru</h6>
                <a href="#" class="btn btn-sm btn-light text-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Pelanggan</th>
                                <th>Layanan</th>
                                <th>Tanggal & Jam</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-0">
                                            <h6 class="mb-0 fw-bold small">Bunda Sarah</h6>
                                            <small class="text-muted" style="font-size:11px;">Anak: Arkan</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Baby Spa Complete</td>
                                <td>
                                    <div class="small fw-bold">12 Okt</div>
                                    <small class="text-muted">10:00 WIB</small>
                                </td>
                                <td><span class="status-badge bg-soft-warning">Pending</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-success rounded-circle" title="Terima"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle" title="Tolak"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-0">
                                            <h6 class="mb-0 fw-bold small">Bunda Rini</h6>
                                            <small class="text-muted" style="font-size:11px;">Anak: Mikha</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Home Care</td>
                                <td>
                                    <div class="small fw-bold">12 Okt</div>
                                    <small class="text-muted">13:00 WIB</small>
                                </td>
                                <td><span class="status-badge bg-soft-success">Confirmed</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-light border rounded-pill small">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-0">
                                            <h6 class="mb-0 fw-bold small">Bunda Tya</h6>
                                            <small class="text-muted" style="font-size:11px;">Anak: Jojo</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Baby Massage</td>
                                <td>
                                    <div class="small fw-bold">13 Okt</div>
                                    <small class="text-muted">09:00 WIB</small>
                                </td>
                                <td><span class="status-badge bg-soft-warning">Pending</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-success rounded-circle" title="Terima"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle" title="Tolak"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 fw-bold">Terapis Available Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="avatar-sm">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small fw-bold">Bd. Linda</h6>
                        <small class="text-muted" style="font-size:11px;">Shift Pagi (08.00 - 14.00)</small>
                    </div>
                    <span class="badge bg-success rounded-pill">Free</span>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/33.jpg" class="avatar-sm">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small fw-bold">Ns. Rani</h6>
                        <small class="text-muted" style="font-size:11px;">Shift Siang (12.00 - 18.00)</small>
                    </div>
                    <span class="badge bg-secondary rounded-pill">Busy</span>
                </div>
                <div class="d-flex align-items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar-sm">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small fw-bold">Bd. Sarah</h6>
                        <small class="text-muted" style="font-size:11px;">Home Care (Luar)</small>
                    </div>
                    <span class="badge bg-warning text-dark rounded-pill">On Road</span>
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-center pb-3">
                <a href="#" class="btn btn-outline-secondary w-100 rounded-pill btn-sm">Atur Jadwal</a>
            </div>
        </div>
    </div>
</div>

@endsection