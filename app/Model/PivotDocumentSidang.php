<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PivotDocumentSidang extends Model
{
    use SoftDeletes;
    protected $table = 'pivot_document_sidang';
    protected $fillable = ['dokumen','jenis_dokumen','mahasiswa_id','jenis_bimbingan','jadwal_id','status','created_at','updated_at','deleted_at'];
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal','jadwal_id');
    }
}
