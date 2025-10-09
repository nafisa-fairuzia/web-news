@extends('layout.main')

@section('title', 'Dashboard Portal Berita')

@section('content')

<div class="hero-cover d-flex align-items-center justify-content-center text-center text-white position-relative" style="min-height: 60vh;">
  <div class="overlay position-absolute top-0 start-0 w-100 h-100"
    style="background: linear-gradient(rgba(0,0,0,0.20), rgba(0,0,0,0.20));">
  </div>

  <div class="content position-relative text-center">
    <h2 class="fw-bold text-uppercase mb-5 display-5" data-aos="fade-down">
      Portal Berita <span>SMKN 08 Jember</span>
    </h2>
    <div class="row g-4 justify-content-center" data-aos="zoom-in">
      <div class="col-4">
        <div class="p-4 rounded-4 shadow-lg border-0"
          style="background:rgba(20,20,20,0.85);transition:.4s;cursor:pointer;">
          <div class="d-flex justify-content-center align-items-center mb-3">
            <span class="d-flex justify-content-center align-items-center"
              style="width:80px;height:80px;border-radius:50%;background:rgba(255,193,7,0.15);transition:.3s;">
              <i class="bi bi-journal-text fs-1 text-warning"></i>
            </span>
          </div>
          <h1 class="fw-bold text-warning mb-1 counter" data-target="{{ $totalNews ?? 0 }}">0</h1>
          <p class="mb-0 text-uppercase small text-light">Total Berita</p>
        </div>
      </div>

      <div class="col-4">
        <div class="p-4 rounded-4 shadow-lg border-0"
          style="background:rgba(20,20,20,0.85);transition:.4s;cursor:pointer;">
          <div class="d-flex justify-content-center align-items-center mb-3">
            <span class="d-flex justify-content-center align-items-center"
              style="width:80px;height:80px;border-radius:50%;background:rgba(13,202,240,0.15);transition:.3s;">
              <i class="bi bi-folder2-open fs-1 text-info"></i>
            </span>
          </div>
          <h1 class="fw-bold text-info mb-1 counter" data-target="{{ $totalCategories ?? 0 }}">0</h1>
          <p class="mb-0 text-uppercase small text-light">Kategori</p>
        </div>
      </div>

      <div class="col-4">
        <div class="p-4 rounded-4 shadow-lg border-0"
          style="background:rgba(20,20,20,0.85);transition:.4s;cursor:pointer;">
          <div class="d-flex justify-content-center align-items-center mb-3">
            <span class="d-flex justify-content-center align-items-center"
              style="width:80px;height:80px;border-radius:50%;background:rgba(25,135,84,0.15);transition:.3s;">
              <i class="bi bi-bar-chart-line fs-1 text-success"></i>
            </span>
          </div>
          <h1 class="fw-bold text-success mb-1 counter" data-target="{{ $totalVisitors ?? 0 }}">0</h1>
          <p class="mb-0 text-uppercase small text-light">Pengunjung</p>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="breaking-news">
  <div class="container d-flex align-items-center">
    <span class="me-3"><i class="bi bi-lightning-charge-fill"></i> Breaking News:</span>
    <marquee behavior="scroll" direction="left" scrollamount="6">
      @foreach($popularNews as $news)
      {{ $news->title }} &nbsp; | &nbsp;
      @endforeach
      @foreach($popularNews as $news)
      {{ $news->title }} &nbsp; | &nbsp;
      @endforeach
    </marquee>
  </div>
</div>

<div class="container my-5">
  <div class="row g-4">
    <div class="col-lg-8" data-aos="fade-right"
      data-aos-offset="100"
      data-aos-easing="ease-in-sine">
      <a href="{{ route('news.show', $headline->id) }}">
        @if($headline)
        <div class="card hero-card text-white shadow-lg">
          <img src="{{ asset('storage/'.$headline->image) }}" class="card-img-top" style="height: 480px; object-fit: cover;" />
          <div class="card-img-overlay d-flex flex-column justify-content-end p-4"
            style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
            <h2 class="card-title text-truncate-2 fw-bold">
              {{ $headline->title }}
            </h2>
          </div>
        </div>
        @endif
      </a>
    </div>

    <div class="col-lg-4">
      <h5 class="fw-bold mb-3 " style="border-left: 6px solid #007bff; padding-left: 12px;" data-aos="fade-right">Berita Terkini</h5>
      <ul class="list-group list-group-flush" data-aos="fade-up"
        data-aos-easing="linear"
        data-aos-duration="500">
        @foreach($latestNews as $news)
        <li class="list-group-item">
          <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark">
            <div class="d-flex">
              <img src="{{ asset('storage/'.$news->image) }}" class="rounded me-3" style="width: 100px; height: 70px; object-fit: cover;">
              <div>
                <h6 class="fw-semibold mb-1" style="max-width: 250px;">
                  {{ \Illuminate\Support\Str::limit($news->title, 45, '...') }}
                </h6>
                <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
              </div>
            </div>
          </a>
        </li>

        @endforeach
      </ul>
    </div>
  </div>
</div>

<div class="container mb-5">
  <div class="d-flex align-items-center mb-3">
    <div class="px-4 py-2 text-white fw-bold rounded" style="background-color: #253b80;">
      Berita Populer
    </div>
    <div class="flex-grow-1 mx-2" style="border-bottom: 2px solid #253b80;"></div>
    <a href="{{ route('news.index') }}"
      class="btn btn-sm d-flex align-items-center gap-1 px-3 py-1 shadow-sm"
      style="border-radius: 20px; font-weight: 600; border: 2px solid #253b80; color: #253b80; background: transparent;">
      <span>Lihat Semua</span>
      <i class="bi bi-arrow-right-circle ms-1"></i>
    </a>
  </div>

  <div class="row g-4 card-grid">
    @foreach($popularNews as $news)
    <div class="col-md-3" data-aos="fade-up">
      <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark">
        <div class="card border-0 shadow-sm h-100">
          <img src="{{ asset('storage/'.$news->image) }}" class="card-img-top rounded-top">
          <div class="card-body">
            <p class="meta-info mb-1" style="font-size: 14px;">
              <i class="bi bi-person-circle me-1"></i>{{ $news->author ?? 'Admin' }} |
              <i class="bi bi-calendar-event me-1"></i>{{ $news->created_at->format('d F Y') }} |
              <i class="bi bi-tag me-1"></i>{{ $news->category }}
            </p>
            <h5 class="card-title text-truncate-2">
              {{ $news->title }}
            </h5>
            <h6 class="text-truncate-1">
              {{ Str::limit($news->content, 100) }}
            </h6>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>

</div>

<div class="container py-4">
  <div class="d-flex align-items-center mb-3">
    <div class="px-4 py-2 text-white fw-bold rounded" style="background-color: #253b80;">
      Rekomendasi
    </div>
    <div class="flex-grow-1 mx-2" style="border-bottom: 2px solid #253b80;"></div>
    <a href="{{ route('news.index') }}"
      class="btn btn-sm d-flex align-items-center gap-1 px-3 py-1 shadow-sm"
      style="border-radius: 20px; font-weight: 600; border: 2px solid #253b80; color: #253b80; background: transparent;">
      <span>Lihat Semua</span>
      <i class="bi bi-arrow-right-circle ms-1"></i>
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-4" data-aos="fade-right">
      <div id="carouselBerita" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
          @foreach($carouselNews as $i => $news)
          <div class="carousel-item {{ $i==0 ? 'active' : '' }} h-100">
            <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark">
              <div class="card text-white h-100">
                <img src="{{ asset('storage/'.$news->image) }}" class="card-img h-100" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end"
                  style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                  <p class="meta-info mb-1" style="font-size: 14px;">
                    <i class="bi bi-person-circle me-1"></i>{{ $news->author->name ?? 'Admin' }} |
                    <i class="bi bi-calendar-event me-1"></i>{{ $news->created_at->format('d F Y') }} |
                    <i class="bi bi-tag me-1"></i>{{ $news->category }}
                  </p>
                  <h5 class="card-title text-truncate-2">
                    {{ $news->title }}
                  </h5>
                  <h6 class="text-truncate-1">
                    {{ $news->content }}
                  </h6>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="row g-3 card-grid">
        @foreach($recommendNews as $news)
        <div class="col-md-4" data-aos="fade-up">
          <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-dark">
            <div class="berita-3 card">
              <img src="{{ asset('storage/'.$news->image) }}" class="card-img-top" alt="...">
              <div class="card-body">
                <p class="meta-info mb-1" style="font-size: 14px;">
                  <i class="bi bi-person-circle me-1"></i>{{ $news->author->name ?? 'Admin' }} |
                  <i class="bi bi-calendar-event me-1"></i>{{ $news->created_at->format('d F Y') }} |
                  <i class="bi bi-tag me-1"></i>{{ $news->category }}
                </p>
                <h5 class="card-title text-truncate-2">
                  {{ $news->title }}
                </h5>
                <h6 class="text-truncate-1">
                  {{ $news->content }}
                </h6>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>

  </div>
</div>


@endsection