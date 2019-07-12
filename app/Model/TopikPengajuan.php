<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopikPengajuan extends Model
{
    use SoftDeletes;
    protected $table='topik_pengajuan';
    protected $fillable=['pengajuan_id','dosen_id','topik','created_at','updated_at','deleted_at'];

    function pengajuan()
    {
        return $this->belongsTo('App\Model\Pengajuan','pengajuan_id');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
}
