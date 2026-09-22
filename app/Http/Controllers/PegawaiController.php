<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    // 1. TAMPILKAN DATA PEGAWAI (READ)
    public function index(Request $request)
    {
        if ($request->user()->role !== 'Admin') {
            return redirect()->route('dashboard.main')->with('error', 'Akses Ditolak: Fitur khusus Administrator.');
        }

        $pegawai = User::orderBy('users_id', 'ASC')->get();
        return view('pegawai.index', compact('pegawai'));
    }

    // 2. FORM TAMBAH PEGAWAI (CREATE)
    public function create(Request $request)
    {
        if ($request->user()->role !== 'Admin') abort(403);
        return view('pegawai.create');
    }

    // 3. PROSES SIMPAN PEGAWAI BARU (STORE)
    public function store(Request $request)
    {
        if ($request->user()->role !== 'Admin') abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required|in:Admin,Pegawai',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('pegawai.index')->with('success', "Akun {$request->name} berhasil ditambahkan!");
    }

    // 4. FORM EDIT PEGAWAI (EDIT)
    public function edit(Request $request, $id)
    {
        if ($request->user()->role !== 'Admin') abort(403);
        
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    // 5. PROSES UPDATE PEGAWAI (UPDATE)
    public function update(Request $request, $id)
    {
        if ($request->user()->role !== 'Admin') abort(403);

        $pegawai = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pegawai->users_id . ',users_id',
            'role' => 'required|in:Admin,Pegawai',
        ]);

        $pegawai->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('pegawai.index')->with('success', "Data akun {$request->name} berhasil diperbarui!");
    }

    // 6. PROSES HAPUS PEGAWAI (DELETE)
    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'Admin') abort(403);

        $pegawai = User::findOrFail($id);
        
        // Mencegah Admin menghapus dirinya sendiri
        if ($pegawai->users_id === $request->user()->users_id) {
            return redirect()->route('pegawai.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login!');
        }

        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Akun beserta seluruh rekam datanya berhasil dihapus.');
    }

    // 7. FITUR RESET PASSWORD PAKSA OLEH ADMIN
    public function forceResetPassword(Request $request, $id)
    {
        $userLagiLogin = $request->user();

        if ($userLagiLogin->role !== 'Admin') {
            return redirect()->back()->with('error', 'Akses ditolak! Anda bukan Admin.');
        }

        $request->validate([
            'password' => 'required|min:4|confirmed',
        ]);

        $pegawai = User::findOrFail($id);
        $pegawai->password = Hash::make($request->password);
        $pegawai->save();

        return redirect()->back()->with('success', "Kata sandi untuk pegawai {$pegawai->name} berhasil direset secara paksa!");
    }
}