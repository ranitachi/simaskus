<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengujiKP extends Model
{
    use SoftDeletes;
    protected $table = 'penguji_k_p';
    protected $fillable = ['pivot_jadwal_id','departemen_id','grup_id','penguji_id','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','penguji_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
    function pivotjadwal()
    {
        return $this->belongsTo('App\Model\PivotJadwal','pivot_jadwal_id');
    }
    function kelompok()
    {
        return $this->belongsTo('App\Model\KelompokKP','grup_id');
    }
}
