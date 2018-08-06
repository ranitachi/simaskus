<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staf extends Model
{
    use SoftDeletes;
    protected $table = 'staf';
    protected $fillable = ['nip','inisial','nama','departemen_id','tanggal_lahir','gender','alamat','kota','email','hp','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }

    function staf()
    {
        return $this->hasOne('App\Model\Users','id_user');
    }

    function staf_user()
    {
        return $this->hasOne('App\User','id_user');
    }
}
