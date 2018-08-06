<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotBimbingan extends Model
{
    use SoftDeletes;
    protected $table = 'pivot_bimbingan';
    protected $fillable = ['dosen_id','mahasiswa_id','jenis_bimbingan','judul_id','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function judul()
    {
        return $this->belongsTo('App\Model\JudulTugasAkhir','judul_id');
    }
}