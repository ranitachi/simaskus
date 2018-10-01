<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    protected $table='module';
    protected $fillable=['code_module','nama_module','bobot_module','jenis_id','departemen_id','created_at','updated_at'];

    function jenis()
    {
        return $this->belongsTo('App\Model\MasterJenisPengajuan','jenis_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}
