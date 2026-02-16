@extends('admin.layouts.app')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')
@section('breadcrumb', 'Data Pelanggan')

@section('content')

    <div class="card border-0 rounded-lg">
        <div class="card-body p-6">
            <div class="flex items-center flex-wrap gap-2 justify-between mb-4">
                <h6 class="font-bold text-lg mb-0">Daftar Pelanggan</h6>
                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-4 py-1.5 rounded-full text-sm font-semibold">
                    {{ $pelanggans->count() }} Pelanggan
                </span>
            </div>

            <div class="overflow-x-auto">
                <table id="pelangganTable" class="table bordered-table sm-table mb-0 table-auto w-full">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Email</th>
                            <th scope="col">WhatsApp</th>
                            <th scope="col">Anak</th>
                            <th scope="col">Status</th>
                            <th scope="col">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggans as $index => $pelanggan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-pink-100 dark:bg-pink-600/25 text-pink-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                            {{ strtoupper(substr($pelanggan->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="font-medium block">{{ $pelanggan->nickname }} {{ $pelanggan->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{ $pelanggan->email }}</span>
                                </td>
                                <td>{{ $pelanggan->phone ?? '-' }}</td>
                                <td>
                                    <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-2.5 py-0.5 rounded-full text-xs font-medium">
                                        {{ $pelanggan->anaks_count }} anak
                                    </span>
                                </td>
                                <td>
                                    @if ($pelanggan->hasVerifiedEmail())
                                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1">
                                            <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1">
                                            <iconify-icon icon="solar:clock-circle-outline" class="text-sm"></iconify-icon>
                                            Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $pelanggan->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="flex flex-col items-center justify-center py-16 px-4">
                                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pink-100 to-pink-50 dark:from-pink-600/15 dark:to-pink-600/5 flex items-center justify-center mb-5">
                                            <iconify-icon icon="flowbite:users-group-outline" style="font-size: 48px;" class="text-pink-400 dark:text-pink-500"></iconify-icon>
                                        </div>
                                        <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada pelanggan</h6>
                                        <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Pelanggan yang mendaftar dari website akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        if (document.getElementById("pelangganTable") && typeof simpleDatatables.DataTable !== 'undefined') {
            new simpleDatatables.DataTable("#pelangganTable", {
                perPage: 10,
                columns: [{ select: 0, sortable: false }],
                labels: {
                    placeholder: "Cari pelanggan...",
                    searchTitle: "Cari dalam tabel",
                    noRows: "Tidak ada data",
                    noResults: "Tidak ada hasil yang cocok",
                    info: "Menampilkan {start} - {end} dari {rows} pelanggan",
                    perPage: "data per halaman",
                },
                template: function(options, dom) {
                    return '<div class="' + options.classes.top + '">'
                        + (options.searchable ? '<div class="' + options.classes.search + '"><input class="' + options.classes.input + '" placeholder="' + options.labels.placeholder + '" type="search" name="search" title="' + options.labels.searchTitle + '"' + (dom.id ? ' aria-controls="' + dom.id + '"' : '') + '></div>' : '')
                        + (options.paging && options.perPageSelect ? '<div class="' + options.classes.dropdown + '"><label><select class="' + options.classes.selector + '" name="per-page"></select> ' + options.labels.perPage + '</label></div>' : '')
                        + '</div>'
                        + '<div class="' + options.classes.container + '"' + (options.scrollY.length ? ' style="height: ' + options.scrollY + '; overflow-Y: auto;"' : '') + '></div>'
                        + '<div class="' + options.classes.bottom + '">'
                        + (options.paging ? '<div class="' + options.classes.info + '"></div>' : '')
                        + '<nav class="' + options.classes.pagination + '"></nav>'
                        + '</div>';
                },
            });
        }
    </script>
@endpush
