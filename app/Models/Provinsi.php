<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'provinsi_id';
    public $timestamps = false;

    protected $fillable = ['nama_provinsi'];

    public function wilayah()
    {
        return $this->hasMany(Wilayah::class, 'provinsi_id', 'provinsi_id');
    }
}
