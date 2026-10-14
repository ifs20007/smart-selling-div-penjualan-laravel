<?php

namespace App\Http\Controllers;

use App\Models\KategoriToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriTokoController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $kategoris = KategoriToko::orderBy('kategori_toko_id', 'desc')->get();

        return view('kategori-toko.index', compact('kategoris'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        return view('kategori-toko.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        KategoriToko::create($request->all());

        return redirect()->route('kategori-toko.index')->with('success', 'Kategori Bisnis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $kategori = KategoriToko::findOrFail($id);

        return view('kategori-toko.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $kategori = KategoriToko::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori-toko.index')->with('success', 'Kategori Bisnis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan Administrator.');
        }

        $kategori = KategoriToko::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-toko.index')->with('success', 'Kategori Bisnis berhasil dihapus secara permanen!');
    }
}
