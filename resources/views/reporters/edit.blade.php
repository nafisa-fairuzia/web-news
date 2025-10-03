@extends('layout.main')

@section('title', 'Edit Reporter')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                <h2 class="text-center mb-4 fw-bold">Edit Data Reporter</h2>

                <form action="{{ route('reporters.update', $reporter->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Reporter</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $reporter->name) }}" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $reporter->email) }}" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password (opsional)</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Biarkan kosong jika tidak diganti">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg fw-bold">
                            Update
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