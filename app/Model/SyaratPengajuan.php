<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SyaratPengajuan extends Model
{
    use SoftDeletes;
    protected $table='syarat_pengajuans';
    protected $fillable=['code','syarat','pengajuan_id','keterangan','flag','created_at','departemen_id','updated_at','deleted_at'];

    function pengajuan()
    {
        return $this->belongsTo('App\Model\MasterJenisPengajuan','pengajuan_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}
