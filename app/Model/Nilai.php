<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use SoftDeletes;
    protected $table='nilai';
    protected $fillable=['penilai','jadwal_id','pengajuan_id','nilai_angka','persen','subtotal','total','huruf','komponen_id','dosen_id','created_at','updated_at','deleted_at'];

    function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal','jadwal_id');
    }
    function pengajuan()
    {
        return $this->belongsTo('App\Model\Pengajuan','pengajuan_id');
    }
    function komponen()
    {
        return $this->belongsTo('App\Model\Component','komponen_id');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
}
