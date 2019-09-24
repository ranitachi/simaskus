<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publikasi extends Model
{
    use SoftDeletes;
    protected $table='publikasi';
    protected $fillable=['judul','pengajuan_id','status','acc_dep','acc_mandik','mahasiswa_id','url','penulis','lokasi_publikasi','file','keterangan','created_at','updated_at'];

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
}
