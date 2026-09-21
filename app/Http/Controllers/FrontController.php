<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Provinsi (menggunakan query builder Laravel)
        $provinsi = DB::table('provinsi')->orderBy('nama_provinsi', 'ASC')->get();
        
        // 2. Data Promosi (Jika belum ada tabelnya, kita kosongkan dulu)
        $promos = collect(); 

        // 3. Logika Pencarian Ongkir
        $data_ongkir = collect();
        $nama_tujuan = "";
        $berat = max((int) $request->input('berat', 1), 1);
        $is_pos_cheapest = false;

        if ($request->has('id_wilayah')) {
            $id_wilayah = $request->input('id_wilayah');
            
            // Query Join tabel tarif_ongkir, kategori_kompetitor, dan wilayah
            $data_ongkir = DB::table('tarif_ongkir')
                ->join('kategori_kompetitor', 'tarif_ongkir.kategori_kompetitor_id', '=', 'kategori_kompetitor.kategori_kompetitor_id')
                ->join('wilayah', 'tarif_ongkir.wilayah_id', '=', 'wilayah.wilayah_id')
                ->where('tarif_ongkir.wilayah_id', $id_wilayah)
                ->select(
                    'tarif_ongkir.*', 
                    'kategori_kompetitor.nama_kategori as ekspedisi',
                    'wilayah.nama_wilayah'
                )
                ->get()
                ->map(function ($item) use ($berat) {
                    $item->total_harga = $item->harga_per_kg * $berat;
                    return $item;
                });

            if ($data_ongkir->isNotEmpty()) {
                $nama_tujuan = $data_ongkir->first()->nama_wilayah;
                $min_price = $data_ongkir->min('total_harga');
                
                // Asumsi POS Indonesia memiliki ID = 1 di tabel kategori_kompetitor
                $pos_ongkir = $data_ongkir->firstWhere('kategori_kompetitor_id', 1);
                if ($pos_ongkir && $pos_ongkir->total_harga <= $min_price) {
                    $is_pos_cheapest = true;
                }
            }
        }

        return view('front.index', compact(
            'provinsi', 'promos', 'data_ongkir', 
            'berat', 'nama_tujuan', 'is_pos_cheapest'
        ));
    }
    // ... kode fungsi index() di atasnya ...

    // TAMBAHKAN FUNGSI INI
    public function getWilayah($provinsi_id) {
        // Ambil data wilayah berdasarkan ID Provinsi
        $wilayah = DB::table('wilayah')
            ->where('provinsi_id', $provinsi_id)
            ->orderBy('nama_wilayah', 'ASC')
            ->get();

        // Format output menjadi HTML Option karena AJAX script Anda mengharapkan format HTML
        $html = '<option value="">-- Pilih Kota/Kabupaten Tujuan --</option>';
        foreach ($wilayah as $w) {
            $html .= '<option value="' . $w->wilayah_id . '">' . $w->nama_wilayah . '</option>';
        }

        return $html;
    } // <--- Ini kurung kurawal penutup class FrontController
}