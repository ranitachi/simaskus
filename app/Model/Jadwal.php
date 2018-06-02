<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use SoftDeletes;
    protected $table = 'jadwal';
    protected $fillable = ['code','nama','ruangan_id','tanggal','hari','jenis_jadwal','staf_id','created_at','updated_at','deleted_at'];

    function ruangan()
    {
        return $this->belongsTo('App\Model\MasterRuangan','ruangan_id');
    }

    function staf()
    {
        return $this->belongsTo('App\Staf','staf_id');
    }
}
