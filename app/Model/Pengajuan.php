<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use SoftDeletes;
    protected $table='pengajuan';
    protected $fillable=['jenis_id' ,'ipk_terakhir' ,'jumlah_sks_lulus' ,'mahasiswa_id','topik_diajukan' ,'bidang' ,'skema' ,'judul_ind' ,'judul_eng' ,'deskripsi_rencana' ,'abstrak_ind' ,'abstrak_eng' ,'pengambilan_ke','dospem1','dospem2','dospem3','dosen_ketua','pembimbing_sebelumnya','status_pengajuan','alasan_mengulang','departemen_id','tahunajaran_id','created_at','updated_at','deleted_at'];
  
    function tahunajaran()
    {
        return $this->belongsTo('App\Model\TahunAjaran','tahunajaran_id');
    }
    function jenispengajuan()
    {
        return $this->belongsTo('App\Model\MasterJenisPengajuan','jenis_id');
    }
    function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
    }
    function dospem_1()
    {
        return $this->belongsTo('App\Model\Dosen','dospem1');
    }
    function dospem_2()
    {
        return $this->belongsTo('App\Model\Dosen','dospem2');
    }
    function dospem_3()
    {
        return $this->belongsTo('App\Model\Dosen','dospem3');
    }
    function dosenketua()
    {
        return $this->belongsTo('App\Model\Dosen','dosen_ketua');
    }
    function pembimbing_sebelum()
    {
        return $this->belongsTo('App\Model\Dosen','pembimbing_sebelumnya');
    }

}
