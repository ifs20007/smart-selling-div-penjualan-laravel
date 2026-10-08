<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifOngkir extends Model
{
    protected $table = 'tarif_ongkir';
    protected $primaryKey = 'tarif_ongkir_id';
    public $timestamps = false;

    protected $fillable = [
        'wilayah_id', 
        'kategori_kompetitor_id', 
        'jenis_layanan', 
        'harga_per_kg', 
        'estimasi_waktu'
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'wilayah_id');
    }

    public function kompetitor()
    {
        return $this->belongsTo(KategoriKompetitor::class, 'kategori_kompetitor_id', 'kategori_kompetitor_id');
    }
}
