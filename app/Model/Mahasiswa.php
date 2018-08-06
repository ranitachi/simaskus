<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;
    protected $table = 'mahasiswa';
    protected $fillable = ['npm','nama','tempat_lahir','tanggal_lahir','gender','alamat','kota','email','hp','tahun_masuk','program_studi_id','departemen_id','jenjang_id','created_at','updated_at','deleted_at'];

    function departemen()
    {
        return $this->belongsTo('App\Model\MasterDepartemen','departemen_id');
    }
    function programstudi()
    {
        return $this->belongsTo('App\Model\ProgamStudi','program_studi_id');
    }

    function mahasiswa()
    {
        return $this->hasOne('App\Model\Users','id_user');
    }
    function mahasiswa_user()
    {
        return $this->hasOne('App\User','id_user');
    }
    function jenjang()
    {
        return $this->belongsTo('App\Model\ProgamStudi','jenjang_id');
    }
}
