<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluasiACCSidang extends Model
{
    use SoftDeletes;
    protected $table='evaluasi_a_c_c_sidang';
    protected $fillable=['pengajuan_id','mahasiswa_id','dept_id','dosen_id','component_id','nilai','keterangan','catatan','created_at','updated_at','deleted_at'];

    function pengajuan()
    {
        return $this->belongsTo('App\Model\MasterJenisPengajuan','pengajuan_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
    function component()
    {
        return $this->belongsTo('App\Model\Component','component_id');
    }
}
