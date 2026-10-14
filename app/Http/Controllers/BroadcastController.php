<?php

namespace App\Http\Controllers;

use App\Models\KategoriToko;
use App\Models\RiwayatBroadcast;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BroadcastController extends Controller
{
    public function index()
    {
        $riwayats = RiwayatBroadcast::with(['kategoriToko', 'user'])->orderBy('created_at', 'desc')->get();

        return view('broadcast.index', compact('riwayats'));
    }

    public function create()
    {
        $kategoris = KategoriToko::all();

        return view('broadcast.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_toko_id' => 'required|exists:kategori_toko,kategori_toko_id',
            'isi_pesan' => 'required|string',
        ]);

        $tokos = Toko::where('kategori_toko_id', $request->kategori_toko_id)
            ->whereNotNull('nomor_whatsapp')
            ->where('nomor_whatsapp', '!=', '')
            ->get();

        $token = config('services.fonnte.token');
        if (empty($token)) {
            return back()->withInput()->withErrors(['API Token Fonnte belum dikonfigurasi di file .env.']);
        }

        if ($tokos->isEmpty()) {
            return back()->withInput()->withErrors(['Tidak ada pelanggan dengan nomor WhatsApp pada kategori ini.']);
        }

        $targetArray = [];
        foreach ($tokos as $toko) {
            $nohp = preg_replace('/[^0-9]/', '', $toko->nomor_whatsapp);
            if (! empty($nohp)) {
                // If it starts with 0, we can leave it as Fonnte handles it via countryCode parameter,
                // but stripping 0 and adding 62 is safer if countryCode acts up, or just pass as is.
                // According to Fonnte docs, countryCode='62' will replace first zero with 62.
                $targetArray[] = $nohp;
            }
        }

        if (empty($targetArray)) {
            return back()->withInput()->withErrors(['Semua kontak pada kategori ini tidak memiliki format nomor yang valid.']);
        }

        $targetString = implode(',', $targetArray);

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->withoutVerifying()->post('https://api.fonnte.com/send', [
                'target' => $targetString,
                'message' => $request->isi_pesan,
                'delay' => '2',
                'countryCode' => '62', // Fonnte automatically replaces first 0 with 62
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                // Fonnte confirms message is in queue
                $jumlahTerkirim = count($targetArray);

                RiwayatBroadcast::create([
                    'kategori_toko_id' => $request->kategori_toko_id,
                    'users_id' => auth()->id(),
                    'isi_pesan' => $request->isi_pesan,
                    'jumlah_terkirim' => $jumlahTerkirim,
                ]);

                return redirect()->route('broadcast.index')->with('success', "Permintaan broadcast berhasil masuk antrean Fonnte untuk $jumlahTerkirim kontak.");
            } else {
                $reason = $result['reason'] ?? 'Unknown Error / Invalid Response';
                Log::error('Fonnte API Error: '.json_encode($result));

                return back()->withInput()->withErrors(['Gagal mengirim ke Fonnte. Alasan: '.$reason]);
            }
        } catch (\Exception $e) {
            Log::error('Fonnte System Exception: '.$e->getMessage());

            return back()->withInput()->withErrors(['Terjadi kesalahan saat terhubung ke server Fonnte: '.$e->getMessage()]);
        }
    }

    public function webhook(Request $request)
    {
        // Untuk menerima report dari Fonnte (bila dikonfigurasi di dashboard Fonnte)
        Log::info('Webhook Fonnte Received:', $request->all());

        return response()->json(['status' => 'success']);
    }
}
