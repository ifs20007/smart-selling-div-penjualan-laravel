<?php

namespace Database\Seeders;

use App\Models\Kompetitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitorMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds to migrate competitor categories & branches from smart-selling.
     */
    public function run(): void
    {
        // 1. Data 13 Kategori Kompetitor dari smart-selling
        $kategoriData = [
            [
                'kategori_kompetitor_id' => 1,
                'nama_kategori' => 'POS Indonesia',
                'inisial' => 'POS',
                'keterangan' => 'Badan Usaha Milik Negara',
                'kode_warna' => '#F7941D',
            ],
            [
                'kategori_kompetitor_id' => 2,
                'nama_kategori' => 'JNE',
                'inisial' => 'JNE',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#003366',
            ],
            [
                'kategori_kompetitor_id' => 3,
                'nama_kategori' => 'J&T',
                'inisial' => 'J&T',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#E3000F',
            ],
            [
                'kategori_kompetitor_id' => 4,
                'nama_kategori' => 'SiCepat Express',
                'inisial' => 'SiC',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#DF1921',
            ],
            [
                'kategori_kompetitor_id' => 5,
                'nama_kategori' => 'AnterAja',
                'inisial' => 'ANT',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#E84393',
            ],
            [
                'kategori_kompetitor_id' => 6,
                'nama_kategori' => 'ID Express',
                'inisial' => 'IDX',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#EA2027',
            ],
            [
                'kategori_kompetitor_id' => 7,
                'nama_kategori' => 'Shopee Express (SPX)',
                'inisial' => 'SPX',
                'keterangan' => 'Ekspedisi E-Commerce',
                'kode_warna' => '#EE4D2D',
            ],
            [
                'kategori_kompetitor_id' => 8,
                'nama_kategori' => 'TIKI (Titipan Kilat)',
                'inisial' => 'TIKI',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#0097E6',
            ],
            [
                'kategori_kompetitor_id' => 9,
                'nama_kategori' => 'SAP Express (SAPX)',
                'inisial' => 'SAPX',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#F39C12',
            ],
            [
                'kategori_kompetitor_id' => 10,
                'nama_kategori' => 'Lion Parcel',
                'inisial' => 'LION',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#D63031',
            ],
            [
                'kategori_kompetitor_id' => 11,
                'nama_kategori' => 'Ninja Xpress',
                'inisial' => 'NJX',
                'keterangan' => 'Ekspedisi Reguler',
                'kode_warna' => '#C23616',
            ],
            [
                'kategori_kompetitor_id' => 12,
                'nama_kategori' => 'Indah Logistik Cargo',
                'inisial' => 'ILC',
                'keterangan' => 'Layanan Kargo',
                'kode_warna' => '#273C75',
            ],
            [
                'kategori_kompetitor_id' => 13,
                'nama_kategori' => 'Baraka Cargo',
                'inisial' => 'BRK',
                'keterangan' => 'Layanan Kargo',
                'kode_warna' => '#192A56',
            ],
        ];

        // Cek jika database possmart_selling ada di MySQL untuk membaca data asli secara langsung
        try {
            $fromDb = DB::select('SELECT * FROM possmart_selling.kategori_kompetitor ORDER BY id_kategori_kompetitor ASC');
            if (! empty($fromDb)) {
                $kategoriData = [];
                foreach ($fromDb as $kat) {
                    $kategoriData[] = [
                        'kategori_kompetitor_id' => $kat->id_kategori_kompetitor,
                        'nama_kategori' => $kat->nama_kompetitor,
                        'inisial' => $kat->inisial,
                        'keterangan' => $kat->keterangan,
                        'kode_warna' => $kat->kode_warna,
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Gunakan $kategoriData fallback
        }

        // Simpan / update ke kategori_kompetitor
        foreach ($kategoriData as $kat) {
            DB::table('kategori_kompetitor')->updateOrInsert(
                ['kategori_kompetitor_id' => $kat['kategori_kompetitor_id']],
                [
                    'nama_kategori' => $kat['nama_kategori'],
                    'inisial' => $kat['inisial'],
                    'keterangan' => $kat['keterangan'],
                    'kode_warna' => $kat['kode_warna'],
                ]
            );
        }

        // 2. Data 47 Cabang / Agen Resmi Kompetitor di Pematangsiantar
        $branches = [];
        try {
            $fromBranches = DB::select('SELECT * FROM possmart_selling.daftar_kompetitor ORDER BY id_kompetitor ASC');
            if (! empty($fromBranches)) {
                foreach ($fromBranches as $b) {
                    $branches[] = [
                        'kompetitor_id' => $b->id_kompetitor,
                        'kategori_kompetitor_id' => $b->id_kategori_kompetitor,
                        'users_id' => 1,
                        'nama_kompetitor' => $b->nama_kompetitor,
                        'alamat' => $b->alamat,
                        'latitude' => $b->latitude,
                        'longitude' => $b->longitude,
                        'url' => $b->url,
                        'created_at' => $b->created_at ?? now(),
                        'updated_at' => $b->created_at ?? now(),
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Error connecting to possmart_selling
        }

        if (empty($branches)) {
            // Fallback dataset jika database possmart_selling tidak terbaca
            $branches = [
                ['kompetitor_id' => 47, 'kategori_kompetitor_id' => 1, 'nama_kompetitor' => 'Kantor Pos Cabang Pematangsiantar', 'alamat' => 'Jl. Sutomo No.2, Proklamasi, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21154, Indonesia', 'latitude' => 2.9549696170641, 'longitude' => 99.061702443502, 'url' => 'https://maps.google.com/?q=2.95496961706408,99.061702443502'],
                ['kompetitor_id' => 48, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'PT JNE Express Cabang Pematangsiantar', 'alamat' => 'Jl. Merdeka No.320, Pahlawan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21136, Indonesia', 'latitude' => 2.96152542979, 'longitude' => 99.072508513492, 'url' => 'https://maps.google.com/?q=2.96152542979004,99.07250851349175'],
                ['kompetitor_id' => 49, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Kartini Pematansiantar', 'alamat' => 'Jl. Kartini No.2, Proklamasi, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21112, Indonesia', 'latitude' => 2.9591121387094, 'longitude' => 99.062441479667, 'url' => 'https://maps.google.com/?q=2.959112138709365,99.06244147966666'],
                ['kompetitor_id' => 50, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Express Jl Vihara', 'alamat' => 'Jl. Vihara No.52, Simalungun, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21145, Indonesia', 'latitude' => 2.9567206154915, 'longitude' => 99.068960289203, 'url' => 'https://maps.google.com/?q=2.956720615491529,99.06896028920276'],
                ['kompetitor_id' => 51, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Melanthon Pematansiantar', 'alamat' => 'Siregar, Jl. Melanthon Siregar No.1, Karo, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21122, Indonesia', 'latitude' => 2.9495857573112, 'longitude' => 99.067383782803, 'url' => 'https://maps.google.com/?q=2.949585757311158,99.06738378280332'],
                ['kompetitor_id' => 52, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Pane Pematangsiantar', 'alamat' => 'Jl. Pane No.26, Kebun Sayur, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21131, Indonesia', 'latitude' => 2.9529061803737, 'longitude' => 99.073400588891, 'url' => 'https://maps.google.com/?q=2.952906180373729,99.07340058889146'],
                ['kompetitor_id' => 53, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Medan Pematangsiantar', 'alamat' => 'Jl. Medan No.45, Sumber Jaya, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21143, Indonesia', 'latitude' => 2.9774619379658, 'longitude' => 99.079218209867, 'url' => 'https://maps.google.com/?q=2.9774619379658237,99.07921820986745'],
                ['kompetitor_id' => 54, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Asahan Pematangsiantar', 'alamat' => 'Jl. Asahan No.KM.4, Dolok Marlawan, Kec. Siantar, Kabupaten Simalungun, Sumatera Utara 21151, Indonesia', 'latitude' => 2.9669649774136, 'longitude' => 99.100984186591, 'url' => 'https://maps.google.com/?q=2.9669649774135503,99.10098418659074'],
                ['kompetitor_id' => 55, 'kategori_kompetitor_id' => 2, 'nama_kompetitor' => 'JNE Sub Agen Parluasan Pematangsiantar', 'alamat' => 'Jl. Patuan Anggi No.86, Sukadame, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21143, Indonesia', 'latitude' => 2.9669278994793, 'longitude' => 99.068270529532, 'url' => 'https://maps.google.com/?q=2.9669278994792625,99.06827052953188'],
                ['kompetitor_id' => 56, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Express Drop Point Pematangsiantar Kota', 'alamat' => 'Jl. Merdeka No.308, Pahlawan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21132, Indonesia', 'latitude' => 2.961019672619, 'longitude' => 99.071689369947, 'url' => 'https://maps.google.com/?q=2.961019672619028,99.0716893699471'],
                ['kompetitor_id' => 57, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Express Drop Point Kartini', 'alamat' => 'Jl. Kartini No.28, Proklamasi, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21111, Indonesia', 'latitude' => 2.9592476579603, 'longitude' => 99.061730044549, 'url' => 'https://maps.google.com/?q=2.9592476579602933,99.06173004454877'],
                ['kompetitor_id' => 58, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Express Drop Point Siantar Marihat', 'alamat' => 'Jl. DI Panjaitan No.18, Naga Huta Tim., Kec. Siantar Marimbun, Kota Pematang Siantar, Sumatera Utara 21127, Indonesia', 'latitude' => 2.9372132630591, 'longitude' => 99.06456006495, 'url' => 'https://maps.google.com/?q=2.9372132630590823,99.06456006494951'],
                ['kompetitor_id' => 59, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Express Drop Point Siantar Utara', 'alamat' => 'Jl. Patuan Anggi No.110, Sukadame, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21143, Indonesia', 'latitude' => 2.9675685827663, 'longitude' => 99.069123847936, 'url' => 'https://maps.google.com/?q=2.967568582766299,99.06912384793574'],
                ['kompetitor_id' => 60, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Cargo Pematangsiantar', 'alamat' => 'Jl. Medan KM 4,5 No.21, Sumber Jaya, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21137, Indonesia', 'latitude' => 2.9868770258169, 'longitude' => 99.081541819717, 'url' => 'https://maps.google.com/?q=2.986877025816942,99.08154181971714'],
                ['kompetitor_id' => 61, 'kategori_kompetitor_id' => 3, 'nama_kompetitor' => 'J&T Express Drop Point Tanah Jawa Siantar', 'alamat' => 'Jl. Gereja No.55, Kristen, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21121, Indonesia', 'latitude' => 2.946571597818, 'longitude' => 99.060133917983, 'url' => 'https://maps.google.com/?q=2.9465715978179925,99.06013391798319'],
                ['kompetitor_id' => 62, 'kategori_kompetitor_id' => 4, 'nama_kompetitor' => 'SiCepat Ekspres Pematangsiantar Hub', 'alamat' => 'Jl. Sangnawaluh No.12, Siopat Suhu, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21136, Indonesia', 'latitude' => 2.9622941031388, 'longitude' => 99.08103328225, 'url' => 'https://maps.google.com/?q=2.9622941031388487,99.08103328224976'],
                ['kompetitor_id' => 63, 'kategori_kompetitor_id' => 1, 'nama_kompetitor' => 'Kantor Pos KCP Simarito', 'alamat' => 'Jl. Gereja No.31A, Simarito, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21128, Indonesia', 'latitude' => 2.9496468787728, 'longitude' => 99.060879559869, 'url' => 'https://maps.google.com/?q=2.9496468787727976,99.0608795598694'],
                ['kompetitor_id' => 64, 'kategori_kompetitor_id' => 4, 'nama_kompetitor' => 'SiCepat Point Pematangsiantar Pusat', 'alamat' => 'Jl. Cipto No.88, Simalungun, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21145, Indonesia', 'latitude' => 2.9554316008681, 'longitude' => 99.065275817246, 'url' => 'https://maps.google.com/?q=2.9554316008680795,99.06527581724578'],
                ['kompetitor_id' => 65, 'kategori_kompetitor_id' => 5, 'nama_kompetitor' => 'AnterAja Staging Store Siantar Barat', 'alamat' => 'Jl. Sudirman No.42, Teladan, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21114, Indonesia', 'latitude' => 2.9531818293902, 'longitude' => 99.060934989647, 'url' => 'https://maps.google.com/?q=2.9531818293901777,99.06093498964654'],
                ['kompetitor_id' => 66, 'kategori_kompetitor_id' => 5, 'nama_kompetitor' => 'AnterAja Drop Point Siantar Martoba', 'alamat' => 'Jl. Rakutta Sembiring No.108, Naga Pita, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21143, Indonesia', 'latitude' => 2.9782522718105, 'longitude' => 99.072522295669, 'url' => 'https://maps.google.com/?q=2.9782522718104597,99.07252229566914'],
                ['kompetitor_id' => 67, 'kategori_kompetitor_id' => 6, 'nama_kompetitor' => 'ID Express Flagship Pematangsiantar', 'alamat' => 'Jl. Ahmad Yani No.78, Merdeka, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21132, Indonesia', 'latitude' => 2.9647690184405, 'longitude' => 99.074558509893, 'url' => 'https://maps.google.com/?q=2.9647690184404787,99.07455850989297'],
                ['kompetitor_id' => 68, 'kategori_kompetitor_id' => 7, 'nama_kompetitor' => 'Shopee Express Hub Siantar', 'alamat' => 'Jl. Medan KM 4.5, Sumber Jaya, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9895456293267, 'longitude' => 99.081774254724, 'url' => 'https://maps.google.com/?q=2.9895456293267,99.081774254724'],
                ['kompetitor_id' => 69, 'kategori_kompetitor_id' => 7, 'nama_kompetitor' => 'Shopee Express Siantar Selatan Hub', 'alamat' => 'Jl. Parsoburan, Kristen, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21118', 'latitude' => 2.9439475327931, 'longitude' => 99.063069851221, 'url' => 'https://maps.google.com/?q=2.9439475327931,99.063069851221'],
                ['kompetitor_id' => 70, 'kategori_kompetitor_id' => 7, 'nama_kompetitor' => 'Shopee Express Siantar Sitalasari Hub', 'alamat' => 'Jl. Viyata Yudha No.18, Setia Negara, Kec. Siantar Sitalasari, Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9510576224645, 'longitude' => 99.043310624879, 'url' => 'https://maps.google.com/?q=2.9510576224645,99.043310624879'],
                ['kompetitor_id' => 71, 'kategori_kompetitor_id' => 8, 'nama_kompetitor' => 'TIKI Agen Jl Merdeka', 'alamat' => 'Jl. Merdeka No.24/30, Proklamasi, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21117', 'latitude' => 2.9574231877325, 'longitude' => 99.063328960027, 'url' => 'https://maps.google.com/?q=2.9574231877325,99.063328960027'],
                ['kompetitor_id' => 72, 'kategori_kompetitor_id' => 9, 'nama_kompetitor' => 'SAP Express Pematangsiantar', 'alamat' => 'Jl. Pdt J Wismar Saragih, Kel. Tanjung Pinggir, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21143', 'latitude' => 2.9858407499725, 'longitude' => 99.065223953373, 'url' => 'https://maps.google.com/?q=2.9858407499725,99.065223953373'],
                ['kompetitor_id' => 73, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Komplek SBC', 'alamat' => 'Kompleks SBC, Jl. Sutomo No.24, Pahlawan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21143', 'latitude' => 2.9598193620258, 'longitude' => 99.072542980725, 'url' => 'https://maps.google.com/?q=2.9598193620258,99.072542980725'],
                ['kompetitor_id' => 74, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Pajak Horas', 'alamat' => 'PASAR HORAS Gedung 1, Jl. Sutomo No.112 lantai 2, Dwikora, Siantar Barat, Pematang Siantar City, North Sumatra 21118', 'latitude' => 2.9579369044117, 'longitude' => 99.067328866935, 'url' => 'https://maps.google.com/?q=2.9579369044117,99.067328866935'],
                ['kompetitor_id' => 75, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Jl Medan Pematangsiantar', 'alamat' => 'Jl. Medan KM 3,5 No.95, RW.001, Sumber Jaya, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9772911162486, 'longitude' => 99.079488413317, 'url' => 'https://maps.google.com/?q=2.9772911162486,99.079488413317'],
                ['kompetitor_id' => 76, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Simpang Kerang ', 'alamat' => 'Jl. Ke Medan No.km 4, RW.5, simpang kerang, Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9851078479908, 'longitude' => 99.081165690857, 'url' => 'https://maps.google.com/?q=2.9851078479908,99.081165690857'],
                ['kompetitor_id' => 77, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Ahmad Yani', 'alamat' => 'Jl. Ahmad Yani No.168, Merdeka, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21132', 'latitude' => 2.966759739307, 'longitude' => 99.076010153373, 'url' => 'https://maps.google.com/?q=2.966759739307,99.076010153373'],
                ['kompetitor_id' => 78, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Ragi Hotang', 'alamat' => 'Jl. Ragi Hotang No.2, Bane, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21144', 'latitude' => 2.9688943179134, 'longitude' => 99.060034717791, 'url' => 'https://maps.google.com/?q=2.9688943179134,99.060034717791'],
                ['kompetitor_id' => 79, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Jl Kartini', 'alamat' => 'Jl. Kartini No.26, Timbang Galung, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 20000', 'latitude' => 2.9566642883141, 'longitude' => 99.055302598535, 'url' => 'https://maps.google.com/?q=2.9566642883141,99.055302598535'],
                ['kompetitor_id' => 80, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Jl Tarutung', 'alamat' => 'Jl. Tarutung No.25a, Kristen, Kec. Siantar Sel., Kota Pematang Siantar, Sumatera Utara 21118', 'latitude' => 2.9471988686214, 'longitude' => 99.064372215719, 'url' => 'https://maps.google.com/?q=2.9471988686214,99.064372215719'],
                ['kompetitor_id' => 81, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Farell Pasaribu', 'alamat' => 'Jl. Farel Pasaribu No.8, Parhorasan Nauli, Kec. Siantar Marihat, Kota Pematang Siantar, Sumatera Utara 21128', 'latitude' => 2.9448781126728, 'longitude' => 99.070206324537, 'url' => 'https://maps.google.com/?q=2.9448781126728,99.070206324537'],
                ['kompetitor_id' => 82, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Narumonda', 'alamat' => 'Jl. Narumonda Bawah No.55b, Tomuan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21135', 'latitude' => 2.9506874820206, 'longitude' => 99.071473935582, 'url' => 'https://maps.google.com/?q=2.9506874820206,99.071473935582'],
                ['kompetitor_id' => 83, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Parluasan', 'alamat' => 'Jl. Patuan Anggi No.159, Baru, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21145', 'latitude' => 2.9672969109832, 'longitude' => 99.068851235582, 'url' => 'https://maps.google.com/?q=2.9672969109832,99.068851235582'],
                ['kompetitor_id' => 84, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Sisingamangaraja', 'alamat' => 'Jl. Sisingamangaraja, Bane, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21139', 'latitude' => 2.9700402820894, 'longitude' => 99.053287353373, 'url' => 'https://maps.google.com/?q=2.9700402820894,99.053287353373'],
                ['kompetitor_id' => 85, 'kategori_kompetitor_id' => 10, 'nama_kompetitor' => 'Lion Parcel Nagapita', 'alamat' => 'Jl. Rakutta Sembiring Jl. Tangki Lrg. 20, Naga Pita., Kec. Siantar Martoba, Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9779930094615, 'longitude' => 99.069323031778, 'url' => 'https://maps.google.com/?q=2.9779930094615,99.069323031778'],
                ['kompetitor_id' => 86, 'kategori_kompetitor_id' => 11, 'nama_kompetitor' => 'Ninja Xpress Pematang Siantar (PMS)', 'alamat' => 'X22P+X2H, Jl. Desa Indah Dalam, Setia Negara, Kec. Siantar Sitalasari, Kota Pematang Siantar, Sumatera Utara 21139, Indonesia', 'latitude' => 2.9705126, 'longitude' => 99.0663155, 'url' => 'https://maps.google.com/?q=2.9705126,99.0663155'],
                ['kompetitor_id' => 87, 'kategori_kompetitor_id' => 11, 'nama_kompetitor' => 'Ninja Xpress Pematang Siantar Hub DTB', 'alamat' => 'X22M+WW3, Jl. Desa Indah Dalam, Setia Negara, Kec. Siantar Sitalasari, Kota Pematang Siantar, Sumatera Utara 21139, Indonesia', 'latitude' => 2.978761, 'longitude' => 99.0631313, 'url' => 'https://maps.google.com/?q=2.978761,99.0631313'],
                ['kompetitor_id' => 88, 'kategori_kompetitor_id' => 12, 'nama_kompetitor' => 'Indah Logistik Cargo Jl Ahmad Yani', 'alamat' => 'Jl. Ahmad Yani No.336, Asuhan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21137', 'latitude' => 2.9717273170737, 'longitude' => 99.077878530167, 'url' => 'https://maps.google.com/?q=2.9717273170737,99.077878530167'],
                ['kompetitor_id' => 89, 'kategori_kompetitor_id' => 12, 'nama_kompetitor' => 'Indah Logistik Cargo Siantar Utara', 'alamat' => 'Jl. Mufakat No.88, Suka Dame, Kec. Siantar Utara, Kota Pematang Siantar, Sumatera Utara 21143', 'latitude' => 2.9687883139087, 'longitude' => 99.066772240743, 'url' => 'https://maps.google.com/?q=2.9687883139087,99.066772240743'],
                ['kompetitor_id' => 90, 'kategori_kompetitor_id' => 12, 'nama_kompetitor' => 'Loren Stationery Indah Cargo', 'alamat' => 'Jl. Kiyai 1, Bantan, Kec. Siantar Bar., Kota Pematang Siantar, Sumatera Utara 21111', 'latitude' => 2.9574860576835, 'longitude' => 99.054493688914, 'url' => 'https://maps.google.com/?q=2.9574860576835,99.054493688914'],
                ['kompetitor_id' => 91, 'kategori_kompetitor_id' => 12, 'nama_kompetitor' => 'Agen Indah Cargo Tomuan', 'alamat' => 'Jl. Narumonda Bawah, Tomuan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21135', 'latitude' => 2.9530778072448, 'longitude' => 99.07331611041, 'url' => 'https://maps.google.com/?q=2.9530778072448,99.07331611041'],
                ['kompetitor_id' => 92, 'kategori_kompetitor_id' => 12, 'nama_kompetitor' => 'Indah Cargo Siantar Sitalasari', 'alamat' => 'Jl. Sisingamangaraja No.182, Bukit Sofa, Kec. Siantar Sitalasari, Kota Pematang Siantar, Sumatera Utara 21139', 'latitude' => 2.958934210255, 'longitude' => 99.045774611426, 'url' => 'https://maps.google.com/?q=2.958934210255,99.045774611426'],
                ['kompetitor_id' => 93, 'kategori_kompetitor_id' => 13, 'nama_kompetitor' => 'Baraka Express Pematangsiantar', 'alamat' => 'Jl. Ahmad Yani, Asuhan, Kec. Siantar Tim., Kota Pematang Siantar, Sumatera Utara 21143', 'latitude' => 2.9690550957616, 'longitude' => 99.076653564661, 'url' => 'https://maps.google.com/?q=2.9690550957616,99.076653564661'],
                ['kompetitor_id' => 95, 'kategori_kompetitor_id' => 1, 'nama_kompetitor' => 'Kantor Pos Cabang Pematangsiantar Nomensen', 'alamat' => 'Jl Sangnawaluh No. 87, Siopat Suhu, Kec Siantar Timur', 'latitude' => 2.964, 'longitude' => 99.0859, 'url' => 'https://www.instagram.com/stories/mrgiemrnd/'],
            ];
        }

        // Hapus data lama cabang untuk menghindari duplikasi id
        DB::table('kompetitor')->delete();

        foreach ($branches as $branch) {
            DB::table('kompetitor')->insert([
                'kompetitor_id' => $branch['kompetitor_id'],
                'kategori_kompetitor_id' => $branch['kategori_kompetitor_id'],
                'users_id' => $branch['users_id'] ?? 1,
                'nama_kompetitor' => $branch['nama_kompetitor'],
                'alamat' => $branch['alamat'],
                'latitude' => $branch['latitude'],
                'longitude' => $branch['longitude'],
                'url' => $branch['url'],
                'created_at' => $branch['created_at'] ?? now(),
                'updated_at' => $branch['updated_at'] ?? now(),
            ]);
        }
    }
}
