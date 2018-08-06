<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotSetujuSidang extends Model
{
    use SoftDeletes;
    protected $table = 'pivot_setuju_sidang';
    protected $fillable = ['dosen_id','mahasiswa_id','jenis_bimbingan','pengajuan_id','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function pengajuan_id()
    {
        return $this->belongsTo('App\Model\PengajuanSkripsi','pengajuan_id');
    }
}
