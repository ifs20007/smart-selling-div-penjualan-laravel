<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetitor extends Model
{
    use HasFactory;

    // Menyesuaikan dengan nama tabel di database
    protected $table = 'kompetitor';
    
    // Mendefinisikan primary key karena tidak menggunakan standar 'id'
    protected $primaryKey = 'kompetitor_id';

    // Kolom-kolom yang diizinkan untuk diisi (Mass Assignment)
    protected $fillable = [
        'kategori_kompetitor_id', 
        'users_id', 
        'nama_kompetitor', 
        'alamat', 
        'latitude', 
        'longitude', 
        'url'
    ];

    // Relasi: Satu Cabang dimiliki oleh Satu Kategori Kompetitor
    public function kategori()
    {
        return $this->belongsTo(KategoriKompetitor::class, 'kategori_kompetitor_id', 'kategori_kompetitor_id');
    }

    // Relasi: Satu Cabang didata oleh Satu User (Pegawai/Admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
}