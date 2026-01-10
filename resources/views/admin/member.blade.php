@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Member</h4>
        <p class="text-muted small mb-0">Database pelanggan (Ibu & Bayi).</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-white border shadow-sm text-success"><i class="fas fa-file-excel me-2"></i>Export CSV</button>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Member Baru</button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Cari Nama Bunda / ID...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option>Urutkan Poin Tertinggi</option>
                    <option>Member Baru</option>
                    <option>Paling Sering Datang</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-custom align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Profil Bunda</th>
                        <th>Data Anak</th>
                        <th>Kontak</th>
                        <th>Statistik</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Sarah&background=ffe4e6&color=d63384" class="avatar-sm">
                                <div>
                                    <h6 class="mb-0 fw-bold small">Bunda Sarah</h6>
                                    <span class="badge bg-warning text-dark" style="font-size: 10px;"><i class="fas fa-crown me-1"></i>Gold</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small fw-bold">Arkan (6 Bln)</div>
                            <small class="text-muted">Lahir: 12 Feb 2024</small>
                        </td>
                        <td>
                            <div class="small"><i class="fab fa-whatsapp text-success me-1"></i> 0812-3456-7890</div>
                            <small class="text-muted">Surabaya Pusat</small>
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                <div>
                                    <small class="text-muted d-block" style="font-size:10px;">Poin</small>
                                    <span class="fw-bold text-primary">150</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:10px;">Visit</small>
                                    <span class="fw-bold text-dark">5x</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-soft-success text-success rounded-pill">Active</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light border" title="Lihat Detail"><i class="fas fa-eye text-primary"></i></button>
                            <button class="btn btn-sm btn-light border" title="Edit"><i class="fas fa-edit text-muted"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Rini&background=e0f2fe&color=0369a1" class="avatar-sm">
                                <div>
                                    <h6 class="mb-0 fw-bold small">Bunda Rini</h6>
                                    <span class="badge bg-secondary" style="font-size: 10px;">Silver</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small fw-bold">Mikha (1 Thn)</div>
                            <div class="small fw-bold">Jojo (3 Thn)</div>
                        </td>
                        <td>
                            <div class="small"><i class="fab fa-whatsapp text-success me-1"></i> 0819-9988-7766</div>
                            <small class="text-muted">Sidoarjo</small>
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                <div>
                                    <small class="text-muted d-block" style="font-size:10px;">Poin</small>
                                    <span class="fw-bold text-primary">45</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:10px;">Visit</small>
                                    <span class="fw-bold text-dark">2x</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-soft-success text-success rounded-pill">Active</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light border" title="Lihat Detail"><i class="fas fa-eye text-primary"></i></button>
                            <button class="btn btn-sm btn-light border" title="Edit"><i class="fas fa-edit text-muted"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3">
        <nav>
            <ul class="pagination justify-content-end mb-0 small">
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>
    </div>
</div>

@endsection