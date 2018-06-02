<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PengajuanSkripsi;
use App\Model\JudulTugasAkhir;
use App\Model\Dosen;
use App\Model\MasterJenisPengajuan;
use Auth;
class PengajuanSkripsiController extends Controller
{
    public function index()
    {
        return view('pages.mahasiswa.pengajuan.index');
    }
    public function data()
    {
        $pengajuan=PengajuanSkripsi::where('mahasiswa_id',Auth::user()->id_user)->orderBy('tanggal_pengajuan')->get();
        return view('pages.mahasiswa.pengajuan.data')->with('pengajuan',$pengajuan);
    }
    public function show($id)
    {
        $dosen=Dosen::all();
        $judul=JudulTugasAkhir::all();
        $jenispengajuan=MasterJenisPengajuan::all();
        return view('pages.mahasiswa.pengajuan.form')
                ->with('judul',$judul)
                ->with('dosen',$dosen)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
    }
}
