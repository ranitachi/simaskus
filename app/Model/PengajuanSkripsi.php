<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanSkripsi extends Model
{
    use SoftDeletes;
    protected $table='pengajuan_skripsi';
    protected $fillable = ['tanggal_pengajuan','mahasiswa_id','pembimbing_id','judul_id','judul','status','disetujui','created_at','updated_at','deleted_at'];

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function pembimbing()
    {
        return $this->belongsTo('App\Model\Dosen','pembimbing_id');
    }
    function judul()
    {
        return $this->belongsTo('App\Model\JudulTugasAkhir','judul_id');
    }
    
}
