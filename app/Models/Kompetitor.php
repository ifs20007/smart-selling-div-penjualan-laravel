<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kompetitor extends Model
{
    protected $table = 'kompetitor';
    protected $primaryKey = 'kompetitor_id';

    protected $fillable = [
        'kategori_kompetitor_id', 'users_id', 'nama_kompetitor', 
        'alamat', 'latitude', 'longitude', 'url'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKompetitor::class, 'kategori_kompetitor_id', 'kategori_kompetitor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
}