<?php

namespace App\Http\Controllers;

use App\Models\KategoriToko;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $tokos = Toko::with('kategoriToko', 'user')->orderBy('toko_id', 'desc')->get();

        return view('daftar-toko.index', compact('tokos'));
    }

    public function create()
    {
        $kategoris = KategoriToko::orderBy('nama_kategori', 'asc')->get();

        return view('daftar-toko.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_toko_id' => 'required|exists:kategori_toko,kategori_toko_id',
            'nama_toko' => 'required|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255',
            'alamat_toko' => 'required|string',
            'nomor_whatsapp' => 'required|string|max:20',
            'status_kemitraan' => 'required|in:Prospek,Pelanggan Aktif,Mantan Pelanggan',
        ]);

        $data = $request->all();
        $data['users_id'] = Auth::id();
        $data['status_pesan'] = 'Belum Dikirim';

        Toko::create($data);

        return redirect()->route('daftar-toko.index')->with('success', 'Data Prospek & Mitra berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $toko = Toko::findOrFail($id);

        if (Auth::user()->role !== 'Admin' && $toko->users_id !== Auth::id()) {
            return redirect()->route('daftar-toko.index')->with('error', 'Akses Ditolak: Anda tidak dapat mengedit rekaman milik pegawai lain.');
        }

        $kategoris = KategoriToko::orderBy('nama_kategori', 'asc')->get();

        return view('daftar-toko.edit', compact('toko', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);

        if (Auth::user()->role !== 'Admin' && $toko->users_id !== Auth::id()) {
            return redirect()->route('daftar-toko.index')->with('error', 'Akses Ditolak: Anda tidak dapat mengubah rekaman milik pegawai lain.');
        }

        $request->validate([
            'kategori_toko_id' => 'required|exists:kategori_toko,kategori_toko_id',
            'nama_toko' => 'required|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255',
            'alamat_toko' => 'required|string',
            'nomor_whatsapp' => 'required|string|max:20',
            'status_kemitraan' => 'required|in:Prospek,Pelanggan Aktif,Mantan Pelanggan',
        ]);

        $toko->update($request->all());

        return redirect()->route('daftar-toko.index')->with('success', 'Data Prospek & Mitra berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);

        if (Auth::user()->role !== 'Admin' && $toko->users_id !== Auth::id()) {
            return redirect()->route('daftar-toko.index')->with('error', 'Akses Ditolak: Anda tidak berhak menghapus rekaman ini.');
        }

        $toko->delete();

        return redirect()->route('daftar-toko.index')->with('success', 'Data toko berhasil dihapus secara permanen!');
    }

    public function export()
    {
        $tokos = Toko::with('kategoriToko', 'user')
            ->orderBy('kategori_toko_id', 'asc')
            ->orderBy('nama_toko', 'asc')
            ->get();

        return view('daftar-toko.export', compact('tokos'));
    }

    public function import(Request $request)
    {
        if ($request->hasFile('file_excel') && $request->file('file_excel')->isValid()) {
            $file = $request->file('file_excel');

            if ($file->getClientOriginalExtension() != 'xlsx') {
                return redirect()->route('daftar-toko.index')->with('error', 'Format file wajib .xlsx (Excel)');
            }

            $zip = new \ZipArchive;
            if ($zip->open($file->getPathname()) === true) {

                $sharedStrings = [];
                if (($index = $zip->locateName('xl/sharedStrings.xml')) !== false) {
                    $xml = simplexml_load_string($zip->getFromIndex($index));
                    foreach ($xml->si as $val) {
                        $sharedStrings[] = (string) $val->t;
                    }
                }

                $sheetData = [];
                if (($index = $zip->locateName('xl/worksheets/sheet1.xml')) !== false) {
                    $xml = simplexml_load_string($zip->getFromIndex($index));
                    foreach ($xml->sheetData->row as $row) {
                        $rowData = [];
                        $cellIndex = 0;

                        foreach ($row->c as $c) {
                            $r = (string) $c['r'];
                            $colLetter = preg_replace('/[0-9]/', '', $r);
                            $colNum = ord(strtoupper($colLetter)) - 65;

                            while ($cellIndex < $colNum) {
                                $rowData[] = '';
                                $cellIndex++;
                            }

                            $v = (string) $c->v;
                            if (isset($c['t']) && (string) $c['t'] == 's') {
                                $v = isset($sharedStrings[$v]) ? $sharedStrings[$v] : '';
                            }
                            $rowData[] = $v;
                            $cellIndex++;
                        }
                        $sheetData[] = $rowData;
                    }
                }
                $zip->close();

                $kategori_map = [];
                $kategoris = KategoriToko::all();
                foreach ($kategoris as $k) {
                    $nama_kat_lowercase = strtolower(trim($k->nama_kategori));
                    $kategori_map[$nama_kat_lowercase] = $k->kategori_toko_id;
                }

                $berhasil = 0;
                $gagal = 0;

                array_shift($sheetData);

                foreach ($sheetData as $data) {
                    if (count($data) >= 6) {
                        $kategori_input = strtolower(trim($data[0]));
                        $id_kat = isset($kategori_map[$kategori_input]) ? $kategori_map[$kategori_input] : 0;

                        $toko = trim($data[1]);
                        $pemilik = trim($data[2]);
                        $alamat = trim($data[3]);
                        $wa = trim($data[4]);
                        $status = trim($data[5]);

                        if (! empty($toko) && $id_kat > 0) {
                            Toko::create([
                                'kategori_toko_id' => $id_kat,
                                'nama_toko' => $toko,
                                'nama_pemilik' => $pemilik,
                                'alamat_toko' => $alamat,
                                'nomor_whatsapp' => $wa,
                                'status_pesan' => 'Belum Dikirim',
                                'status_kemitraan' => $status ?: 'Prospek',
                                'users_id' => Auth::id(),
                            ]);
                            $berhasil++;
                        } else {
                            $gagal++;
                        }
                    }
                }

                $msg = "Import Sukses! {$berhasil} data toko berhasil masuk, {$gagal} gagal/salah ketik nama kategori.";

                return redirect()->route('daftar-toko.index')->with('success', $msg);
            } else {
                return redirect()->route('daftar-toko.index')->with('error', 'Gagal membaca file Excel. Pastikan file tidak corrupt.');
            }
        }

        return redirect()->route('daftar-toko.index')->with('error', 'Upload gagal atau file tidak ditemukan.');
    }
}
