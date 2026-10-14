<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --primary-navy-light: #EBF3FA;
            --accent-orange: #F7941D; 
            --accent-orange-hover: #E08213;
            --accent-orange-light: #FFF5EA;
            --accent-orange-border: #FCD9B1;
            --bg-body: #F4F7F6;
            --bg-card: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --border-light: #E2E8F0;
            --border-focus: #003B73;
        }

        .clean-card {
            background: var(--bg-card);
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 59, 115, 0.04);
            border: 1px solid var(--border-light);
            transition: all 0.25s ease;
        }

        .clean-input {
            width: 100%;
            padding: 10px 14px;
            background-color: #F8FAFC;
            color: var(--text-dark);
            border: 1px solid var(--border-light);
            border-radius: 9px;
            font-size: 13.5px;
            outline: none;
            transition: all 0.2s ease;
        }

        .clean-input:focus {
            background-color: #FFFFFF;
            border-color: var(--primary-navy);
            box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.12);
        }

        .clean-input-locked {
            background-color: #F1F5F9;
            color: #334155;
            border: 1px solid #CBD5E1;
            cursor: default;
        }

        .dropdown-menu-search {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            z-index: 60;
            background: #FFFFFF;
            border: 1px solid var(--border-light);
            border-radius: 10px;
            max-height: 280px;
            overflow-y: auto;
            box-shadow: 0 12px 30px -4px rgba(0, 59, 115, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .dropdown-menu-search::-webkit-scrollbar {
            width: 6px;
        }
        .dropdown-menu-search::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        /* Preset Weight Chips */
        .preset-chip {
            padding: 5px 12px;
            font-size: 11.5px;
            font-weight: 600;
            border-radius: 7px;
            border: 1px solid var(--border-light);
            background: #F8FAFC;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .preset-chip:hover {
            border-color: var(--accent-orange);
            color: var(--accent-orange);
            background: var(--accent-orange-light);
        }
        .preset-chip.active {
            border-color: var(--accent-orange);
            color: #FFFFFF;
            background: var(--accent-orange);
            box-shadow: 0 2px 6px rgba(247, 148, 29, 0.3);
        }

        /* Filter Tab Buttons */
        .filter-tab-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .filter-tab-btn:hover {
            color: var(--primary-navy);
            background: #F1F5F9;
        }
        .filter-tab-btn.active {
            background: #FFFFFF;
            color: var(--primary-navy);
            border-color: var(--border-light);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        /* Table Specifics */
        .courier-logo-box {
            width: 52px;
            height: 38px;
            border-radius: 8px;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3px 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            flex-shrink: 0;
        }
        .courier-logo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Row Highlight for POS Indonesia */
        .tr-pos-highlight {
            background-color: #FFF9F2 !important;
            border-left: 4px solid var(--accent-orange) !important;
        }
        .tr-pos-highlight:hover {
            background-color: #FFF3E2 !important;
        }
    </style>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">
        
        <!-- Header & Breadcrumb Info -->
        <div class="clean-card bg-gradient-to-r from-white via-white to-orange-50/30">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider mb-2 flex-wrap">
                        <span class="px-2.5 py-1 rounded-md bg-orange-100 text-[#E08213] font-mono inline-flex items-center gap-1.5 border border-orange-200">
                            <i class="fa-solid fa-flask-vial"></i> SANDBOX MODULE
                        </span>
                        <span class="text-slate-300">•</span>
                        <span class="text-[#003B73] font-semibold">RajaOngkir Komerce v1 API</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-slate-500 font-medium">Logistik Pos Indonesia</span>
                    </div>
                    
                    <h1 class="text-2xl font-extrabold text-[#003B73] flex items-center gap-2.5 tracking-tight">
                        <span class="w-9 h-9 rounded-lg bg-orange-100 text-[#F7941D] inline-flex items-center justify-center text-lg shadow-xs">
                            <i class="fa-solid fa-calculator"></i>
                        </span>
                        Cek Ongkir Tes (Sandbox)
                    </h1>
                    <p class="text-sm text-slate-600 mt-1.5 leading-relaxed max-w-2xl">
                        Pengujian integrasi perhitungan ongkos kirim real-time dari <b>Pematangsiantar</b> menuju seluruh wilayah Indonesia menggunakan RajaOngkir Komerce dengan komparasi 7 ekspedisi nasional.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row md:flex-col lg:flex-row items-start md:items-end gap-2.5 shrink-0">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        API Komerce v1 Terhubung
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-[#003B73] border border-blue-200 shadow-xs">
                        <i class="fa-solid fa-truck-ramp-box text-[#F7941D]"></i>
                        Komparasi 7 Ekspedisi
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Input Card -->
        <div class="clean-card">
            <div class="flex items-center justify-between pb-3.5 mb-5 border-b border-slate-100 flex-wrap gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-md bg-[#FFF5EA] text-[#F7941D] flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-sliders"></i>
                    </span>
                    <h2 class="text-base font-bold text-[#003B73]">
                        Parameter Perhitungan Ongkos Kirim
                    </h2>
                </div>
                <div class="text-xs text-slate-400 flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-info text-blue-500"></i>
                    Titik asal telah ditentukan default dari Kantor Pos Pematangsiantar
                </div>
            </div>

            <form id="ongkirForm" class="space-y-6">
                <!-- Group 1: Rute Asal & Tujuan -->
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Asal (Origin) - Pre-determined Pematangsiantar (ID: 43847) -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                    <i class="fa-solid fa-location-dot text-[#F7941D] me-1"></i> Titik Asal Pengiriman
                                </label>
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i> Lokasi Terpilih
                                </span>
                            </div>
                            
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="origin_display" 
                                    value="Pematangsiantar" 
                                    readonly
                                    class="clean-input clean-input-locked pr-10 font-bold text-slate-800"
                                    title="Titik asal pengiriman telah dikunci di Pematangsiantar"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-lock text-xs" title="Terkunci secara otomatis"></i>
                                </div>
                            </div>
                            
                            <!-- Hidden Origin ID for RajaOngkir API (PROKLAMASI, PEMATANG SIANTAR, ID 43847) -->
                            <input type="hidden" id="origin_id" name="origin" value="43847" required>
                            
                            <div class="mt-1.5 flex items-center justify-between text-[11px] text-slate-400">
                                <span><i class="fa-solid fa-building text-slate-400 me-1"></i>Kantor Pos Pematangsiantar (Sumatera Utara)</span>
                                <span class="font-mono text-slate-500 font-medium">Subdistrict ID: 43847</span>
                            </div>
                        </div>

                        <!-- Tujuan (Destination) Search -->
                        <div class="relative">
                            <label for="destination_search" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                <i class="fa-solid fa-location-crosshairs text-[#003B73] me-1"></i> Titik Tujuan (Destination) <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="destination_search" 
                                    placeholder="Ketik nama kota atau kecamatan tujuan (cth: Jakarta, Medan)..." 
                                    autocomplete="off"
                                    class="clean-input pr-9 font-medium"
                                    required
                                >
                                <button 
                                    type="button" 
                                    id="destination_clear_btn" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition hidden cursor-pointer"
                                    title="Bersihkan input tujuan"
                                >
                                    <i class="fa-solid fa-circle-xmark text-sm"></i>
                                </button>
                                <div id="destination_search_icon" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                                </div>
                            </div>
                            
                            <input type="hidden" id="destination_id" name="destination" required>
                            
                            <!-- Destination Selected Badge -->
                            <div id="destination_selected_badge" class="mt-2 hidden"></div>
                            
                            <!-- Destination Dropdown Suggestions -->
                            <div id="destination_dropdown" class="dropdown-menu-search hidden"></div>
                            
                            <p class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                                <i class="fa-regular fa-lightbulb text-amber-500"></i> Ketik minimal 2 karakter lalu klik salah satu rekomendasi wilayah.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Group 2: Berat Paket & Pilihan Kurir -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-3 border-t border-slate-100">
                    
                    <!-- Berat Paket (Gram) -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="weight" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                <i class="fa-solid fa-weight-hanging text-slate-600 me-1"></i> Berat Paket (Gram) <span class="text-red-500">*</span>
                            </label>
                            <span class="text-[11px] font-semibold text-slate-500" id="weightKgDisplay">
                                = 1.00 Kg
                            </span>
                        </div>

                        <div class="relative">
                            <input 
                                type="number" 
                                id="weight" 
                                name="weight" 
                                value="1000" 
                                min="1" 
                                step="1" 
                                placeholder="Cth: 1000" 
                                class="clean-input pr-16 font-medium"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-xs font-bold text-[#003B73]">
                                Gram
                            </div>
                        </div>

                        <!-- Quick Presets -->
                        <div class="mt-2 flex items-center gap-1.5 flex-wrap">
                            <span class="text-[11px] text-slate-400 font-medium me-1">Preset:</span>
                            <button type="button" class="preset-chip active" data-weight="1000">1 Kg</button>
                            <button type="button" class="preset-chip" data-weight="2000">2 Kg</button>
                            <button type="button" class="preset-chip" data-weight="3000">3 Kg</button>
                            <button type="button" class="preset-chip" data-weight="5000">5 Kg</button>
                            <button type="button" class="preset-chip" data-weight="10000">10 Kg</button>
                        </div>
                    </div>

                    <!-- Ekspedisi / Kurir -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="courier" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                <i class="fa-solid fa-truck-fast text-slate-600 me-1"></i> Pilihan Ekspedisi <span class="text-red-500">*</span>
                            </label>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#003B73]">
                                <i class="fa-solid fa-layer-group text-[#F7941D]"></i> 7 Kurir Rekomendasi
                            </span>
                        </div>

                        <div class="relative">
                            <select 
                                id="courier" 
                                name="courier"
                                class="clean-input font-medium cursor-pointer"
                            >
                                <option value="pos:jne:jnt:tiki:lion:sicepat:sap" selected>Semua Ekspedisi (7 Kurir: POS, JNE, J&amp;T, TIKI, Lion, SiCepat, SAP)</option>
                                <option value="pos">POS Indonesia (pos)</option>
                                <option value="jne">JNE Express (jne)</option>
                                <option value="jnt">J&amp;T Express (jnt)</option>
                                <option value="tiki">TIKI (tiki)</option>
                                <option value="lion">Lion Parcel (lion)</option>
                                <option value="sicepat">SiCepat Express (sicepat)</option>
                                <option value="sap">SAP Express (sap)</option>
                            </select>
                        </div>

                        <p class="text-[11px] text-slate-400 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i> Menampilkan data rekomendasi layanan <b>Reguler (Standard)</b> dari ke-7 ekspedisi nasional.
                        </p>
                    </div>

                </div>

                <!-- Action Button Row -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-bolt text-[#F7941D]"></i>
                        <span>Kalkulasi AJAX instan tanpa reload halaman dashboard.</span>
                    </div>

                    <div class="flex items-center gap-2.5 w-full sm:w-auto">
                        <button 
                            type="button" 
                            id="btnResetForm"
                            class="w-full sm:w-auto px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-lg transition-all inline-flex items-center justify-center gap-1.5 cursor-pointer"
                        >
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Reset Input</span>
                        </button>

                        <button 
                            type="submit" 
                            id="btnCalculate"
                            class="w-full sm:w-auto px-6 py-2.5 bg-[#003B73] hover:bg-[#002D59] text-white font-bold text-xs rounded-lg shadow-sm hover:shadow-md transition-all inline-flex items-center justify-center gap-2 cursor-pointer border border-[#002D59]"
                        >
                            <i class="fa-solid fa-calculator text-[#F7941D]" id="btnIcon"></i>
                            <span id="btnText">Hitung Ongkos Kirim</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Hasil Perhitungan Section -->
        <div class="clean-card" id="resultsCard">
            
            <!-- Result Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="w-7 h-7 rounded-md bg-blue-50 text-[#003B73] flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-table-list"></i>
                    </span>
                    <h2 class="text-base font-bold text-[#003B73]">
                        Hasil Estimasi Biaya Pengiriman
                    </h2>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-[#003B73] border border-blue-200">
                        <i class="fa-solid fa-filter text-[10px] text-[#F7941D]"></i> Layanan Reguler 7 Ekspedisi
                    </span>
                </div>

                <!-- Filter Controls (Hidden initially) -->
                <div id="resultsFilterControls" class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-lg hidden">
                    <button type="button" class="filter-tab-btn active" id="tabAll">Semua Ekspedisi</button>
                    <button type="button" class="filter-tab-btn" id="tabPosOnly">Khusus POS</button>
                </div>
            </div>

            <!-- Route Summary Bar (Appears when calculated) -->
            <div id="routeSummaryBar" class="hidden mb-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2 flex-wrap text-slate-700">
                    <span class="font-bold text-[#003B73] inline-flex items-center gap-1">
                        <i class="fa-solid fa-route text-[#F7941D]"></i> Rute Pengiriman:
                    </span>
                    <span id="summaryOrigin" class="font-semibold text-slate-900 bg-white px-2 py-1 rounded border border-slate-200">Pematangsiantar</span>
                    <i class="fa-solid fa-arrow-right text-slate-400"></i>
                    <span id="summaryDest" class="font-semibold text-slate-900 bg-white px-2 py-1 rounded border border-slate-200">-</span>
                </div>

                <div class="flex items-center gap-3 text-slate-600">
                    <span class="inline-flex items-center gap-1 font-medium">
                        <i class="fa-solid fa-box text-slate-400"></i>
                        <span id="summaryWeight">1.000 gr (1 Kg)</span>
                    </span>
                    <span class="text-slate-300">•</span>
                    <span id="resultsCount" class="font-bold text-[#003B73]">0 opsi</span>
                </div>
            </div>

            <!-- Initial Empty State -->
            <div id="emptyState" class="py-14 text-center">
                <div class="w-16 h-16 mx-auto mb-3.5 rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#F7941D] shadow-xs">
                    <i class="fa-solid fa-box-open text-2xl"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Siap Menghitung Ongkos Kirim</h3>
                <p class="text-xs text-slate-500 mt-1.5 max-w-sm mx-auto leading-relaxed">
                    Titik asal telah disetel dari <b>Pematangsiantar</b>. Cukup ketik titik <b>Tujuan</b> pengiriman dan sesuaikan berat paket di atas, lalu klik <b>Hitung Ongkos Kirim</b>.
                </p>
                <div class="mt-4 flex items-center justify-center gap-2 flex-wrap">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600">
                        <i class="fa-solid fa-location-dot text-[#F7941D]"></i> Asal: Pematangsiantar
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600">
                        <i class="fa-solid fa-check text-emerald-600"></i> 7 Ekspedisi Nasional
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600">
                        <i class="fa-solid fa-check text-emerald-600"></i> Layanan Reguler
                    </span>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="py-14 text-center hidden">
                <div class="relative w-12 h-12 mx-auto mb-3.5">
                    <div class="w-12 h-12 rounded-full border-4 border-slate-200 border-t-[#003B73] animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-[#F7941D] text-xs">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
                <p class="text-sm font-bold text-slate-800">Menghubungi API RajaOngkir Komerce...</p>
                <p class="text-xs text-slate-500 mt-1">Mengambil data tarif dari 7 ekspedisi resmi (POS, JNE, J&amp;T, TIKI, Lion, SiCepat, SAP) secara real-time</p>
            </div>

            <!-- Error State -->
            <div id="errorState" class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm hidden">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-red-900" id="errorTitle">Gagal Mendapatkan Tarif</h4>
                        <p class="text-xs text-red-700 mt-0.5 leading-relaxed" id="errorMessage"></p>
                    </div>
                </div>
            </div>

            <!-- Highlight Banner POS Termurah -->
            <div id="posHighlightBanner" class="hidden"></div>

            <!-- Table Result State -->
            <div id="tableContainer" class="overflow-x-auto hidden">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50/80 border-y border-slate-200 text-slate-600 text-xs uppercase tracking-wider font-bold">
                            <th class="py-3 px-4">Ekspedisi</th>
                            <th class="py-3 px-4">Layanan &amp; Deskripsi</th>
                            <th class="py-3 px-4 text-center">Estimasi Pengiriman</th>
                            <th class="py-3 px-4 text-right">Biaya Ongkir</th>
                        </tr>
                    </thead>
                    <tbody id="resultsTableBody" class="divide-y divide-slate-100 text-slate-700">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <!-- JavaScript Sandbox Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const DEFAULT_ORIGIN_ID = "43847";
            const DEFAULT_ORIGIN_LABEL = "Pematangsiantar";

            const originIdInput = document.getElementById('origin_id');
            const originDisplay = document.getElementById('origin_display');

            const destSearchInput = document.getElementById('destination_search');
            const destIdInput = document.getElementById('destination_id');
            const destDropdown = document.getElementById('destination_dropdown');
            const destBadge = document.getElementById('destination_selected_badge');
            const destClearBtn = document.getElementById('destination_clear_btn');
            const destSearchIcon = document.getElementById('destination_search_icon');

            const weightInput = document.getElementById('weight');
            const weightKgDisplay = document.getElementById('weightKgDisplay');
            const presetChips = document.querySelectorAll('.preset-chip');
            const courierSelect = document.getElementById('courier');

            const ongkirForm = document.getElementById('ongkirForm');
            const btnCalculate = document.getElementById('btnCalculate');
            const btnResetForm = document.getElementById('btnResetForm');
            const btnIcon = document.getElementById('btnIcon');
            const btnText = document.getElementById('btnText');

            const emptyState = document.getElementById('emptyState');
            const loadingState = document.getElementById('loadingState');
            const errorState = document.getElementById('errorState');
            const tableContainer = document.getElementById('tableContainer');
            const resultsTableBody = document.getElementById('resultsTableBody');
            const resultsCount = document.getElementById('resultsCount');
            const posHighlightBanner = document.getElementById('posHighlightBanner');
            const routeSummaryBar = document.getElementById('routeSummaryBar');
            const summaryOrigin = document.getElementById('summaryOrigin');
            const summaryDest = document.getElementById('summaryDest');
            const summaryWeight = document.getElementById('summaryWeight');
            const resultsFilterControls = document.getElementById('resultsFilterControls');
            const tabAll = document.getElementById('tabAll');
            const tabPosOnly = document.getElementById('tabPosOnly');

            const searchApiUrl = "{{ route('rajaongkir.sandbox.search') }}";
            const calculateApiUrl = "{{ route('rajaongkir.sandbox.calculate') }}";

            // State Cache
            let currentCalculatedItems = [];
            let activeFilter = 'all';

            // Ekspedisi Metadata & Official Image Logos
            const courierLogos = {
                pos: "{{ asset('assets/images/posind.png') }}",
                jne: "{{ asset('assets/images/logo_jne.png') }}",
                jnt: "{{ asset('assets/images/logo_jnt.png') }}",
                tiki: "{{ asset('assets/images/logo_tiki.png') }}",
                lion: "{{ asset('assets/images/logo_lion.png') }}",
                sicepat: "{{ asset('assets/images/logo_sicepat.png') }}",
                sap: "{{ asset('assets/images/logo_sap.png') }}"
            };

            const courierMeta = {
                pos: {
                    name: 'POS Indonesia',
                    fullName: 'PT Pos Indonesia (Persero)',
                    tag: 'POS',
                    badgeBg: 'bg-orange-500',
                    badgeText: 'text-white',
                    logoImg: courierLogos.pos
                },
                jne: {
                    name: 'JNE Express',
                    fullName: 'Jalur Nugraha Ekakurir',
                    tag: 'JNE',
                    badgeBg: 'bg-[#003D79]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.jne
                },
                jnt: {
                    name: 'J&T Express',
                    fullName: 'PT Global Jet Express',
                    tag: 'J&T',
                    badgeBg: 'bg-[#ED1C24]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.jnt
                },
                tiki: {
                    name: 'TIKI',
                    fullName: 'Citra Van Titipan Kilat',
                    tag: 'TIKI',
                    badgeBg: 'bg-[#0090D0]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.tiki
                },
                lion: {
                    name: 'Lion Parcel',
                    fullName: 'PT Lion Express',
                    tag: 'LION',
                    badgeBg: 'bg-[#EC1C24]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.lion
                },
                sicepat: {
                    name: 'SiCepat Express',
                    fullName: 'PT SiCepat Ekspres Indonesia',
                    tag: 'SICEPAT',
                    badgeBg: 'bg-[#E52320]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.sicepat
                },
                sap: {
                    name: 'SAP Express',
                    fullName: 'PT Satria Antaran Prima Tbk',
                    tag: 'SAP',
                    badgeBg: 'bg-[#004C99]',
                    badgeText: 'text-white',
                    logoImg: courierLogos.sap
                }
            };

            const getCourierInfo = (code, rawName) => {
                const c = (code || '').toLowerCase().trim();
                for (const key of Object.keys(courierMeta)) {
                    if (c.includes(key)) {
                        return courierMeta[key];
                    }
                }
                return {
                    name: rawName || (code ? code.toUpperCase() : 'Ekspedisi'),
                    fullName: rawName || '',
                    tag: (code || 'EXP').toUpperCase(),
                    badgeBg: 'bg-slate-700',
                    badgeText: 'text-white',
                    logoImg: null
                };
            };

            // Helper: Debounce
            function debounce(func, delay = 350) {
                let timer;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            // Helper: Currency Formatter (IDR)
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(number);
            };

            // Update Weight Display Helper
            function updateWeightKg() {
                const grams = parseFloat(weightInput.value) || 0;
                const kg = (grams / 1000).toFixed(2);
                weightKgDisplay.textContent = `= ${kg} Kg`;
            }

            weightInput.addEventListener('input', () => {
                updateWeightKg();
                presetChips.forEach(chip => {
                    chip.classList.toggle('active', chip.dataset.weight === weightInput.value);
                });
            });

            // Preset Weight Chip Handler
            presetChips.forEach(chip => {
                chip.addEventListener('click', () => {
                    presetChips.forEach(c => c.classList.remove('active'));
                    chip.classList.add('active');
                    weightInput.value = chip.dataset.weight;
                    updateWeightKg();
                });
            });

            // Toggle Search Input Icons / Clear Buttons
            function updateClearButtonState(inputEl, clearBtn, searchIcon) {
                if (inputEl.value.trim().length > 0) {
                    clearBtn.classList.remove('hidden');
                    searchIcon.classList.add('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                    searchIcon.classList.remove('hidden');
                }
            }

            destClearBtn.addEventListener('click', () => {
                destSearchInput.value = '';
                destIdInput.value = '';
                destBadge.classList.add('hidden');
                destBadge.innerHTML = '';
                destDropdown.classList.add('hidden');
                updateClearButtonState(destSearchInput, destClearBtn, destSearchIcon);
                destSearchInput.focus();
            });

            // Destination Location Search Handler
            async function fetchLocationSearch(keyword, dropdownEl, idInputEl, searchInputEl, badgeEl, clearBtn, searchIcon) {
                const query = keyword.trim();
                updateClearButtonState(searchInputEl, clearBtn, searchIcon);

                if (query.length < 2) {
                    dropdownEl.innerHTML = '';
                    dropdownEl.classList.add('hidden');
                    return;
                }

                dropdownEl.innerHTML = `
                    <div class="p-3.5 text-xs text-slate-500 text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-notch fa-spin text-[#003B73]"></i> Mencari destinasi wilayah...
                    </div>
                `;
                dropdownEl.classList.remove('hidden');

                try {
                    const response = await fetch(`${searchApiUrl}?search=${encodeURIComponent(query)}&limit=10`);
                    const result = await response.json();

                    if (!response.ok || !result.data || result.data.length === 0) {
                        dropdownEl.innerHTML = `
                            <div class="p-3.5 text-xs text-slate-500 text-center">
                                Tidak ditemukan wilayah dengan kata kunci "<b>${query}</b>".
                            </div>
                        `;
                        return;
                    }

                    dropdownEl.innerHTML = '';
                    result.data.forEach(item => {
                        const row = document.createElement('div');
                        row.className = 'p-3 hover:bg-orange-50/50 cursor-pointer border-b border-slate-100 last:border-b-0 transition-colors text-left flex items-start gap-2.5';
                        
                        const subName = item.subdistrict_name && item.subdistrict_name !== '-' ? item.subdistrict_name : item.district_name;
                        const cityName = item.city_name || '';
                        const provName = item.province_name || '';
                        const zipCode = item.zip_code ? item.zip_code : '';

                        row.innerHTML = `
                            <div class="w-6 h-6 rounded-md bg-blue-50 text-[#003B73] flex items-center justify-center shrink-0 mt-0.5 text-xs">
                                <i class="fa-solid fa-map-pin"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-slate-900 truncate">
                                    ${subName ? subName + ', ' : ''}${cityName}
                                </div>
                                <div class="text-[11px] text-slate-500 mt-0.5 truncate">
                                    ${provName} ${zipCode ? '<span class="text-slate-400">• Kode Pos: ' + zipCode + '</span>' : ''}
                                </div>
                                <div class="text-[10px] text-[#003B73] font-mono mt-0.5 font-semibold inline-flex items-center gap-1">
                                    <span class="px-1.5 py-0.2 bg-blue-100/60 rounded">Subdistrict ID: ${item.id}</span>
                                </div>
                            </div>
                        `;

                        row.addEventListener('click', () => {
                            idInputEl.value = item.id;
                            searchInputEl.value = item.label || `${subName}, ${cityName}`;
                            updateClearButtonState(searchInputEl, clearBtn, searchIcon);

                            badgeEl.innerHTML = `
                                <div class="inline-flex items-center justify-between w-full p-2.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs shadow-xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <i class="fa-solid fa-circle-check text-emerald-600"></i>
                                        <span class="truncate">Tujuan: <b>${subName || cityName}</b> (${cityName}, ${provName})</span>
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-200 text-emerald-800">ID ${item.id}</span>
                                    </div>
                                    <button type="button" class="text-emerald-700 hover:text-emerald-900 text-[11px] font-bold px-2 py-0.5 rounded hover:bg-emerald-100 transition cursor-pointer" onclick="this.closest('#destination_selected_badge').classList.add('hidden');">
                                        Ubah
                                    </button>
                                </div>
                            `;
                            badgeEl.classList.remove('hidden');
                            dropdownEl.classList.add('hidden');
                            dropdownEl.innerHTML = '';
                        });

                        dropdownEl.appendChild(row);
                    });
                } catch (error) {
                    dropdownEl.innerHTML = `
                        <div class="p-3 text-xs text-red-600 text-center">
                            Gagal menghubungi API search: ${error.message}
                        </div>
                    `;
                }
            }

            // Bind Destination Autocomplete
            destSearchInput.addEventListener('input', debounce((e) => {
                destIdInput.value = '';
                destBadge.classList.add('hidden');
                fetchLocationSearch(e.target.value, destDropdown, destIdInput, destSearchInput, destBadge, destClearBtn, destSearchIcon);
            }, 350));

            // Close dropdowns on outside click
            document.addEventListener('click', (e) => {
                if (!destSearchInput.contains(e.target) && !destDropdown.contains(e.target)) {
                    destDropdown.classList.add('hidden');
                }
            });

            // Reset Button (Origin tetap Pematangsiantar ID 43847)
            btnResetForm.addEventListener('click', () => {
                // Keep Origin locked to Pematangsiantar
                originIdInput.value = DEFAULT_ORIGIN_ID;
                if (originDisplay) {
                    originDisplay.value = DEFAULT_ORIGIN_LABEL;
                }

                // Clear Destination
                destSearchInput.value = '';
                destIdInput.value = '';
                destBadge.classList.add('hidden');
                destBadge.innerHTML = '';
                destClearBtn.classList.add('hidden');
                destSearchIcon.classList.remove('hidden');

                // Reset Weight & Courier
                weightInput.value = 1000;
                updateWeightKg();
                presetChips.forEach(c => c.classList.toggle('active', c.dataset.weight === '1000'));
                courierSelect.value = 'pos:jne:jnt:tiki:lion:sicepat:sap';

                // Reset Results State
                emptyState.classList.remove('hidden');
                loadingState.classList.add('hidden');
                errorState.classList.add('hidden');
                tableContainer.classList.add('hidden');
                routeSummaryBar.classList.add('hidden');
                resultsFilterControls.classList.add('hidden');
                posHighlightBanner.classList.add('hidden');
                currentCalculatedItems = [];
                destSearchInput.focus();
            });

            // Render Table Function
            function renderResultsTable(items) {
                resultsTableBody.innerHTML = '';

                // Calculate minimum cost
                const validCosts = items.map(item => Number(item.cost) || 0).filter(c => c > 0);
                const minCost = validCosts.length > 0 ? Math.min(...validCosts) : 0;

                // Check POS lowest
                const posItems = items.filter(item => (item.code || '').toLowerCase().includes('pos'));
                const isPosLowest = posItems.some(item => (Number(item.cost) || 0) === minCost);

                items.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    const isPos = (item.code || '').toLowerCase().includes('pos');
                    const isThisPosLowest = isPos && isPosLowest && (Number(item.cost) || 0) === minCost;
                    const meta = getCourierInfo(item.code, item.name);

                    // Row visual treatment
                    if (isThisPosLowest) {
                        tr.className = 'tr-pos-highlight transition-colors';
                    } else if (isPos) {
                        tr.className = 'bg-[#FFFDF9] hover:bg-[#FFF7EC] border-l-4 border-l-amber-400 transition-colors';
                    } else {
                        tr.className = index % 2 === 0 ? 'bg-white hover:bg-slate-50 transition-colors' : 'bg-slate-50/40 hover:bg-slate-50 transition-colors';
                    }

                    // Logo / Icon
                    let logoHtml = '';
                    if (meta.logoImg) {
                        logoHtml = `
                            <div class="courier-logo-box">
                                <img src="${meta.logoImg}" alt="${meta.name}" onerror="this.parentElement.innerHTML='<span class=\\'font-bold text-[11px] text-[#003B73]\\'>${meta.tag}</span>'">
                            </div>
                        `;
                    } else {
                        logoHtml = `
                            <div class="courier-logo-box ${meta.badgeBg} ${meta.badgeText} font-bold text-xs tracking-tight">
                                ${meta.tag}
                            </div>
                        `;
                    }

                    // Description text
                    const rawDesc = item.description ? item.description.trim() : '';
                    const serviceDesc = (rawDesc && rawDesc !== item.service && rawDesc !== '240')
                        ? rawDesc 
                        : 'Layanan Pengiriman Reguler';

                    // ETD Column
                    let etdText = item.etd ? item.etd.trim() : '';
                    let etdHtml = '<span class="text-slate-400 text-xs italic">-</span>';
                    if (etdText) {
                        const hasDay = etdText.toLowerCase().includes('day') || etdText.toLowerCase().includes('hari');
                        const displayEtd = hasDay ? etdText : `${etdText} Hari`;
                        const etdBadgeClass = isThisPosLowest 
                            ? 'bg-amber-100 text-amber-900 border border-amber-300' 
                            : 'bg-slate-100 text-slate-700';
                        etdHtml = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold ${etdBadgeClass}"><i class="fa-regular fa-clock ${isThisPosLowest ? 'text-amber-700' : 'text-slate-400'}"></i> ${displayEtd}</span>`;
                    }

                    // Price Column
                    let priceHtml = '';
                    if (isThisPosLowest) {
                        priceHtml = `
                            <div class="text-right">
                                <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#F7941D] text-white shadow-xs mb-1">
                                    <i class="fa-solid fa-crown text-[9px]"></i> Paling Hemat
                                </div>
                                <div class="text-base font-extrabold text-[#003B73] whitespace-nowrap">
                                    ${formatRupiah(item.cost || 0)}
                                </div>
                            </div>
                        `;
                    } else {
                        const isCheapestOverall = (Number(item.cost) || 0) === minCost;
                        priceHtml = `
                            <div class="text-right">
                                ${isCheapestOverall ? '<div class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mb-0.5">Termurah</div>' : ''}
                                <div class="font-bold text-slate-900 text-sm whitespace-nowrap">
                                    ${formatRupiah(item.cost || 0)}
                                </div>
                            </div>
                        `;
                    }

                    tr.innerHTML = `
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                ${logoHtml}
                                <div>
                                    <div class="font-bold ${isThisPosLowest ? 'text-[#003B73] font-extrabold' : 'text-slate-900'} flex items-center gap-1.5 flex-wrap">
                                        <span>${meta.name}</span>
                                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold ${isThisPosLowest ? 'bg-orange-200 text-orange-950' : 'bg-slate-100 text-slate-600'}">${meta.tag}</span>
                                        ${isThisPosLowest ? '<span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-[#F7941D] text-white"><i class="fa-solid fa-award me-0.5"></i>Pilihan Terbaik</span>' : ''}
                                    </div>
                                    <div class="text-[11px] text-slate-500">${meta.fullName}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm ${isThisPosLowest ? 'text-[#003B73]' : 'text-slate-800'}">${item.service || '-'}</span>
                                <span class="inline-block px-1.5 py-0.2 rounded text-[10px] uppercase font-bold bg-blue-50 text-[#003B73] border border-blue-200">REGULER</span>
                            </div>
                            <span class="text-xs text-slate-500 block mt-0.5">${serviceDesc}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            ${etdHtml}
                        </td>
                        <td class="py-3 px-4">
                            ${priceHtml}
                        </td>
                    `;

                    resultsTableBody.appendChild(tr);
                });
            }

            // Tab Filters
            tabAll.addEventListener('click', () => {
                tabAll.classList.add('active');
                tabPosOnly.classList.remove('active');
                activeFilter = 'all';
                renderResultsTable(currentCalculatedItems);
            });

            tabPosOnly.addEventListener('click', () => {
                tabPosOnly.classList.add('active');
                tabAll.classList.remove('active');
                activeFilter = 'pos';
                const posFiltered = currentCalculatedItems.filter(item => (item.code || '').toLowerCase().includes('pos'));
                renderResultsTable(posFiltered);
            });

            // Handle Calculate Submit
            ongkirForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Origin is always 43847 (Pematangsiantar)
                const origin = originIdInput.value || DEFAULT_ORIGIN_ID;
                const destination = destIdInput.value;
                const weight = weightInput.value;
                const courier = courierSelect.value;

                if (!destination) {
                    alert('Silakan ketik dan pilih salah satu rekomendasi wilayah Tujuan (Destination) dari dropdown terlebih dahulu.');
                    destSearchInput.focus();
                    return;
                }

                // UI Loading State
                btnCalculate.disabled = true;
                btnCalculate.classList.add('opacity-75', 'cursor-not-allowed');
                btnIcon.className = 'fa-solid fa-circle-notch fa-spin';
                btnText.textContent = 'Menghitung...';

                emptyState.classList.add('hidden');
                errorState.classList.add('hidden');
                tableContainer.classList.add('hidden');
                routeSummaryBar.classList.add('hidden');
                resultsFilterControls.classList.add('hidden');
                posHighlightBanner.classList.add('hidden');
                posHighlightBanner.innerHTML = '';
                loadingState.classList.remove('hidden');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(calculateApiUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            origin: origin,
                            destination: destination,
                            weight: weight,
                            courier: courier,
                            price: 'lowest',
                            filter_regular: true
                        })
                    });

                    const res = await response.json();
                    loadingState.classList.add('hidden');

                    if (!response.ok || !res.data || res.data.length === 0) {
                        const msg = (res.meta && res.meta.message) ? res.meta.message : 'Tarif pengiriman tidak ditemukan untuk rute atau ekspedisi yang dipilih.';
                        document.getElementById('errorTitle').textContent = 'Tarif Tidak Ditemukan';
                        document.getElementById('errorMessage').textContent = msg;
                        errorState.classList.remove('hidden');
                        return;
                    }

                    // Filter Layanan Reguler
                    const isRegularService = (item) => {
                        const service = (item.service || '').toLowerCase().trim();
                        const desc = (item.description || '').toLowerCase().trim();
                        const combined = `${service} ${desc}`;

                        const excluded = [
                            'cargo', 'kargo', 'truck', 'trucking', 'jtr', 'gokil', 'bigpack', 'jumbo',
                            'instant', 'instan',
                            'same day', 'sameday', 'sds',
                            'next day', 'nextday', 'overnight', 'onepack', 'yes', 'besok', 'best',
                            'ons', 'udrons'
                        ];

                        for (const term of excluded) {
                            if (combined.includes(term)) return false;
                        }

                        if (/\b(express|ekspres)\b/i.test(service) && !/\b(reg|reguler|regular)\b/i.test(service)) {
                            return false;
                        }

                        const regularKeywords = [
                            'reg', 'reguler', 'regular', 'regpack', 'ez', 'siuntung',
                            'reg15', 'std', 'standard', 'standar', 'udrreg'
                        ];

                        return regularKeywords.some(pattern => combined.includes(pattern));
                    };

                    let regularItems = res.data.filter(isRegularService);

                    if (regularItems.length === 0) {
                        document.getElementById('errorTitle').textContent = 'Tidak Ada Layanan Reguler';
                        document.getElementById('errorMessage').textContent = 'Tidak ditemukan opsi pengiriman untuk kategori layanan Reguler (Standard) dari Pematangsiantar menuju tujuan ini.';
                        errorState.classList.remove('hidden');
                        return;
                    }

                    // Urutkan lowest cost first
                    regularItems.sort((a, b) => (Number(a.cost) || 0) - (Number(b.cost) || 0));
                    currentCalculatedItems = regularItems;

                    // Hitung tarif terendah
                    const validCosts = regularItems.map(item => Number(item.cost) || 0).filter(c => c > 0);
                    const minCost = validCosts.length > 0 ? Math.min(...validCosts) : 0;

                    // POS Indonesia Highlight
                    const posItems = regularItems.filter(item => (item.code || '').toLowerCase().includes('pos'));
                    const isPosLowest = posItems.some(item => (Number(item.cost) || 0) === minCost);

                    if (isPosLowest) {
                        posHighlightBanner.innerHTML = `
                            <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-orange-50/90 via-[#FFF9F2] to-amber-50/70 border border-orange-200 text-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-xs">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-11 h-11 rounded-xl bg-[#F7941D] text-white flex items-center justify-center shrink-0 shadow-sm text-lg">
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-extrabold text-[#003B73] flex items-center gap-2 flex-wrap">
                                            <span>POS Indonesia Pilihan Paling Hemat dari Pematangsiantar!</span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#F7941D] text-white uppercase tracking-wider">Terhemat</span>
                                        </div>
                                        <p class="text-xs text-slate-600 mt-0.5">
                                            Tarif layanan reguler POS Indonesia paling terjangkau dengan harga <b>${formatRupiah(minCost)}</b> dibandingkan seluruh ekspedisi lainnya.
                                        </p>
                                    </div>
                                </div>
                                <div class="shrink-0 flex items-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#003B73] text-white text-xs font-bold rounded-lg shadow-xs">
                                        <i class="fa-solid fa-award text-[#F7941D]"></i> Rekomendasi Utama
                                    </span>
                                </div>
                            </div>
                        `;
                        posHighlightBanner.classList.remove('hidden');
                    }

                    // Update Route Summary Bar
                    summaryOrigin.textContent = "Pematangsiantar";
                    summaryDest.textContent = destSearchInput.value.split(',')[0] || destSearchInput.value;
                    const weightVal = parseFloat(weight);
                    summaryWeight.textContent = `${weightVal.toLocaleString('id-ID')} Gram (${(weightVal/1000).toFixed(2)} Kg)`;
                    resultsCount.textContent = `${regularItems.length} opsi reguler ditemukan`;
                    routeSummaryBar.classList.remove('hidden');
                    resultsFilterControls.classList.remove('hidden');

                    // Reset Filter Tabs
                    tabAll.classList.add('active');
                    tabPosOnly.classList.remove('active');
                    activeFilter = 'all';

                    // Render Table
                    renderResultsTable(regularItems);
                    tableContainer.classList.remove('hidden');

                    // Scroll into view gently
                    tableContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

                } catch (err) {
                    loadingState.classList.add('hidden');
                    document.getElementById('errorTitle').textContent = 'Koneksi Bermasalah';
                    document.getElementById('errorMessage').textContent = err.message || 'Terjadi kesalahan saat memproses permintaan ongkir.';
                    errorState.classList.remove('hidden');
                } finally {
                    btnCalculate.disabled = false;
                    btnCalculate.classList.remove('opacity-75', 'cursor-not-allowed');
                    btnIcon.className = 'fa-solid fa-calculator text-[#F7941D]';
                    btnText.textContent = 'Hitung Ongkos Kirim';
                }
            });
        });
    </script>
</x-app-layout>
