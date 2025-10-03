@extends('layout.main')

@section('title', 'Kelola Berita')

@section('content')
<div class="container mb-4 py-5">
    <h2 class="fw-semibold">Kelola Berita</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter -->
    <div class="card shadow-sm mb-3" style="padding-bottom: 20px">
        <div class="card-body">
            <h5 class="card-title mb-3">Filter Berita</h5>
            <form method="GET" action="{{ url('/manage') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-calendar me-1"></i> Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-tag me-1"></i> Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">-- Semua Kategori --</option>
                            <option disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                            <option value="TKR" {{ old('kategori')=='RPL' ? 'selected' : '' }}>TKR</option>
                            <option value="TSM" {{ old('kategori')=='DKV' ? 'selected' : '' }}>TSM</option>
                            <option value="TKJ" {{ old('kategori')=='TKJ' ? 'selected' : '' }}>TKJ</option>
                            <option value="RPL" {{ old('kategori')=='TSM' ? 'selected' : '' }}>RPL</option>
                            <option value="DKV" {{ old('kategori')=='TKR' ? 'selected' : '' }}>DKV</option>
                            <option value="ATPH" {{ old('kategori')=='TKR' ? 'selected' : '' }}>ATPH</option>
                            <option value="APT" {{ old('kategori')=='TKR' ? 'selected' : '' }}>APT</option>
                            <option value="Prestasi" {{ old('kategori')=='TKR' ? 'selected' : '' }}>Prestasi</option>
                            <option value="Umum" {{ old('kategori')=='TKR' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-file-earmark-text me-1"></i> Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filter</button>
                        <a href="{{ url('/manage') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-repeat me-1"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('news.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Berita</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center text-nowrap">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $index => $item)
                <tr>
                    <td>{{ $news->firstItem() + $index }}</td>
                    <td class="text-start text-truncate" style="max-width: 250px;">{{ $item->title }}</td>
                    <td>{{ ucfirst($item->category) }}</td>
                    <td>
                        @if($item->status === 'published')
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Published</span>
                        @else
                        <span class="badge bg-secondary"><i class="bi bi-file-earmark-text"></i> Draft</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @if($item->status==='draft')
                        <form action="{{ route('news.publish', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mempublikasikan berita ini?')">
                            @csrf
                            <button class="btn btn-sm btn-success"><i class="bi bi-upload"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada berita</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
        {{ $news->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection