<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'wilayah_id';
    public $timestamps = false;

    protected $fillable = ['provinsi_id', 'nama_wilayah'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'provinsi_id');
    }

    public function tarifOngkir()
    {
        return $this->hasMany(TarifOngkir::class, 'wilayah_id', 'wilayah_id');
    }
}
