<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembimbingKP extends Model
{
    use SoftDeletes;
    protected $table = 'pembimbing_k_p';
    protected $fillable = ['dosen_id','mahasiswa_id','departemen_id','grup_id','kategori','nama','status','created_at','updated_at','deleted_at'];

    function dosen()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function kelompok()
    {
        return $this->belongsTo('App\Model\KelompokKP','grup_id');
    }
    function departemen()
    {
        return $this->belongsTo('App\MasterDepartemen','departemen_id');
    }
}
