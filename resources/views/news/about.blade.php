 @extends('layout.main')

 @section('title', 'Hubungi Kami')

 @section('content')
 <!-- Hero Section -->
 <section class="hero-tentang d-flex align-items-center text-white text-center">
     <div class="container">
         <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Tentang Portal Berita</h1>
         <p class="lead animate__animated animate__fadeInUp">Sumber informasi modern yang cepat, akurat, dan inspiratif</p>
     </div>
 </section>

 <!-- Intro -->
 <section class="py-5 bg-light">
     <div class="container">
         <div class="row align-items-center g-5">
             <div class="col-lg-6">
                 <img src="https://source.unsplash.com/700x500/?journalism,media" class="img-fluid rounded shadow" alt="Tentang Portal Berita">
             </div>
             <div class="col-lg-6">
                 <h2 class="fw-bold text-primary mb-3">Siapa Kami?</h2>
                 <p class="fs-5 text-muted">
                     <strong>Portal Berita</strong> adalah media digital yang hadir untuk memberikan <em>berita aktual, terpercaya, dan mendidik</em>.
                     Kami percaya bahwa informasi yang benar dapat membentuk masyarakat yang lebih cerdas dan kritis.
                     Dengan dukungan tim redaksi profesional dan teknologi modern, kami terus berkomitmen menghadirkan
                     <span class="fw-bold text-dark">jurnalisme berkualitas</span> di era digital.
                 </p>
             </div>
         </div>
     </div>
 </section>

 <!-- Visi Misi -->
 <section class="py-5">
     <div class="container text-center">
         <h2 class="fw-bold text-primary mb-5">Visi & Misi Kami</h2>
         <div class="row g-4">
             <div class="col-md-6">
                 <div class="card shadow-lg border-0 h-100 p-4 rounded-4 hover-card">
                     <i class="bi bi-eye-fill display-3 text-primary mb-3"></i>
                     <h4 class="fw-bold">Visi</h4>
                     <p class="text-muted">
                         Menjadi portal berita terdepan yang menginspirasi, mendidik, dan membangun literasi masyarakat.
                     </p>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="card shadow-lg border-0 h-100 p-4 rounded-4 hover-card">
                     <i class="bi bi-flag-fill display-3 text-warning mb-3"></i>
                     <h4 class="fw-bold">Misi</h4>
                     <ul class="list-unstyled text-muted fs-6">
                         <li>✅ Menyajikan berita faktual & berimbang</li>
                         <li>✅ Memberikan perspektif dari berbagai bidang</li>
                         <li>✅ Meningkatkan literasi digital masyarakat</li>
                         <li>✅ Menjunjung tinggi etika jurnalistik</li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Nilai Kami -->
 <section class="py-5 bg-light">
     <div class="container text-center">
         <h2 class="fw-bold text-primary mb-5">Nilai yang Kami Pegang</h2>
         <div class="row g-4">
             <div class="col-md-4">
                 <div class="p-4 shadow-sm rounded-4 bg-white hover-card">
                     <i class="bi bi-shield-lock-fill display-4 text-danger mb-3"></i>
                     <h5 class="fw-bold">Integritas</h5>
                     <p class="text-muted">Setiap berita kami sajikan dengan tanggung jawab dan kejujuran.</p>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="p-4 shadow-sm rounded-4 bg-white hover-card">
                     <i class="bi bi-people-fill display-4 text-success mb-3"></i>
                     <h5 class="fw-bold">Keterbukaan</h5>
                     <p class="text-muted">Melayani semua lapisan masyarakat dengan informasi yang transparan.</p>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="p-4 shadow-sm rounded-4 bg-white hover-card">
                     <i class="bi bi-lightning-fill display-4 text-warning mb-3"></i>
                     <h5 class="fw-bold">Inovasi</h5>
                     <p class="text-muted">Menggunakan teknologi terbaru untuk menyajikan berita lebih cepat dan mudah diakses.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Tim Redaksi -->
 <section class="py-5">
     <div class="container">
         <h2 class="fw-bold text-center text-primary mb-5">Tim Redaksi</h2>
         <div class="row g-4 justify-content-center">
             <div class="col-md-4">
                 <div class="card team-card text-center border-0 shadow-lg rounded-4">
                     <img src="https://source.unsplash.com/300x300/?man,portrait" class="rounded-circle mx-auto mt-4 border border-4 border-primary" width="150" height="150" alt="Redaksi">
                     <div class="card-body">
                         <h5 class="fw-bold">Budi Santoso</h5>
                         <p class="text-muted">Pemimpin Redaksi</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="card team-card text-center border-0 shadow-lg rounded-4">
                     <img src="https://source.unsplash.com/300x300/?woman,editor" class="rounded-circle mx-auto mt-4 border border-4 border-primary" width="150" height="150" alt="Editor">
                     <div class="card-body">
                         <h5 class="fw-bold">Siti Rahmawati</h5>
                         <p class="text-muted">Editor Berita</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="card team-card text-center border-0 shadow-lg rounded-4">
                     <img src="https://source.unsplash.com/300x300/?photographer,media" class="rounded-circle mx-auto mt-4 border border-4 border-primary" width="150" height="150" alt="Fotografer">
                     <div class="card-body">
                         <h5 class="fw-bold">Andi Pratama</h5>
                         <p class="text-muted">Fotografer</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- CTA -->
 <section class="py-5 text-center bg-primary text-white">
     <div class="container">
         <h2 class="fw-bold mb-3">Ikuti Perjalanan Kami</h2>
         <p class="mb-4">Dapatkan berita terbaru, akurat, dan terpercaya hanya di Portal Berita.</p>
         <a href="{{ url('/') }}" class="btn btn-light px-5 py-2 fw-bold rounded-pill">Kembali ke Beranda</a>
     </div>
 </section>
 @endsection

 @push('styles')
 <style>
     .hero-tentang {
         background: url('https://source.unsplash.com/1600x700/?news,media') center/cover no-repeat;
         height: 65vh;
         position: relative;
     }

     .hero-tentang::after {
         content: "";
         position: absolute;
         inset: 0;
         background: rgba(0, 0, 0, 0.65);
     }

     .hero-tentang .container {
         position: relative;
         z-index: 2;
     }

     .hover-card {
         transition: transform .3s ease, box-shadow .3s ease;
     }

     .hover-card:hover {
         transform: translateY(-8px);
         box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
     }

     .team-card {
         transition: transform .3s ease;
     }

     .team-card:hover {
         transform: scale(1.05);
     }
 </style>
 @endpush