<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenjang extends Model
{
    use SoftDeletes;
    protected $table ='jenjang';
    protected $fillable = ['jenjang','desc','flag_active','departemen_id','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}
