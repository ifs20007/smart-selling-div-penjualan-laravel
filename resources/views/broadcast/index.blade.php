<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Broadcast SMS & WhatsApp</title>
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
        
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; margin-top: 10px; min-width: 800px; }
        th, td { padding: 15px 16px; text-align: left; }
        th { color: var(--text-muted); font-weight: 700; border-bottom: 2px solid var(--border-light); white-space: nowrap; text-transform: uppercase; font-size: 11.5px; letter-spacing: 0.5px; background-color: var(--bg-highlight);}
        td { border-bottom: 1px solid var(--border-light); color: var(--text-dark); font-weight: 500;}
        tr:hover td { background-color: var(--bg-highlight); }
        
        .badge-status { padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 11.5px; display: inline-block; white-space: nowrap;}
        .bg-aktif { background-color: #eafaf1; color: #27ae60; border: 1px solid #27ae60;}
        
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
            <h3><i class="fa-solid fa-bullhorn" style="color: var(--accent-orange); margin-right:8px;"></i> Riwayat Broadcast WhatsApp</h3>
            <div class="header-buttons">
                <a href="{{ route('broadcast.create') }}" class="btn-clean btn-add"><i class="fa-solid fa-paper-plane"></i> Buat Broadcast Baru</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="border-radius: 8px; font-size: 14px; font-weight: 600; background-color: #eafaf1; color: #27ae60; border: 1px solid #27ae60; padding: 15px; margin-bottom: 20px;">
                <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal</th>
                        <th width="20%">Pengirim</th>
                        <th width="20%">Target Kategori</th>
                        <th width="30%">Isi Pesan</th>
                        <th width="10%">Terkirim</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $riwayat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong style='color:var(--primary-navy);'>{{ $riwayat->created_at->format('d M Y H:i') }}</strong></td>
                            <td>{{ $riwayat->user->name ?? 'Sistem' }}</td>
                            <td>
                                @if($riwayat->kategoriToko)
                                    <span class="badge-status bg-aktif">{{ $riwayat->kategoriToko->nama_kategori }}</span>
                                @else
                                    <span class="badge-status bg-aktif" style="background-color: #ebf5fb; color: #2980b9; border: 1px solid #3498db;">Semua Kategori</span>
                                @endif
                            </td>
                            <td><div style="max-height: 80px; overflow-y: auto; font-size: 13px; line-height: 1.5; color: var(--text-muted);">{{ $riwayat->isi_pesan }}</div></td>
                            <td align="center"><strong>{{ $riwayat->jumlah_terkirim }}</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan='6' style='text-align:center; padding:40px; color:var(--text-muted); font-weight:500;'>Belum ada riwayat pengiriman pesan broadcast.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
