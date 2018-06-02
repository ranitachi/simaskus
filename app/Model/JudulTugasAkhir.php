<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JudulTugasAkhir extends Model
{
    use SoftDeletes;
    protected $table = 'judul_tugas_akhir';
    protected $fillable = ['code','judul','jenis','dosen_id','departemen_id','kategori','staf_id','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }

    function staf()
    {
        return $this->belongsTo('App\Staf','staf_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
}

