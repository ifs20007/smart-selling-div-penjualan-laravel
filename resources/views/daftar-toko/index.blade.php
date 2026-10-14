<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Manajemen Data Mitra & Prospek</title>
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
            --bg-highlight: #F8FAFC;
        }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: transparent !important; padding: 20px 10px; margin: 0; color: var(--text-dark); overflow-x: hidden; }
        
        .clean-card { width: 100%; max-width: 1200px; margin: 0 auto 50px auto; background-color: var(--bg-card); border-radius: 16px; padding: 30px; box-sizing: border-box; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px dashed var(--border-light); padding-bottom: 20px; flex-wrap: wrap; gap: 15px;}
        .table-header h3 { margin: 0; color: var(--primary-navy); font-weight: 800; font-size: 20px; }
        
        .header-buttons { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn-clean { padding: 10px 18px; border-radius: 8px; font-size: 13.5px; font-weight: 700; text-decoration: none !important; transition: 0.3s; white-space: nowrap; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px;}
        
        .btn-add { background-color: var(--accent-orange); color: #ffffff; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.2); }
        .btn-add:hover { background-color: #e08316; color: #ffffff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(247, 148, 29, 0.3); }
        
        .btn-import { background-color: #27ae60; color: #fff; box-shadow: 0 4px 10px rgba(39, 174, 96, 0.2); }
        .btn-import:hover { background-color: #2ecc71; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(39, 174, 96, 0.3);}
        
        .btn-export { background-color: var(--primary-navy); color: #fff; box-shadow: 0 4px 10px rgba(0, 59, 115, 0.2); }
        .btn-export:hover { background-color: #002D59; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0, 59, 115, 0.3);}
        
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; margin-top: 10px; min-width: 800px; }
        th, td { padding: 15px 16px; text-align: left; }
        th { color: var(--text-muted); font-weight: 700; border-bottom: 2px solid var(--border-light); white-space: nowrap; text-transform: uppercase; font-size: 11.5px; letter-spacing: 0.5px; background-color: var(--bg-highlight);}
        td { border-bottom: 1px solid var(--border-light); color: var(--text-dark); font-weight: 500;}
        tr:hover td { background-color: var(--bg-highlight); }
        
        .badge-status { padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 11.5px; display: inline-block; white-space: nowrap;}
        .bg-prospek { background-color: #FFF5EA; color: #f39c12; border: 1px solid #f39c12;}
        .bg-aktif { background-color: #eafaf1; color: #27ae60; border: 1px solid #27ae60;}
        .bg-mantan { background-color: #fdedec; color: #c0392b; border: 1px solid #e74c3c;}
        .skala { background-color: #ebf5fb; color: #2980b9; border: 1px solid #3498db;}
        
        .aksi-buttons { display: flex; gap: 8px; flex-wrap: nowrap;}
        .btn-edit, .btn-delete { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; text-decoration: none !important; border-radius: 6px; font-size: 13px; border: none; cursor: pointer; transition: 0.2s; }
        .btn-edit { color: #2980b9; background-color: #ebf5fb; border: 1px solid #d6eaf8; } 
        .btn-edit:hover { background-color: #3498db; color: #fff; border-color: #3498db;}
        .btn-delete { color: #c0392b; background-color: #fdedec; border: 1px solid #fadbd8; }
        .btn-delete:hover { background-color: #e74c3c; color: #fff; border-color: #e74c3c;}
        
        .btn-locked { color: var(--text-muted); cursor: not-allowed; background-color: transparent; font-style: italic; font-size: 12px; padding: 8px 10px; display: inline-block; white-space: nowrap; font-weight: 600;}
        
        /* Modal Clean UI */
        .clean-modal { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .clean-input-file { background-color: var(--bg-highlight); color: var(--text-dark); border: 1px dashed var(--border-light); padding: 15px; border-radius: 10px; width: 100%; outline: none; margin-bottom: 15px; cursor: pointer; transition: 0.3s; font-weight: 500;}
        .clean-input-file:hover { border-color: var(--primary-navy); background-color: #ffffff;}
        
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; text-decoration: none !important; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-modal-danger { background-color: #e74c3c; color: #ffffff; }
        .btn-modal-danger:hover { background-color: #c0392b; color: #ffffff; }
        .btn-modal-save { background-color: #27ae60; color: #ffffff; }
        .btn-modal-save:hover { background-color: #2ecc71; color: #ffffff; }

        @media (max-width: 768px) {
            .clean-card { padding: 20px 15px; border-radius: 12px; width: 100%;}
            .table-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .table-header h3 { font-size: 18px; text-align: center; width: 100%;}
            .header-buttons { flex-direction: column; width: 100%; }
            .btn-clean { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="table-header">
            <h3><i class="fa-solid fa-store" style="color: var(--accent-orange); margin-right:8px;"></i> Database Mitra & Calon Prospek</h3>
            <div class="header-buttons">
                <a href="#" data-bs-toggle="modal" data-bs-target="#importModal" class="btn-clean btn-import"><i class="fa-solid fa-file-import"></i> Import Excel</a>
                <a href="{{ route('daftar-toko.export') }}" target="_blank" class="btn-clean btn-export"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('daftar-toko.create') }}" class="btn-clean btn-add"><i class="fa-solid fa-plus"></i> Rekam Manual</a>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr><th width="5%">No</th><th width="25%">Identitas Toko</th><th width="20%">Kategori Bisnis</th><th width="15%">WhatsApp</th><th width="15%">Status CRM</th><th width="20%">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($tokos as $toko)
                        @php
                            $badge_class = "bg-prospek";
                            if ($toko->status_kemitraan == 'Pelanggan Aktif') $badge_class = "bg-aktif";
                            if ($toko->status_kemitraan == 'Mantan Pelanggan') $badge_class = "bg-mantan";
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong style='color:var(--primary-navy); font-size:14.5px;'>{{ $toko->nama_toko }}</strong><br><small style='color:var(--text-muted); font-weight:600;'>PIC: {{ $toko->nama_pemilik }}</small></td>
                            <td>{{ $toko->kategoriToko->nama_kategori ?? '-' }}</td>
                            <td><a href='https://wa.me/{{ $toko->nomor_whatsapp }}' target='_blank' style='color:#27ae60; text-decoration:none; font-weight:600;'><i class='fa-brands fa-whatsapp'></i> {{ $toko->nomor_whatsapp }}</a></td>
                            <td><span class='badge-status {{ $badge_class }}'>{{ $toko->status_kemitraan }}</span></td>
                            <td class='aksi-buttons'>
                                @if(auth()->user()->role === 'Admin' || $toko->users_id == auth()->id())
                                    <a href="{{ route('daftar-toko.edit', $toko->toko_id) }}" class='btn-edit' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <button type="button" onclick='showDeleteModal("{{ route('daftar-toko.destroy', $toko->toko_id) }}", "{{ addslashes($toko->nama_toko) }}")' class='btn-delete' title='Hapus'><i class='fa-solid fa-trash-can'></i></button>
                                @else
                                    <span class='btn-locked'><i class='fa-solid fa-lock me-1'></i> Terkunci</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan='6' style='text-align:center; padding:40px; color:var(--text-muted); font-weight:500;'>Belum ada rekaman database prospek di sistem.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: #e74c3c; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation me-2"></i> Konfirmasi Penghapusan</h5>
                </div>
                <div class="modal-body border-0 pt-3 pb-4">
                    <p style="color: var(--text-dark); font-weight:500; font-size: 13.5px; margin-bottom: 0; line-height:1.6;">Yakin ingin menghapus rekam jejak toko <strong id="deleteEntityName" style="color: var(--primary-navy);"></strong> secara permanen?</p>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal btn-modal-danger">Ya, Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL IMPORT EXCEL -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: var(--primary-navy); font-weight: bold;"><i class="fa-solid fa-file-excel text-success me-2"></i> Import Data Massal (Excel)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('daftar-toko.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body border-0 pt-3 pb-4">
                        <p style="color: var(--text-dark); font-weight:500; font-size: 13.5px; margin-bottom: 15px; line-height:1.6;">
                            Upload file Microsoft Excel <b>(.xlsx)</b>. Pastikan urutan kolomnya sama persis dengan urutan ini:<br>
                            <code style="background-color: var(--bg-highlight); border:1px solid var(--border-light); padding: 8px; border-radius:6px; color:#27ae60; display:block; margin-top:8px; font-weight:bold;">Nama_Kategori_Bisnis | Nama_Toko | Nama_Pemilik | Alamat | No_WA | Status</code>
                            <br><small style="color: var(--accent-orange); font-weight:600;"><i class="fa-solid fa-circle-info me-1"></i> <b>Catatan Penting:</b> Kolom pertama diisi dengan <b>Teks Nama Kategori</b> persis seperti yang ada di sistem (Contoh: <i>Instansi Pendidikan</i>), BUKAN berupa angka ID.</small>
                        </p>
                        <input type="file" name="file_excel" accept=".xlsx" class="clean-input-file" required>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="import" class="btn-modal btn-modal-save">Upload & Eksekusi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function showDeleteModal(deleteUrl, entityName) {
            document.getElementById('deleteEntityName').innerText = entityName;
            document.getElementById('deleteForm').action = deleteUrl;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    
    @if(session('success'))
        <script>
            if(window.parent && window.parent.showToast) {
                window.parent.showToast("{{ session('success') }}", 'success');
            }
        </script>
    @endif
    @if(session('error'))
        <script>
            if(window.parent && window.parent.showToast) {
                window.parent.showToast("{{ session('error') }}", 'error');
            }
        </script>
    @endif
</body>
</html>
