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
use App\Model\Component;
use App\Model\Mahasiswa;
use App\Model\ComponentScore;
use App\Model\EvaluasiACCSidang;
use Auth;
use DB;
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

        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if($user)
        {
            $dept_id=$user->dosen->departemen_id;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->join('master_jenis_pengajuan','master_jenis_pengajuan.id','=','module.jenis_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('master_jenis_pengajuan.jenis','like',"%Tugas Skripsi%")->get();

        $eval=EvaluasiACCSidang::where('dept_id',$dept_id)->where('mahasiswa_id',$mahasiswa_id)->where('pengajuan_id',$id)->where('dosen_id',Auth::user()->id_user)->get();
        $ev=array();
        foreach($eval as $ke => $ve)
        {
            $ev[$ve->component_id]=$ve;
        }

        $acc=PivotSetujuSidang::where('pengajuan_id',$id)->where('dosen_id',Auth::user()->id_user)->where('mahasiswa_id',$mahasiswa_id)->first();
        // dd($acc);
        $pengajuan=Pengajuan::where('id',$id)
                ->with('jenispengajuan')
                ->with('mahasiswa')
                ->with('dospem_1')
                ->with('dospem_2')
                ->with('dospem_3')
                ->with('tahunajaran')
                ->with('dosenketua')
                ->with('pembimbing_sebelum')
                ->orderBy('created_at','desc')->first();

        return view('pages.dosen.bimbingan.detail',compact('jenis','pengajuan','mp','jenis','id','mahasiswa_id','penilaian','ev','acc','eval'));
    }
    public function bimbingandata($id)
    {
        $bimbingan=Bimbingan::where('mahasiswa_id',$id)->with('dospem')->with('mahasiswa')->get();
        return view('pages.dosen.bimbingan.bimbingan-data',compact('bimbingan'));
    }

    public function simpan_form_evaluasi_skipsi(Request $request)
    {
        // dd($request->all());
        $pengajuan_id=$request->pengajuan_id;
        $mahasiswa_id=$request->mahasiswa_id;
        $mhs=Mahasiswa::find($mahasiswa_id);
        $dept_id=$request->dept_id;
        $dosen_id=$request->dosen_id;
        $catatan=$request->catatan;

        EvaluasiACCSidang::where('dept_id',$dept_id)->where('dosen_id',$dosen_id)->where('pengajuan_id',$pengajuan_id)->where('mahasiswa_id',$mahasiswa_id)->forceDelete();
        
        PivotSetujuSidang::where('dosen_id',$dosen_id)->where('pengajuan_id',$pengajuan_id)->where('mahasiswa_id',$mahasiswa_id)->forceDelete();
                
        if(isset($request->nilai))
        {
            $nilai=$request->nilai;
            $simpan=0;
            foreach($request->nilai as $idx=>$vl)
            {
                if($vl!=null)
                {
                    $insert=new EvaluasiACCSidang;
                    // echo $vl;
                    $ket=$request->keterangan[$idx];
                    $insert->pengajuan_id=$pengajuan_id;
                    $insert->mahasiswa_id=$mahasiswa_id;
                    $insert->dept_id=$dept_id;
                    $insert->dosen_id=$dosen_id;
                    $insert->component_id=$idx;
                    $insert->nilai=$vl;
                    $insert->keterangan=$ket;
                    $insert->catatan=$catatan;
                    $insert->save();
                    $simpan=1;
                }
            }

            if($simpan==1)
            {
                $acc=new PivotSetujuSidang;
                $acc->dosen_id	=$dosen_id;
                $acc->mahasiswa_id	=$mahasiswa_id;
                $acc->jenis_bimbingan	='Skripsi';
                $acc->pengajuan_id	=$pengajuan_id;
                $acc->status=1;
                $acc->save();
            }
            return redirect('bimbingan-detail/'.$pengajuan_id.'/'.$mahasiswa_id.'#tab_5_3')->with('status','Evaluasi Bimbingan Telah di Simpan, dan Mahasiswa '.$mhs->nama.' Telah Di Setujui untuk Mengajukan Sidang');
        }
        else
        {
            return redirect('bimbingan-detail/'.$pengajuan_id.'/'.$mahasiswa_id.'#tab_5_3')->with('fail','Evaluasi Bimbingan Gagal di Simpan');
        }


    }
}