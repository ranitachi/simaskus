<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HasilSidang extends Model
{
    use SoftDeletes;
    protected $table='hasil_sidang';
    protected $filable=['mahasiswa_id','jenis_id','jadwal_id','nilai','huruf_mutu','catatan','keterangan','created_at','updated_at','deleted_at'];

    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function jenis()
    {
        return $this->belongsTo('App\Model\MasterJenisPengajuan','jenis_id');
    }
    function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal','jadwal_id');
    }
}
