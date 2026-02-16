@extends('admin.layouts.app')

@section('title', 'Bidan / Terapis')
@section('page-title', 'Bidan / Terapis')
@section('breadcrumb', 'Bidan / Terapis')

@section('content')

@if (session('success'))
<div class="mb-4 p-4 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-lg border border-success-200 dark:border-success-600/50 flex items-center gap-2">
    <iconify-icon icon="solar:check-circle-outline" class="text-xl"></iconify-icon>
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="mb-4 p-4 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-lg border border-danger-200 dark:border-danger-600/50 flex items-center gap-2">
    <iconify-icon icon="solar:danger-triangle-outline" class="text-xl"></iconify-icon>
    {{ session('error') }}
</div>
@endif

<div class="card border-0 rounded-lg">
    <div class="card-body p-6">
        <div class="flex items-center flex-wrap gap-2 justify-between mb-4">
            <h6 class="font-bold text-lg mb-0">Daftar Bidan / Terapis</h6>
            @if (auth('admin')->user()->canManageBidans())
            <a href="{{ route('admin.bidans.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
                <iconify-icon icon="solar:add-circle-outline" class="text-lg"></iconify-icon>
                Tambah Bidan
            </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table id="bidansTable" class="table bordered-table sm-table mb-0 table-auto w-full">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Spesialisasi</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Status</th>
                        @if (auth('admin')->user()->canManageBidans())
                        <th scope="col" class="text-center" data-sortable="false">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bidans as $index => $bidan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($bidan->photo_url)
                            <img src="{{ $bidan->photo_url }}" alt="{{ $bidan->user->name }}"
                                class="w-10 h-10 rounded-full object-cover">
                            @else
                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 font-semibold">
                                {{ strtoupper(substr($bidan->user->name, 0, 2)) }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <div>
                                <span class="font-medium">{{ $bidan->full_name }}</span>
                                @if ($bidan->str_number)
                                <br><span class="text-xs text-neutral-400">STR: {{ $bidan->str_number }}</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $bidan->specialization }}</td>
                        <td>{{ $bidan->user->phone ?? '-' }}</td>
                        <td>
                            @if ($bidan->is_active)
                            <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium">
                                Aktif
                            </span>
                            @else
                            <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-3 py-1 rounded-full text-xs font-medium">
                                Nonaktif
                            </span>
                            @endif
                        </td>
                        @if (auth('admin')->user()->canManageBidans())
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.bidans.show', $bidan) }}"
                                    class="w-8 h-8 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex items-center justify-center hover:bg-primary-200 transition"
                                    title="Detail">
                                    <iconify-icon icon="solar:eye-outline" class="text-sm"></iconify-icon>
                                </a>
                                <a href="{{ route('admin.bidans.edit', $bidan) }}"
                                    class="w-8 h-8 bg-warning-100 dark:bg-warning-600/25 text-warning-600 rounded-full flex items-center justify-center hover:bg-warning-200 transition"
                                    title="Edit">
                                    <iconify-icon icon="solar:pen-outline" class="text-sm"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.bidans.destroy', $bidan) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data bidan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 rounded-full flex items-center justify-center hover:bg-danger-200 transition"
                                        title="Hapus">
                                        <iconify-icon icon="solar:trash-bin-trash-outline" class="text-sm"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth('admin')->user()->canManageBidans() ? 7 : 6 }}">
                            <div class="flex flex-col items-center justify-center py-16 px-4">
                                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-600/15 dark:to-primary-600/5 flex items-center justify-center mb-5">
                                    <iconify-icon icon="solar:stethoscope-bold-duotone" style="font-size: 48px;" class="text-primary-400 dark:text-primary-500"></iconify-icon>
                                </div>
                                <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada data bidan / terapis</h6>
                                <p class="text-sm text-neutral-400 dark:text-neutral-500 mb-5 text-center">Mulai tambahkan data bidan untuk mengelola tim Anda.</p>
                                @if (auth('admin')->user()->canManageBidans())
                                <a href="{{ route('admin.bidans.create') }}" class="inline-flex items-center gap-2 border border-primary-300 dark:border-primary-600 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-600/10 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">
                                    <iconify-icon icon="solar:add-circle-bold" class="text-lg"></iconify-icon>
                                    Tambah Bidan Pertama
                                </a>
                                @endif
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
    if (document.getElementById("bidansTable") && typeof simpleDatatables.DataTable !== 'undefined') {
        var unsortableCols = [{
            select: 0,
            sortable: false
        }, {
            select: 1,
            sortable: false
        }];
        var lastCol = document.querySelector("#bidansTable thead tr").children.length - 1;
        if (document.querySelector("#bidansTable th[data-sortable='false']")) {
            unsortableCols.push({
                select: lastCol,
                sortable: false
            });
        }
        new simpleDatatables.DataTable("#bidansTable", {
            perPage: 10,
            columns: unsortableCols,
            labels: {
                placeholder: "Cari...",
                searchTitle: "Cari dalam tabel",
                noRows: "Tidak ada data",
                noResults: "Tidak ada hasil yang cocok",
                info: "Menampilkan {start} - {end} dari {rows} data",
                perPage: "data per halaman",
            },
            template: function(options, dom) {
                return '<div class="' + options.classes.top + '">' +
                    (options.searchable ? '<div class="' + options.classes.search + '"><input class="' + options.classes.input + '" placeholder="' + options.labels.placeholder + '" type="search" name="search" title="' + options.labels.searchTitle + '"' + (dom.id ? ' aria-controls="' + dom.id + '"' : '') + '></div>' : '') +
                    (options.paging && options.perPageSelect ? '<div class="' + options.classes.dropdown + '"><label><select class="' + options.classes.selector + '" name="per-page"></select> ' + options.labels.perPage + '</label></div>' : '') +
                    '</div>' +
                    '<div class="' + options.classes.container + '"' + (options.scrollY.length ? ' style="height: ' + options.scrollY + '; overflow-Y: auto;"' : '') + '></div>' +
                    '<div class="' + options.classes.bottom + '">' +
                    (options.paging ? '<div class="' + options.classes.info + '"></div>' : '') +
                    '<nav class="' + options.classes.pagination + '"></nav>' +
                    '</div>';
            },
        });
    }
</script>
@endpush