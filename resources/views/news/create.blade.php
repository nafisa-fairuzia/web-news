@extends('layout.main')

@section('title', 'Tambah Berita')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 bg-light">
                <h2 class="text-center mb-4 fw-bold text-primary">
                    Tambahkan Berita Baru
                </h2>

                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                        <input type="text" class="form-control form-control-lg" id="judul" name="judul"
                            placeholder="Contoh: Teknologi AI Mengubah Dunia" value="{{ old('judul') }}" required>
                    </div>

                    {{-- Kategori & Tanggal --}}
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
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
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-4">
                        <label for="author" class="form-label fw-semibold">Penulis</label>
                        <input
                            type="text"
                            class="form-control"
                            id="author"
                            name="author"
                            placeholder="Contoh: Nafisa"
                            value="{{ old('author', $defaultAuthor ?? '') }}">
                    </div>

                    {{-- Upload Gambar dengan Preview --}}
                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-semibold">Unggah Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*" required>
                        <div class="mt-3 text-center" id="preview-container" style="display: none;">
                            <p class="fw-semibold text-muted mb-2">Preview Gambar:</p>
                            <img id="preview-image" src="#" alt="Preview Gambar"
                                class="img-fluid rounded shadow-sm border" style="max-height: 300px;">
                        </div>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-4">
                        <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" placeholder="Tulis isi berita lengkap di sini..." required>{{ old('isi') }}</textarea>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                            Simpan Berita
                        </button>
                    </div>
                </form>

                {{-- Tombol Kembali --}}
                <div class="text-center mt-4">
                    <a href="{{ route('news.manage') }}" class="text-decoration-none text-secondary fw-semibold">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Gambar --}}
<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            previewImage.src = URL.createObjectURL(file);
            previewContainer.style.display = 'block';
        }
    });
</script>

@endsection
