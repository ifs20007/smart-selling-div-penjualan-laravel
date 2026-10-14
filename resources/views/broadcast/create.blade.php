<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Broadcast Baru</title>
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
        
        .clean-card { width: 100%; max-width: 800px; margin: 0 auto; background-color: var(--bg-card); border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .form-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; border-bottom: 1px dashed var(--border-light); padding-bottom: 15px; }
        .form-header h3 { margin: 0; color: var(--primary-navy); font-weight: 800; font-size: 20px; }
        
        .form-group { margin-bottom: 20px; }
        .form-label { font-weight: 700; color: var(--primary-navy); margin-bottom: 8px; font-size: 14px; display: block; }
        .form-control, .form-select { border: 1px solid var(--border-light); border-radius: 8px; padding: 12px 15px; font-size: 14px; color: var(--text-dark); background-color: #F8FAFC; transition: 0.3s; width: 100%; box-sizing: border-box; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-navy); outline: none; background-color: #ffffff; box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); }
        
        .btn-clean { padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 700; text-decoration: none !important; transition: 0.3s; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; }
        .btn-save { background-color: var(--accent-orange); color: #ffffff; width: 100%; justify-content: center; }
        .btn-save:hover { background-color: #e08316; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(247, 148, 29, 0.3); }
        .btn-back { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-back:hover { background-color: #E2E8F0; color: var(--text-dark); }
        
        .alert-info { background-color: #ebf5fb; color: #2980b9; border: 1px solid #3498db; border-radius: 8px; padding: 15px; font-size: 13.5px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="form-header">
            <h3><i class="fa-solid fa-paper-plane" style="color: var(--accent-orange); margin-right:8px;"></i> Buat Broadcast Baru</h3>
            <a href="{{ route('broadcast.index') }}" class="btn-clean btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>

        <div class="alert-info mb-4">
            <i class="fa-solid fa-info-circle me-2"></i> Broadcast akan dikirim melalui WhatsApp API (Fonnte) ke semua pelanggan yang memiliki nomor WhatsApp valid di dalam kategori yang dipilih. Jeda waktu 2 detik antar pesan akan diterapkan otomatis.
        </div>

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius: 8px; background-color: #fdedec; color: #c0392b; border: 1px solid #e74c3c; padding: 15px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('broadcast.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Target Kategori Pelanggan</label>
                <select name="kategori_toko_id" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Kategori Pelanggan --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->kategori_toko_id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
                <small style="color: var(--text-muted); font-size: 12px; margin-top: 5px; display: block;">Hanya pelanggan dengan nomor WhatsApp yang akan menerima pesan ini.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Pesan WhatsApp</label>
                <textarea name="isi_pesan" class="form-control" rows="8" required placeholder="Ketikkan pesan broadcast Anda di sini..."></textarea>
                <small style="color: var(--text-muted); font-size: 12px; margin-top: 5px; display: block;">Pastikan isi pesan relevan dan tidak bersifat spamming.</small>
            </div>

            <button type="submit" class="btn-clean btn-save" onclick="return confirm('Apakah Anda yakin ingin mengirim pesan broadcast ini? Proses ini mungkin memakan waktu beberapa saat tergantung jumlah penerima.')"><i class="fa-solid fa-paper-plane"></i> Kirim Broadcast Sekarang</button>
        </form>
    </div>
</body>
</html>
