<div id="sidebar" class="sidebar">
  <div class="sidebar-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0 d-flex align-items-center">
      <img src="{{ asset('assets/img/logo.png') }}"
        alt="Logo"
        class="me-2"
        style="height: 2rem; width: 2rem; object-fit: contain; ">
      <span class="fs-6 fw-bold">SMKN 08 Jember</span>
    </h5>
    <button class="btn btn-sm btn-light d-lg-none" id="sidebarClose">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <ul class="list-unstyled mt-3">
    <li class="sidebar-section">Dashboard</li>
    <li>
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill me-2"></i> Beranda
      </a>
    </li>
    <li class="sidebar-section">Utama</li>
    <li>
      <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.index') ? 'active' : '' }}">
        <i class="fa-solid fa-newspaper me-2"></i> Berita
      </a>
    </li>
    <li class="sidebar-section">Manajemen</li>
    <li>
      <a href="{{ route('news.manage') }}" class="{{ request()->routeIs('news.manage') ? 'active' : '' }}">
        <i class="fa-solid fa-folder-open me-2"></i> Kelola Berita
      </a>
    </li>
    @auth
    @if(auth()->user()->role == 'admin')
    <li>
      <a href="{{ route('reporters.index') }}" class="{{ request()->routeIs('reporters.index') ? 'active' : '' }}">
        <i class="bi bi-person-workspace me-2"></i> Kelola Reporter
      </a>
    </li>
    @endif
    @endauth

    <li class="sidebar-section">Akun</li>
    <li>
      <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="bi bi-person-circle me-2"></i> Profil
      </a>
    </li>

    @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reporter')
    <li class="sidebar-section">Lainnya</li>
    <li>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
        <i class="bi bi-info-circle-fill me-2"></i> Tentang
      </a>
    </li>
    <li>
      <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
        <i class="bi bi-envelope-fill me-2"></i> Kontak
      </a>
    </li>
    @endif
    @endauth

  </ul>
</div>


<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm navbar-animated px-4 py-3">
  <div class="container-fluid">
    @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reporter')
    <button class="btn btn-link text-white me-3" id="sidebarToggle">
      <i class="bi bi-list fs-3"></i>
    </button>
    @endif
    @endauth

    <a class="navbar-brand fw-bold text-white d-flex align-items-center d-none d-lg-flex">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="me-2" style="height: 2rem; width: 2rem; object-fit: contain; vertical-align: middle;"> <span class="fs-5">SMKN 08 Jember</span>
    </a>


    @guest
    <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop">
      <i class="bi bi-list fs-1"></i>
    </button>
    @endguest

    <div class="collapse navbar-collapse justify-content-center" id="navbarTop">
      <ul class="navbar-nav">
        @guest
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i> Beranda</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" href="{{ route('news.index') }}"><i class="bi bi-card-text me-1"></i> Berita</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}"><i class="bi bi-info-circle me-1"></i> Tentang</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}"><i class="bi bi-envelope me-1"></i> Kontak</a></li>
        @endguest
      </ul>
    </div>

    <div class="d-flex align-items-center">
      <form class="d-flex me-3" action="{{ route('news.index') }}" method="GET">
        <input class="form-control search-bar" type="search" name="q" placeholder="Cari berita...">
        <button class="btn btn-light search-btn" type="submit"> <i class="bi bi-search"></i>
        </button>
      </form>

      @auth
      @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reporter')
      <div class="dropdown">
        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
          href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0D6EFD&color=fff&size=40' }}"
            alt="profile"
            class="rounded-circle me-2 shadow-sm border border-white"
            width="40" height="40"
            style="object-fit: cover; object-position: center;">
          <div class="d-none d-md-block text-truncate" style="max-width: 120px;">
            <span class="fw-bold">{{ auth()->user()->name }}</span><br>
            <small class="text-warning text-capitalize">{{ auth()->user()->role }}</small>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-1"></i> Profil</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
              @csrf
              <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
          </li>
        </ul>
      </div>

      @endif
      @else
      <a class="btn btn-custom" href="{{ route('login') }}">
        <i class="bi bi-person-circle me-1"></i> Login
      </a>
      @endauth


    </div>
  </div>
</nav>