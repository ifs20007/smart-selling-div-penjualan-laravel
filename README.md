# 📦 Smart Selling POSIND (posind-app)

Sistem Informasi Pendukung Keputusan dan Manajemen Operasional Penjualan **PT Pos Indonesia**. Aplikasi ini dirancang khusus untuk memfasilitasi divisi penjualan dalam menganalisis peta persaingan logistik, mengelola hubungan kemitraan dengan UMKM/merchant (CRM), membandingkan tarif ongkos kirim secara transparan, serta mengotomatisasi kampanye promosi terarah.

---

## 📌 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Peran Pengguna & Matriks Hak Akses](#-peran-pengguna--matriks-hak-akses)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Direktori Proyek](#-struktur-direktori-proyek)
- [Panduan Instalasi & Menjalankan](#-panduan-instalasi--menjalankan)
- [Konfigurasi Lingkungan (.env)](#-konfigurasi-lingkungan-env)
- [Integrasi Layanan Pihak Ketiga](#-integrasi-layanan-pihak-ketiga)
- [Pengujian & Kualitas Kode](#-pengujian--kualitas-kode)
- [Keamanan & Privasi](#-keamanan--privasi)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Proyek

**Smart Selling POSIND** adalah platform berbasis web modern yang mentransformasi proses penjualan dan pemantauan pasar logistik. Aplikasi ini mengintegrasikan pemetaan geografis (GIS), basis data tarif ekspedisi multi-kurir, manajemen prospek pelanggan, serta integrasi gateway pesan instan untuk memberikan keunggulan kompetitif bagi tenaga pemasar di lapangan.

### Sasaran Utama
1. **Transparansi Pasar**: Memetakan sebaran titik agen/kantor cabang kompetitor secara visual berbasis peta interaktif.
2. **Kalkulasi & Komparasi Cepat**: Memberikan perbandingan ongkos kirim real-time antara layanan Pos Indonesia dengan berbagai kurir kompetitor per wilayah tujuan.
3. **Efisiensi CRM**: Mempermudah inventarisasi calon mitra (merchant/toko online) dengan pipeline status kemitraan serta kemudahan ekspor/impor data Excel.
4. **Otomatisasi Promosi**: Mendukung penjangkauan calon mitra dalam jumlah besar (bulk broadcast) melalui saluran WhatsApp.
5. **Kolaborasi Tim**: Menyediakan forum internal bagi para pegawai untuk bertukar strategi penjualan dan informasi lapangan.

---

## 🚀 Fitur Utama

### 1. 🗺️ Analisis Pasar & Pemetaan Interaktif (GIS)
- **Peta Digital Terintegrasi**: Visualisasi sebaran kantor pos dan cabang ekspedisi kompetitor (JNE, J&T, SiCepat, AnterAja, ID Express, SPX, TIKI, Lion Parcel, Ninja Xpress, Indah Cargo, Baraka, dll.) menggunakan **Leaflet.js** dan OpenStreetMap.
- **Identitas Warna & Logo**: Setiap kompetitor dilengkapi dengan inisial penanda, kode warna khas, serta logo resmi untuk identifikasi visual instan di peta.
- **Informasi Titik Lokasi**: Menampilkan nama cabang, alamat lengkap, koordinat latitude & longitude, serta tautan langsung navigasi ke Google Maps.
- **Manajemen Kategori & Titik Cabang**: CRUD master kategori kompetitor dan penambahan titik cabang baru oleh petugas lapangan.

### 2. ⚖️ Komparasi Cek Ongkos Kirim
- **Kalkulasi Otomatis**: Perhitungan tarif pengiriman berbasis provinsi tujuan, wilayah spesifik, dan berat paket (kg).
- **Rekomendasi Hemat**: Penandaan visual khusus (*badge crown/hemat*) jika tarif Pos Indonesia lebih ekonomis dibandingkan kompetitor pada rute terkait.
- **Master Data Tarif**: Pengelolaan tarif per kg dan estimasi waktu kirim per wilayah dengan dukungan ekspor data ke format spreadsheet (.xlsx).

### 3. 👥 CRM & Data Prospek Mitra Toko
- **Database Merchant & UMKM**: Pencatatan toko/pelanggan potensial lengkap dengan kategori bisnis, nama pemilik, alamat, nomor WhatsApp, serta titik koordinat lokasi.
- **Siklus Kemitraan**: Klasifikasi status pelanggan (*Prospek*, *Pelanggan Aktif*, *Mantan Pelanggan*).
- **Impor & Ekspor Excel**: Dukungan impor massal data toko langsung dari dokumen Excel (.xlsx) dan ekspor laporan daftar mitra.
- **Hak Kepemilikan Data**: Pegawai dapat fokus mengelola mitra binaannya sendiri, sementara Administrator memiliki wawasan penuh atas seluruh data.

### 4. 📢 Modul Promosi & WhatsApp Broadcast
- **Broadcast Terarah**: Pengiriman pesan penawaran atau promosi ke nomor WhatsApp mitra berdasarkan segmentasi kategori toko.
- **WhatsApp Gateway**: Terkoneksi dengan layanan gateway WhatsApp (**Fonnte**) untuk pengiriman pesan massal berjadwal.
- **Riwayat Broadcast**: Pencatatan riwayat pengiriman pesan promosi beserta jumlah pesan yang berhasil terkirim.
- **Webhook Listener**: Menerima laporan status penerimaan pesan dari gateway secara otomatis.

### 5. 💬 Forum Aktivitas Internal
- **Pusat Diskusi Pegawai**: Ruang interaksi dan pertukaran informasi seputar aktivitas lapangan, peluang tender, dan kiat promosi.
- **Komentar Berulir**: Diskusi interaktif pada setiap topik promosi atau strategi penjualan.
- **Moderasi Topik**: Fitur penguncian (*lock topic*) untuk diskusi yang telah selesai atau bersifat pengumuman resmi.

### 6. 🌐 Portal Publik (Landing Page)
- **Akses Terbuka**: Halaman depan dapat diakses oleh publik tanpa login untuk melakukan pengecekan tarif ongkos kirim secara cepat.
- **Etalase Promosi**: Menampilkan informasi penawaran layanan Pos Indonesia terkini untuk calon pelanggan umum.

### 7. 🧪 Sandbox Integrasi RajaOngkir
- **Modul Pengujian API**: Lingkungan sandbox untuk pencarian destinasi domestik hingga tingkat kelurahan/kecamatan (*domestic destination*).
- **Kalkulasi Multi-Kurir Real-time**: Pengujian respon API untuk perhitungan tarif ongkos kirim berbagai kurir secara dinamis.

---

## 🔐 Peran Pengguna & Matriks Hak Akses

Sistem menerapkan **Role-Based Access Control (RBAC)** dengan dua tingkatan peran:

| Modul / Fitur | Pengunjung Publik | Pegawai | Administrator |
|---|:---:|:---:|:---:|
| **Landing Page & Cek Ongkir Publik** | ✅ | ✅ | ✅ |
| **Dashboard Operasional** | ❌ | ✅ | ✅ |
| **Peta Interaktif GIS Kompetitor** | ❌ | ✅ (Lihat & Tambah Cabang) | ✅ (Akses Penuh CRUD) |
| **Master Kategori Kompetitor** | ❌ | ❌ (Hanya Baca di Peta) | ✅ (Akses Penuh CRUD) |
| **Cek Komparasi Ongkir** | ❌ | ✅ | ✅ |
| **Master Tarif Ongkir & Ekspor** | ❌ | ❌ | ✅ |
| **Kelola Prospek & Mitra Toko** | ❌ | ✅ (Data Sendiri) | ✅ (Seluruh Data) |
| **Impor & Ekspor Data Mitra (Excel)** | ❌ | ✅ | ✅ |
| **Forum Aktivitas Internal** | ❌ | ✅ | ✅ |
| **Broadcast WhatsApp Promosi** | ❌ | ❌ | ✅ |
| **Manajemen Akun & Reset Sandi Pegawai** | ❌ | ❌ | ✅ |
| **Sandbox RajaOngkir** | ❌ | ✅ | ✅ |

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Framework**: [Laravel 13](https://laravel.com/)
- **Bahasa Pemrograman**: PHP 8.3 / 8.4
- **Autentikasi**: Laravel Breeze
- **Database ORM**: Eloquent ORM
- **Standar Kode**: Laravel Pint (PSR-12 compliant)
- **Unit & Feature Testing**: PHPUnit

### Frontend
- **Templating**: Laravel Blade
- **CSS Framework**: 
  - [Bootstrap 5](https://getbootstrap.com/) (Dashboard CMS Admin)
  - [Tailwind CSS v4](https://tailwindcss.com/) (Halaman Publik & Autentikasi)
- **Interaktivitas UI**: [Alpine.js](https://alpinejs.dev/) & Vanilla JavaScript
- **Peta & GIS**: [Leaflet.js](https://leafletjs.com/) & OpenStreetMap Tiles
- **Ikon**: FontAwesome 6

### Penyimpanan Data
- **Database Utama**: SQLite (Pengembangan Lokal) / Kompatibel dengan MySQL & MariaDB untuk Produksi.

---

## 📁 Struktur Direktori Proyek

Berikut ringkasan struktur direktori utama pada aplikasi ini:

```plaintext
posind-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Logika alur aplikasi (Kompetitor, Toko, Ongkir, Broadcast, dll.)
│   │   └── Requests/             # Validasi request formulir
│   └── Models/                   # Model Eloquent (User, Kompetitor, Toko, TarifOngkir, Forum, dll.)
├── config/                       # Berkas konfigurasi aplikasi dan layanan pihak ketiga
├── database/
│   ├── factories/                # Model factories untuk testing
│   ├── migrations/               # Skema migrasi tabel database
│   └── seeders/                  # Seeder awal (kategori kompetitor, cabang, dan data dasar)
├── public/
│   ├── assets/                   # Aset statis (CSS, JS, logo ekspedisi, gambar ilustrasi)
│   └── index.php                 # Entry point aplikasi
├── resources/
│   ├── css/                      # Sumber berkas stylesheet (Vite / Tailwind)
│   ├── js/                       # Sumber berkas script frontend
│   └── views/                    # Template tampilan Blade
│       ├── auth/                 # Halaman login, register, reset password
│       ├── broadcast/            # Tampilan formulir & riwayat WhatsApp Broadcast
│       ├── cek-ongkir/           # Tampilan komparasi tarif & master ongkir
│       ├── daftar-toko/          # Tampilan CRM data prospek & mitra toko
│       ├── forum/                # Tampilan forum diskusi internal
│       ├── front/                # Tampilan portal publik / beranda
│       ├── kategori-kompetitor/  # Tampilan master kategori kompetitor
│       ├── kategori-toko/        # Tampilan master kategori toko
│       ├── kompetitor/           # Tampilan peta GIS & kelola titik cabang
│       ├── pegawai/              # Tampilan manajemen akun pegawai
│       └── dashboard.blade.php   # Kerangka utama dashboard operasional
├── routes/
│   ├── auth.php                  # Rute autentikasi
│   ├── console.php               # Perintah CLI Artisan kustom
│   └── web.php                   # Rute web utama aplikasi
├── tests/
│   ├── Feature/                  # Pengujian fungsional fitur (Auth, Kompetitor, Sandbox, dll.)
│   └── Unit/                     # Pengujian unit logic
├── .env.example                  # Template variabel lingkungan sistem
├── composer.json                 # Manajemen paket dependensi PHP
├── package.json                  # Manajemen dependensi Node.js / frontend
└── vite.config.js                # Konfigurasi bundler Vite
```

---

## 💻 Panduan Instalasi & Menjalankan

Ikuti langkah-langkah di bawah ini untuk menyiapkan dan menjalankan proyek di lingkungan pengembangan lokal:

### 1. Prasyarat Sistem
Pastikan lingkungan komputer Anda telah terpasang:
- **PHP** versi 8.3 atau 8.4 (disertai ekstensi `pdo_sqlite` / `pdo_mysql`, `mbstring`, `curl`, `zip`, `xml`)
- **Composer** (v2.x)
- **Node.js** (v18.x atau lebih baru) & **NPM**
- Web server lokal (misalnya **Laragon**, **XAMPP**, atau bawaan PHP CLI server)

### 2. Kloning Repositori
```bash
git clone <URL_REPOSITORI_ANDA> posind-app
cd posind-app
```

### 3. Instalasi Dependensi PHP
```bash
composer install
```

### 4. Instalasi Dependensi JavaScript & Frontend
```bash
npm install
```

### 5. Penyiapan Berkas Konfigurasi (.env)
Salin berkas template lingkungan `.env.example` menjadi `.env`:
```bash
# Untuk Linux / macOS / Git Bash:
cp .env.example .env

# Untuk Windows Command Prompt:
copy .env.example .env
```

### 6. Pembuatan Kunci Enkripsi Aplikasi
```bash
php artisan key:generate
```

### 7. Penyiapan Basis Data & Migrasi
Bila menggunakan SQLite (bawaan lokal), pastikan berkas basis data sudah tersedia:
```bash
# Membuat berkas database sqlite kosong jika belum ada
touch database/database.sqlite
```
Jalankan migrasi dan seeder awal:
```bash
php artisan migrate --seed
```

> **Catatan:** Seeder akan memuat data referensi kategori ekspedisi kompetitor, titik koordinat cabang acuan, serta struktur tabel awal.

### 8. Kompilasi Aset Frontend
Jalankan dev server Vite untuk kompilasi hot-reload aset:
```bash
npm run dev
```
*(Atau gunakan `npm run build` untuk menghasilkan bundle produksi statis).*

### 9. Menjalankan Server Aplikasi
Buka jendela terminal baru lalu jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Aplikasi kini dapat diakses melalui peramban web pada alamat:
👉 **`http://127.0.0.1:8000`** (atau URL host lokal sesuai pengaturan virtual host Laragon).

---

## ⚙️ Konfigurasi Lingkungan (.env)

Berikut adalah variabel-variabel konfigurasi penting yang terdapat pada file `.env`. 

> [!IMPORTANT]
> **Kebijakan Keamanan Kunci:** Jangan pernah memasukkan nilai API Key rahasia asli, kredensial produksi, atau password ke dalam dokumentasi maupun repositori publik. Selalu gunakan nilai pengganti (*placeholder*) saat berbagi contoh konfigurasi.

```env
APP_NAME="Smart Selling POSIND"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

# Konfigurasi Basis Data (Contoh menggunakan SQLite)
DB_CONNECTION=sqlite

# Jika beralih ke MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=possmart_selling
# DB_USERNAME=root
# DB_PASSWORD=your_database_password

# Konfigurasi Layanan WhatsApp Gateway (Fonnte)
# Dapatkan token akses dari dashboard akun resmi penyedia
FONNTE_TOKEN=your_fonnte_token_here

# Konfigurasi Layanan RajaOngkir Sandbox (Komerce v1)
RAJAONGKIR_API_KEY=your_rajaongkir_api_key_here
RAJAONGKIR_BASE_URL="https://rajaongkir.komerce.id/api/v1"
```

---

## 🔌 Integrasi Layanan Pihak Ketiga

### 1. Fonnte (WhatsApp Gateway)
- Digunakan pada modul **Broadcast Promosi** (`BroadcastController`).
- Bertugas mengirimkan pesan promosi penawaran secara otomatis ke daftar kontak nomor WhatsApp mitra terdaftar.
- Mengonversi format nomor seluler lokal secara otomatis ke kode negara standar (`+62`).
- Dilengkapi endpoint webhook (`/api/webhook/whatsapp`) untuk menerima callback status pengiriman pesan.

### 2. RajaOngkir API (Komerce)
- Digunakan pada modul **Cek Ongkir Sandbox** (`RajaOngkirTestController`).
- Menyediakan endpoint pencarian kode wilayah domestik secara instan (`/destination/domestic-destination`).
- Menyediakan kalkulasi biaya tarif pengiriman kurir domestik berbasis berat paket dan kota/kabupaten asal-tujuan.

---

## 🧪 Pengujian & Kualitas Kode

Aplikasi ini dilengkapi pengujian otomatis (*automated testing*) menggunakan PHPUnit untuk memastikan integritas logika bisnis dan fungsionalitas modul.

### Menjalankan Pengujian Otomatis
Untuk menjalankan seluruh rangkaian pengujian fitur dan unit:
```bash
php artisan test
```

Untuk menjalankan pengujian spesifik per berkas:
```bash
# Pengujian modul integrasi RajaOngkir
php artisan test --filter=RajaOngkirSandboxTest

# Pengujian migrasi data kompetitor
php artisan test --filter=CompetitorMigrationTest

# Pengujian autentikasi
php artisan test --filter=Auth
```

### Standar Pemformatan Kode (Code Style)
Proyek ini menggunakan **Laravel Pint** untuk menjamin konsistensi gaya kode PHP:
```bash
vendor/bin/pint --format agent
```

---

## 🛡️ Keamanan & Privasi

- **Penyimpanan Kredensial**: File konfigurasi `.env` telah dimasukkan ke dalam `.gitignore` sehingga tidak akan terunggah secara tidak sengaja ke repositori kontrol versi.
- **Proteksi Kata Sandi**: Seluruh kata sandi pengguna dienkripsi secara aman menggunakan algoritma *Bcrypt / Argon2id*.
- **Proteksi Akses Data**: Dilengkapi middleware autentikasi dan pengecekan role di tingkat Controller guna mencegah akses data ilegal antar-pengguna.
- **CSRF Protection**: Seluruh formulir pengiriman data dilindungi token anti-CSRF Laravel bawaan.
- **Sanitasi File Unggahan**: Modul impor Excel memvalidasi format dokumen dan sanitasi baris masukan sebelum diproses ke basis data.

---

## 📄 Lisensi

Pengembangan aplikasi ini ditujukan untuk kebutuhan operasional internal **PT Pos Indonesia** dalam ruang lingkup sistem pendukung penjualan. Hak cipta seluruh aset grafis, merek dagang, dan data internal melekat pada entitas pemilik hak masing-masing.

Dokumentasi dan kerangka aplikasi dilisensikan di bawah ketentuan [MIT License](https://opensource.org/licenses/MIT).
