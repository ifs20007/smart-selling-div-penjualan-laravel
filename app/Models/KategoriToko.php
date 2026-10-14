<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriToko extends Model
{
    protected $table = 'kategori_toko';

    protected $primaryKey = 'kategori_toko_id';

    public $timestamps = false;

    protected $fillable = ['nama_kategori', 'keterangan'];

    public function toko()
    {
        return $this->hasMany(Toko::class, 'kategori_toko_id', 'kategori_toko_id');
    }
}
