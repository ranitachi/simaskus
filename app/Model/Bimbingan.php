<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bimbingan extends Model
{
    use SoftDeletes;
    protected $table='bimbingan';
    protected $fillable=['tanggal_bimbingan','mahasiswa_id','flag','bimbingan_ke','judul','dospem_id','deskripsi_bimbingan','created_at','updated_at','deleted_at'];
    function dospem()
    {
        return $this->belongsTo('App\Model\Dosen','dospem_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
}
