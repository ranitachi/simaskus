<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class KerjaPraktek extends Model
{
        use SoftDeletes;
        protected $table='kerja_praktek';
        protected $fillable=['jenis_id','mahasiswa_id','file_riwayat_akademis','departemen_id','tahunajaran_id','waktu','nama_perusahaan','alamat_perusahaan','kontak_perusahaan','status_pengajuan','status_kp','balasan_surat','surat_pernyataan_selesai','created_at','updated_at','deleted_at'];
        
        function mahasiswa()
        {
            return $this->belongsTo('App\Model\Mahasiswa','mahasiswa_id');
        }
        function tahunajaran()
        {
            return $this->belongsTo('App\Model\TahunAjaran','tahunajaran_id');
        }
        function jenispengajuan()
        {
            return $this->belongsTo('App\Model\MasterJenisPengajuan','jenis_id');
        }
}
