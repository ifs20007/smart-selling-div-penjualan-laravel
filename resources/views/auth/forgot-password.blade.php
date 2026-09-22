<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Smart Selling CMS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --primary-navy: #003B73; --accent-orange: #F7941D; --bg-body: #F4F7F6; --text-dark: #2C3E50; --text-muted: #7F8C8D; --border-color: #E2E8F0; }
        body { margin: 0; background-color: var(--bg-body); color: var(--text-dark); font-family: 'Segoe UI', Tahoma, sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { background: #ffffff; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 15px 35px rgba(0, 59, 115, 0.08); border: 1px solid rgba(0,0,0,0.03); }
        .logo-container { text-align: center; margin-bottom: 25px; }
        .logo-container img { max-width: 100px; margin-bottom: 15px; }
        .login-title { font-weight: 800; font-size: 20px; color: var(--primary-navy); margin-bottom: 10px; }
        .login-subtitle { font-size: 13.5px; color: var(--text-muted); font-weight: 500; line-height: 1.5; margin-bottom: 25px;}
        
        .form-group { margin-bottom: 20px; position: relative; }
        .form-group i { position: absolute; left: 16px; top: 15px; color: var(--text-muted); font-size: 16px; }
        input { width: 100%; padding: 14px 18px 14px 45px; background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 10px; font-size: 14.5px; outline: none; transition: 0.3s; box-sizing: border-box; }
        input:focus { background: #ffffff; border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); }
        
        .btn-login { width: 100%; background: var(--accent-orange); color: #ffffff; padding: 14px; border: none; border-radius: 10px; font-weight: bold; font-size: 14.5px; cursor: pointer; transition: 0.3s; }
        .btn-login:hover { background: #e08316; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(247, 148, 29, 0.4); }
        .btn-back { display: block; width: 100%; background: #ffffff; color: var(--text-muted); padding: 12px; border: 1px solid var(--border-color); border-radius: 10px; font-weight: 600; font-size: 14px; text-align: center; text-decoration: none; margin-top: 10px; transition: 0.3s; }
        .btn-back:hover { background: var(--bg-body); color: var(--primary-navy); border-color: var(--primary-navy); }
        .alert-success { background-color: #e8f9f0; color: #27ae60; padding: 12px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; border: 1px solid #d1f3e0; display: flex; align-items: center; }
        .alert-error { background-color: #fdf2f2; color: #e74c3c; padding: 12px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; border: 1px solid #fce8e8; display: flex; align-items: center; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('assets/images/posind.png') }}" alt="Logo Pos Indonesia">
            <div class="login-title">Lupa Kata Sandi?</div>
            <div class="login-subtitle">Tidak masalah. Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan tautan untuk membuat kata sandi baru.</div>
        </div>

        <!-- Notifikasi Berhasil -->
        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('status') }}
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if ($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> Email tidak ditemukan di sistem.
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email Anda" required autofocus>
                <i class="fa-solid fa-envelope"></i>
            </div>
            
            <button type="submit" class="btn-login"><i class="fa-solid fa-paper-plane me-2"></i> KIRIM TAUTAN</button>
            <a href="{{ route('login') }}" class="btn-back">Kembali ke Halaman Login</a>
        </form>
    </div>
</body>
</html>