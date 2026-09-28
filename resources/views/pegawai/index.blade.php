<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Murni mengadaptasi CSS PHP Native Anda */
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
        }

        .clean-card { background-color: #ffffff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); margin-bottom: 20px;}
        .card-header-clean { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-light); padding-bottom: 15px; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;}
        .card-header-clean h5 { margin: 0; font-size: 16px; font-weight: 700; color: var(--primary-navy);}
        
        /* Tombol Standar */
        .btn-orange { background: var(--accent-orange); color: #fff; padding: 8px 16px; border-radius: 8px; font-weight: bold; font-size: 13px; text-decoration: none; border: none; transition: 0.3s; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3); display: inline-flex; align-items: center; gap: 8px; cursor: pointer;}
        .btn-orange:hover { background: #e08316; transform: translateY(-2px); color: #fff; }

        /* Tabel Pengguna */
        .native-table { width: 100%; border-collapse: collapse; font-size: 13.5px; min-width: 600px; }
        .native-table th, .native-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid var(--border-light); color: var(--text-dark);}
        .native-table th { color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;}
        .native-table tr:hover td { background-color: #F8FAFC; }

        /* Badge Hak Akses */
        .role-badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; }
        .role-admin { background-color: #e8f4fd; color: var(--primary-navy); border: 1px solid #b6dfff;}
        .role-pegawai { background-color: #fef5e7; color: var(--accent-orange); border: 1px solid #fde2b4;}

        /* Tombol Aksi Tabel */
        .btn-action { width: 32px; height: 32px; border-radius: 6px; display: inline-flex; justify-content: center; align-items: center; text-decoration: none; transition: 0.2s; font-size: 13px; cursor: pointer; border: none;}
        .btn-edit { background-color: #fff3cd; color: #F7941D; }
        .btn-edit:hover { background-color: #F7941D; color: #fff; }
        .btn-pass { background-color: #e8f4fd; color: var(--primary-navy); }
        .btn-pass:hover { background-color: var(--primary-navy); color: #fff; }
        .btn-delete { background-color: #fdf2f2; color: #e74c3c; }
        .btn-delete:hover { background-color: #e74c3c; color: #fff; }

        /* Desain Pop-Up Modal ala Native */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,35,70,0.5); z-index: 1050; align-items: center; justify-content: center; backdrop-filter: blur(2px);}
        .clean-modal { background-color: #ffffff; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); padding: 25px; width: 100%; max-width: 450px;}
        .clean-input { width: 100%; padding: 12px 16px; background-color: #F8FAFC; border: 1px solid var(--border-light); border-radius: 8px; margin-bottom: 15px; outline: none; transition: 0.3s; color: var(--text-dark);}
        .clean-input:focus { border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); background: #ffffff;}
        .btn-modal-save { background: var(--primary-navy); color: white; padding: 12px 20px; border-radius: 8px; border: none; font-weight: bold; cursor: pointer; transition: 0.2s;}
        .btn-modal-save:hover { background: #002D59; transform: translateY(-2px);}
        .btn-modal-cancel { background: #F1F5F9; color: var(--text-muted); padding: 12px 20px; border-radius: 8px; border: none; font-weight: bold; cursor: pointer; text-decoration: none; transition: 0.2s;}
        .btn-modal-cancel:hover { background: #E2E8F0; color: var(--text-dark);}
    </style>

    <div class="py-6 px-4 font-['Segoe_UI',Tahoma,sans-serif]">
        
        <!-- Area Notifikasi -->
        @if(session('success'))
            <div style="background: white; border-left: 5px solid #2ecc71; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('status') === 'password-updated')
            <div style="background: white; border-left: 5px solid #2ecc71; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">Kata sandi akun Anda berhasil diperbarui!</span>
            </div>
        @endif
        @if(session('error') || $errors->updatePassword->any() || $errors->any())
            <div style="background: white; border-left: 5px solid #e74c3c; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #e74c3c; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">
                    {{ session('error') ?? 'Gagal mengganti sandi! Pastikan sandi lama benar dan konfirmasi sandi baru cocok.' }}
                </span>
            </div>
        @endif

        <div class="clean-card">
            <div class="card-header-clean">
                <h5><i class="fa-solid fa-users-gear" style="color: var(--accent-orange); margin-right: 8px;"></i> Data Pengguna Sistem</h5>
                
                <div style="display: flex; gap: 10px;">
                    <!-- Tombol Ganti Sandi Diri Sendiri (Semua Role) -->
                    <button type="button" class="btn-orange" style="background: #F8FAFC; color: var(--primary-navy); border: 1px solid var(--border-light); box-shadow: none;" onclick="openModal('modalGantiSandiDiri')">
                        <i class="fa-solid fa-key"></i> Ganti Sandi Saya
                    </button>
                    <!-- Tombol Tambah Pengguna Baru (Hanya Admin) -->
                    <a href="{{ route('pegawai.create') }}" class="btn-orange">
                        <i class="fa-solid fa-user-plus"></i> Tambah Pengguna
                    </a>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="native-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Nama Pengguna</th>
                            <th style="width: 25%;">Alamat Email</th>
                            <th style="width: 15%;">Hak Akses</th>
                            <th style="width: 30%; text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawai as $user)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: bold;">#{{ $user->users_id }}</td>
                            <td style="font-weight: 600;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="role-badge {{ $user->role === 'Admin' ? 'role-admin' : 'role-pegawai' }}">
                                    <i class="fa-solid {{ $user->role === 'Admin' ? 'fa-user-shield' : 'fa-user-tie' }}" style="margin-right: 4px;"></i> {{ $user->role }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    
                                    <!-- Aksi Edit Info Dasar -->
                                    <a href="{{ route('pegawai.edit', $user->users_id) }}" class="btn-action btn-edit" title="Edit Info Pengguna">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    
                                    <!-- Aksi Reset Sandi (Trigger Modal Paksa) -->
                                    <button type="button" class="btn-action btn-pass" title="Reset Kata Sandi" onclick="openResetModal('{{ $user->users_id }}', '{{ $user->name }}')">
                                        <i class="fa-solid fa-unlock-keyhole"></i>
                                    </button>

                                    <!-- Aksi Hapus (Mencegah hapus diri sendiri) -->
                                    @if(Auth::id() !== $user->users_id)
                                        <form action="{{ route('pegawai.destroy', $user->users_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');" style="margin:0; padding:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Akun">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn-action" style="background: #f1f5f9; color: #cbd5e1; cursor: not-allowed;" title="Anda tidak dapat menghapus akun Anda sendiri">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL 1: GANTI SANDI UNTUK DIRI SENDIRI    -->
    <!-- ========================================== -->
    <div id="modalGantiSandiDiri" class="modal-overlay">
        <div class="clean-modal">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--border-light); padding-bottom: 15px;">
                <h5 style="margin: 0; font-size: 18px; font-weight: bold; color: var(--primary-navy);"><i class="fa-solid fa-key text-warning" style="margin-right: 8px;"></i> Ganti Kata Sandi</h5>
                <button type="button" onclick="closeModal('modalGantiSandiDiri')" style="background: transparent; border: none; font-size: 22px; cursor: pointer; color: var(--text-muted);">&times;</button>
            </div>
            
            <!-- Langsung tembak ke PasswordController bawaan Laravel Breeze -->
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <label style="font-size: 11px; font-weight: bold; color: var(--text-muted); margin-bottom: 8px; display: block; letter-spacing: 0.5px;">KATA SANDI LAMA</label>
                <input type="password" name="current_password" class="clean-input" required placeholder="Masukkan sandi saat ini">

                <label style="font-size: 11px; font-weight: bold; color: var(--text-muted); margin-bottom: 8px; display: block; letter-spacing: 0.5px;">KATA SANDI BARU</label>
                <input type="password" name="password" class="clean-input" required minlength="4" placeholder="Masukkan sandi baru (min. 4 karakter)">

                <label style="font-size: 11px; font-weight: bold; color: var(--text-muted); margin-bottom: 8px; display: block; letter-spacing: 0.5px;">KONFIRMASI SANDI BARU</label>
                <input type="password" name="password_confirmation" class="clean-input" required minlength="4" placeholder="Ulangi sandi baru">

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal('modalGantiSandiDiri')">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-floppy-disk" style="margin-right: 5px;"></i> Perbarui Sandi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL 2: RESET SANDI PAKSA OLEH ADMIN      -->
    <!-- ========================================== -->
    <div id="modalResetSandiPaksa" class="modal-overlay">
        <div class="clean-modal">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid var(--border-light); padding-bottom: 15px;">
                <h5 style="margin: 0; font-size: 18px; font-weight: bold; color: #e74c3c;"><i class="fa-solid fa-unlock-keyhole" style="margin-right: 8px;"></i> Reset Sandi Pengguna</h5>
                <button type="button" onclick="closeModal('modalResetSandiPaksa')" style="background: transparent; border: none; font-size: 22px; cursor: pointer; color: var(--text-muted);">&times;</button>
            </div>
            
            <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 25px; line-height: 1.5;">Anda bertindak sebagai Admin. Mereset sandi untuk akun: <strong id="resetUserName" style="color: var(--primary-navy);"></strong></p>

            <!-- Menembak ke PegawaiController@forceResetPassword -->
            <form id="formResetSandi" action="" method="POST">
                @csrf
                @method('PUT') 
                
                <label style="font-size: 11px; font-weight: bold; color: var(--text-muted); margin-bottom: 8px; display: block; letter-spacing: 0.5px;">SANDI BARU</label>
                <input type="password" name="password" class="clean-input" required minlength="4" placeholder="Ketik sandi baru pengguna">

                <label style="font-size: 11px; font-weight: bold; color: var(--text-muted); margin-bottom: 8px; display: block; letter-spacing: 0.5px;">KONFIRMASI SANDI</label>
                <input type="password" name="password_confirmation" class="clean-input" required minlength="4" placeholder="Ulangi sandi baru">

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal('modalResetSandiPaksa')">Batal</button>
                    <button type="submit" class="btn-modal-save" style="background: #e74c3c;"><i class="fa-solid fa-triangle-exclamation" style="margin-right: 5px;"></i> Paksa Reset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Kontrol Pop-Up -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Fungsi khusus untuk menangkap ID User saat Admin klik logo Gembok
        function openResetModal(userId, userName) {
            document.getElementById('resetUserName').innerText = userName;
            
            // Menyusun URL Dinamis berdasarkan ID
            let url = "{{ url('pegawai') }}/" + userId + "/reset-password";
            document.getElementById('formResetSandi').action = url;
            
            openModal('modalResetSandiPaksa');
        }
    </script>
</x-app-layout>