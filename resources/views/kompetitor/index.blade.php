<x-app-layout>
    <!-- Load Leaflet CSS & FontAwesome -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Murni mengadaptasi CSS PHP Native Anda (dashboard.php & admin.php) */
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.04); 
            border: 1px solid var(--border-light); 
        }

        .card-header-clean { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; 
            border-bottom: 1px solid var(--border-light); 
            padding-bottom: 12px;
        }

        .card-header-clean h5 { 
            margin: 0; 
            font-size: 15px; 
            font-weight: 700; 
            color: var(--primary-navy); 
            letter-spacing: 0.5px;
        }

        /* Tombol Tambah Native */
        .btn-orange { 
            background: var(--accent-orange); 
            color: #fff; 
            padding: 8px 16px; 
            border-radius: 8px; 
            font-weight: bold; 
            font-size: 13px; 
            text-decoration: none; 
            border: none; 
            cursor: pointer; 
            transition: 0.3s; 
            box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3); 
            display: inline-flex;
            align-items: center;
        }
        .btn-orange:hover { background: #e08316; transform: translateY(-2px); color: #fff; }

        /* Tabel ala PHP Native */
        .table-responsive { width: 100%; overflow-x: auto; }
        .native-table { width: 100%; border-collapse: collapse; font-size: 13px; min-width: 600px;}
        .native-table th, .native-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border-light); color: var(--text-dark);}
        .native-table th { color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;}
        .native-table tr:hover td { background-color: #F8FAFC; }
        .native-table tr:last-child td { border-bottom: none; }

        /* Tombol Aksi Tabel */
        .btn-action { width: 32px; height: 32px; border-radius: 6px; display: inline-flex; justify-content: center; align-items: center; text-decoration: none; border: 1px solid transparent; transition: 0.2s; font-size: 13px; cursor: pointer;}
        .btn-maps { background-color: #e8f5e9; color: #2ecc71; border-color: #a5d6a7; }
        .btn-maps:hover { background-color: #2ecc71; color: #fff; }
        .btn-edit { background-color: #fff3cd; color: #F7941D; border-color: #ffeeba; }
        .btn-edit:hover { background-color: #F7941D; color: #fff; }
        .btn-delete { background-color: #fdf2f2; color: #e74c3c; border-color: #f5c6cb; }
        .btn-delete:hover { background-color: #e74c3c; color: #fff; }

        /* Map Pin Native */
        .custom-pin { width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 2px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; position: absolute; left: -15px; top: -30px; }
        .custom-pin span { transform: rotate(45deg); color: #ffffff; font-size: 9px; font-weight: 800; letter-spacing: 0.5px; }
        
        .insight-box { background-color: #F8FAFC; padding: 15px; border-radius: 8px; border: 1px solid var(--border-light); font-size: 12.5px; color: var(--text-dark); line-height: 1.5; margin-top: 15px;}
    </style>

    <div class="py-4 px-4 font-['Segoe_UI',Tahoma,sans-serif]">
        
        <!-- Notifikasi (Toast Alert) -->
        @if(session('success'))
            <div style="background: #ffffff; color: var(--text-dark); box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; border-left: 5px solid #2ecc71; padding: 15px; font-size: 14px; font-weight: 500; margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 12px;"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #ffffff; color: var(--text-dark); box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; border-left: 5px solid #e74c3c; padding: 15px; font-size: 14px; font-weight: 500; margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #e74c3c; font-size: 18px; margin-right: 12px;"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Card Peta Wilayah -->
        <div class="clean-card">
            <div class="card-header-clean">
                <h5><i class="fa-solid fa-map-location-dot text-danger" style="color:#e74c3c; margin-right:8px;"></i> Peta Wilayah Operasional</h5>
                <a href="{{ route('kompetitor.create') }}" class="btn-orange">
                    <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Tambah Data Agen
                </a>
            </div>
            
            <div id="map" style="width: 100%; height: 450px; border-radius: 8px; border: 1px solid var(--border-light); z-index: 1;"></div>
            
            <div class="insight-box">
                <i class="fa-solid fa-lightbulb text-warning" style="color: var(--accent-orange); margin-right: 5px;"></i> <strong>Saran Taktis:</strong> Visualisasi peta mempermudah penetrasi dan penentuan titik lokasi strategis jemput bola.
            </div>
        </div>

        <!-- Card Tabel Data Agen/Cabang -->
        <div class="clean-card">
            <div class="card-header-clean">
                <h5><i class="fa-solid fa-table-list" style="color:var(--primary-navy); margin-right:8px;"></i> Database Cabang / Agen Resmi Setiap Kompetitor</h5>
            </div>
            
            <div class="table-responsive">
                <table class="native-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Nama Agen / Cabang</th>
                            <th style="width: 15%;">Ekspedisi</th>
                            <th style="width: 35%;">Alamat Lengkap</th>
                            <th style="width: 20%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cabang as $index =>$item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td style="font-weight: 600;">{{ $item->nama_kompetitor }}</td>
                                <td>
                                    <span style="background-color: {{ $item->kategori->kode_warna ?? '#34495e' }}; color: white; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold;">
                                        {{ $item->kategori->inisial ?? 'UMUM' }}
                                    </span>
                                </td>
                                <td>{{ $item->alamat }}</td>
                                <td style="text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <a href="{{ $item->url }}" target="_blank" class="btn-action btn-maps" title="Lihat di Google Maps">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </a>
                                        
                                        @if(Auth::user()->role === 'Admin' || Auth::id() === $item->users_id)
                                            <a href="{{ route('kompetitor.edit', $item->kompetitor_id) }}" class="btn-action btn-edit" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('kompetitor.destroy', $item->kompetitor_id) }}" method="POST" onsubmit="return confirm('Hapus data agen ini dari peta secara permanen?');" style="margin: 0; padding: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fa-solid fa-folder-open" style="font-size: 30px; margin-bottom: 10px;"></i><br>
                                    Belum ada titik agen yang didaftarkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Peta Leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([2.9566, 99.0625], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap',
                maxZoom: 19,
            }).addTo(map);

            var locations = @json($lokasi_kompetitor ?? []);
            
            if(locations && locations.length > 0) {
                locations.forEach(function(loc) {
                    var markerHtml = `
                        <div class="custom-pin" style="background-color: ${loc.color};">
                            <span>${loc.inisial}</span>
                        </div>`;

                    var customIcon = L.divIcon({
                        className: '',
                        html: markerHtml,
                        iconSize: [30, 30],
                        iconAnchor: [0, 0],
                        popupAnchor: [0, -30]
                    });

                    var popupContent = `
                        <div style="font-family: 'Segoe UI', Tahoma, sans-serif; min-width: 200px;">
                            <div style="font-size:13.5px; font-weight:bold; color:var(--primary-navy); margin-bottom:5px; border-bottom:1px solid #E2E8F0; padding-bottom:5px;">
                                ${loc.nama_kompetitor}
                            </div>
                            <div style="font-size:12px; color:var(--text-muted); margin-bottom:10px; line-height: 1.4;">
                                ${loc.alamat}
                            </div>
                            <a href="${loc.url}" target="_blank" style="display:inline-block; background-color:#2ecc71; color:white; padding:6px 12px; text-decoration:none; border-radius:6px; font-size:11px; font-weight:bold;">
                                <i class="fa-solid fa-map-location-dot"></i> Buka Maps
                            </a>
                        </div>
                    `;

                    L.marker([loc.latitude, loc.longitude], {icon: customIcon})
                     .addTo(map)
                     .bindPopup(popupContent);
                });
            }
        });
    </script>
</x-app-layout>