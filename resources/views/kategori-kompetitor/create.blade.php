<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --bg-card: #FFFFFF;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
        }
        .clean-card { background-color: var(--bg-card); border-radius: 12px; padding: 35px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .header-title { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px dashed var(--border-light); padding-bottom: 15px; }
        .header-title h2 { margin: 0; font-size: 18px; font-weight: 700; color: var(--primary-navy); }
        .btn-back { background-color: #F1F5F9; color: var(--text-muted); padding: 8px 16px; border-radius: 6px; text-decoration: none !important; font-size: 13px; font-weight: 600; transition: 0.3s; white-space: nowrap;}
        .btn-back:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;}
        input[type="text"], textarea { width: 100%; padding: 12px 16px; background-color: #F8FAFC; color: var(--text-dark); border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; transition: 0.3s; }
        input[type="text"]:focus, textarea:focus { border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); background-color: #fff;}
        .color-picker-wrapper { display: flex; align-items: center; gap: 15px; background: #F8FAFC; padding: 10px; border-radius: 8px; border: 1px solid var(--border-light);}
        input[type="color"] { -webkit-appearance: none; border: none; width: 40px; height: 40px; border-radius: 8px; cursor: pointer; padding: 0; flex-shrink: 0;}
        input[type="color"]::-webkit-color-swatch-wrapper { padding: 0; }
        input[type="color"]::-webkit-color-swatch { border: none; border-radius: 6px; }
        .btn-submit { background-color: var(--primary-navy); color: #ffffff; padding: 12px; border: none; border-radius: 8px; font-weight: 600; width: 100%; font-size: 14px; margin-top: 10px; transition: 0.3s; cursor: pointer;}
        .btn-submit:hover { background-color: var(--primary-navy-hover); transform: translateY(-2px); }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="clean-card">
                
                <div class="header-title">
                    <h2><i class="fa-solid fa-square-plus mr-2 text-yellow-500"></i> Entitas Baru</h2>
                    <a href="{{ route('kategori-kompetitor.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali</a>
                </div>

                @if ($errors->any())
                    <div style="background-color: #fdedec; color: #c0392b; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                        <ul style="margin:0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori-kompetitor.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama Resmi Ekspedisi</label>
                        <input type="text" name="nama_kategori" placeholder="Contoh: POS Indonesia, JNE..." value="{{ old('nama_kategori') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Inisial Kode (Maks 4 Huruf)</label>
                        <input type="text" name="inisial" placeholder="Contoh: POS, JNE, J&T" value="{{ old('inisial') }}" maxlength="4" required style="text-transform: uppercase;">
                    </div>

                    <div class="form-group">
                        <label>Jenis Layanan</label>
                        <textarea name="keterangan" rows="3" placeholder="Contoh: Ekspedisi Reguler, Layanan Kargo..." required>{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Warna Brand / Identitas</label>
                        <div class="color-picker-wrapper">
                            <input type="color" name="kode_warna" value="{{ old('kode_warna', '#003B73') }}" required>
                            <span style="font-size: 12.5px; color: var(--text-dark); font-weight:500;">Klik kotak untuk memilih warna representatif peta.</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Data Master</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>