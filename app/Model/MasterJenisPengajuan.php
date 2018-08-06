<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJenisPengajuan extends Model
{
    use SoftDeletes;
    protected $table = 'master_jenis_pengajuan';
    protected $fillable = ['code','jenis','keterangan','created_at','updated_at','deleted_at'];
}