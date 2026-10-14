<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatBroadcast extends Model
{
    protected $table = 'riwayat_broadcasts';

    protected $primaryKey = 'riwayat_broadcasts_id';

    protected $fillable = [
        'kategori_toko_id',
        'users_id',
        'isi_pesan',
        'jumlah_terkirim',
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
