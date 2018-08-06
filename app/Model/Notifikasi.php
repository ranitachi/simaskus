<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifikasi extends Model
{
    use SoftDeletes;
    protected $table ='notifikasi';
    protected $fillable = ['title','from','to','seen','flag_active','pesan','created_at','updated_at','deleted_at'];


    function user()
    {
        return $this->belongsTo('App\Model\Users','from');
    }

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','from');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','from');
    }
    function staf()
    {
        return $this->belongsTo('App\Model\Staf','from');
    }
}
