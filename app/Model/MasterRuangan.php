<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRuangan extends Model
{
    use SoftDeletes;
    protected $table = 'master_ruangan';
    protected $fillable = ['code_ruangan','nama_ruangan','deskripsi','lokasi_kuliah','departemen_id','lokasi','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}