<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Selling CMS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --bg-body: #F4F7F6;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-color: #E2E8F0;
        }

        body { 
            margin: 0; padding: 0; 
            background-color: var(--bg-body);
            color: var(--text-dark); 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
            display: flex; align-items: center; justify-content: center; 
            height: 100vh; overflow: hidden; 
        }
        
        .login-card { 
            background: #ffffff; 
            border-radius: 16px; 
            padding: 45px 40px; width: 100%; max-width: 420px; 
            box-shadow: 0 15px 35px rgba(0, 59, 115, 0.08); 
            border: 1px solid rgba(0,0,0,0.03);
        }

        .logo-container { text-align: center; margin-bottom: 25px; }
        .logo-container img { max-width: 120px; margin-bottom: 20px; }
        
        .login-title { font-weight: 800; font-size: 22px; color: var(--primary-navy); letter-spacing: 0.5px; margin-bottom: 5px; }
        .login-subtitle { font-size: 13px; color: var(--text-muted); font-weight: 500; }

        /* Styling baru untuk kotak peringatan salah password */
        .alert-error {
            background-color: #fdf2f2;
            color: #e74c3c;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid #fce8e8;
            display: flex;
            align-items: center;
        }
        .alert-error i { margin-right: 10px; font-size: 16px; }

        .form-group { margin-bottom: 20px; position: relative; }
        .form-group i { position: absolute; left: 16px; top: 15px; color: var(--text-muted); font-size: 16px; transition: 0.3s;}
        
        input { 
            width: 100%; padding: 14px 18px 14px 45px; 
            background: #F8FAFC; box-sizing: border-box;
            color: var(--text-dark); 
            border: 1px solid var(--border-color); 
            border-radius: 10px; font-size: 14.5px; font-weight: 500;
            outline: none; transition: 0.3s; 
        }
        input::placeholder { color: #A0AEC0; font-weight: 400;}
        input:focus { 
            background: #ffffff;
            border-color: var(--primary-navy); 
            box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); 
        }
        input:focus + i { color: var(--primary-navy); }
        
        .btn-login { 
            width: 100%; 
            background: var(--accent-orange); 
            color: #ffffff; 
            padding: 14px; 
            border: none; 
            border-radius: 10px; font-weight: bold; font-size: 15px; cursor: pointer; letter-spacing: 0.5px; 
            box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3); 
            transition: all 0.3s ease; margin-top: 5px; 
        }
        .btn-login:hover { 
            background: #e08316; 
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(247, 148, 29, 0.4);
        }

        .btn-back {
            display: block; width: 100%;
            background: #ffffff; color: var(--text-muted);
            padding: 12px; border: 1px solid var(--border-color);
            border-radius: 10px; font-weight: 600; font-size: 14px; 
            text-align: center; text-decoration: none;
            transition: all 0.3s ease; margin-top: 10px;
        }
        .btn-back:hover {
            background: var(--bg-body);
            color: var(--primary-navy);
            border-color: var(--primary-navy);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('assets/images/posind.png') }}" alt="Logo Pos Indonesia">
            <div class="login-title">Smart Selling CMS</div>
            <div class="login-subtitle">Masuk untuk mengelola pemasaran & operasional</div>
        </div>

        <!-- Posisi peringatan salah sandi tepat di atas form input -->
        @if ($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Username atau Password anda salah
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Pengguna (Username)" required autofocus autocomplete="username">
                <i class="fa-solid fa-user"></i>
            </div>
            
            <div class="form-group" style="margin-bottom: 10px;">
                <input type="password" name="password" placeholder="Kata Sandi" required autocomplete="current-password">
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <div style="text-align: right; margin-bottom: 15px;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 13px; color: var(--primary-navy); text-decoration: none; font-weight: 600;">Lupa Kata Sandi?</a>
                @endif
            </div>
            
            <button type="submit" class="btn-login"><i class="fa-solid fa-right-to-bracket me-2"></i> MASUK SISTEM</button>
            <a href="{{ route('front.index') }}" class="btn-back"><i class="fa-solid fa-house me-2"></i> Kembali ke Beranda</a>
        </form>
    </div>

    <!-- Script Javascript untuk Toast Notification dihapus sepenuhnya -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>