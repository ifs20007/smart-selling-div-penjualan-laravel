<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKompetitor extends Model
{
    protected $table = 'kategori_kompetitor';

    protected $primaryKey = 'kategori_kompetitor_id';

    public $timestamps = false; // Tabel ini tidak memiliki created_at / updated_at

    protected $fillable = ['nama_kategori', 'inisial', 'keterangan', 'kode_warna'];

    public function cabang()
    {
        return $this->hasMany(Kompetitor::class, 'kategori_kompetitor_id', 'kategori_kompetitor_id');
    }

    /**
     * Mendapatkan URL aset logo resmi ekspedisi
     */
    public function getLogoUrlAttribute(): ?string
    {
        $logos = [
            'POS' => 'assets/images/posind.png',
            'JNE' => 'assets/images/logo_jne.png',
            'J&T' => 'assets/images/logo_jnt.png',
            'JNT' => 'assets/images/logo_jnt.png',
            'SIC' => 'assets/images/logo_sicepat.png',
            'ANT' => 'assets/images/logo_anteraja.jpg',
            'IDX' => 'assets/images/logo_idexpress.png',
            'SPX' => 'assets/images/logo_shopeeexpress.png',
            'TIKI' => 'assets/images/logo_tiki.png',
            'SAPX' => 'assets/images/logo_sap.png',
            'SAP' => 'assets/images/logo_sap.png',
            'LION' => 'assets/images/logo_lion.png',
            'NJX' => 'assets/images/logo_ninja.png',
            'ILC' => 'assets/images/logo_indahcargo.png',
            'BRK' => 'assets/images/logo_baraka.png',
        ];

        $key = strtoupper(trim($this->inisial ?? ''));
        if (isset($logos[$key])) {
            return asset($logos[$key]);
        }

        $name = strtolower($this->nama_kategori ?? '');
        if (str_contains($name, 'pos')) {
            return asset('assets/images/posind.png');
        }
        if (str_contains($name, 'jne')) {
            return asset('assets/images/logo_jne.png');
        }
        if (str_contains($name, 'j&t') || str_contains($name, 'jnt')) {
            return asset('assets/images/logo_jnt.png');
        }
        if (str_contains($name, 'sicepat')) {
            return asset('assets/images/logo_sicepat.png');
        }
        if (str_contains($name, 'anteraja')) {
            return asset('assets/images/logo_anteraja.jpg');
        }
        if (str_contains($name, 'id express') || str_contains($name, 'idx')) {
            return asset('assets/images/logo_idexpress.png');
        }
        if (str_contains($name, 'shopee') || str_contains($name, 'spx')) {
            return asset('assets/images/logo_shopeeexpress.png');
        }
        if (str_contains($name, 'tiki')) {
            return asset('assets/images/logo_tiki.png');
        }
        if (str_contains($name, 'sap')) {
            return asset('assets/images/logo_sap.png');
        }
        if (str_contains($name, 'lion')) {
            return asset('assets/images/logo_lion.png');
        }
        if (str_contains($name, 'ninja')) {
            return asset('assets/images/logo_ninja.png');
        }
        if (str_contains($name, 'indah')) {
            return asset('assets/images/logo_indahcargo.png');
        }
        if (str_contains($name, 'baraka')) {
            return asset('assets/images/logo_baraka.png');
        }

        return null;
    }
}
