<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgamStudi extends Model
{
    use SoftDeletes;
    protected $table = 'progam_studis';
    protected $fillable = ['code','nama_program_studi','departemen_id','keterangan','pimpinan_id','created_at','updated_at','deleted_at'];

    function pimpinan()
    {
        return $this->belongsTo('App\Model\Dosen','pimpinan_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
}


