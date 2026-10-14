<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tambah Prospek / Mitra</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --bg-body: #F4F7F6;
            --bg-card: #FFFFFF;
            --text-dark: #1A252F;
            --text-muted: #5D6D7E;
            --border-light: #E2E8F0;
        }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: transparent !important; padding: 20px 10px; margin: 0; color: var(--text-dark); }
        
        .clean-card { width: 100%; max-width: 800px; margin: 0 auto; background-color: var(--bg-card); border-radius: 16px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .card-header-clean { margin-bottom: 30px; border-bottom: 1px dashed var(--border-light); padding-bottom: 20px; }
        .card-header-clean h3 { margin: 0; color: var(--primary-navy); font-weight: 800; font-size: 20px; }
        .card-header-clean p { margin: 5px 0 0 0; color: var(--text-muted); font-size: 14px; }
        
        .form-group { margin-bottom: 22px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 700; color: var(--text-dark); font-size: 13px; letter-spacing: 0.5px; }
        .form-control, select.form-control { width: 100%; padding: 14px 16px; background-color: #F8FAFC; border: 1px solid var(--border-light); border-radius: 10px; color: var(--text-dark); font-size: 14px; outline: none; transition: 0.3s; box-sizing: border-box; }
        .form-control:focus, select.form-control:focus { border-color: var(--primary-navy); background-color: #ffffff; box-shadow: 0 0 0 4px rgba(0, 59, 115, 0.05); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        
        .row-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        
        .btn-container { display: flex; gap: 12px; margin-top: 30px; }
        .btn { padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: bold; text-decoration: none !important; border: none; cursor: pointer; transition: 0.3s; text-align: center; display: inline-block;}
        .btn-cancel { background-color: #F1F5F9; color: var(--text-muted); flex: 1; }
        .btn-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-save { background-color: var(--primary-navy); color: #ffffff; flex: 2; }
        .btn-save:hover { background-color: #002D59; color: #ffffff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0, 59, 115, 0.2); }

        @media (max-width: 768px) {
            .clean-card { padding: 25px 20px; }
            .row-grid { grid-template-columns: 1fr; gap: 0; }
            .btn-container { flex-direction: column-reverse; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="card-header-clean">
            <h3><i class="fa-solid fa-store" style="color: var(--accent-orange); margin-right:8px;"></i> Tambah Mitra / Prospek</h3>
            <p>Masukkan data klien atau calon pelanggan baru</p>
        </div>

        <form action="{{ route('daftar-toko.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">KATEGORI BISNIS *</label>
                <select name="kategori_toko_id" class="form-control" required>
                    <option value="">-- Pilih Klasifikasi Bisnis --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->kategori_toko_id }}" {{ old('kategori_toko_id') == $kategori->kategori_toko_id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row-grid">
                <div class="form-group">
                    <label class="form-label">NAMA TOKO / INSTANSI *</label>
                    <input type="text" name="nama_toko" class="form-control" value="{{ old('nama_toko') }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="form-label">NAMA PEMILIK / PIC</label>
                    <input type="text" name="nama_pemilik" class="form-control" value="{{ old('nama_pemilik') }}" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">ALAMAT LENGKAP TOKO *</label>
                <textarea name="alamat_toko" class="form-control" required>{{ old('alamat_toko') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">NOMOR WHATSAPP *</label>
                <input type="text" name="nomor_whatsapp" class="form-control" placeholder="Contoh: 628123456789" value="{{ old('nomor_whatsapp') }}" required autocomplete="off">
            </div>

            <div class="form-group">
                <label class="form-label">STATUS KEMITRAAN *</label>
                <select name="status_kemitraan" class="form-control" required>
                    <option value="Prospek" {{ old('status_kemitraan') == 'Prospek' ? 'selected' : '' }}>Prospek (Calon Pelanggan)</option>
                    <option value="Pelanggan Aktif" {{ old('status_kemitraan') == 'Pelanggan Aktif' ? 'selected' : '' }}>Pelanggan Aktif</option>
                    <option value="Mantan Pelanggan" {{ old('status_kemitraan') == 'Mantan Pelanggan' ? 'selected' : '' }}>Mantan Pelanggan</option>
                </select>
            </div>

            <div class="btn-container">
                <a href="{{ route('daftar-toko.index') }}" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Data Prospek</button>
            </div>
        </form>
    </div>
    @if($errors->any())
        <script>
            if(window.parent && window.parent.showToast) {
                window.parent.showToast("{{ $errors->first() }}", 'error');
            }
        </script>
    @endif
</body>
</html>
