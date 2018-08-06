<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = ['name','email','password','flag','kat_user','id_user','created_at','updated_at','deleted_at'];

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','id_user');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','id_user');
    }
    function staf()
    {
        return $this->belongsTo('App\Model\Staf','id_user');
    }
}
