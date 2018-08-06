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
class PengajuanSidangController extends Controller
{
    public function index()
    {
        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }   
         $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.dosen.sidang.index')
            ->with('dosen',$dosen)
            ->with('dept_id',$dept_id);
    }

    public function indexjadwal()
    {
        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }   
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.dosen.sidang.index-jadwal')
            ->with('dosen',$dosen)
            ->with('dept_id',$dept_id);
    }
    public function jadwal_sidang_dosen_data()
    {
        $aju=Pengajuan::where('status_pengajuan',2)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();
        $pengajuan=array();
        foreach($aju as $ka=>$va)
        {
            if($va->status_pengajuan==2)
            {
                $pengajuan[]=$va;
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
            // if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        return view('pages.dosen.sidang.jadwal')
                    ->with('acc_sid',$acc_sid)
                    ->with('pengajuan',$pengajuan)     
                    ->with('jadwal',$jad)
                    ->with('piv',$piv)
                    ->with('uji',$uji);
    }

    public function data()
    {
        $aju=Pengajuan::where('dospem1',Auth::user()->id_user)
                    ->orWhere('dospem2',Auth::user()->id_user)
                    ->orWhere('dospem3',Auth::user()->id_user)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();
        $pengajuan=array();
        foreach($aju as $ka=>$va)
        {
            if($va->status_pengajuan==1)
            {
                $pengajuan[]=$va;
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
            $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        return view('pages.dosen.sidang.data')
                    ->with('acc_sid',$acc_sid)
                    ->with('pengajuan',$pengajuan)     
                    ->with('jadwal',$jad)
                    ->with('piv',$piv)
                    ->with('uji',$uji);
    }

    public function setujui($id_pengajuan,$id_mahasiswa)
    {
        $pengajuan=Pengajuan::find($id_pengajuan);
        $setuju=PivotSetujuSidang::where('dosen_id',Auth::user()->id_user)->where('mahasiswa_id',$id_mahasiswa)->where('pengajuan_id',$id_pengajuan)->get();
        if($setuju->count()!=0)
        {
            $setuju->status=1;
            $setuju->save();
        }
        else
        {
            $stj=new PivotSetujuSidang;
            $stj->dosen_id=Auth::user()->id_user;
            $stj->mahasiswa_id=$id_mahasiswa;
            $stj->pengajuan_id=$id_pengajuan;
            $stj->status=1;
            $stj->save();
            // $stj->jenis_pengajuan=
        }
        return response()->json(['done']);
    }

    public function form_nilai($idjadwal,$idpengajuan)
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

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();

        return view('pages.dosen.sidang.form-nilai',compact('pengajuan','jadwal','penilaian'));
    }
}