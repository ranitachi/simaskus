<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotJadwal extends Model
{
    use SoftDeletes;
    protected $table = 'pivot_jadwal';
    protected $fillable = ['jadwal_id','ruangan_id','mahasiswa_id','judul_id','status','created_at','updated_at','deleted_at'];

    function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal','jadwal_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function judul()
    {
        return $this->belongsTo('App\Model\JudulTugasAkhir','judul_id');
    }
    function pengajuan()
    {
        return $this->belongsTo('App\Model\Pengajuan','judul_id');
    }
    function ruangan()
    {
        return $this->belongsTo('App\Model\MasterRuangan','ruangan_id');
    }
}