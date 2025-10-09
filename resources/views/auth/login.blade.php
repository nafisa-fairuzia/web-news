<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - PortalBerita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      padding: 1rem;
    }

    .login-wrapper {
      display: flex;
      max-width: 900px;
      width: 100%;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    .login-illustration {
      flex: 1;
      position: relative;
      background: url('https://images.unsplash.com/photo-1522199755839-a2bacb67c546?auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      color: #fff;
      text-align: center;
    }

    .login-illustration::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.45);
      z-index: 1;
      border-radius: 0 0 0 0;
    }

    .login-illustration>div {
      position: relative;
      z-index: 2;
    }

    .login-illustration h2 {
      font-weight: 700;
      font-size: 1.8rem;
      text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .login-container {
      flex: 1;
      padding: 3rem 2rem;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header i {
      font-size: 3rem;
      color: #253b80;
    }

    .login-header h3 {
      font-weight: 700;
      margin-top: 0.8rem;
      color: #1d3557;
    }

    .login-header p {
      color: #6c757d;
      font-size: 0.9rem;
    }

    .form-control {
      border-radius: 12px;
      padding: 0.75rem 1rem;
      border: 1px solid #ced4da;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #457b9d;
      box-shadow: 0 0 8px rgba(69, 123, 157, 0.4);
    }

    .btn-login {
      background: linear-gradient(135deg, #253b80, #179bd7);
      border: none;
      border-radius: 12px;
      padding: 0.75rem;
      font-weight: 600;
      transition: all 0.3s ease;
      color: #fff;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #179bd7, #253b80);
      color: #fff;
      transform: translateY(-2px);
    }

    .extra-links {
      margin-top: 1.5rem;
      text-align: center;
      font-size: 0.9rem;
    }

    .extra-links a {
      text-decoration: none;
      color: #457b9d;
      font-weight: 500;
    }

    .extra-links a:hover {
      color: #1d3557;
    }

    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
      }

      .login-illustration {
        min-height: 200px;
      }

      .login-container {
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-illustration">
      <div>
        <h2>PortalBerita</h2>
        <p>Kelola konten dan laporan berita dengan cepat melalui akun admin atau reporter Anda</p>
      </div>
    </div>

    <div class="login-container">
      <div class="login-header">
        <i class="bi bi-person-circle"></i>
        <h3>Selamat Datang</h3>
        <p>Silakan login untuk melanjutkan</p>
      </div>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required />
        </div>

        <div class="mb-3 position-relative">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required />
          <span class="position-absolute top-50 end-0 me-3 mt-1" style="cursor:pointer;" id="togglePassword">
            <i class="bi bi-eye"></i>
          </span>
        </div>

        <button type="submit" class="btn btn-login w-100">Masuk</button>
      </form>

      <div class="extra-links">
        <a href="#">Lupa Kata Sandi?</a>
      </div>
    </div>
  </div>
</body>
<script>
  const passwordInput = document.getElementById('password');
  const togglePassword = document.getElementById('togglePassword');
  togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
  });
</script>

</html>