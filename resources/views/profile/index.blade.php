@extends('layout.main')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- HEADER --}}
            <div class="card border-0 shadow-lg mb-4 overflow-hidden profile-glass">
                <div class="position-relative" style="height: 220px; overflow: hidden;">
                    {{-- Background foto user / default --}}
                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://picsum.photos/1200/400?grayscale' }}"
                        class="w-100 h-100 object-fit-cover"
                        alt="Background"
                        style="filter: blur(14px); transform: scale(1.12);">
                    <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                        style="background: rgba(30,40,80,0.45);backdrop-filter: blur(2px);"></div>
                </div>
                <div class="card-body text-center position-relative" style="margin-top:-80px;">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=253b80&color=fff'}}"
                            alt="Avatar"
                            class="rounded-circle border border-4 border-white shadow avatar-animate"
                            width="140" height="140" style="object-fit: cover; background: #fff;">
                        <h3 class="fw-bold mt-3 mb-1 text-dark">{{ $user->name }}</h3>
                        <span class="badge px-3 py-2 mb-2 text-capitalize profile-badge-{{ $user->role }}">
                            <i class="bi bi-person-badge me-1"></i> {{ $user->role }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ALERTS --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 px-4 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger rounded-3 p-3 shadow-sm">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- NAVIGATION --}}
            <ul class="nav nav-pills justify-content-center mb-4 gap-2" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold px-4 py-2" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">
                        <i class="bi bi-person-lines-fill me-1"></i> Info Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold px-4 py-2" id="avatar-tab" data-bs-toggle="tab" data-bs-target="#avatar" type="button">
                        <i class="bi bi-image me-1"></i> Avatar
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold px-4 py-2" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button">
                        <i class="bi bi-key-fill me-1"></i> Password
                    </button>
                </li>
            </ul>

            {{-- CONTENT --}}
            <div class="tab-content" id="profileTabContent">

                {{-- Info Profil --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>
                                <button class="btn btn-gradient w-100 py-2 fw-bold">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Avatar --}}
                <div class="tab-pane fade" id="avatar" role="tabpanel">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pilih Foto</label>
                                    <input type="file" name="avatar" class="form-control" required>
                                </div>
                                <button class="btn btn-gradient w-100 py-2 fw-bold">Ganti Foto</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <form action="{{ route('profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Password Lama</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Password Baru</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                <button class="btn btn-gradient w-100 py-2 fw-bold">Ubah Password</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Styles --}}
@push('styles')
<style>
    .btn-gradient {
        background: linear-gradient(135deg, #253b80, #179bd7);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #179bd7, #253b80);
        color: #fff;
    }

    .nav-pills .nav-link {
        color: #253b80;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #253b80, #179bd7);
        color: #fff;
    }

    .nav-pills .nav-link:hover {
        background: rgba(37, 59, 128, 0.08);
        color: #179bd7;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .profile-glass {
        background: rgba(255, 255, 255, 0.85) !important;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        border-radius: 1.5rem;
        overflow: hidden;
        backdrop-filter: blur(4px);
    }

    .avatar-animate {
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .avatar-animate:hover {
        box-shadow: 0 0 0 6px #179bd7a0, 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        transform: scale(1.04);
    }

    .profile-badge-admin,
    .profile-badge-reporter {
        background: linear-gradient(90deg, #253b80, #179bd7);
        color: #fff;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.08);
    }

    .profile-badge-admin i,
    .profile-badge-reporter i,
    .profile-badge-user i {
        color: #fff;
    }

    .nav-pills .nav-link {
        color: #253b80;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s;
        letter-spacing: 0.2px;
        box-shadow: 0 1px 4px rgba(23, 155, 215, 0.04);
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #253b80, #179bd7);
        color: #fff;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.10);
    }

    .nav-pills .nav-link:hover {
        background: rgba(37, 59, 128, 0.10);
        color: #179bd7;
        transform: translateY(-2px);
    }

    .btn-gradient {
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.2px;
        box-shadow: 0 2px 8px rgba(23, 155, 215, 0.08);
        transition: all 0.2s;
    }

</style>
@endpush
@endsection