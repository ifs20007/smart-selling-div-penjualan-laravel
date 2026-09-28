<?php

namespace App\Http\Controllers;

use App\Models\Kompetitor;
use App\Models\KategoriKompetitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KompetitorController extends Controller
{
    // 1. READ: Menampilkan Peta dan Daftar Cabang
    public function index()
    {
        $cabang = Kompetitor::with(['kategori', 'user'])->orderBy('created_at', 'desc')->get();

        $lokasi_kompetitor = [];
        $kategori_list = [];
        $kategori_ids = [];

        // Memformat data untuk titik koordinat Peta (Leaflet.js)
        foreach ($cabang as $row) {
            $kat = $row->kategori;
            $inisial = $kat->inisial ?? substr($kat->nama_kategori ?? 'U', 0, 3);
            $warna = $kat->kode_warna ?? '#003B73';

            $lokasi_kompetitor[] = [
                'nama_kompetitor' => $row->nama_kompetitor,
                'alamat' => $row->alamat,
                'latitude' => $row->latitude,
                'longitude' => $row->longitude,
                'url' => $row->url ?? '#',
                'ekspedisi' => $kat->nama_kategori ?? 'N/A',
                'inisial' => $inisial,
                'color' => $warna
            ];

            if ($kat && !in_array($kat->kategori_kompetitor_id, $kategori_ids)) {
                $kategori_list[] = $kat;
                $kategori_ids[] = $kat->kategori_kompetitor_id;
            }
        }

        return view('kompetitor.index', compact('cabang', 'lokasi_kompetitor', 'kategori_list'));
    }

    // 2. CREATE: Menampilkan form tambah
    public function create()
    {
        $kategori = KategoriKompetitor::orderBy('nama_kategori', 'ASC')->get();
        return view('kompetitor.create', compact('kategori'));
    }

    // 3. STORE: Menyimpan data cabang baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kompetitor_id' => 'required|integer',
            'nama_kompetitor'        => 'required|string|max:255',
            'alamat'                 => 'required|string',
            'latitude'               => 'required|numeric',
            'longitude'              => 'required|numeric',
            'url'                    => 'required|url',
        ]);

        Kompetitor::create([
            'kategori_kompetitor_id' => $request->kategori_kompetitor_id,
            'users_id'               => Auth::id(),
            'nama_kompetitor'        => $request->nama_kompetitor,
            'alamat'                 => $request->alamat,
            'latitude'               => $request->latitude,
            'longitude'              => $request->longitude,
            'url'                    => $request->url,
        ]);

        return redirect()->route('kompetitor.index')->with('success', 'Titik agen berhasil ditambahkan ke peta!');
    }

    // 4. EDIT: Menampilkan form edit cabang
    public function edit($id)
    {
        $kompetitor = Kompetitor::findOrFail($id);
        
        if (Auth::user()->role !== 'Admin' && $kompetitor->users_id !== Auth::id()) {
            return redirect()->route('kompetitor.index')->with('error', 'Akses Ditolak! Anda bukan pembuat data ini.');
        }

        $kategori = KategoriKompetitor::orderBy('nama_kategori', 'ASC')->get();
        return view('kompetitor.edit', compact('kompetitor', 'kategori'));
    }

    // 5. UPDATE: Menyimpan pembaruan data
    public function update(Request $request, $id)
    {
        $kompetitor = Kompetitor::findOrFail($id);

        if (Auth::user()->role !== 'Admin' && $kompetitor->users_id !== Auth::id()) {
            return redirect()->route('kompetitor.index')->with('error', 'Akses Ditolak! Anda bukan pembuat data ini.');
        }

        $request->validate([
            'kategori_kompetitor_id' => 'required|integer',
            'nama_kompetitor'        => 'required|string|max:255',
            'alamat'                 => 'required|string',
            'latitude'               => 'required|numeric',
            'longitude'              => 'required|numeric',
            'url'                    => 'required|url',
        ]);

        $kompetitor->update($request->only([
            'kategori_kompetitor_id', 'nama_kompetitor', 'alamat', 'latitude', 'longitude', 'url'
        ]));

        return redirect()->route('kompetitor.index')->with('success', 'Data titik agen sukses diubah.');
    }

    // 6. DESTROY: Menghapus data cabang
    public function destroy($id)
    {
        $kompetitor = Kompetitor::findOrFail($id);

        if (Auth::user()->role !== 'Admin' && $kompetitor->users_id !== Auth::id()) {
            return redirect()->route('kompetitor.index')->with('error', 'Gagal! Anda bukan pemilik data ini.');
        }

        $kompetitor->delete();
        return redirect()->route('kompetitor.index')->with('success', 'Titik agen dihapus dari peta.');
    }
}