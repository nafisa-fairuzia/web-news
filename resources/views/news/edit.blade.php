@extends('layout.main')

@section('title', 'Edit Berita')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 bg-light">
                <h2 class="text-center mb-4 fw-bold text-primary">
                    Edit Berita
                </h2>

                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                        <input type="text" class="form-control form-control-lg" id="judul" name="judul"
                            value="{{ old('judul', $news->title) }}" required>
                    </div>

                    {{-- Kategori & Tanggal --}}
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                                <option value="TKR" {{ old('kategori', $news->category)=='TKR' ? 'selected' : '' }}>TKR</option>
                                <option value="TSM" {{ old('kategori', $news->category)=='TSM' ? 'selected' : '' }}>TSM</option>
                                <option value="TKJ" {{ old('kategori', $news->category)=='TKJ' ? 'selected' : '' }}>TKJ</option>
                                <option value="RPL" {{ old('kategori', $news->category)=='RPL' ? 'selected' : '' }}>RPL</option>
                                <option value="DKV" {{ old('kategori', $news->category)=='DKV' ? 'selected' : '' }}>DKV</option>
                                <option value="ATPH" {{ old('kategori', $news->category)=='ATPH' ? 'selected' : '' }}>ATPH</option>
                                <option value="APT" {{ old('kategori', $news->category)=='APT' ? 'selected' : '' }}>APT</option>
                                <option value="Prestasi" {{ old('kategori', $news->category)=='Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="Umum" {{ old('kategori', $news->category)=='Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', $news->published_at) }}" required>
                        </div>
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-4">
                        <label for="author" class="form-label fw-semibold">Penulis</label>
                        <input type="text" class="form-control" id="author" name="author"
                            value="{{ old('author', $news->author) }}" required>
                    </div>

                    {{-- Upload Gambar dengan Preview --}}
                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-semibold">Unggah Gambar</label>
                        @if($news->image)
                            <div class="mb-2 text-center">
                                <p class="fw-semibold text-muted mb-2">Gambar Lama:</p>
                                <img src="{{ asset('storage/'.$news->image) }}" alt="Gambar Lama"
                                     class="img-fluid rounded shadow-sm border" style="max-height: 250px;">
                            </div>
                        @endif
                        <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
                        <div class="mt-3 text-center" id="preview-container" style="display: none;">
                            <p class="fw-semibold text-muted mb-2">Preview Gambar Baru:</p>
                            <img id="preview-image" src="#" alt="Preview Gambar"
                                 class="img-fluid rounded shadow-sm border" style="max-height: 250px;">
                        </div>
                        <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengganti gambar</small>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="mb-4">
                        <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" placeholder="Tulis isi berita lengkap di sini..." required>{{ old('isi', $news->content) }}</textarea>
                    </div>

                    {{-- Tombol Update --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                            Update Berita
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
