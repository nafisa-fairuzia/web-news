@extends('layout.main')

@section('title', 'Edit Reporter')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 bg-light">
                <h2 class="text-center mb-4 fw-bold text-primary">
                    Edit Data Reporter
                </h2>

                <form action="{{ route('reporters.update', $reporter->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Nama Reporter</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                            value="{{ old('name', $reporter->name) }}" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                            value="{{ old('email', $reporter->email) }}" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Password (opsional) --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password (Opsional)</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                            placeholder="Biarkan kosong jika tidak diganti">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tombol Update --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                            Update Reporter
                        </button>
                    </div>
                </form>

                {{-- Tombol Kembali --}}
                <div class="text-center mt-4">
                    <a href="{{ route('reporters.index') }}" class="text-decoration-none text-secondary fw-semibold">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
