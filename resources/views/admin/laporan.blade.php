@extends('layouts.admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold mb-1">Laporan Bisnis</h4>
        <p class="text-muted small mb-0">Ringkasan pendapatan dan operasional spa.</p>
    </div>

    <div class="d-flex gap-2 bg-white p-2 rounded-3 shadow-sm border">
        <select class="form-select form-select-sm border-0 bg-light" style="width: 120px;">
            <option>Oktober 2024</option>
            <option>September 2024</option>
            <option>Agustus 2024</option>
        </select>
        <button class="btn btn-sm btn-light border" onclick="window.print()"><i class="fas fa-print me-2"></i>Cetak</button>
        <button class="btn btn-sm btn-success text-white"><i class="fas fa-file-excel me-2"></i>Export</button>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1 text-uppercase">Total Omset</p>
                    <h3 class="fw-bold text-dark mb-0">Rp 45.2jt</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i> 12% dari bulan lalu</small>
                </div>
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3">
                    <i class="fas fa-wallet fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1 text-uppercase">Total Booking</p>
                    <h3 class="fw-bold text-dark mb-0">182</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i> 5% dari bulan lalu</small>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                    <i class="fas fa-receipt fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1 text-uppercase">Komisi Terapis</p>
                    <h3 class="fw-bold text-dark mb-0">Rp 12.5jt</h3>
                    <small class="text-muted">Est. 25% dari omset</small>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                    <i class="fas fa-hand-holding-usd fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-primary text-white" style="background: linear-gradient(135deg, #55c2da, #3eaec6);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-white-50 small mb-1 text-uppercase">Profit Bersih</p>
                    <h3 class="fw-bold mb-0">Rp 32.7jt</h3>
                    <small class="text-white-50">Setelah dikurangi biaya</small>
                </div>
                <div class="bg-white bg-opacity-25 text-white p-2 rounded-3">
                    <i class="fas fa-coins fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Grafik Pendapatan (Oktober)</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Layanan Terlaris</h6>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Baby Spa Complete</span>
                        <span class="fw-bold">45%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 45%"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Baby Massage</span>
                        <span class="fw-bold">25%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 25%"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Home Care</span>
                        <span class="fw-bold">20%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Prenatal Massage</span>
                        <span class="fw-bold">10%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-secondary" style="width: 10%"></div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-center">
                    <canvas id="servicePieChart" style="max-height: 150px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between">
                <h6 class="fw-bold mb-0">Performa Terapis</h6>
                <a href="#" class="btn btn-sm btn-light text-primary">Detail Komisi</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Nama Terapis</th>
                            <th>Total Booking</th>
                            <th>Rating Rata-rata</th>
                            <th>Pendapatan Dihasilkan</th>
                            <th class="text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-2" width="30">
                                    <span class="fw-bold small">Bd. Sarah</span>
                                </div>
                            </td>
                            <td>85 Pasien</td>
                            <td><i class="fas fa-star text-warning"></i> 4.9</td>
                            <td class="fw-bold text-success">Rp 15.400.000</td>
                            <td class="text-end pe-4"><span class="badge bg-success">Excellent</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-2" width="30">
                                    <span class="fw-bold small">Ns. Rani</span>
                                </div>
                            </td>
                            <td>60 Pasien</td>
                            <td><i class="fas fa-star text-warning"></i> 4.5</td>
                            <td class="fw-bold text-success">Rp 9.200.000</td>
                            <td class="text-end pe-4"><span class="badge bg-primary">Good</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/33.jpg" class="rounded-circle me-2" width="30">
                                    <span class="fw-bold small">Bd. Linda</span>
                                </div>
                            </td>
                            <td>42 Pasien</td>
                            <td><i class="fas fa-star text-warning"></i> 4.8</td>
                            <td class="fw-bold text-success">Rp 6.800.000</td>
                            <td class="text-end pe-4"><span class="badge bg-secondary">Normal</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Grafik Pendapatan (Line Chart)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [{
                    label: 'Omset (Juta Rupiah)',
                    data: [8.5, 12.2, 10.8, 13.7],
                    borderColor: '#55c2da',
                    backgroundColor: 'rgba(85, 194, 218, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // 2. Grafik Layanan (Pie Chart) - Optional kecil
        const ctxPie = document.getElementById('servicePieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Baby Spa', 'Massage', 'Home Care', 'Mom'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#55c2da', '#0dcaf0', '#ffc107', '#6c757d'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

@endsection