<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;
    protected $table = 'mahasiswa';
    protected $fillable = ['npm','nama','tempat_lahir','tanggal_lahir','gender','alamat','kota','email','hp','tahun_masuk','program_studi_id','departemen_id','created_at','updated_at','deleted_at'];

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
        return $this->hasOne('App\Model\Users','foreign_key','user_id');
    }
    function mahasiswa_user()
    {
        return $this->hasOne('App\User','foreign_key','user_id');
    }
}
