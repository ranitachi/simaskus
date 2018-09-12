<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalSidangKP extends Model
{
    use SoftDeletes;
    protected $table='jadwal_sidang_k_p';
    protected $fillable = ['id_grup','departemen_id','nama','ruangan_id','tanggal','waktu','hari','jenis_jadwal','staf_id','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
    function ruangan()
    {
        return $this->belongsTo('App\Model\MasterRuangan','ruangan_id');
    }
}
