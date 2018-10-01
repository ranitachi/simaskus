<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotaBimbingan extends Model
{
    use SoftDeletes;
    protected $table='quota_bimbingan';
    protected $fillable = ['departemen_id','level','quota','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}
