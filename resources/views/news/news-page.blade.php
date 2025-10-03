@extends('layout.main')

@section('title', 'Semua Berita')

@section('content')

<div class="container mb-0 py-5">
  <div class="card shadow-sm" style="padding-bottom: 20px">
    <div class="card-body">
      <h5 class="card-title mb-3">Filter Berita</h5>
      <form method="GET" action="{{ route('news.index') }}">
        <div class="row g-3 align-items-end">

          <div class="col-md-3">
            <label for="tanggal" class="form-label">
              <i class="bi bi-calendar me-1 text-secondary"></i> Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
          </div>

          <div class="col-md-3">
            <label for="kategori" class="form-label">
              <i class="bi bi-tag me-1 text-secondary"></i> Kategori</label>
            <select id="kategori" name="kategori" class="form-select">
              <option value="">-- Semua Kategori --</option>
              <option value="TKR" {{ request('kategori')=='TKR' ? 'selected' : '' }}>TKR</option>
              <option value="TSM" {{ request('kategori')=='TSM' ? 'selected' : '' }}>TSM</option>
              <option value="TKJ" {{ request('kategori')=='TKJ' ? 'selected' : '' }}>TKJ</option>
              <option value="RPL" {{ request('kategori')=='RPL' ? 'selected' : '' }}>RPL</option>
              <option value="DKV" {{ request('kategori')=='DKV' ? 'selected' : '' }}>DKV</option>
              <option value="ATPH" {{ request('kategori')=='ATPH' ? 'selected' : '' }}>ATPH</option>
              <option value="APT" {{ request('kategori')=='APT' ? 'selected' : '' }}>APT</option>
              <option value="Prestasi" {{ request('kategori')=='Prestasi' ? 'selected' : '' }}>Prestasi</option>
              <option value="Umum" {{ request('kategori')=='Umum' ? 'selected' : '' }}>Umum</option>
            </select>

          </div>

          <div class="col-md-3">
            <label for="sort" class="form-label fw-semibold">
              <i class="bi bi-sort-down me-1 text-secondary"></i> Urutkan
            </label>
            <select id="sort" name="sort" class="form-select shadow-sm">
              <option value="terbaru" {{ request('sort')=='terbaru' ? 'selected' : '' }}>Terbaru</option>
              <option value="terlama" {{ request('sort')=='terlama' ? 'selected' : '' }}>Terlama</option>
              <option value="populer" {{ request('sort')=='populer' ? 'selected' : '' }}>Paling Populer</option>
            </select>
          </div>

          <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-funnel me-1"></i> Filter
            </button>
            <a href="{{ route('news.index') }}" class="btn btn-outline-secondary w-100">
              <i class="bi bi-arrow-repeat me-1"></i> Reset
            </a>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<div class="container mb-3">
  @if(request('q'))
  <div class="alert alert-info shadow-sm">
    Ditemukan <strong>{{ $news->total() }}</strong> berita untuk pencarian:
    <em>"{{ request('q') }}"</em>
  </div>
  @endif
</div>

<div class="container mb-5">
  <div class="row g-4 card-grid">
    @forelse($news as $item)
    <div class="col-md-3">
      <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none text-dark">
        <div class="card border-0 shadow-sm h-100">
          <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top rounded-top">
          <div class="card-body">
            <p class="meta-info mb-1" style="font-size: 14px;">
              <i class="bi bi-person-circle me-1"></i>{{ $item->author ?? 'Admin' }} |
              <i class="bi bi-calendar-event me-1"></i>{{ $item->created_at->format('d F Y') }} |
              <i class="bi bi-tag me-1"></i>{{ $item->category }}
            </p>
            <h5 class="card-title">
              {{ \Illuminate\Support\Str::limit($item->title, 45, '...') }}
            </h5>
            <h6>
              {{ \Illuminate\Support\Str::limit($item->content, 35, '...') }}
            </h6>
          </div>
        </div>
      </a>
    </div>
    @empty
    <p class="text-center">Belum ada berita</p>
    @endforelse
  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $news->links('pagination::bootstrap-5') }}
  </div>
</div>

@endsection