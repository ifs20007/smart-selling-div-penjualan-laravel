<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PosIND Pematangsiantar - Solusi Logistik Anda</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (Menggunakan asset() helper Laravel) -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --accent-orange: #F7941D; 
            --bg-light: #F8FAFC;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
        }

        body { font-family: 'Inter', Tahoma, sans-serif; background-color: var(--bg-light); color: var(--text-dark); margin: 0; padding-top: 80px; scroll-behavior: smooth; }
        
        .navbar-public { background-color: #ffffff; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: fixed; top: 0; width: 100%; z-index: 1030; display: flex; align-items: center; justify-content: space-between; padding: 0 5%;}
        .navbar-brand img { height: 40px; }
        .nav-links a { text-decoration: none; color: var(--primary-navy); font-weight: 600; margin-left: 30px; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: var(--accent-orange); }
        .btn-login-nav { background-color: var(--primary-navy); color: #fff !important; padding: 10px 25px; border-radius: 8px; font-size: 14px; }
        .btn-login-nav:hover { background-color: var(--primary-navy-hover); color: #fff !important; }

        /* HERO SECTION */
        .hero-section { background: linear-gradient(135deg, var(--primary-navy) 0%, #001f3f 100%); color: #fff; padding: 80px 5%; display: flex; flex-wrap: wrap; align-items: center; }
        .hero-text { flex: 1; min-width: 300px; padding-right: 30px; }
        .hero-text h1 { font-size: 42px; font-weight: 800; margin-bottom: 20px; line-height: 1.2; }
        .hero-text h1 span { color: var(--accent-orange); }
        .hero-text p { font-size: 16px; color: rgba(255,255,255,0.8); margin-bottom: 30px; line-height: 1.6;}
        
        .hero-form { flex: 1; min-width: 300px; background: #ffffff; padding: 35px; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        .hero-form h3 { color: var(--primary-navy); font-weight: 700; font-size: 20px; margin-bottom: 20px;}
        .form-label { font-size: 13px; font-weight: 700; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;}
        .form-control { background-color: var(--bg-light); border: 1px solid var(--border-light); padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14.5px; font-weight: 500; color: var(--text-dark);}
        .form-control:focus { border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); }
        .form-control:disabled { background-color: #E2E8F0; cursor: not-allowed; opacity: 0.7;}
        .btn-cek { width: 100%; background: var(--accent-orange); color: #fff; border: none; padding: 14px; border-radius: 8px; font-weight: bold; font-size: 15px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3);}
        .btn-cek:hover { background: #e08316; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(247, 148, 29, 0.4);}

        /* HASIL ONGKIR SECTION */
        .result-section { padding: 60px 5% 20px 5%; background-color: var(--bg-light); }
        .result-header { text-align: center; margin-bottom: 40px; }
        .result-header h2 { color: var(--primary-navy); font-weight: 800; font-size: 28px; margin-bottom: 10px;}
        .result-header p { color: var(--text-muted); font-size: 15px;}
        
        .ongkir-list { display: flex; flex-direction: column; gap: 15px; max-width: 800px; margin: 0 auto;}
        .ongkir-card { background: #fff; border-radius: 12px; padding: 20px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; transition: 0.3s;}
        .ongkir-card:hover { transform: translateX(5px); box-shadow: 0 8px 20px rgba(0,0,0,0.06);}
        
        .brand-col { display: flex; align-items: center; gap: 15px; min-width: 200px;}
        .brand-color-box { width: 45px; height: 45px; border-radius: 10px; display: flex; justify-content: center; align-items: center; color: #fff; font-size: 20px;}
        .brand-name { font-weight: 800; color: var(--primary-navy); font-size: 16px; margin-bottom: 3px;}
        .brand-service { font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase;}
        
        .price-col { text-align: right; }
        .price-val { font-size: 22px; font-weight: 800; color: var(--text-dark); margin-bottom: 2px;}
        .price-eta { font-size: 12px; color: var(--text-muted); font-weight: 500;}

        .ongkir-card.pos-highlight { background-color: #FFF5EA; border: 2px solid var(--accent-orange); box-shadow: 0 10px 25px rgba(247, 148, 29, 0.15); transform: scale(1.02); z-index: 2; margin-bottom: 10px;}
        .ongkir-card.pos-highlight .price-val { color: var(--accent-orange); }
        .badge-cheapest { background-color: var(--accent-orange); color: #fff; font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 800; letter-spacing: 0.5px; position: absolute; top: -12px; right: 25px; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3);}

        /* INFO & FITUR LAYANAN SECTION */
        .features-section { padding: 80px 5%; background-color: #ffffff; }
        .section-title { text-align: center; color: var(--primary-navy); font-weight: 800; font-size: 30px; margin-bottom: 50px; text-transform: uppercase;}
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px;}
        .feature-box { text-align: center; padding: 40px 20px; background-color: var(--bg-light); border-radius: 16px; transition: 0.3s; border: 1px solid var(--border-light);}
        .feature-box:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.05); background-color: #ffffff;}
        .feature-icon { width: 70px; height: 70px; margin: 0 auto 20px auto; background-color: #FFF5EA; color: var(--accent-orange); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px;}
        .feature-box h4 { color: var(--primary-navy); font-weight: 800; font-size: 18px; margin-bottom: 15px;}
        .feature-box p { color: var(--text-muted); font-size: 14.5px; line-height: 1.6; margin: 0;}

        /* PROMO SECTION */
        .promo-section { padding: 80px 5%; background-color: var(--bg-light); border-top: 1px solid var(--border-light);}
        .promo-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; border-top: 4px solid var(--accent-orange); transition: 0.3s; display: flex; flex-direction: column;}
        .promo-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); }
        .promo-title { font-size: 18px; font-weight: 800; color: var(--primary-navy); margin-bottom: 10px; line-height: 1.3;}
        .promo-date { font-size: 12px; color: var(--text-muted); font-weight: 600; margin-bottom: 15px; display: block;}
        .promo-preview { flex-grow: 1; font-size: 14px; color: var(--text-dark); line-height: 1.6; max-height: 120px; overflow: hidden; position: relative; margin-bottom: 20px; }
        .promo-preview::after { content: ""; position: absolute; bottom: 0; left: 0; right: 0; height: 40px; background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1)); }
        .promo-preview img { display: none !important; }
        .btn-baca { width: 100%; border-radius: 8px; font-weight: 700; font-size: 14px; padding: 10px; background-color: #ebf5fb; color: var(--primary-navy); border: 1px solid #d6eaf8; transition: 0.2s;}
        .btn-baca:hover { background-color: var(--primary-navy); color: #fff; border-color: var(--primary-navy);}

        /* CONTACT CHANNELS SECTION */
        .contact-section { padding: 80px 5%; background-color: #ffffff; border-top: 1px solid var(--border-light); text-align: center;}
        .contact-title { color: var(--primary-navy); font-weight: 800; font-size: 24px; margin-bottom: 15px;}
        .contact-desc { color: var(--text-muted); font-size: 15px; margin-bottom: 50px; max-width: 600px; margin-left: auto; margin-right: auto;}
        .contact-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 900px; margin: 0 auto;}
        .contact-item { background: var(--bg-light); border-radius: 12px; padding: 25px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid var(--border-light); display: flex; flex-direction: column; align-items: center; text-decoration: none; transition: 0.3s;}
        .contact-item:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); background: #fff;}
        .contact-icon { font-size: 36px; margin-bottom: 15px; color: var(--primary-navy);}
        .contact-item h5 { color: var(--text-dark); font-weight: 700; font-size: 16px; margin-bottom: 8px;}
        .contact-item p { color: var(--text-muted); font-size: 14px; margin: 0;}

        /* MODAL DETAIL PROMO */
        .modal-content.clean-modal { border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);}
        .modal-header { padding: 25px 25px 15px 25px; border-bottom: 1px dashed var(--border-light) !important;}
        .modal-promo-title { color: var(--primary-navy); font-weight: 800; font-size: 22px; line-height: 1.3; margin-bottom: 5px;}
        .modal-promo-date { font-size: 13px; color: var(--text-muted); font-weight: 600;}
        .modal-body.modal-promo-body { font-size: 15px; color: var(--text-dark); line-height: 1.7; padding: 25px;}
        .modal-promo-body p:first-child { margin-top: 0; }
        .modal-promo-body p:last-child { margin-bottom: 0; }
        .modal-promo-body img { max-width: 100%; height: auto !important; border-radius: 8px; margin: 15px 0; box-shadow: 0 4px 10px rgba(0,0,0,0.05); display: block;}
        .modal-footer { padding: 20px 25px; background-color: var(--bg-light); border-radius: 0 0 16px 16px; border-top: 1px solid var(--border-light);}
        .modal-footer-actions { display: flex; justify-content: space-between; width: 100%; align-items: center; gap: 10px; flex-wrap: wrap;}
        .btn-klaim-wa { background-color: var(--accent-orange); color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; border: none; font-size: 14px;}
        .btn-klaim-wa:hover { background-color: #e08316; color: #fff; transform: translateY(-2px);}
        .btn-share-wa { background-color: #27ae60; color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; border: none; font-size: 14px;}
        .btn-share-wa:hover { background-color: #2ecc71; color: #fff; transform: translateY(-2px);}

        footer { background: var(--primary-navy); color: rgba(255,255,255,0.7); text-align: center; padding: 25px; font-size: 14px; }
        
        @media (max-width: 768px) {
            .hero-section { padding: 40px 5%; }
            .hero-text h1 { font-size: 32px; }
            .hero-form { margin-top: 30px; width: 100%;}
            .nav-links a.hide-mobile { display: none; }
            .ongkir-card.pos-highlight { transform: none; }
            .price-col { text-align: left; width: 100%; border-top: 1px dashed var(--border-light); padding-top: 10px;}
            .badge-cheapest { right: 15px; }
            .modal-header, .modal-body.modal-promo-body, .modal-footer { padding: 20px; }
            .modal-promo-title { font-size: 18px; }
            .btn-klaim-wa, .btn-share-wa { flex: 1; justify-content: center; text-align: center; padding: 12px 10px; font-size: 13px;}
            .modal-footer-actions > div:last-child { width: 100%; }
            .contact-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 480px) {
            .contact-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    @php
        $nomor_cs_pos = "6281234567890";
    @endphp

    <!-- NAVBAR -->
    <nav class="navbar-public">
        <a href="{{ route('front.index') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/posind.png') }}" alt="Pos Indonesia">
        </a>
        <div class="nav-links">
            <a href="#ongkir" class="hide-mobile">Cek Ongkir</a>
            <a href="#layanan" class="hide-mobile">Layanan</a>
            <a href="#promo" class="hide-mobile">Promosi</a>
            <a href="#kontak" class="hide-mobile">Kontak</a>
            
            <!-- Blade Auth Directive menggantikan Session lama -->
            @auth
                <a href="{{ route('dashboard') }}" class="btn-login-nav"><i class="fa-solid fa-chart-line me-2"></i>Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-login-nav"><i class="fa-solid fa-right-to-bracket me-2"></i>Login Admin</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION & CEK ONGKIR FORM -->
    <section class="hero-section" id="ongkir">
        <div class="hero-text">
            <h1>Kirim Paket Lebih <span>Cepat & Hemat</span> Bersama PosIND</h1>
            <p>Jangkauan terluas hingga ke pelosok negeri. Nikmati layanan jemput paket gratis untuk pebisnis online dan UMKM di Pematangsiantar.</p>
            <p style="font-weight:bold; color:var(--accent-orange);"><i class="fa-solid fa-truck-fast me-2"></i> Hubungi CS B2B: {{ $nomor_cs_pos }} (Penjemputan)</p>
        </div>
        
        <div class="hero-form">
            <h3><i class="fa-solid fa-calculator text-warning me-2"></i> Estimasi Ongkos Kirim</h3>
            
            <form action="{{ route('front.index') }}#hasil-ongkir" method="GET">
                <label class="form-label">Titik Asal</label>
                <input type="text" class="form-control" value="Pematangsiantar (Sumatera Utara)" readonly>
                
                <label class="form-label">1. Provinsi Tujuan</label>
                <select id="selectProvinsi" class="form-control" required>
                    <option value="">-- Pilih Provinsi Tujuan --</option>
                    @foreach($provinsi as $p)
                        <option value="{{ $p->provinsi_id }}">{{ $p->nama_provinsi }}</option>
                    @endforeach
                </select>

                <label class="form-label">2. Kota/Kabupaten Tujuan</label>
                <!-- Opsi wilayah akan dimuat oleh AJAX di bawah -->
                <select name="id_wilayah" id="selectWilayah" class="form-control" required disabled>
                    <option value="">-- Pilih Provinsi Dahulu --</option>
                </select>
                
                <label class="form-label">Berat Paket (Kg)</label>
                <input type="number" name="berat" class="form-control" min="1" value="{{ request('berat', 1) }}" required>
                
                <button type="submit" class="btn-cek">Cek Tarif Sekarang</button>
            </form>
        </div>
    </section>

    <!-- SECTION HASIL ONGKIR -->
    @if(request()->has('id_wilayah'))
    <section class="result-section" id="hasil-ongkir">
        <div class="result-header">
            <h2>Hasil Pencarian Ongkos Kirim</h2>
            <p>Pematangsiantar <i class="fa-solid fa-arrow-right mx-2 text-warning"></i> <strong>{{ $nama_tujuan ?? '-' }}</strong> ({{ $berat }} Kg)</p>
        </div>
        
        <div class="ongkir-list">
            @forelse($data_ongkir as $row)
                @php
                    $is_pos = ($row->kategori_kompetitor_id == 1);
                    $highlight_class = ($is_pos && $is_pos_cheapest) ? "pos-highlight" : "";
                    $inisial = $is_pos ? '<i class="fa-solid fa-envelopes-bulk"></i>' : substr($row->ekspedisi, 0, 1);
                    
                    // Kita cetak full atribut HTML style ke dalam variabel string
                    $bgColor = $row->kode_warna ?? '#333333';
                    $styleStr = 'style="background-color: ' . $bgColor . ';"';
                @endphp
                
                <div class="ongkir-card {{ $highlight_class }}" style="position: relative;">
                    @if($highlight_class !== "")
                        <div class="badge-cheapest"><i class="fa-solid fa-star text-light me-1"></i> REKOMENDASI TERMURAH</div>
                    @endif
                    
                    <div class="brand-col">
                        <!-- UBAH BAGIAN STYLE MENJADI SEPERTI INI (Tanpa ada kurung kurawal di dalam tag) -->
                        <div class="brand-color-box" {!! $styleStr !!}>
                            {!! $inisial !!}
                        </div>
                        <div>
                            <div class="brand-name">{{ $row->ekspedisi }}</div>
                            <div class="brand-service">Layanan: {{ $row->jenis_layanan }}</div>
                        </div>
                    </div>
                    
                    <div class="price-col">
                        <div class="price-val">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</div>
                        <div class="price-eta"><i class="fa-regular fa-clock me-1"></i> Estimasi Tiba: {{ $row->estimasi_waktu }}</div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center border-0 shadow-sm rounded-3 py-4" style="background:#fff3cd; color:#856404;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size:30px; margin-bottom:15px; display:block;"></i>
                    <strong>Mohon Maaf!</strong> Data tarif untuk wilayah tujuan tersebut belum tersedia di sistem.
                </div>
            @endforelse
        </div>
        
        @if($data_ongkir->isNotEmpty())
        <div class="text-center mt-5">
            <a href="https://wa.me/{{ $nomor_cs_pos }}?text={{ urlencode('Halo PosIND, saya ingin mengirim paket seberat '.$berat.'kg ke '.$nama_tujuan.'. Bisa bantu pickup?') }}" target="_blank" class="btn btn-success px-4 py-3 rounded-3" style="font-weight:700; box-shadow:0 10px 20px rgba(46,204,113,0.3); text-decoration:none;">
                <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Langsung Order Pick-up PosIND Sekarang
            </a>
        </div>
        @endif
    </section>
    @endif

    <!-- 1. MENGAPA MEMILIH KAMI / LAYANAN SECTION -->
    <section class="features-section" id="layanan">
        <h2 class="section-title">Keunggulan PosIND Pematangsiantar</h2>
        <div class="container px-0">
            <div class="features-grid">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                    <h4>Layanan Jemput Gratis</h4>
                    <p>Tidak perlu repot datang ke loket. Kurir O-Ranger kami siap menjemput paket langsung ke toko atau rumah Anda tanpa biaya tambahan.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <h4>Cash on Delivery (COD)</h4>
                    <p>Tingkatkan penjualan bisnis online Anda dengan layanan bayar di tempat. Pencairan dana cepat, aman, dan langsung ke rekening Anda.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon"><i class="fa-solid fa-earth-asia"></i></div>
                    <h4>Jangkauan Terluas</h4>
                    <p>Dengan jaringan infrastruktur logistik terbesar di Indonesia, kami memastikan paket Anda tiba hingga ke pelosok kecamatan dan desa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. PROMO & AKTIVITAS SECTION -->
    <section class="promo-section" id="promo">
        <h2 class="section-title">Info & Promosi Terbaru</h2>
        <div class="container px-0">
            <div class="row g-4">
                @forelse($promos as $promo)
                    <div class="col-md-4">
                        <div class="promo-card">
                            <h4 class="promo-title">{{ $promo->judul_topic }}</h4>
                            <span class="promo-date"><i class="fa-regular fa-calendar me-2"></i> {{ \Carbon\Carbon::parse($promo->created_at)->format('d M Y') }}</span>
                            <div class="promo-preview">{!! $promo->isi_konten !!}</div>
                            <button class="btn btn-baca mt-auto" data-bs-toggle="modal" data-bs-target="#modalPromo_{{ $promo->id_promo }}">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- MODAL DETAIL PROMO -->
                    <div class="modal fade" id="modalPromo_{{ $promo->id_promo }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                            <div class="modal-content clean-modal">
                                <div class="modal-header">
                                    <div style="padding-right: 20px;">
                                        <h4 class="modal-promo-title">{{ $promo->judul_topic }}</h4>
                                        <div class="modal-promo-date"><i class="fa-regular fa-calendar text-warning me-1"></i> Dipublikasikan: {{ \Carbon\Carbon::parse($promo->created_at)->format('d M Y') }}</div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modal-promo-body">
                                    {!! $promo->isi_konten !!}
                                </div>
                                <div class="modal-footer">
                                    <div class="modal-footer-actions">
                                        <div>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-weight:bold; color:var(--text-muted); border:1px solid var(--border-light); padding: 10px 20px; border-radius: 8px;">Tutup</button>
                                        </div>
                                        <div class="d-flex gap-2" style="flex-wrap: wrap; justify-content: flex-end;">
                                            <a href="#" target="_blank" class="btn-share-wa">
                                                <i class="fa-solid fa-share-nodes"></i> Teruskan ke Teman
                                            </a>
                                            <a href="https://wa.me/{{ $nomor_cs_pos }}?text={{ urlencode('Halo PosIND Pematangsiantar. Saya ingin bertanya detail tentang promo: *'.$promo->judul_topic.'*. Mohon infonya.') }}" target="_blank" class="btn-klaim-wa">
                                                <i class="fa-brands fa-whatsapp" style="font-size:18px;"></i> Tanya / Klaim Promo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada informasi atau promosi terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 3. CONTACT CHANNELS SECTION -->
    <section class="contact-section" id="kontak">
        <h2 class="contact-title">Butuh Bantuan? Hubungi Kami</h2>
        <p class="contact-desc">Selain melalui situs web, Anda juga bisa menyampaikan keluhan atau kendala layanan melalui saluran resmi berikut:</p>
        
        <div class="contact-grid">
            <a href="tel:1500161" class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-phone-volume"></i></div>
                <h5>Halo Pos</h5><p>1500161</p>
            </a>
            <a href="mailto:halopos@posindonesia.co.id" class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                <h5>Email Resmi</h5><p>halopos@posindonesia.co.id</p>
            </a>
            <a href="https://instagram.com/posindonesia.ig" target="_blank" class="contact-item">
                <div class="contact-icon" style="color: #E1306C;"><i class="fa-brands fa-instagram"></i></div>
                <h5>Instagram Resmi</h5><p>@posindonesia.ig</p>
            </a>
            <a href="https://t.me/posindonesia_officialbot" target="_blank" class="contact-item">
                <div class="contact-icon" style="color: #0088cc;"><i class="fa-brands fa-telegram"></i></div>
                <h5>Telegram Resmi</h5><p>@posindonesia_officialbot</p>
            </a>
            <a href="https://twitter.com/PosIndonesia" target="_blank" class="contact-item">
                <div class="contact-icon" style="color: #000000;"><i class="fa-brands fa-x-twitter"></i></div>
                <h5>X (Twitter) Resmi</h5><p>@PosIndonesia</p>
            </a>
            <a href="https://www.facebook.com/posindonesia" target="_blank" class="contact-item">
                <div class="contact-icon" style="color: #1877F2;"><i class="fa-brands fa-facebook"></i></div>
                <h5>Facebook Resmi</h5><p>Pos Indonesia</p>
            </a>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} Pos Indonesia Pematangsiantar. CMS Smart Selling developed for Academic Project.
    </footer>

    <!-- Script jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            $('#selectProvinsi').on('change', function(){
                var provinsi_id = $(this).val();
                if(provinsi_id){
                    $('#selectWilayah').html('<option value="">Sedang memuat wilayah...</option>').prop('disabled', true);
                    
                    $.ajax({
                        type: 'GET',
                        url: '{{ url("/api/wilayah") }}' + '/' + provinsi_id,
                        success: function(html){
                            $('#selectWilayah').html(html).prop('disabled', false);
                        },
                        error: function(){
                            $('#selectWilayah').html('<option value="">Gagal mengambil data sistem</option>').prop('disabled', false);
                        }
                    }); 
                } else {
                    $('#selectWilayah').html('<option value="">-- Pilih Provinsi Dahulu --</option>').prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>