@extends('layout.main')

@section('title', 'Kelola Reporter')

@section('content')
<div class="container mb-5 py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-people-fill text-primary me-2"></i> Kelola Reporter
        </h2>
        <a href="{{ route('reporters.create') }}" class="btn btn-success shadow-sm px-4">
            <i class="bi bi-plus-circle me-2"></i> Tambah Reporter
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3 fw-semibold text-primary">
                <i class="bi bi-funnel me-2"></i> Filter Reporter
            </h5>
            <form method="GET" action="{{ route('reporters.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Cari nama..." value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tanggal Daftar</label>
                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="sort" class="form-label fw-semibold">Urutkan</label>
                        <select id="sort" name="sort" class="form-select">
                            <option value="terbaru" {{ request('sort')=='terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort')=='terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="populer" {{ request('sort')=='populer' ? 'selected' : '' }}>Paling Populer</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                        <a href="{{ route('reporters.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-repeat me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-primary">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Password</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reporters as $index => $item)
                <tr>
                    <td>{{ $reporters->firstItem() + $index }}</td>
                    <td>
                        @if($item->avatar && file_exists(public_path('storage/' . $item->avatar)))
                        <img src="{{ $item->avatar ? asset('storage/'.$item->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($item->name).'&background=253b80&color=fff' }}" class="rounded-circle" alt="{{ $item->name }}" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                        <span class="d-inline-block bg-secondary text-white rounded-circle" style="width:40px;height:40px;line-height:40px;font-size:1.2rem;">
                            <i class="bi bi-person"></i>
                        </span>
                        @endif
                    </td>
                    <td class="text-start">{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                    <td><span class="text-muted">••••••••</span></td>
                    <td>
                        <div class="d-flex flex-row flex-wrap gap-2 justify-content-center">
                            <a href="{{ route('reporters.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- Modal Hapus --}}
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
                            <div class="modal-body text-center py-4 px-3">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-danger bg-gradient text-white rounded-circle"
                                        style="width:70px;height:70px;font-size:2.5rem;box-shadow:0 2px 12px rgba(220,53,69,0.15);">
                                        <i class="bi bi-exclamation-octagon"></i>
                                    </span>
                                </div>
                                <h5 class="fw-bold mb-2 text-danger">Konfirmasi Hapus</h5>
                                <p class="mb-2">Apakah Anda yakin ingin menghapus reporter ini?</p>
                                <p class="fw-semibold text-dark mb-2">"{{ $item->name }}"</p>
                                <p class="text-muted small mb-0">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
                            </div>
                            <div class="modal-footer border-0 d-flex flex-column flex-md-row gap-2 justify-content-center bg-light rounded-bottom-4 py-3">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </button>
                                <form action="{{ route('reporters.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-4">
                                        <i class="bi bi-trash3 me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-light m-0 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Belum ada reporter
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $reporters->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection