<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterPimpinan extends Model
{
    use SoftDeletes;
    protected $table = 'master_pimpinan';
    protected $fillable = ['dosen_id','departemen_id','jabatan','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\Model\Departemen','departemen_id');
    }
}