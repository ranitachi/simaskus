<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerbaikanSkripsi extends Model
{
    use SoftDeletes;
    protected $table='perbaikan_skripsi';
    protected $fillable=['jadwal_id','mahasiswa_id','pembimbing_id','perbaikan','batas_waktu'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','pembimbing_id');
    }
}
