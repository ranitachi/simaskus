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
use App\Model\Notifikasi;
use App\Model\PivotBimbingan;
use App\Model\Bimbingan;
use App\Model\PivotSetujuSidang;
use Auth;
class PengajuanBimbinganController extends Controller
{
    public function pengajuan()
    {
        $jenis='pengajuan';
        return view('pages.dosen.bimbingan.index',compact('jenis'));
    }
    public function daftar()
    {
        $jenis='daftar';
        return view('pages.dosen.bimbingan.index',compact('jenis'));
    }
    public function data($jenis)
    {
        $pivot=PivotBimbingan::where('dosen_id',Auth::user()->id_user)->get();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id]=$v;
        }
        $data=Pengajuan::where('dospem1',Auth::user()->id_user)
                ->orWhere('dospem2',Auth::user()->id_user)
                ->orWhere('dospem3',Auth::user()->id_user)
                ->get();
        // dd($data);

        $acc_sidang=PivotSetujuSidang::all();
        $acc_sid=array();
        foreach($acc_sidang as $k =>$v)
        {
            $acc_sid[$v->dosen_id][$v->mahasiswa_id]=$v;
        }

        return view('pages.dosen.bimbingan.data',compact('data','jenis','piv','acc_sid'));
    }
    public function status($id,$st)
    {
        //$data=Pengajuan::find($id);

        // $pivot=PivotBimbingan::where('mahasiswa_id',$data->mahasiswa_id)->where('dosen_id',Auth::user()->id_user)->first();
        $pivot=PivotBimbingan::find($id);
        $pivot->status=$st;
        $pivot->save();
        $id_user_mhs=Users::where('id_user',$pivot->mahasiswa_id)->first();
        
        $notif=new Notifikasi;
        $notif->title="Pengajuan Bimbingan Telah Di Setujui";
        $notif->from=Auth::user()->id;
        $notif->to=$id_user_mhs->id;
        $notif->flag_active=1;
        $notif->pesan="Dosen <b>".Auth::user()->name."</b> : Pengajuan Bimbingan Mahasiswa <u>".$id_user_mhs->name."</u> Sudah Setujui";
        $notif->save();

        return response()->json(['done']);
    }
    
    public function data_bimbingan_status($id,$st)
    {
        $data=Bimbingan::find($id);
        $data->flag=$st;
        $data->save();

        $pengajuan=Pengajuan::where('mahasiswa_id',$data->mahasiswa_id)->where('status_pengajuan',1)->first();

        $id_user_mhs=Users::where('id_user',$data->mahasiswa_id)->first();
        $notif=new Notifikasi;
        $notif->title="Data Bimbingan Telah DI Setujui";
        $notif->from=Auth::user()->id;
        $notif->to=$id_user_mhs->id;
        $notif->flag_active=1;
        $notif->pesan="Dosen : Data Bimbingan Mahasiswa <u>".$id_user_mhs->name."</u> Sudah Setujui<br>
        <a href='".url('pengajuan-detail/'.$pengajuan->id.'#tab_5_2')."'></a>";
        $notif->save();

        return response()->json(['done']);
    }

    public function detail($id,$mahasiswa_id)
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        $jenis='';
        $pengajuan=Pengajuan::find($id)
                ->with('jenispengajuan')
                ->with('mahasiswa')
                ->with('dospem_1')
                ->with('dospem_2')
                ->with('dospem_3')
                ->with('dosenketua')
                ->with('pembimbing_sebelum')
                ->orderBy('created_at','desc')->first();
        return view('pages.dosen.bimbingan.detail',compact('jenis','pengajuan','mp','jenis','id','mahasiswa_id'));
    }
    public function bimbingandata($id)
    {
        $bimbingan=Bimbingan::where('mahasiswa_id',$id)->with('dospem')->with('mahasiswa')->get();
        return view('pages.dosen.bimbingan.bimbingan-data',compact('bimbingan'));
    }
}