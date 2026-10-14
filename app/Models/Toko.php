<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';

    protected $primaryKey = 'toko_id';

    protected $fillable = [
        'kategori_toko_id',
        'users_id',
        'nama_toko',
        'nama_pemilik',
        'alamat_toko',
        'nomor_whatsapp',
        'latitude',
        'longitude',
        'status_pesan',
        'status_kemitraan',
        'ml_probabilitas_konversi',
        'ml_cluster_route',
    ];

    public function kategoriToko()
    {
        return $this->belongsTo(KategoriToko::class, 'kategori_toko_id', 'kategori_toko_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
}
