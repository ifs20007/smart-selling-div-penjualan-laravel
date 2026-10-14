<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class RajaOngkirTestController extends Controller
{
    /**
     * Tampilkan halaman pengujian RajaOngkir Sandbox.
     */
    public function index(): View
    {
        return view('rajaongkir-test');
    }

    /**
     * Cari ID lokasi/wilayah domestik berdasarkan kata kunci (Direct Search Method).
     */
    public function search(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        if ($search === '') {
            return response()->json([
                'meta' => [
                    'message' => 'Parameter search tidak boleh kosong.',
                    'code' => 422,
                    'status' => 'error',
                ],
                'data' => [],
            ], 422);
        }

        $apiKey = config('services.rajaongkir.key') ?: env('RAJAONGKIR_API_KEY');
        $baseUrl = rtrim(config('services.rajaongkir.base_url') ?: env('RAJAONGKIR_BASE_URL', 'https://rajaongkir.komerce.id/api/v1'), '/');

        $response = Http::withHeaders([
            'key' => $apiKey,
        ])->withoutVerifying()->get($baseUrl.'/destination/domestic-destination', [
            'search' => $search,
            'limit' => (int) $request->query('limit', 10),
            'offset' => (int) $request->query('offset', 0),
        ]);

        return response()->json($response->json(), $response->status());
    }

    /**
     * Hitung ongkos kirim domestik berdasarkan origin, destination, weight, dan courier.
     */
    public function calculate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'origin' => ['required'],
            'destination' => ['required'],
            'weight' => ['required', 'numeric', 'min:1'],
            'courier' => ['nullable', 'string'],
            'price' => ['nullable', 'string'],
            'filter_regular' => ['nullable', 'boolean'],
        ]);

        $courier = $validated['courier'] ?? 'pos:jne:jnt:tiki:lion:sicepat:sap';
        if ($courier === 'all' || trim($courier) === '') {
            $courier = 'pos:jne:jnt:tiki:lion:sicepat:sap';
        }

        $apiKey = config('services.rajaongkir.key') ?: env('RAJAONGKIR_API_KEY');
        $baseUrl = rtrim(config('services.rajaongkir.base_url') ?: env('RAJAONGKIR_BASE_URL', 'https://rajaongkir.komerce.id/api/v1'), '/');

        $response = Http::asForm()->withHeaders([
            'key' => $apiKey,
        ])->withoutVerifying()->post($baseUrl.'/calculate/domestic-cost', [
            'origin' => $validated['origin'],
            'destination' => $validated['destination'],
            'weight' => $validated['weight'],
            'courier' => $courier,
            'price' => $validated['price'] ?? 'lowest',
        ]);

        if (! $response->successful()) {
            return response()->json($response->json(), $response->status());
        }

        $result = $response->json();
        $items = $result['data'] ?? [];

        // Filter hanya layanan reguler jika aktif (default: true)
        $filterRegular = $request->boolean('filter_regular', true);
        if ($filterRegular && is_array($items)) {
            $filtered = array_values(array_filter($items, function (array $item): bool {
                return $this->isRegularService($item);
            }));

            // Urutkan berdasarkan tarif terendah (lowest cost first)
            usort($filtered, function (array $a, array $b): int {
                return ($a['cost'] ?? 0) <=> ($b['cost'] ?? 0);
            });

            $result['data'] = $filtered;
        }

        return response()->json($result, $response->status());
    }

    /**
     * Cek apakah opsi layanan pengiriman termasuk kategori Reguler/Standard.
     * Mengabaikan layanan Kargo, Instant, Same Day, dan Next Day/Express.
     *
     * @param  array<string, mixed>  $item
     */
    protected function isRegularService(array $item): bool
    {
        $service = strtolower(trim((string) ($item['service'] ?? '')));
        $description = strtolower(trim((string) ($item['description'] ?? '')));
        $combined = $service.' '.$description;

        // 1. Abaikan layanan Kargo, Instant, Same Day, Next Day, dsb.
        $excludedKeywords = [
            'cargo', 'kargo', 'truck', 'trucking', 'jtr', 'gokil', 'bigpack', 'jumbo',
            'instant', 'instan',
            'same day', 'sameday', 'sds',
            'next day', 'nextday', 'overnight', 'onepack', 'yes', 'besok', 'best',
            'ons', 'udrons',
        ];

        foreach ($excludedKeywords as $keyword) {
            if (str_contains($combined, $keyword)) {
                return false;
            }
        }

        // Abaikan Express / Ekspres jika bukan bagian dari nama reguler
        if (preg_match('/\b(express|ekspres)\b/i', $service) && ! preg_match('/\b(reg|reguler|regular)\b/i', $service)) {
            return false;
        }

        // 2. Hanya masukkan opsi yang memiliki indikator layanan Reguler / Standard
        $regularPatterns = [
            'reg', 'reguler', 'regular', 'regpack', 'ez', 'siuntung',
            'reg15', 'std', 'standard', 'standar', 'udrreg',
        ];

        foreach ($regularPatterns as $pattern) {
            if (str_contains($combined, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
