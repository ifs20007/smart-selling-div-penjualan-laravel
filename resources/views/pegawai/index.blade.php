<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pegawai</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-navy: #003B73; --accent-orange: #F7941D; --bg-card: #FFFFFF; --text-dark: #1A252F; --text-muted: #5D6D7E; --border-light: #E2E8F0; --bg-highlight: #F8FAFC; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: transparent !important; padding: 20px 10px; margin: 0; color: var(--text-dark); }
        .clean-card { width: 100%; max-width: 1200px; margin: 0 auto 50px auto; background-color: var(--bg-card); border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px dashed var(--border-light); padding-bottom: 20px;}
        .table-header h3 { margin: 0; color: var(--primary-navy); font-weight: 800; font-size: 20px; }
        .btn-add { background-color: var(--accent-orange); color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 700; transition: 0.3s; }
        .btn-add:hover { background-color: #e08316; color: #ffffff; transform: translateY(-2px); }
        .alert-info-clean { background-color: #fdedec; color: #c0392b; padding: 16px 20px; border-radius: 10px; border: 1px solid #e74c3c; margin-bottom: 25px; font-size: 13.5px; font-weight: 500; display: flex; align-items: center; gap: 12px;}
        table { width: 100%; border-collapse: collapse; font-size: 14px; min-width: 600px;}
        th, td { padding: 16px; text-align: left; }
        th { color: var(--text-muted); font-weight: 700; border-bottom: 2px solid var(--border-light); font-size: 12px; text-transform: uppercase; background-color: var(--bg-highlight);}
        td { border-bottom: 1px solid var(--border-light); font-weight: 500;}
        .badge-role { padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 11.5px; text-transform: uppercase;}
        .bg-admin { background-color: #fef9e7; color: #d35400; border: 1px solid #f5b041;}
        .bg-pegawai { background-color: #ebf5fb; color: #2980b9; border: 1px solid #a9cce3;}
        .aksi-buttons { display: flex; gap: 8px; }
        .btn-action { display: inline-flex; align-items: center; padding: 8px 12px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; gap: 6px; border: 1px solid transparent; }
        .btn-edit { color: #2980b9; background-color: #ebf5fb; border-color: #d6eaf8; } 
        .btn-edit:hover { background-color: #3498db; color: #fff; }
        .btn-reset { color: #f39c12; background-color: #fef9e7; border-color: #fdebd0; } 
        .btn-reset:hover { background-color: #f39c12; color: #fff; }
        .btn-delete { color: #c0392b; background-color: #fdedec; border-color: #fadbd8; }
        .btn-delete:hover { background-color: #e74c3c; color: #fff; }
        .clean-modal { border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; border: none; cursor: pointer; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-danger { background-color: #e74c3c; color: #ffffff; }
        .btn-modal-primary { background-color: var(--primary-navy); color: #ffffff; }
        .clean-input { width: 100%; padding: 12px 16px; background-color: #F8FAFC; border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; margin-bottom: 20px;}
        .clean-input:focus { border-color: var(--primary-navy); }
    </style>
</head>
<body>
    <div class="clean-card">
        <div class="table-header">
            <h3><i class="fa-solid fa-users text-warning me-2"></i> Manajemen Sistem & Pengguna</h3>
            <a href="{{ route('pegawai.create') }}" class="btn-add"><i class="fa-solid fa-user-plus me-2"></i> Tambah Akun</a>
        </div>

        <div class="alert-info-clean">
            <i class="fa-solid fa-triangle-exclamation"></i> 
            <div><strong>Peringatan Sistem:</strong> Menghapus akun akan menyebabkan seluruh data (toko, kompetitor) milik akun tersebut terhapus permanen.</div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr><th>ID User</th><th>Username / Email</th><th>Role</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $p)
                    <tr>
                        <td><span style="color:var(--text-muted); font-weight:700;">#{{ $p->users_id }}</span></td>
                        <td>
                            <strong style="color:var(--primary-navy); font-size:14.5px; display:block;">{{ $p->name }}</strong>
                            <small style="color:var(--text-muted);">{{ $p->email }}</small>
                        </td>
                        <td>
                            <span class="badge-role {{ $p->role == 'Admin' ? 'bg-admin' : 'bg-pegawai' }}">
                                <i class="fa-solid {{ $p->role == 'Admin' ? 'fa-user-shield' : 'fa-user-tie' }} me-1"></i> {{ $p->role }}
                            </span>
                        </td>
                        <td class="aksi-buttons">
                            <a href="{{ route('pegawai.edit', $p->users_id) }}" class="btn-action btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                            <!-- Bypass Reset Password -->
                            <button onclick="showResetModal(this)" data-id="{{ $p->users_id }}" data-name="{{ $p->name }}" class="btn-action btn-reset" title="Paksa Reset Sandi"><i class="fa-solid fa-key"></i></button>
                            
                            <!-- Hapus -->
                            <button onclick="showDeleteModal(this)" data-id="{{ $p->users_id }}" data-name="{{ $p->name }}" class="btn-action btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data pengguna di sistem.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: #e74c3c; font-weight: bold;"><i class="fa-solid fa-user-xmark me-2"></i> Cabut Akses</h5>
                </div>
                <div class="modal-body border-0 pt-3 pb-4">
                    <p>Hapus akun <strong id="deleteEntityName" class="text-primary"></strong>? Seluruh data terkait akan hilang permanen!</p>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-end">
                    <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-modal btn-modal-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reset Password (Bypass Admin) -->
    <div class="modal fade" id="resetModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: var(--primary-navy); font-weight: bold;"><i class="fa-solid fa-key text-warning me-2"></i> Reset Sandi Paksa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="resetForm" method="POST">
                    @csrf
                    <div class="modal-body border-0 pt-4 pb-0">
                        <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom:15px;">Buat sandi baru untuk <strong id="resetEntityName"></strong></p>
                        
                        <label style="font-size:12px; font-weight:bold; color:var(--text-muted);">SANDI BARU</label>
                        <input type="password" name="password" class="clean-input" required>
                        
                        <label style="font-size:12px; font-weight:bold; color:var(--text-muted);">KONFIRMASI SANDI</label>
                        <input type="password" name="password_confirmation" class="clean-input" required>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 justify-content-end">
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal btn-modal-primary">Simpan Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ELEMEN HTML TERSEMBUNYI SEBAGAI JEMBATAN BLADE -> JS -->
    <div id="flash-data" class="d-none" 
         data-success="{{ session('success') }}" 
         data-error="{{ session('error') }}" 
         data-validation="{{ $errors->any() ? 'Terjadi kesalahan pada pengisian form.' : '' }}">
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // FUNGSI MODAL
        function showDeleteModal(element) {
            let id = element.getAttribute('data-id');
            let name = element.getAttribute('data-name');
            document.getElementById('deleteEntityName').innerText = name;
            document.getElementById('deleteForm').action = '/pegawai/' + id;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        function showResetModal(element) {
            let id = element.getAttribute('data-id');
            let name = element.getAttribute('data-name');
            document.getElementById('resetEntityName').innerText = name;
            document.getElementById('resetForm').action = '/pegawai/' + id + '/reset-password';
            new bootstrap.Modal(document.getElementById('resetModal')).show();
        }

        // FUNGSI NOTIFIKASI TOAST (MURNI JAVASCRIPT)
        document.addEventListener("DOMContentLoaded", function() {
            let flashDiv = document.getElementById('flash-data');
            
            if (flashDiv && window.parent && window.parent.showToast) {
                let successMsg = flashDiv.getAttribute('data-success');
                let errorMsg = flashDiv.getAttribute('data-error');
                let validationMsg = flashDiv.getAttribute('data-validation');

                if (successMsg) { window.parent.showToast(successMsg, 'success'); }
                if (errorMsg) { window.parent.showToast(errorMsg, 'error'); }
                if (validationMsg) { window.parent.showToast(validationMsg, 'error'); }
            }
        });
    </script>
</body>
</html>