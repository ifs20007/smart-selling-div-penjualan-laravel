<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --accent-orange: #F7941D; 
            --bg-body: #F4F7F6;
            --bg-card: #FFFFFF;
            --text-dark: #1A252F;
            --text-muted: #5D6D7E;
            --border-light: #E2E8F0;
        }

        .clean-card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            margin-bottom: 20px;
            border: 1px solid var(--border-light);
        }

        .header-title {
            color: var(--primary-navy);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-light);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-group select, .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-size: 14.5px;
            color: var(--text-dark);
            background-color: #F8FAFC;
            transition: all 0.3s ease;
        }

        .form-group select:focus, .form-group input:focus {
            outline: none;
            border-color: var(--primary-navy);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1);
        }

        .btn-submit {
            background-color: var(--primary-navy);
            color: #FFFFFF;
            border: none;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 25px;
            display: inline-block;
        }

        .btn-submit:hover {
            background-color: var(--primary-navy-hover);
            transform: translateY(-2px);
        }

        /* Tabel CSS */
        .table-responsive {
            overflow-x: auto;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            background-color: #F8FAFC;
            color: var(--text-dark);
            font-weight: 700;
            padding: 15px;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 2px solid var(--border-light);
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border-light);
            font-size: 14.5px;
            vertical-align: middle;
        }

        .badge-ekspedisi {
            padding: 6px 12px;
            border-radius: 6px;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .harga-total {
            font-weight: 800;
            font-size: 16px;
            color: var(--text-dark);
        }

        .alert-warning-clean {
            background-color: #FFF3CD;
            border-left: 4px solid #F39C12;
            padding: 15px 20px;
            border-radius: 6px;
            color: #856404;
            font-weight: 500;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="clean-card">
                <h2 class="header-title"><i class="fa-solid fa-calculator me-2 text-warning" style="color: var(--accent-orange);"></i> Simulasi & Komparasi Cek Ongkir</h2>
                <form method="POST" action="{{ route('cek-ongkir.hitung') }}">
                    @csrf
                    <div class="form-row">
                        <!-- Input Statis Titik Asal -->
                        <div class="form-group" style="flex: 100%;">
                            <label>TITIK ASAL PENGIRIMAN</label>
                            <input type="text" value="Pematangsiantar (Sumatera Utara)" readonly style="background-color: #E2E8F0; color: var(--text-muted); font-weight: 600; cursor: not-allowed;">
                        </div>

                        <!-- Dropdown Provinsi -->
                        <div class="form-group">
                            <label>1. PILIH PROVINSI</label>
                            <select name="provinsi_id" id="provinsiSelect" onchange="fetchWilayah(this.value)" required>
                                <option value="">-- Pilih Provinsi Dahulu --</option>
                                @foreach($provinsi as $p)
                                    <option value="{{ $p->provinsi_id }}" {{ isset($wilayah) && $wilayah->provinsi_id == $p->provinsi_id ? 'selected' : '' }}>
                                        {{ $p->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dropdown Kota / Kab -->
                        <div class="form-group">
                            <label>2. KOTA / KABUPATEN TUJUAN</label>
                            <select name="wilayah_id" id="wilayahSelect" required {{ isset($wilayah_id) ? '' : 'disabled' }}>
                                @if(isset($wilayah))
                                    <option value="{{ $wilayah->wilayah_id }}">{{ $wilayah->nama_wilayah }}</option>
                                @else
                                    <option value="">-- Menunggu Provinsi... --</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>3. BERAT PAKET (KG)</label>
                            <input type="number" name="berat_paket" min="0.1" step="0.1" placeholder="Contoh: 1.5" value="{{ $berat_paket ?? '1' }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-magnifying-glass me-2"></i> Cek & Bandingkan Tarif</button>
                </form>
            </div>

            @if(isset($tarif))
            <div class="clean-card">
                <h2 class="header-title" style="color:#27ae60;"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Hasil: {{ $wilayah->nama_wilayah }}, Prov. {{ $wilayah->provinsi->nama_provinsi }} ({{ $berat_paket }} Kg)</h2>

                @if($tarif->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Ekspedisi</th>
                                <th>Layanan</th>
                                <th>Estimasi Waktu</th>
                                <th>Tarif / Kg</th>
                                <th>Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tarif as $t)
                                @php
                                    $is_pos = strpos(strtoupper($t->kompetitor->nama_kategori ?? ''), 'POS') !== false;
                                @endphp
                                <tr style="{{ $is_pos ? 'background-color:#FFF5EA;' : '' }}">
                                    <td>
                                        <span class="badge-ekspedisi" style="background-color: {{ $t->kompetitor->kode_warna ?? '#003B73' }};">
                                            {{ $t->kompetitor->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td><strong style="color:var(--primary-navy);">{{ $t->jenis_layanan }}</strong></td>
                                    <td><i class="fa-regular fa-clock text-muted me-1" style="color:var(--text-muted);"></i> {{ $t->estimasi_waktu ?? '-' }}</td>
                                    <td style="color:var(--text-muted);">Rp {{ number_format($t->harga_per_kg, 0, ',', '.') }}</td>
                                    <td class="harga-total">Rp {{ number_format($t->total_biaya, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert-warning-clean">
                    <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i> Data tarif ongkos kirim untuk tujuan <b>{{ $wilayah->nama_wilayah }}</b> belum tersedia di sistem.
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    <script>
        function fetchWilayah(provinsi_id) {
            const wilayahSelect = document.getElementById('wilayahSelect');
            
            if (provinsi_id === "") {
                wilayahSelect.innerHTML = "<option value=''>-- Menunggu Provinsi... --</option>";
                wilayahSelect.disabled = true;
                return;
            }

            wilayahSelect.innerHTML = "<option value=''>Loading data...</option>";
            wilayahSelect.disabled = true;

            fetch('/api/wilayah/' + provinsi_id)
                .then(response => response.text())
                .then(html => {
                    wilayahSelect.innerHTML = html;
                    wilayahSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    wilayahSelect.innerHTML = "<option value=''>Gagal memuat data</option>";
                    wilayahSelect.disabled = false;
                });
        }
    </script>
</x-app-layout>
