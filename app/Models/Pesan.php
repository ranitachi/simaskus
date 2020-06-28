<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesan extends Model
{
    use SoftDeletes;
    protected $fillable=['id_user_dari','id_user_untuk','status_baca','dari','untuk','judul','pesan','created_at','updated_at','deleted_at'];
    
    function userdari()
    {
        return $this->belongsTo('App\User','id_user_dari');
    }
    function useruntuk()
    {
        return $this->belongsTo('App\User','id_user_untuk');
    }
    function lampiran()
    {
        return $this->hasMany('App\Models\PesanLampiran','pesan_id','idform');
    }
}
