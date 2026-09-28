<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
        }

        .clean-card { 
            background-color: #ffffff; 
            border-radius: 12px; 
            padding: 30px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.04); 
            border: 1px solid var(--border-light); 
        }

        .card-header-clean { 
            border-bottom: 1px solid var(--border-light); 
            padding-bottom: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .card-header-clean h5 { 
            margin: 0; 
            font-size: 18px; 
            font-weight: 700; 
            color: var(--primary-navy); 
        }

        .clean-label {
            font-size: 12px; 
            color: var(--text-muted); 
            font-weight: bold; 
            margin-bottom: 8px; 
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .clean-input {
            width: 100%; 
            padding: 12px 16px; 
            background-color: #F8FAFC; 
            color: var(--text-dark); 
            border: 1px solid var(--border-light); 
            border-radius: 8px; 
            font-size: 14px; 
            outline: none; 
            transition: 0.3s;
        }

        .clean-input:focus {
            border-color: var(--primary-navy); 
            box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); 
            background: #ffffff;
        }

        .btn-modal-save {
            background-color: var(--primary-navy); 
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-modal-save:hover {
            background-color: #002D59;
            transform: translateY(-2px);
        }

        .btn-modal-cancel {
            background-color: #F1F5F9; 
            color: var(--text-muted);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-modal-cancel:hover {
            background-color: #E2E8F0; 
            color: var(--text-dark);
        }

        .form-group { margin-bottom: 20px; }
        .error-text { color: #e74c3c; font-size: 12px; font-weight: bold; margin-top: 5px; display: block; }
    </style>

    <div class="py-6 px-4 font-['Segoe_UI',Tahoma,sans-serif]">
        <div class="max-w-4xl mx-auto clean-card">
            
            <div class="card-header-clean">
                <i class="fa-solid fa-map-pin text-warning" style="font-size: 20px; color: var(--accent-orange); margin-right: 10px;"></i>
                <h5>Tambah Titik Agen / Cabang Baru</h5>
            </div>
            
            <form action="{{ route('kompetitor.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="clean-label">Pilih Ekspedisi <span style="color: #e74c3c;">*</span></label>
                    <select name="kategori_kompetitor_id" required class="clean-input">
                        <option value="">-- Pilih Ekspedisi --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->kategori_kompetitor_id }}" {{ old('kategori_kompetitor_id') == $kat->kategori_kompetitor_id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }} ({{ $kat->inisial }})
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_kompetitor_id') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="clean-label">Nama Agen / Cabang <span style="color: #e74c3c;">*</span></label>
                    <input type="text" name="nama_kompetitor" required value="{{ old('nama_kompetitor') }}" class="clean-input" placeholder="Contoh: JNE Sub Agen Sutomo">
                    @error('nama_kompetitor') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="clean-label">Alamat Lengkap <span style="color: #e74c3c;">*</span></label>
                    <textarea name="alamat" required rows="3" class="clean-input" placeholder="Tulis alamat lengkap agen di lapangan...">{{ old('alamat') }}</textarea>
                    @error('alamat') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="clean-label">Latitude (Garis Lintang) <span style="color: #e74c3c;">*</span></label>
                        <input type="text" name="latitude" required value="{{ old('latitude') }}" class="clean-input" placeholder="Contoh: 2.9549696">
                        @error('latitude') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="clean-label">Longitude (Garis Bujur) <span style="color: #e74c3c;">*</span></label>
                        <input type="text" name="longitude" required value="{{ old('longitude') }}" class="clean-input" placeholder="Contoh: 99.0617024">
                        @error('longitude') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group mb-8">
                    <label class="clean-label">Link Google Maps <span style="color: #e74c3c;">*</span></label>
                    <input type="url" name="url" required value="{{ old('url') }}" class="clean-input" placeholder="https://maps.google.com/?q=...">
                    @error('url') <span class="error-text"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--border-light); padding-top: 20px;">
                    <a href="{{ route('kompetitor.index') }}" class="btn-modal-cancel">Batal</a>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-floppy-disk" style="margin-right: 5px;"></i> Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>