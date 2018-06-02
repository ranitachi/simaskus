<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = ['name','email','password','flag','kat_user','user_id','created_at','updated_at','deleted_at'];

    function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa','user_id');
    }
    function dosen()
    {
        return $this->belongsTo('App\Dosen','user_id');
    }
    function staf()
    {
        return $this->belongsTo('App\Staf','user_id');
    }
}
