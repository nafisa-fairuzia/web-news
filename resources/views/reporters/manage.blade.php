@extends('layout.main')

@section('title', 'Kelola Reporter')

@section('content')
<div class="container mb-4 py-5" >
    <h2 class="fw-semibold">Kelola Reporter</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Filter Reporter</h5>
            <form method="GET" action="{{ url('/manage') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-calendar me-1"></i> Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-tag me-1"></i> Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">-- Semua Kategori --</option>
                            <option value="RPL" {{ old('kategori')=='RPL' ? 'selected' : '' }}>RPL</option>
                            <option value="DKV" {{ old('kategori')=='DKV' ? 'selected' : '' }}>DKV</option>
                            <option value="TKJ" {{ old('kategori')=='TKJ' ? 'selected' : '' }}>TKJ</option>
                            <option value="TSM" {{ old('kategori')=='TSM' ? 'selected' : '' }}>TSM</option>
                            <option value="TKR" {{ old('kategori')=='TKR' ? 'selected' : '' }}>TKR</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-file-earmark-text me-1"></i> Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filter</button>
                        <a href="{{ url('/manage') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-repeat me-1"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('reporters.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Reporter</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center text-nowrap">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reporters as $index => $item)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->password }}</td>
                    <td>
                        <a href="{{ route('reporters.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('reporters.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada reporter</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
        {{ $reporters->links('pagination::bootstrap-5') }}
    </div>


</div>
@endsection