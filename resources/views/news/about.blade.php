@extends('layout.main')

@section('title', 'Hubungi Kami')

@section('content')
<section class="hero-tentang d-flex align-items-center text-white text-center position-relative">
    <div class="container position-relative z-2">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">
            Tentang <span class="text-gradient">Portal Berita</span>
        </h1>
        <p class="lead animate__animated animate__fadeInUp">
            Sumber informasi modern yang cepat, akurat, dan inspiratif
        </p>
    </div>
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
</section>

<section class="py-5 position-relative siapa-kami-section animate__animated animate__fadeInUp">
    <div class="siapa-kami-bg"></div>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3 siapa-kami-title"><span class="text-gradient">Siapa Kami?</span></h2>
                <div class="highlight-box-plain mx-auto mb-3">
                    <span class="fw-bold text-dark">Portal Berita</span> adalah media digital yang hadir untuk memberikan <em>berita aktual, terpercaya, dan mendidik</em>.
                </div>
                <p class="fs-5 text-muted mb-2">
                    Kami percaya informasi yang benar membentuk masyarakat cerdas & kritis. Dengan tim redaksi profesional dan teknologi modern, kami berkomitmen menghadirkan <span class="fw-bold text-dark">jurnalisme berkualitas</span>.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light animate__animated animate__fadeInUp">
    <div class="container">
        <h2 class="fw-bold text-gradient mb-5 text-center">Nilai yang Kami Pegang</h2>
        <div class="nilai-row d-flex flex-column flex-md-row justify-content-center align-items-stretch gap-4">
            <div class="nilai-item d-flex flex-column align-items-center flex-fill">
                <div class="icon-circle mb-3 bg-danger bg-gradient text-white"><i class="bi bi-shield-lock-fill display-6"></i></div>
                <h5 class="fw-bold">Integritas</h5>
                <p class="text-muted text-center">Setiap berita kami sajikan dengan tanggung jawab dan kejujuran.</p>
            </div>
            <div class="nilai-item d-flex flex-column align-items-center flex-fill">
                <div class="icon-circle mb-3 bg-success bg-gradient text-white"><i class="bi bi-people-fill display-6"></i></div>
                <h5 class="fw-bold">Keterbukaan</h5>
                <p class="text-muted text-center">Melayani semua lapisan masyarakat dengan informasi yang transparan.</p>
            </div>
            <div class="nilai-item d-flex flex-column align-items-center flex-fill">
                <div class="icon-circle mb-3 bg-warning bg-gradient text-white"><i class="bi bi-lightning-fill display-6"></i></div>
                <h5 class="fw-bold">Inovasi</h5>
                <p class="text-muted text-center">Menggunakan teknologi terbaru untuk menyajikan berita lebih cepat dan mudah diakses.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 animate__animated animate__fadeInUp">
    <div class="container">
        <h2 class="fw-bold text-center text-gradient mb-5">Tim Redaksi</h2>
        <div class="team-horizontal d-flex flex-row flex-nowrap overflow-auto gap-4 justify-content-center align-items-stretch pb-3">
            @foreach($admins as $admin)
            <div class="team-member d-flex flex-column align-items-center flex-shrink-0 px-3">
                <div class="avatar-wrapper mb-2" style="border: 4px solid #253b80;">
                    <img src="{{ $admin->avatar ? asset('storage/'.$admin->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=253b80&color=fff' }}" class="rounded-circle" alt="{{ $admin->name }}">
                </div>
                <h5 class="fw-bold mb-1 text-center">{{ $admin->name }}</h5>
                <span class="badge px-3 py-2 mb-2 text-capitalize " style="background: linear-gradient(90deg,#253b80,#179bd7)">
                    <i class="bi bi-person-badge me-1"></i> Admin
                </span>
            </div>
            @endforeach

            @foreach($reporters as $reporter)
            <div class="team-member d-flex flex-column align-items-center flex-shrink-0 px-3">
                <div class="avatar-wrapper mb-2" style="border: 4px solid #253b80;">
                    <img src="{{ $reporter->avatar ? asset('storage/'.$reporter->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($reporter->name).'&background=253b80&color=fff' }}" class="rounded-circle" alt="{{ $reporter->name }}">
                </div>
                <h5 class="fw-bold mb-1 text-center">{{ $reporter->name }}</h5>
                <span class="badge px-3 py-2 mb-2 text-capitalize " style="background: linear-gradient(90deg,#253b80,#179bd7)">
                    <i class="bi bi-person-badge me-1"></i> Reporter
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .hero-tentang {
        background: url("/assets/img/gambar2.jpeg") center/cover no-repeat;
        height: 65vh;
        position: relative;
        overflow: hidden;
    }

    .hero-overlay {
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
        pointer-events: none;
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .siapa-kami-section {
        background: none;
        overflow: visible;
    }

    .siapa-kami-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, #f8fafc 60%, #e3f2fd 100%);
        z-index: 0;
    }

    .siapa-kami-title {
        letter-spacing: 1px;
        font-size: 2.3rem;
    }

    .highlight-box-plain {
        font-size: 1.1rem;
        display: inline-block;
        padding: 1rem 1.5rem;
    }

    .siapa-kami-img-wrapper {
        position: relative;
        display: inline-block;
    }

    .siapa-kami-img {
        z-index: 2;
        position: relative;
        border: 6px solid #fff;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
    }

    .nilai-row {
        border-radius: 2rem;
        background: linear-gradient(90deg, #f8fafc 60%, #e3f2fd 100%);
        padding: 2rem 1rem;
        box-shadow: 0 4px 24px 0 rgba(23, 155, 215, 0.07);
    }

    .team-horizontal {
        scrollbar-width: thin;
        scrollbar-color: #179bd7 #e3f2fd;
        overflow-x: auto;
    }

    .team-horizontal::-webkit-scrollbar {
        height: 8px;
    }

    .team-horizontal::-webkit-scrollbar-thumb {
        background: #179bd7;
        border-radius: 4px;
    }

    .team-horizontal::-webkit-scrollbar-track {
        background: #e3f2fd;
        border-radius: 4px;
    }

    .team-member {
        min-width: 220px;
        max-width: 240px;
        background: none;
        border: none;
    }

    .hover-card {
        transition: transform .3s cubic-bezier(.4, 2, .6, 1), box-shadow .3s cubic-bezier(.4, 2, .6, 1);
    }

    .hover-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 15px 30px rgba(23, 155, 215, 0.13);
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.10);
    }

    .avatar-wrapper {
        width: 120px;
        height: 120px;
        overflow: hidden;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.10);
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
    }

    .role-badge {
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.4rem 1.1rem;
        border-radius: 50px;
        color: #fff;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.08);
    }
</style>
@endpush