<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KalenderAkademik extends Model
{
    use SoftDeletes;
    protected $table='kalender_akademik';
    protected $fillable = ['start_dat','end_date','keterangan','kegiatan','status','tahunajaran_id','departemen_id','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
    function tahunajaran()
    {
        return $this->belongsTo('App\Model\TahunAjaran','tahunajaran_id');
    }
}
