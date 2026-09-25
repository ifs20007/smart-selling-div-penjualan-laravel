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
}