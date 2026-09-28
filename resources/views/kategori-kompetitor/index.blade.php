<x-app-layout>
    <!-- Memuat FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --bg-card: #FFFFFF;
            --text-dark: #1A252F; 
            --text-muted: #5D6D7E; 
            --border-light: #E2E8F0;
            --bg-highlight: #F0F4F8; 
        }
        .header-wrapper { background-color: var(--bg-card); padding: 25px 35px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); }
        .header-title { margin: 0; font-size: 20px; font-weight: 800; color: var(--primary-navy); }
        .header-subtitle { font-size: 13.5px; color: var(--text-muted); margin-top: 5px; font-weight: 500; }
        .btn-add { background-color: var(--accent-orange); color: #ffffff; padding: 10px 20px; text-decoration: none !important; border-radius: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.2); transition: 0.3s; display: inline-flex; align-items: center; justify-content: center; gap: 8px; border: none;}
        .btn-add:hover { background-color: #e08316; color: #ffffff; transform: translateY(-2px); }
        .clean-card { background-color: var(--bg-card); border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid var(--border-light); display: flex; flex-direction: column; height: 100%; transition: transform 0.3s ease; }
        .clean-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .card-top { display: flex; align-items: center; gap: 15px; margin-bottom: 18px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light); }
        .card-logo { width: 55px; height: 55px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; color: #fff; flex-shrink: 0; text-transform: uppercase; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card-title-group h4 { margin: 0 0 6px 0; font-size: 18px; font-weight: 800; color: var(--primary-navy); line-height: 1.2; }
        .card-badge { background-color: var(--bg-highlight); color: var(--primary-navy); padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; border: 1px solid #CBD5E1; display: inline-block; }
        .card-body-text { flex: 1; font-size: 13.5px; color: var(--text-dark); line-height: 1.6; margin-bottom: 18px; font-weight: 500; }
        .highlight-text { color: var(--accent-orange); font-weight: 700; }
        .branch-info { background-color: var(--bg-highlight); padding: 15px; border-radius: 8px; border: 1px solid #CBD5E1; display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .branch-icon { font-size: 22px; color: var(--primary-navy); }
        .branch-text { font-size: 13px; color: var(--text-dark); line-height: 1.4; font-weight: 500; }
        .branch-count { font-size: 16px; font-weight: 800; color: var(--accent-orange); }
        .card-actions { display: flex; gap: 10px; margin-top: auto; }
        .btn-action { flex: 1; text-align: center; padding: 10px; border-radius: 6px; font-size: 13px; font-weight: 700; text-decoration: none !important; transition: 0.3s; border: 1px solid transparent; cursor: pointer;}
        .btn-action.edit { color: #2980b9; background-color: #ebf5fb; border-color: #d6eaf8;}
        .btn-action.edit:hover { background-color: #3498db; color: #fff; }
        .btn-action.delete { color: #c0392b; background-color: #fdedec; border-color: #fadbd8;}
        .btn-action.delete:hover { background-color: #e74c3c; color: #fff; }
        /* Modal Custom */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 50; }
        .clean-modal { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); width: 90%; max-width: 400px; padding: 25px; }
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-danger { background-color: #e74c3c; color: #ffffff; }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="header-wrapper flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="header-title"><i class="fa-solid fa-server mr-2 text-yellow-500"></i> Profil Entitas Kompetitor</h2>
                    <div class="header-subtitle">Daftar lengkap perusahaan ekspedisi beserta analitik jangkauan cabangnya.</div>
                </div>
                <a href="{{ route('kategori-kompetitor.create') }}" class="btn-add mt-4 md:mt-0">
                    <i class="fa-solid fa-plus"></i> Tambah Entitas Baru
                </a>
            </div>

            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kategori as $item)
                    @php
                        // Menghitung jumlah cabang langsung dari relasi DB (Aman dari error)
                        $jumlah_cabang = \App\Models\Kompetitor::where('kategori_kompetitor_id', $item->kategori_kompetitor_id)->count();
                    @endphp
                    <div class="clean-card">
                        <div class="card-top">
                            <!-- INI PERBAIKAN LOGO WARNA YANG ERROR SEBELUMNYA -->
                            <div class="card-logo" style="background-color: {{ $item->kode_warna ?? '#003B73' }};">
                                {{ $item->inisial ?? substr($item->nama_kategori, 0, 3) }}
                            </div>
                            <div class="card-title-group">
                                <h4>{{ $item->nama_kategori }}</h4>
                                <div class="card-badge"><i class="fa-solid fa-tag mr-1"></i> Kode: {{ $item->inisial }}</div>
                            </div>
                        </div>

                        <div class="card-body-text">
                            Entitas terdaftar dengan nama resmi <span class="highlight-text">{{ $item->nama_kategori }}</span>. 
                            Secara operasional dikategorikan sebagai <span class="highlight-text">{{ $item->keterangan }}</span>.
                        </div>

                        <div class="branch-info">
                            <div class="branch-icon"><i class="fa-solid fa-store"></i></div>
                            <div class="branch-text">
                                @if($jumlah_cabang > 0)
                                    Terdeteksi <span class="branch-count">{{ $jumlah_cabang }}</span> agen resmi/cabang yang beroperasi.
                                @else
                                    Belum ada agen resmi yang terdata.
                                @endif
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('kategori-kompetitor.edit', $item->kategori_kompetitor_id) }}" class="btn-action edit">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </a>
                            <button type="button" onclick="openDeleteModal({{ $item->kategori_kompetitor_id }}, '{{ addslashes($item->nama_kategori) }}')" class="btn-action delete w-full">
                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="clean-card" style="text-align: center; padding: 50px; background:#F8FAFC; align-items:center;">
                            <i class="fa-solid fa-folder-open" style="font-size: 40px; color: var(--border-light); margin-bottom: 20px;"></i>
                            <h4 style="color:var(--text-dark); font-weight:800; font-size:18px;">Belum ada data kompetitor</h4>
                            <p style="color: var(--text-muted); font-weight:500;">Silakan tambahkan data master kategori kompetitor baru.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- M O D A L : KONFIRMASI HAPUS -->
    <div id="deleteModal" class="modal-overlay">
        <div class="clean-modal">
            <div style="margin-bottom: 15px;">
                <h5 style="color: #e74c3c; font-weight: bold; font-size:18px; margin:0;">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> Konfirmasi Penghapusan
                </h5>
            </div>
            <div>
                <p style="color: var(--text-dark); font-weight: 500; font-size: 13.5px; margin-bottom: 20px; line-height: 1.6;">
                    Menghapus <strong id="deleteEntityName" style="color: var(--primary-navy);"></strong> akan menghapus seluruh data lokasi cabangnya secara permanen.<br><br>Apakah Anda yakin melanjutkan?
                </p>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeDeleteModal()" class="btn-modal btn-modal-cancel">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal btn-modal-danger">Ya, Hapus Permanen</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('deleteEntityName').innerText = name;
            // Set action URL form ke route destroy Laravel
            document.getElementById('deleteForm').action = '/kategori-kompetitor/' + id;
            document.getElementById('deleteModal').style.display = 'flex';
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
    </script>
</x-app-layout>