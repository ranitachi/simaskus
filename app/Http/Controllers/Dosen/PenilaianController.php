<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PengajuanSkripsi;
use App\Model\JudulTugasAkhir;
use App\Model\Dosen;
use App\Model\MasterJenisPengajuan;
use App\Model\Pengajuan;
use App\Model\Users;
use App\Model\Jadwal;
use App\Model\Notifikasi;
use App\Model\PivotBimbingan;
use App\Model\PivotAccSidang;
use App\Model\PivotSetujuSidang;
use App\Model\PivotPenguji;
use App\Model\Component;
use Auth;
use DB;
class PenilaianController extends Controller
{
    public function index()
    {
        $aju=Pengajuan::where('status_pengajuan',2)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();
        $pengajuan=$jenis=array();
        foreach($aju as $ka=>$va)
        {
            if($va->status_pengajuan==2)
            {
                $pengajuan[$va->jenis_id][]=$va;
                $jenis[$va->jenis_id]=$va->jenispengajuan->jenis;
            }
        }
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->with('ruangan')
                    ->get();

        $jad=array();
        foreach($jadwal as $kj=>$vj)
        {
            $jad[$vj->judul_id]=$vj;
        }
        // dd($jad);
        $pivot=PivotBimbingan::all();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
        }

        $acc_sidang=PivotSetujuSidang::all();
        $acc_sid=array();
        foreach($acc_sidang as $k =>$v)
        {
            $acc_sid[$v->pengajuan_id][$v->dosen_id]=$v;
        }

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }
        // dd($pengajuan);
        return view('pages.dosen.penilaian.index')
                    ->with('acc_sid',$acc_sid)
                    ->with('pengajuan',$pengajuan)     
                    ->with('jadwal',$jad)
                    ->with('piv',$piv)
                    ->with('jenis',$jenis)
                    ->with('uji',$uji);

    }

    public function form($idjadwal,$idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();
        // dd(Auth::user()->id_user);
        return view('pages.dosen.penilaian.form',
            compact('pengajuan','jadwal','penilaian','uji'));
    }
    public function perbaikan($idjadwal,$idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();
        // dd(Auth::user()->id_user);
        return view('pages.dosen.penilaian.daftar-perbaikan',
            compact('pengajuan','jadwal','penilaian','uji'));
    }
    public function penetapan($idjadwal,$idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();
        // dd(Auth::user()->id_user);
        return view('pages.dosen.penilaian.penetapan-judul',
            compact('pengajuan','jadwal','penilaian','uji'));
    }
}
