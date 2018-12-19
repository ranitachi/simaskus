<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publikasi extends Model
{
    use SoftDeletes;
    protected $table='publikasi';
    protected $fillable=['judul','pengajuan_id','mahasiswa_id','url','penulis','lokasi_publikasi','file','created_at','updated_at'];
}
