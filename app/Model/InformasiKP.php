<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformasiKP extends Model
{
    use SoftDeletes;
    protected $table='informasi_k_p';
    protected $fillable=['judul','isi','departemen_id','grup_id','status','created_at','updated_at','deleted_at'];
    
    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
}
