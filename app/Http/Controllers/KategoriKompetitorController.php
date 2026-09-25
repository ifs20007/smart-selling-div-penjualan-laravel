<?php

namespace App\Http\Controllers;

use App\Models\KategoriKompetitor;
use Illuminate\Http\Request;

class KategoriKompetitorController extends Controller
{
    public function index()
    {
        $kategori = KategoriKompetitor::orderBy('nama_kategori', 'ASC')->get();
        return view('kategori-kompetitor.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori-kompetitor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'inisial' => 'nullable|string|max:10',
            'keterangan' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:10',
        ]);

        KategoriKompetitor::create($request->all());
        return redirect()->route('kategori-kompetitor.index')->with('success', 'Master Kompetitor ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriKompetitor::findOrFail($id);
        return view('kategori-kompetitor.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'inisial' => 'nullable|string|max:10',
            'keterangan' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:10',
        ]);

        KategoriKompetitor::findOrFail($id)->update($request->all());
        return redirect()->route('kategori-kompetitor.index')->with('success', 'Master Kompetitor diperbarui.');
    }

    public function destroy($id)
    {
        KategoriKompetitor::findOrFail($id)->delete();
        return redirect()->route('kategori-kompetitor.index')->with('success', 'Master Kompetitor dihapus.');
    }
}