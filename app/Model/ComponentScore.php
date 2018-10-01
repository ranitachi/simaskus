<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentScore extends Model
{
    use SoftDeletes;
    protected $table='component_score';
    protected $fillable=['jadwal_id','mahasiswa_id','component_id','dosen_id','score','created_at','updated_at','deleted_at'];

    function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal','jadwal_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function component()
    {
        return $this->belongsTo('App\Model\Component','component_id');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
}
