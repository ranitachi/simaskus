<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotPenguji extends Model
{
    use SoftDeletes;
    protected $table = 'pivot_penguji';
    protected $fillable = ['pivot_jadwal_id','penguji_id','mahasiswa_id','status','pengajuan_id','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','penguji_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function pivotjadwal()
    {
        return $this->belongsTo('App\Model\PivotJadwal','pivot_jadwal_id');
    }
    function pengajuan()
    {
        return $this->belongsTo('App\Model\MasterPengajuan','pengajuan_id');
    }
}