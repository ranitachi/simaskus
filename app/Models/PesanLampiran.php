<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesanLampiran extends Model
{
    use SoftDeletes;

    protected $fillable=['pesan_id','nama_file','lokasi_file','created_at','updated_at','deleted_at'];

    function pesan()
    {
        return $this->belongsTo('App\Models\Pesan','pesan_id');
    }
}
