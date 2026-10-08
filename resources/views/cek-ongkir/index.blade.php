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
            padding: 25px; 
            margin-bottom: 20px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); 
            border: 1px solid var(--border-light);
        }

        .header-title { 
            font-size: 20px; 
            font-weight: 700; 
            color: var(--primary-navy); 
            margin-bottom: 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .action-buttons a { 
            text-decoration: none; 
            padding: 8px 16px; 
            border-radius: 8px; 
            font-size: 13.5px; 
            font-weight: 600; 
            transition: 0.3s; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
        }

        .btn-add { background-color: var(--primary-navy); color: #ffffff; border: 1px solid var(--primary-navy); }
        .btn-add:hover { background-color: #002D59; color: #ffffff; }
        .btn-export { background-color: #27ae60; color: #ffffff; border: 1px solid #27ae60; }
        .btn-export:hover { background-color: #219a52; color: #ffffff; }

        .filter-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-dark);
            background-color: #F8FAFC;
            min-width: 200px;
            flex: 1;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-navy);
            box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1);
            background: #ffffff;
        }

        .btn-filter {
            background-color: #F8FAFC;
            border: 1px solid var(--border-light);
            color: var(--primary-navy);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-filter:hover { background-color: var(--primary-navy); color: #ffffff; }

        .btn-reset {
            background-color: #e74c3c;
            border: 1px solid #e74c3c;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-reset:hover { background-color: #c0392b; color: #ffffff; }

        .table-responsive { overflow-x: auto; }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0; }
        th { background-color: #F8FAFC; color: var(--text-muted); font-weight: 700; padding: 15px; font-size: 12.5px; text-transform: uppercase; border-bottom: 2px solid var(--border-light); text-align: left;}
        td { padding: 15px; border-bottom: 1px solid var(--border-light); font-size: 14px; vertical-align: middle;}

        .badge-ekspedisi { padding: 5px 10px; border-radius: 6px; color: #ffffff; font-weight: 700; font-size: 11.5px; letter-spacing: 0.5px; }

        .row-pos-termurah { background-color: #FFF5EA; }
        
        .aksi-buttons { display: flex; gap: 8px; }
        .btn-edit { background-color: #F8FAFC; border: 1px solid var(--border-light); color: #3498db; width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; border-radius: 6px; transition: 0.3s; text-decoration: none;}
        .btn-edit:hover { background-color: #3498db; color: #ffffff; border-color: #3498db; }
        .btn-delete { background-color: #F8FAFC; border: 1px solid var(--border-light); color: #e74c3c; width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; border-radius: 6px; transition: 0.3s; cursor: pointer; border-width: 1px; }
        .btn-delete:hover { background-color: #e74c3c; color: #ffffff; border-color: #e74c3c; }

        .pagination-container { display: flex; justify-content: space-between; align-items: center; padding-top: 20px; font-size: 13.5px; color: var(--text-muted); flex-wrap: wrap; gap: 10px;}
        .pagination-nav { display: flex; gap: 5px; }
        .page-link-clean { padding: 8px 12px; border: 1px solid var(--border-light); border-radius: 6px; color: var(--text-dark); text-decoration: none; font-weight: 600; transition: 0.2s; background: #ffffff;}
        .page-link-clean:hover { background-color: #F8FAFC; color: var(--primary-navy); }
        .page-link-clean.active { background-color: var(--primary-navy); color: #ffffff; border-color: var(--primary-navy); }
        .page-link-clean.disabled { opacity: 0.5; pointer-events: none; background: #F8FAFC;}

        /* Alert Toast */
        .toast-clean { background-color: #ffffff; color: var(--text-dark); box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 10px; border-left: 5px solid var(--accent-orange); font-size: 14px; font-weight: 500; border-top:1px solid var(--border-light); border-right:1px solid var(--border-light); border-bottom:1px solid var(--border-light); position: fixed; bottom: 20px; right: 20px; z-index: 2000; padding: 15px; display: flex; align-items: center;}
        .toast-clean.success { border-left-color: #2ecc71; }
        .toast-clean.error { border-left-color: #e74c3c; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="clean-card">
                <div class="header-title">
                    <span><i class="fa-solid fa-table-list text-warning" style="color: var(--accent-orange); margin-right: 8px;"></i> Master Tarif Ekspedisi</span>
                    <div class="action-buttons">
                        <a href="{{ route('data-ongkir.export') }}" class="btn-export"><i class="fa-solid fa-file-excel"></i> Export CSV</a>
                        <a href="{{ route('data-ongkir.create') }}" class="btn-add"><i class="fa-solid fa-plus"></i> Tambah Tarif Baru</a>
                    </div>
                </div>

                <form method="GET" action="{{ route('data-ongkir.index') }}" class="filter-container">
                    <select name="provinsi" class="filter-select">
                        <option value="">-- Semua Provinsi Tujuan --</option>
                        @foreach($provinsi as $p)
                            <option value="{{ $p->provinsi_id }}" {{ $filter_provinsi == $p->provinsi_id ? 'selected' : '' }}>
                                {{ $p->nama_provinsi }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="limit" class="filter-select" style="max-width: 150px; flex: none;">
                        <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20 Baris</option>
                        <option value="50" {{ $limit == 50 ? 'selected' : '' }}>50 Baris</option>
                        <option value="100" {{ $limit == 100 ? 'selected' : '' }}>100 Baris</option>
                    </select>

                    <button type="submit" class="btn-filter"><i class="fa-solid fa-filter me-2"></i> Terapkan Filter</button>
                    @if($filter_provinsi)
                        <a href="{{ route('data-ongkir.index') }}" class="btn-reset"><i class="fa-solid fa-rotate-left me-2"></i> Reset</a>
                    @endif
                </form>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Ekspedisi</th>
                                <th width="25%">Kota / Kab Tujuan</th>
                                <th width="15%">Layanan</th>
                                <th width="15%">Tarif / Kg</th>
                                <th width="15%">Estimasi</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarif_ongkir as $index => $row)
                                @php
                                    $is_pos = strpos(strtoupper($row->kompetitor->inisial ?? ''), 'POS') !== false;
                                    $is_termurah = ($row->harga_per_kg == ($min_prices[$row->wilayah_id] ?? null));
                                    $row_class = ($is_pos && $is_termurah) ? "row-pos-termurah" : "";
                                @endphp
                                <tr class="{{ $row_class }}">
                                    <td>{{ $tarif_ongkir->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge-ekspedisi" style="background-color: {{ $row->kompetitor->kode_warna ?? '#003B73' }};">
                                            {{ $row->kompetitor->nama_kategori ?? '-' }}
                                        </span>
                                        @if($is_pos && $is_termurah)
                                            <i class='fa-solid fa-crown' style='color:var(--accent-orange); margin-left:5px;' title='POS Termurah!'></i>
                                        @endif
                                    </td>
                                    <td>
                                        <strong style="color:var(--primary-navy);">{{ $row->wilayah->nama_wilayah ?? '-' }}</strong><br>
                                        <small style="color:var(--text-muted); font-weight:600;">Prov. {{ $row->wilayah->provinsi->nama_provinsi ?? '-' }}</small>
                                    </td>
                                    <td>{{ $row->jenis_layanan }}</td>
                                    <td style="{{ ($is_pos && $is_termurah) ? 'color:#e67e22; font-weight:800; font-size:14.5px;' : 'font-weight:700;' }}">
                                        Rp {{ number_format($row->harga_per_kg, 0, ',', '.') }}
                                    </td>
                                    <td><i class="fa-regular fa-clock me-1 text-muted"></i> {{ $row->estimasi_waktu ?? '-' }}</td>
                                    <td class="aksi-buttons">
                                        <a href="{{ route('data-ongkir.edit', $row->tarif_ongkir_id) }}" class="btn-edit" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('data-ongkir.destroy', $row->tarif_ongkir_id) }}" method="POST" class="inline-block" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus tarif ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:40px; color:var(--text-muted);">Data tarif tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION SECTION -->
                @if($tarif_ongkir->hasPages())
                <div class="pagination-container">
                    <div style="margin-bottom: 10px;">Menampilkan <b>{{ $tarif_ongkir->firstItem() }}</b> - <b>{{ $tarif_ongkir->lastItem() }}</b> dari total <b>{{ number_format($tarif_ongkir->total(), 0, ',', '.') }}</b> Data Tarif.</div>
                    
                    <div class="pagination-nav">
                        @if ($tarif_ongkir->onFirstPage())
                            <span class="page-link-clean disabled"><i class="fa-solid fa-angle-left"></i></span>
                        @else
                            <a href="{{ $tarif_ongkir->appends(request()->query())->previousPageUrl() }}" class="page-link-clean"><i class="fa-solid fa-angle-left"></i></a>
                        @endif
                        
                        @php
                            $start_page = max(1, $tarif_ongkir->currentPage() - 2);
                            $end_page = min($tarif_ongkir->lastPage(), $tarif_ongkir->currentPage() + 2);
                        @endphp
                        
                        @for ($i = $start_page; $i <= $end_page; $i++)
                            <a href="{{ $tarif_ongkir->appends(request()->query())->url($i) }}" class="page-link-clean {{ ($i == $tarif_ongkir->currentPage()) ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        @if ($tarif_ongkir->hasMorePages())
                            <a href="{{ $tarif_ongkir->appends(request()->query())->nextPageUrl() }}" class="page-link-clean"><i class="fa-solid fa-angle-right"></i></a>
                        @else
                            <span class="page-link-clean disabled"><i class="fa-solid fa-angle-right"></i></span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div id="toastAlert" class="toast-clean success">
            <i class="fa-solid fa-circle-check" style="font-size: 18px; margin-right: 12px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div id="toastAlert" class="toast-clean error">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px; margin-right: 12px;"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <script>
        // Auto hide toast after 3 seconds
        setTimeout(function() {
            let toast = document.getElementById('toastAlert');
            if(toast) {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
</x-app-layout>
