<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use SoftDeletes;
    protected $table = 'dosen';
    protected $fillable = ['nip','inisial','nama','departemen_id','tanggal_lahir','gender','alamat','kota','email','hp','jabatan','status_dosen','nidn','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }

    function dosen()
    {
        return $this->hasOne('App\Model\Users','foreign_key','id_user');
    }
}
