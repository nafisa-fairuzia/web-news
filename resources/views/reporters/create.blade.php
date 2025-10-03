@extends('layout.main')

@section('title', 'Tambah Reporter')

@section('content')

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                <h2 class="text-center mb-4 fw-bold">Tambahkan Reporter Baru</h2>

                <form action="{{ route('reporters.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Reporter</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Contoh: budi@email.com" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Minimal 6 karakter" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            Simpan
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('reporters.index') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
