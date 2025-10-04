@extends('layout.main')

@section('title', 'Kelola Berita')

@section('content')
<div class="container mb-5 py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-folder-check text-primary me-2"></i> Kelola Berita
        </h2>
        <a href="{{ route('news.create') }}" class="btn btn-success shadow-sm px-4">
            <i class="bi bi-plus-circle me-2"></i> Tambah Berita
        </a>
    </div>

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card h-100 border-0 shadow-sm bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-newspaper fs-1 mb-2 text-primary"></i>
                    <div class="fw-bold fs-3 text-primary">{{ $stat_total ?? 0 }}</div>
                    <div class="small text-primary">Total Berita</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card h-100 border-0 shadow-sm bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill fs-1 mb-2 text-primary"></i>
                    <div class="fw-bold fs-3 text-primary">{{ $stat_published ?? 0 }}</div>
                    <div class="small text-primary">Published</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card h-100 border-0 shadow-sm bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text fs-1 mb-2 text-primary"></i>
                    <div class="fw-bold fs-3 text-primary">{{ $stat_draft ?? 0 }}</div>
                    <div class="small text-primary">Draft</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card h-100 border-0 shadow-sm bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-eye-fill fs-1 mb-2 text-primary"></i>
                    <div class="fw-bold fs-3 text-primary">{{ $stat_views ?? 0 }}</div>
                    <div class="small text-primary">Total Views</div>
                </div>
            </div>
        </div>
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
            <h5 class="card-title mb-3 fw-semibold text-primary"><i class="bi bi-funnel me-2"></i> Filter Berita</h5>
            <form method="GET" action="{{ url('/manage') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">-- Semua --</option>
                            @foreach(['TKR','TSM','TKJ','RPL','DKV','ATPH','APT','Prestasi','Umum'] as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua --</option>
                            <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2 align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i> Cari</button>
                        <a href="{{ url('/manage') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-repeat me-1"></i> Reset</a>
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
                    <th style="width:50px;">No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th style="width:200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $index => $item)
                <tr>
                    <td>{{ $news->firstItem() + $index }}</td>
                    <td class="text-start text-truncate" style="max-width: 250px;">{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td>
                        @if($item->status === 'published')
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill ">
                            <i class="bi bi-check-circle me-1"></i> Published
                        </span>
                        @else
                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 py-2 rounded-pill ">
                            <i class="bi bi-pencil-square me-1"></i> Draft
                        </span>
                        @endif
                    </td>

                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex flex-row flex-wrap gap-2 justify-content-center">
                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                            @if($item->status === 'draft')
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#publishModal{{ $item->id }}">
                                <i class="bi bi-upload"></i>
                            </button>
                            @endif
                        </div>
                    </td>

                </tr>

                {{-- Modal Hapus --}}
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
                            <div class="modal-body text-center py-4 px-3">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-danger bg-gradient text-white rounded-circle" style="width:70px;height:70px;font-size:2.5rem;box-shadow:0 2px 12px rgba(220,53,69,0.15);">
                                        <i class="bi bi-exclamation-octagon"></i>
                                    </span>
                                </div>
                                <h5 class="fw-bold mb-2 text-danger">Konfirmasi Hapus</h5>
                                <p class="mb-2">Apakah Anda yakin ingin menghapus berita ini?</p>
                                <p class="fw-semibold text-dark mb-2">"{{ $item->title }}"</p>
                                <p class="text-muted small mb-0">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
                            </div>
                            <div class="modal-footer border-0 d-flex flex-column flex-md-row gap-2 justify-content-center bg-light rounded-bottom-4 py-3">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </button>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
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

                <div class="modal fade" id="publishModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
                            <div class="modal-body text-center py-4 px-3">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center bg-success bg-gradient text-white rounded-circle" style="width:70px;height:70px;font-size:2.5rem;box-shadow:0 2px 12px rgba(25,135,84,0.15);">
                                        <i class="bi bi-upload"></i>
                                    </span>
                                </div>
                                <h5 class="fw-bold mb-2 text-success">Konfirmasi Publikasi</h5>
                                <p class="mb-2">Apakah Anda yakin ingin mempublikasikan berita ini?</p>
                                <p class="fw-semibold text-dark mb-2">"{{ $item->title }}"</p>
                                <p class="text-muted small mb-0">Berita ini akan tampil di halaman utama setelah dipublikasikan.</p>
                            </div>
                            <div class="modal-footer border-0 d-flex flex-column flex-md-row gap-2 justify-content-center bg-light rounded-bottom-4 py-3">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </button>
                                <form action="{{ route('news.publish', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="bi bi-check-circle me-1"></i> Publikasikan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="6">
                        <div class="alert alert-light m-0 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Belum ada berita
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $news->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection