<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class IzinDosen extends Model
{
    use SoftDeletes;
    protected $table='izin_dosen';
    protected $fillable=['dosen_id','start_date','end_date','start_time','end_time','keterangan','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
}
