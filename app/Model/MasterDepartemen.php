<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDepartemen extends Model
{
    use SoftDeletes;
    protected $table = 'master_departemen';
    protected $fillable = ['code','nama_departemen','pimpinan_id','flag','created_at','updated_at','deleted_at'];

    function pimpinan()
    {
        return $this->belongsTo('App\Model\Dosen','pimpinan_id');
    }
}


