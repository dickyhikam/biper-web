@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Terapis</h4>
        <p class="text-muted small mb-0">Manajemen Bidan & Perawat.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTherapistModal">
        <i class="fas fa-user-plus me-2"></i>Tambah Terapis
    </button>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-success">
            <small class="text-muted">Total Terapis</small>
            <h4 class="fw-bold mb-0">12</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-primary">
            <small class="text-muted">Sedang Bertugas</small>
            <h4 class="fw-bold mb-0">5</h4>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-success rounded-pill">Available</span>
            </div>
            <div class="card-body p-4">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle border border-3 border-light shadow-sm mb-3" width="90" height="90">
                <h5 class="fw-bold mb-1">Bd. Sarah</h5>
                <p class="text-muted small mb-2">Senior Midwife</p>
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                    <span class="small ms-1 fw-bold">(4.8)</span>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                    <span class="badge bg-light text-secondary border">Baby Massage</span>
                    <span class="badge bg-light text-secondary border">Hydrotherapy</span>
                    <span class="badge bg-light text-secondary border">Gym</span>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill">Lihat Jadwal</button>
                    <button class="btn btn-sm btn-light text-muted"><i class="fas fa-cog me-1"></i> Edit Profil</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-warning text-dark rounded-pill">Busy</span>
            </div>
            <div class="card-body p-4">
                <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle border border-3 border-light shadow-sm mb-3" width="90" height="90">
                <h5 class="fw-bold mb-1">Ns. Rani</h5>
                <p class="text-muted small mb-2">Pediatric Nurse</p>
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <span class="small ms-1 fw-bold">(4.0)</span>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                    <span class="badge bg-light text-secondary border">Home Care</span>
                    <span class="badge bg-light text-secondary border">Flu Therapy</span>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill">Lihat Jadwal</button>
                    <button class="btn btn-sm btn-light text-muted"><i class="fas fa-cog me-1"></i> Edit Profil</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-secondary rounded-pill">Off Duty</span>
            </div>
            <div class="card-body p-4 opacity-75">
                <img src="https://randomuser.me/api/portraits/women/33.jpg" class="rounded-circle border border-3 border-light shadow-sm mb-3" width="90" height="90">
                <h5 class="fw-bold mb-1">Bd. Linda</h5>
                <p class="text-muted small mb-2">Junior Midwife</p>
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <span class="small ms-1 fw-bold">(5.0)</span>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                    <span class="badge bg-light text-secondary border">Baby Massage</span>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill" disabled>Lihat Jadwal</button>
                    <button class="btn btn-sm btn-light text-muted"><i class="fas fa-cog me-1"></i> Edit Profil</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addTherapistModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tambah Terapis Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nama Lengkap & Gelar</label>
                        <input type="text" class="form-control" placeholder="Contoh: Bd. Mawar, S.Tr.Keb">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Jabatan / Role</label>
                        <select class="form-select">
                            <option>Senior Midwife</option>
                            <option>Pediatric Nurse</option>
                            <option>Junior Therapist</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Spesialisasi (Skills)</label>
                        <input type="text" class="form-control" placeholder="Pisahkan dengan koma (Misal: Massage, Gym)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">No. WhatsApp</label>
                        <input type="tel" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

@endsection