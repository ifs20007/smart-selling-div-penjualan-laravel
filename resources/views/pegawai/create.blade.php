<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-navy: #003B73; --bg-card: #FFFFFF; --text-dark: #1A252F; --text-muted: #5D6D7E; --border-light: #E2E8F0; }
        body { margin: 0; padding: 30px 15px; color: var(--text-dark); font-family: 'Segoe UI', sans-serif; background: transparent; }
        .clean-card { background-color: var(--bg-card); border-radius: 12px; padding: 35px; max-width: 550px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .header-title { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px dashed var(--border-light); padding-bottom: 15px; }
        .header-title h2 { margin: 0; font-size: 18px; font-weight: 800; color: var(--primary-navy); }
        .btn-back { background-color: #F1F5F9; color: var(--text-muted); padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; font-size: 12px; color: var(--text-muted); text-transform: uppercase;}
        input, select { width: 100%; padding: 12px 16px; background-color: #F8FAFC; border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; }
        input:focus, select:focus { border-color: var(--primary-navy); }
        .btn-submit { background-color: var(--primary-navy); color: #ffffff; padding: 14px; border: none; border-radius: 8px; font-weight: 700; width: 100%; cursor: pointer; transition: 0.3s;}
        .btn-submit:hover { background-color: #002D59; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="header-title">
            <h2><i class="fa-solid fa-user-plus text-warning me-2"></i> Tambah Akun Baru</h2>
            <a href="{{ route('pegawai.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
        </div>
        
        <!-- Menampilkan Error Validasi (Email Duplikat dll) -->
        @if ($errors->any())
            <div class="alert alert-danger" style="font-size: 13px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username / Nama Pegawai</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan username unik..." required>
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email wajib diisi untuk fitur lupa sandi..." required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Minimal 4 karakter" required>
            </div>
            <div class="form-group">
                <label>Role / Hak Akses</label>
                <select name="role" required>
                    <option value="Pegawai" {{ old('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai Lapangan</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Administrator Sistem</option>
                </select>
            </div>
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk me-2"></i> Buat Akun Sistem</button>
        </form>
    </div>
</body>
</html>