<?php

namespace Tests\Unit;

use App\Models\KategoriKompetitor;
use Tests\TestCase;

class KategoriKompetitorTest extends TestCase
{
    /**
     * Test that logo_url accessor correctly maps all couriers to their respective official asset images.
     */
    public function test_logo_url_accessor_maps_all_couriers(): void
    {
        $couriers = [
            'POS' => 'posind.png',
            'JNE' => 'logo_jne.png',
            'J&T' => 'logo_jnt.png',
            'JNT' => 'logo_jnt.png',
            'SiC' => 'logo_sicepat.png',
            'ANT' => 'logo_anteraja.jpg',
            'IDX' => 'logo_idexpress.png',
            'SPX' => 'logo_shopeeexpress.png',
            'TIKI' => 'logo_tiki.png',
            'SAPX' => 'logo_sap.png',
            'LION' => 'logo_lion.png',
            'NJX' => 'logo_ninja.png',
            'ILC' => 'logo_indahcargo.png',
            'BRK' => 'logo_baraka.png',
        ];

        foreach ($couriers as $initial => $filename) {
            $model = new KategoriKompetitor([
                'nama_kategori' => $initial,
                'inisial' => $initial,
            ]);

            $logoUrl = $model->logo_url;
            $this->assertNotNull($logoUrl, "Logo for {$initial} should not be null");
            $this->assertStringContainsString($filename, $logoUrl);
        }
    }

    /**
     * Test that fallback by nama_kategori also matches correctly.
     */
    public function test_logo_url_accessor_fallback_by_name(): void
    {
        $model = new KategoriKompetitor([
            'nama_kategori' => 'PT Pos Indonesia (Persero)',
            'inisial' => null,
        ]);
        $this->assertStringContainsString('posind.png', $model->logo_url);

        $lionModel = new KategoriKompetitor([
            'nama_kategori' => 'Lion Parcel Pematangsiantar',
            'inisial' => null,
        ]);
        $this->assertStringContainsString('logo_lion.png', $lionModel->logo_url);
    }
}
