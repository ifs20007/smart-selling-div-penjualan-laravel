<?php

namespace App\Http\Controllers;

use App\Models\Kompetitor;
use App\Models\KategoriKompetitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KompetitorController extends Controller
{
    public function index()
    {
        $cabang = Kompetitor::with(['kategori', 'user'])->latest()->get();
        return view('kompetitor.index', compact('cabang'));
    }

    public function create()
    {
        $kategori = KategoriKompetitor::orderBy('nama_kategori', 'ASC')->get();
        return view('kompetitor.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Cegah error validasi 'numeric' jika user mengetik koma
        $request->merge([
            'latitude' => str_replace(',', '.', $request->latitude),
            'longitude' => str_replace(',', '.', $request->longitude),
        ]);

        $request->validate([
            'kategori_kompetitor_id' => 'required|exists:kategori_kompetitor,kategori_kompetitor_id',
            'nama_kompetitor' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'url' => 'nullable|url'
        ]);

        Kompetitor::create([
            'kategori_kompetitor_id' => $request->kategori_kompetitor_id,
            'users_id' => Auth::id(), // Diambil dari sesi yang sedang aktif
            'nama_kompetitor' => $request->nama_kompetitor,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'url' => $request->url
        ]);

        return redirect()->route('kompetitor.index')->with('success', 'Cabang/Agen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kompetitor = Kompetitor::findOrFail($id);
        $kategori = KategoriKompetitor::orderBy('nama_kategori', 'ASC')->get();
        return view('kompetitor.edit', compact('kompetitor', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'latitude' => str_replace(',', '.', $request->latitude),
            'longitude' => str_replace(',', '.', $request->longitude),
        ]);

        $request->validate([
            'kategori_kompetitor_id' => 'required|exists:kategori_kompetitor,kategori_kompetitor_id',
            'nama_kompetitor' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'url' => 'nullable|url'
        ]);

        Kompetitor::findOrFail($id)->update($request->all());
        return redirect()->route('kompetitor.index')->with('success', 'Cabang/Agen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kompetitor::findOrFail($id)->delete();
        return redirect()->route('kompetitor.index')->with('success', 'Cabang/Agen dihapus.');
    }
}