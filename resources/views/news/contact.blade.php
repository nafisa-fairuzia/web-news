@extends('layout.main')

@section('title', 'Hubungi Kami')

@section('content')
<div class=" py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <h1 class="fw-bold text-center mb-4">Hubungi Kami</h1>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4">
                        <form method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label fw-semibold">Subjek</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek Pesan" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Pesan</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesanmu..." required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                        <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Pelita no 27 Sidomekar - Semboro - Jember Jawa Timur, Indonesia </p>
                        <p><i class="bi bi-telephone-fill me-2"></i>(0336)444112</p>
                        <p><i class="bi bi-envelope-fill me-2"></i>smknegeri08jember@gmail.com</p>

                        <div class="d-flex gap-2 mb-3">
                            <a href="https://www.facebook.com/SMKNegeri8Jbr/" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.youtube.com/@smkn8jemberofficial" class="btn btn-outline-danger btn-sm"><i class="bi bi-youtube"></i></a>
                            <a href="https://www.tiktok.com/@smkn.8.jember.off" class="btn btn-outline-secondary btn-sm"><i class="bi bi-tiktok"></i></a>
                            <a href="https://www.instagram.com/smkn8_official/" class="btn btn-outline-danger btn-sm"><i class="bi bi-instagram"></i></a>

                        </div>

                        <div class="mt-3 rounded overflow-hidden" style="height:250px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d395.8328670805743!2d113.45707231565585!3d-8.212882004703619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd689a74a6ed807%3A0x8dafe690fd4375d6!2sSMK%20Negeri%208%20Jember!5e0!3m2!1sid!2sid!4v1695881234567!5m2!1sid!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    input.form-control:focus,
    textarea.form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.3);
        transition: 0.3s;
    }

    .btn-outline-primary:hover {
        background-color: #3b5998;
        color: #fff;
    }

    .btn-outline-info:hover {
        background-color: #00acee;
        color: #fff;
    }

    .btn-outline-danger:hover {
        background-color: #C13584;
        color: #fff;
    }

    .btn-outline-secondary:hover {
        background-color: #0e76a8;
        color: #fff;
    }
</style>
@endsection