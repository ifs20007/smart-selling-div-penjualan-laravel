<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TarifOngkir;
use App\Models\Provinsi;
use App\Models\Wilayah;
use App\Models\KategoriKompetitor;
use Illuminate\Support\Facades\Auth;

class OngkirController extends Controller
{
    public function komparasi()
    {
        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        return view('cek-ongkir.komparasi', compact('provinsi'));
    }

    public function hitungKomparasi(Request $request)
    {
        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $wilayah_id = $request->input('wilayah_id');
        $berat_paket = $request->input('berat_paket', 1);

        $wilayah = Wilayah::with('provinsi')->find($wilayah_id);
        
        $tarif = TarifOngkir::with('kompetitor')
            ->where('wilayah_id', $wilayah_id)
            ->get()
            ->map(function ($item) use ($berat_paket) {
                $berat_hitung = ceil($berat_paket);
                $item->total_biaya = $item->harga_per_kg * $berat_hitung;
                $item->is_pos = (stripos($item->kompetitor->nama_kategori ?? '', 'POS') !== false) ? 0 : 1;
                return $item;
            })
            ->sortBy([
                ['is_pos', 'asc'],
                ['total_biaya', 'asc'],
            ])
            ->values();

        return view('cek-ongkir.komparasi', compact('provinsi', 'tarif', 'wilayah', 'berat_paket', 'wilayah_id'));
    }

    public function index(Request $request)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $filter_provinsi = $request->get('provinsi');
        $limit = $request->get('limit', 20);

        $query = TarifOngkir::with(['wilayah.provinsi', 'kompetitor']);

        if ($filter_provinsi) {
            $query->whereHas('wilayah', function($q) use ($filter_provinsi) {
                $q->where('provinsi_id', $filter_provinsi);
            });
        }
        
        // Paginate logic
        $tarif_ongkir = $query->paginate($limit);
        
        // Find minimum price logic per wilayah for the crown icon
        $min_prices = TarifOngkir::selectRaw('wilayah_id, MIN(harga_per_kg) as min_harga')
            ->groupBy('wilayah_id')
            ->pluck('min_harga', 'wilayah_id');

        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        
        return view('cek-ongkir.index', compact('tarif_ongkir', 'provinsi', 'filter_provinsi', 'limit', 'min_prices'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $kompetitor = KategoriKompetitor::orderBy('nama_kategori', 'asc')->get();

        return view('cek-ongkir.create', compact('provinsi', 'kompetitor'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $request->validate([
            'wilayah_id' => 'required',
            'kategori_kompetitor_id' => 'required',
            'jenis_layanan' => 'required',
            'harga_per_kg' => 'nullable|numeric',
            'estimasi_waktu' => 'nullable|string'
        ]);

        TarifOngkir::create($request->all());

        return redirect()->route('data-ongkir.index')->with('success', 'Tarif Ongkir berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $ongkir = TarifOngkir::findOrFail($id);
        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $wilayah = Wilayah::where('provinsi_id', $ongkir->wilayah->provinsi_id)->orderBy('nama_wilayah', 'asc')->get();
        $kompetitor = KategoriKompetitor::orderBy('nama_kategori', 'asc')->get();

        return view('cek-ongkir.edit', compact('ongkir', 'provinsi', 'wilayah', 'kompetitor'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $request->validate([
            'wilayah_id' => 'required',
            'kategori_kompetitor_id' => 'required',
            'jenis_layanan' => 'required',
            'harga_per_kg' => 'nullable|numeric',
            'estimasi_waktu' => 'nullable|string'
        ]);

        $ongkir = TarifOngkir::findOrFail($id);
        $ongkir->update($request->all());

        return redirect()->route('data-ongkir.index')->with('success', 'Tarif Ongkir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        TarifOngkir::findOrFail($id)->delete();
        return redirect()->route('data-ongkir.index')->with('success', 'Tarif Ongkir berhasil dihapus.');
    }

    public function export()
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $tarif_ongkir = TarifOngkir::with(['wilayah.provinsi', 'kompetitor'])->get();

        $filename = "master_ongkir_" . date('Ymd') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        fputcsv($handle, ['ID Tarif', 'Provinsi', 'Wilayah/Kota', 'Kompetitor', 'Jenis Layanan', 'Harga per Kg', 'Estimasi Waktu']);
        
        foreach($tarif_ongkir as $row) {
            fputcsv($handle, [
                $row->tarif_ongkir_id,
                $row->wilayah->provinsi->nama_provinsi ?? '-',
                $row->wilayah->nama_wilayah ?? '-',
                $row->kompetitor->nama_kategori ?? '-',
                $row->jenis_layanan,
                $row->harga_per_kg,
                $row->estimasi_waktu
            ]);
        }
        
        fclose($handle);
        exit;
    }
}
