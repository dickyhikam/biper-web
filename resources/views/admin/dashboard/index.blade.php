@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">

        {{-- Total Booking Hari Ini --}}
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Booking Hari Ini</p>
                        <h6 class="mb-0 dark:text-white">12</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="solar:calendar-outline" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +3
                    </span>
                    Dari kemarin
                </p>
            </div>
        </div>

        {{-- Total Pelanggan --}}
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-purple-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Pelanggan</p>
                        <h6 class="mb-0 dark:text-white">1,250</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +48
                    </span>
                    Bulan ini
                </p>
            </div>
        </div>

        {{-- Pendapatan Bulan Ini --}}
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-success-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Pendapatan Bulan Ini</p>
                        <h6 class="mb-0 dark:text-white">Rp 15.500.000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-success-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +12%
                    </span>
                    Dari bulan lalu
                </p>
            </div>
        </div>

        {{-- Layanan Aktif --}}
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-blue-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Layanan Aktif</p>
                        <h6 class="mb-0 dark:text-white">6</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-blue-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="solar:hand-stars-outline" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="text-neutral-500">Semua layanan aktif</span>
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mt-6">

        {{-- Chart Pendapatan --}}
        <div class="xl:col-span-12 2xl:col-span-8">
            <div class="card h-full rounded-lg border-0">
                <div class="card-body">
                    <div class="flex flex-wrap items-center justify-between">
                        <h6 class="text-lg mb-0">Statistik Pendapatan</h6>
                        <select class="form-select bg-white dark:bg-neutral-700 form-select-sm w-auto" id="revenueFilter">
                            <option>Tahunan</option>
                            <option>Bulanan</option>
                            <option>Mingguan</option>
                        </select>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <h6 class="mb-0">Rp 15.500.000</h6>
                        <span class="text-sm font-semibold rounded-full bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 border border-success-200 dark:border-success-600/50 px-2 py-1.5 line-height-1 flex items-center gap-1">
                            12% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                        </span>
                        <span class="text-xs font-medium">+ Rp 1.200.000 dari bulan lalu</span>
                    </div>
                    <div id="revenueChart" class="pt-[28px] apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>

        {{-- Layanan Populer --}}
        <div class="xl:col-span-12 2xl:col-span-4">
            <div class="card h-full rounded-lg border-0 overflow-hidden">
                <div class="card-body p-6">
                    <h6 class="mb-3 font-semibold text-lg">Layanan Populer</h6>
                    <div id="serviceChart" class="apexcharts-tooltip-z-none"></div>
                    <ul class="flex flex-wrap items-center justify-between mt-4 gap-3">
                        <li class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm bg-primary-600"></span>
                            <span class="text-secondary-light text-sm font-normal">
                                Baby Spa
                            </span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm bg-warning-600"></span>
                            <span class="text-secondary-light text-sm font-normal">
                                Pijat Bayi
                            </span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm bg-success-600"></span>
                            <span class="text-secondary-light text-sm font-normal">
                                Lainnya
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Booking Terbaru --}}
        <div class="xl:col-span-12 2xl:col-span-8">
            <div class="card h-full border-0">
                <div class="card-body p-6">
                    <div class="flex items-center flex-wrap gap-2 justify-between mb-4">
                        <h6 class="font-bold text-lg mb-0">Booking Terbaru</h6>
                        <a href="javascript:void(0)" class="text-primary-600 dark:text-primary-600 hover-text-primary flex items-center gap-1">
                            Lihat Semua
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table bordered-table sm-table mb-0 table-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                                AS
                                            </div>
                                            <div class="grow">
                                                <h6 class="text-base mb-0 font-medium">Andi Susanto</h6>
                                                <span class="text-sm text-secondary-light font-medium">Baby Arya (8 bln)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Complete Baby Spa</td>
                                    <td>16 Feb 2026</td>
                                    <td>09:00</td>
                                    <td class="text-center">
                                        <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Menunggu</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-success-100 dark:bg-success-600/25 text-success-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                                RN
                                            </div>
                                            <div class="grow">
                                                <h6 class="text-base mb-0 font-medium">Rina Novianti</h6>
                                                <span class="text-sm text-secondary-light font-medium">Baby Keisha (5 bln)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Pijat Pediatrik</td>
                                    <td>16 Feb 2026</td>
                                    <td>10:00</td>
                                    <td class="text-center">
                                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Dikonfirmasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-info-100 dark:bg-info-600/25 text-info-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                                DW
                                            </div>
                                            <div class="grow">
                                                <h6 class="text-base mb-0 font-medium">Dewi Wulandari</h6>
                                                <span class="text-sm text-secondary-light font-medium">Baby Raka (12 bln)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Baby Swim</td>
                                    <td>16 Feb 2026</td>
                                    <td>11:00</td>
                                    <td class="text-center">
                                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Dikonfirmasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-600/25 text-purple-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                                SP
                                            </div>
                                            <div class="grow">
                                                <h6 class="text-base mb-0 font-medium">Siti Permata</h6>
                                                <span class="text-sm text-secondary-light font-medium">Baby Naya (3 bln)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home Care</td>
                                    <td>16 Feb 2026</td>
                                    <td>13:00</td>
                                    <td class="text-center">
                                        <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Menunggu</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-danger-100 dark:bg-danger-600/25 text-danger-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                                LH
                                            </div>
                                            <div class="grow">
                                                <h6 class="text-base mb-0 font-medium">Linda Hartono</h6>
                                                <span class="text-sm text-secondary-light font-medium">Baby Zara (6 bln)</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Complete Baby Spa</td>
                                    <td>17 Feb 2026</td>
                                    <td>09:00</td>
                                    <td class="text-center">
                                        <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-sm">Terjadwal</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bidan / Terapis Aktif --}}
        <div class="xl:col-span-12 2xl:col-span-4">
            <div class="card h-full border-0">
                <div class="card-body">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Bidan Aktif Hari Ini</h6>
                        <a href="javascript:void(0)" class="text-primary-600 dark:text-primary-600 hover-text-primary flex items-center gap-1">
                            Lihat Semua
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between gap-2 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 font-semibold">
                                    SR
                                </div>
                                <div class="grow">
                                    <h6 class="text-base mb-0 font-medium">Bd. Sri Rahayu</h6>
                                    <span class="text-sm text-secondary-light font-medium">Baby Spa & Pijat</span>
                                </div>
                            </div>
                            <span class="bg-success-100 dark:bg-success-600/25 text-success-600 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between gap-2 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-warning-100 dark:bg-warning-600/25 text-warning-600 rounded-full flex justify-center items-center shrink-0 font-semibold">
                                    DN
                                </div>
                                <div class="grow">
                                    <h6 class="text-base mb-0 font-medium">Bd. Dina Nurhaliza</h6>
                                    <span class="text-sm text-secondary-light font-medium">Baby Swim</span>
                                </div>
                            </div>
                            <span class="bg-success-100 dark:bg-success-600/25 text-success-600 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between gap-2 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-info-100 dark:bg-info-600/25 text-info-600 rounded-full flex justify-center items-center shrink-0 font-semibold">
                                    AW
                                </div>
                                <div class="grow">
                                    <h6 class="text-base mb-0 font-medium">Bd. Ayu Widianti</h6>
                                    <span class="text-sm text-secondary-light font-medium">Laktasi & Postpartum</span>
                                </div>
                            </div>
                            <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 px-3 py-1 rounded-full text-xs font-medium">Sibuk</span>
                        </div>

                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-success-100 dark:bg-success-600/25 text-success-600 rounded-full flex justify-center items-center shrink-0 font-semibold">
                                    MF
                                </div>
                                <div class="grow">
                                    <h6 class="text-base mb-0 font-medium">Bd. Maya Fitriani</h6>
                                    <span class="text-sm text-secondary-light font-medium">Home Care</span>
                                </div>
                            </div>
                            <span class="bg-success-100 dark:bg-success-600/25 text-success-600 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
    // Revenue Chart
    var revenueOptions = {
        series: [{
            name: 'Pendapatan',
            data: [8500000, 9200000, 7800000, 10500000, 11200000, 9800000, 12300000, 11800000, 13500000, 14200000, 12800000, 15500000]
        }],
        chart: {
            type: 'area',
            height: 310,
            toolbar: { show: false },
            fontFamily: 'Inter, sans-serif',
        },
        colors: ['#df1995'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return 'Rp ' + (val / 1000000).toFixed(1) + ' Jt';
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        }
    };
    var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
    revenueChart.render();

    // Service Donut Chart
    var serviceOptions = {
        series: [45, 30, 15, 10],
        chart: {
            type: 'donut',
            height: 260,
        },
        colors: ['#df1995', '#40d7e3', '#28A745', '#ffd93d'],
        labels: ['Baby Spa', 'Pijat Bayi', 'Baby Swim', 'Home Care'],
        legend: { show: false },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function() { return '156'; }
                        }
                    }
                }
            }
        }
    };
    var serviceChart = new ApexCharts(document.querySelector("#serviceChart"), serviceOptions);
    serviceChart.render();
</script>
@endpush
