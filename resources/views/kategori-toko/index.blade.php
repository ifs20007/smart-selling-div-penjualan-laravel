<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Manajemen Kategori Bisnis</title>
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
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px dashed var(--border-light); padding-bottom: 20px;}
        .table-header h3 { margin: 0; color: var(--primary-navy); font-weight: 800; font-size: 20px; }
        
        .btn-add { background-color: var(--accent-orange); color: #ffffff; padding: 10px 20px; text-decoration: none !important; border-radius: 8px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.2); transition: 0.3s; white-space: nowrap;}
        .btn-add:hover { background-color: #e08316; color: #ffffff; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(247, 148, 29, 0.3); }
        
        .alert-info-clean { background-color: #FFF5EA; color: var(--primary-navy); padding: 16px 20px; border-radius: 10px; border: 1px solid var(--accent-orange); margin-bottom: 25px; font-size: 13.5px; font-weight: 500; display: flex; align-items: center; gap: 12px;}
        .alert-info-clean i { font-size: 20px; color: var(--accent-orange); }

        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 10px; min-width: 600px;}
        th, td { padding: 16px; text-align: left; }
        th { color: var(--text-muted); font-weight: 700; border-bottom: 2px solid var(--border-light); white-space: nowrap; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; background-color: var(--bg-highlight);}
        td { border-bottom: 1px solid var(--border-light); color: var(--text-dark); font-weight: 500;}
        tr:hover td { background-color: var(--bg-highlight); }
        
        .aksi-buttons { display: flex; gap: 8px; }
        .btn-edit, .btn-delete { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; text-decoration: none !important; border-radius: 6px; font-size: 13px; border: none; cursor: pointer; transition: 0.2s; }
        .btn-edit { color: #2980b9; background-color: #ebf5fb; border: 1px solid #d6eaf8; } 
        .btn-edit:hover { background-color: #3498db; color: #fff; border-color: #3498db;}
        .btn-delete { color: #c0392b; background-color: #fdedec; border: 1px solid #fadbd8; }
        .btn-delete:hover { background-color: #e74c3c; color: #fff; border-color: #e74c3c;}
        
        /* Modal Clean UI */
        .clean-modal { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; text-decoration: none !important; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-modal-danger { background-color: #e74c3c; color: #ffffff; }
        .btn-modal-danger:hover { background-color: #c0392b; color: #ffffff; }

        @media (max-width: 768px) {
            .clean-card { padding: 20px 15px; border-radius: 12px; width: 100%;}
            .table-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .table-header h3 { font-size: 18px; }
            .btn-add { width: 100%; text-align: center; }
            .alert-info-clean { align-items: flex-start; flex-direction: column; gap: 8px;}
        }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="table-header">
            <h3><i class="fa-solid fa-layer-group" style="color: var(--accent-orange); margin-right:8px;"></i> Klasifikasi Kategori Bisnis</h3>
            <a href="{{ route('kategori-toko.create') }}" class="btn-add"><i class="fa-solid fa-plus me-2"></i> Tambah Kategori</a>
        </div>

        <div class="alert-info-clean">
            <i class="fa-solid fa-triangle-exclamation"></i> 
            <div><strong>Peringatan Sistem:</strong> Menghapus sebuah kategori akan secara otomatis menghapus <b>semua database toko / pelanggan</b> yang terdaftar di dalam kategori tersebut (Efek <i>Cascade</i>).</div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr><th width="5%">No</th><th width="35%">Nama Kategori Bisnis</th><th width="40%">Keterangan Deskripsi</th><th width="20%">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong style='color:var(--primary-navy); font-size: 14.5px;'>{{ $kategori->nama_kategori }}</strong></td>
                            <td style='color:var(--text-muted);'>{{ $kategori->keterangan }}</td>
                            <td class='aksi-buttons'>
                                <a href="{{ route('kategori-toko.edit', $kategori->kategori_toko_id) }}" class='btn-edit' title='Edit Kategori'><i class='fa-solid fa-pen-to-square'></i></a>
                                <button type="button" onclick='showDeleteModal("{{ route('kategori-toko.destroy', $kategori->kategori_toko_id) }}", "{{ addslashes($kategori->nama_kategori) }}")' class='btn-delete' title='Hapus Kategori'><i class='fa-solid fa-trash-can'></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan='4' style='text-align:center; padding: 40px; color:var(--text-muted); font-weight:500;'>Belum ada klasifikasi kategori bisnis di database.</td></tr>
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
                    <p style="color: var(--text-dark); font-weight: 500; font-size: 14px; margin-bottom: 0; line-height: 1.6;">Yakin ingin menghapus kategori <strong id="deleteEntityName" style="color: var(--primary-navy);"></strong> secara permanen?<br><br><span style="color:#e74c3c; font-weight:700;"><i class="fa-solid fa-circle-exclamation"></i> Semua database toko di dalamnya juga akan terhapus!</span></p>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal btn-modal-danger">Ya, Hapus Semua</button>
                    </form>
                </div>
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
