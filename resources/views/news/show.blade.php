@extends('layout.main')

@section('title', $news->title)

@section('content')
<div class="container py-5">
  <div class="row">
    <!-- Konten Utama -->
    <div class="col-lg-8">
      <div class="card shadow-sm h-100 border-0 rounded-4">

        <div class="card-body">
          <!-- Judul Berita -->
          <h2 class="fw-bold mb-3">{{ $news->title }}</h2>

          <!-- Meta Info (Penulis, Tanggal, Kategori, Views) -->
          <div class="d-flex flex-wrap text-muted mb-4 gap-3" style="font-size: 0.95rem;">
            <div class="d-flex align-items-center">
              <i class="bi bi-person-circle me-1"></i> {{ $news->user->name ?? 'Admin' }}
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event me-1"></i> {{ $news->created_at->format('d F Y') }}
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-tag me-1"></i> {{ $news->category }}
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-eye me-1"></i> {{ $news->views }} kali dilihat
            </div>
          </div>

          <!-- Gambar Utama -->
          <img src="{{ asset('storage/'.$news->image) }}"
               alt="{{ $news->title }}"
               class="img-fluid mb-4 shadow-sm"
               style="object-fit: cover; width: 100%;">

          <!-- Konten Berita -->
          <div class="mb-4" style="line-height: 1.8; font-size: 1.05rem;">
            {!! nl2br(e($news->content)) !!}
          </div>

          <!-- Tombol Aksi -->
          <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
              <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>

            <!-- Tombol Bagikan -->
            <div class="dropdown">
              <button class="btn btn-outline-success dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-share me-1"></i> Bagikan
              </button>
              <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                <li>
                  <a class="dropdown-item" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}">
                    Facebook
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}">
                    Twitter
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" target="_blank" href="https://wa.me/?text={{ urlencode($news->title.' '.request()->fullUrl()) }}">
                    WhatsApp
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Sidebar Berita Populer -->
    <div class="col-lg-4">
      <div style="position: sticky; top: 100px;">
        <h5 class="fw-bold mb-3" style="border-left: 6px solid #007bff; padding-left: 12px;">
          Berita Populer
        </h5>
        <ul class="list-group list-group-flush">
          @foreach($popularNews as $popular)
          <li class="list-group-item border-0 p-2">
            <a href="{{ route('news.show', $popular->id) }}" class="text-decoration-none text-dark">
              <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('storage/'.$popular->image) }}" class="rounded" style="width: 100px; height: 70px; object-fit: cover;">
                <div>
                  <h6 class="fw-semibold mb-1" style="max-width: 250px;">
                    {{ \Illuminate\Support\Str::limit($popular->title, 45, '...') }}
                  </h6>
                  <small class="text-muted">{{ $popular->created_at->diffForHumans() }}</small>
                </div>
              </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection
