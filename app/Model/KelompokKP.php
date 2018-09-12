<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelompokKP extends Model
{
    use SoftDeletes;
    protected $table = 'kelompok_k_ps';
    protected $fillable = ['code','nama_kelompok','lokasi_kp','pembimbing_id','departemen_id','kategori','mahasiswa_id','created_at','updated_at','deleted_at'];

    function kp()
    {
        return $this->belongsTo('App\Model\KerjaPraktek','code');
    }
    function pembimbing()
    {
        return $this->belongsTo('App\Model\Dosen','pembimbing_id');
    }

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
}


