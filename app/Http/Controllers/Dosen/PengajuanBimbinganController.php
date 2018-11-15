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
use App\Model\PivotPembimbing;
use App\Model\Component;
use App\Model\Mahasiswa;
use App\Model\ComponentScore;
use App\Model\EvaluasiACCSidang;
use App\Model\PivotPenguji;
use App\Model\QuotaPenguji;
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
        $pivot_pengajuan_id=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id]=$v;
            $pivot_pengajuan_id[$v->judul_id]=$v->judul_id;
        }
        $data=Pengajuan::whereIn('id',$pivot_pengajuan_id)
                ->with('jenispengajuan')
                ->get();
        // dd($data);

        $acc_sidang=PivotSetujuSidang::all();
        $acc_sid=array();
        foreach($acc_sidang as $k =>$v)
        {
            $acc_sid[$v->dosen_id][$v->mahasiswa_id]=$v;
            // $acc_sid2[$v->mahasiswa_id][$v->dosen_id]=$v;
        }

        $p_uji=PivotPenguji::with('dosen')->with('mahasiswa')->get();
        $penguji=array();
        foreach($p_uji as $k =>$v)
        {
            $penguji[$v->mahasiswa_id][$v->penguji_id]=$v;
        }
        return view('pages.dosen.bimbingan.data',compact('data','jenis','piv','acc_sid','penguji'));
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
        // dd($penilaian);
        $eval=EvaluasiACCSidang::where('dept_id',$dept_id)->where('mahasiswa_id',$mahasiswa_id)->where('pengajuan_id',$id)->where('dosen_id',Auth::user()->id_user)->get();
        $ev=array();
        foreach($eval as $ke => $ve)
        {
            $ev[$ve->component_id]=$ve;
        }

        $dosen=Dosen::where('departemen_id',$dept_id)->get();

        $acc=PivotSetujuSidang::where('pengajuan_id',$id)->where('dosen_id',Auth::user()->id_user)->where('mahasiswa_id',$mahasiswa_id)->first();
        // dd($acc);

        $quota_penguji=QuotaPenguji::where('departemen_id',$dept_id)->get();
        // dd($quota_penguji);
        $q_penguji=array();
        foreach($quota_penguji as $k=>$vq)
        {
            $q_penguji[$vq->level]=$vq;
        }

        $pivotPenguji=PivotPenguji::where('pengajuan_id',$id)->get();
        $piv_uji=array();
        $no=1;
        foreach($pivotPenguji as $kp =>$vp)
        {
            $piv_uji[$vp->mahasiswa_id][$no]=$vp;
            $no++;
        }

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

        return view('pages.dosen.bimbingan.detail',compact('jenis','pengajuan','mp','jenis','id','mahasiswa_id','penilaian','ev','acc','eval','dosen','q_penguji','piv_uji'));
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
            return redirect('bimbingan-detail/'.$pengajuan_id.'/'.$mahasiswa_id.'#tab_5_4')->with('status','Evaluasi Bimbingan Telah di Simpan, dan Mahasiswa '.$mhs->nama.' Telah Di Setujui untuk Mengajukan Sidang. Silahkan Mengusulkan Nama Dosen Penguji');
        }
        else
        {
            return redirect('bimbingan-detail/'.$pengajuan_id.'/'.$mahasiswa_id.'#tab_5_3')->with('fail','Evaluasi Bimbingan Gagal di Simpan');
        }


    }

    public function simpan_data_penguji(Request $request,$id,$mahasiswa_id)
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        $jenis='';

        $user=Users::where('id_user',$mahasiswa_id)->with('mahasiswa')->first();
        $dept_id=0;
        if($user)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
        // dd($request->all());
        PivotPenguji::where('pengajuan_id',$id)->forceDelete();


        foreach($request->penguji as $id_p=>$v_p)
        {
            $pivot=new PivotPenguji;
            $pivot->pivot_jadwal_id=0;
            $pivot->penguji_id=$v_p;
            $pivot->mahasiswa_id=$mahasiswa_id;
            $pivot->pengajuan_id=$id;
            $pivot->status=0;
            $pivot->save();
        }
        return redirect('bimbingan-detail/'.$id.'/'.$mahasiswa_id.'#tab_5_4')->with('status','Nama Usulan Penguji Berhasil Di Tambahkan');
    }

    public function hapus_data_penguji($dosen_id,$id)
    {
        PivotPenguji::where('penguji_id',$dosen_id)->where('id',$id)->first()->delete();
        echo 1;
    }

    public function pengajuan_acc_dosen()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        elseif(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }

        $pengajuan=Pengajuan::where('departemen_id',$dept_id)
                    ->where('status_pengajuan',1)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('tahunajaran')
                    ->orderBy('created_at')->get();

        $pembimbing=PivotBimbingan::all();
        $pemb=array();
        foreach($pembimbing as $k=>$v)
        {
            $pemb[$v->mahasiswa_id][$v->dosen_id]=$v;
        }
        
        $setujusidang=PivotSetujuSidang::all();
        $setuju=array();
        foreach($setujusidang as $k=>$v)
        {
            $setuju[$v->pengajuan_id][$v->dosen_id]=$v;
        }
        

        foreach($pengajuan as $k=>$v)
        {
            if(isset($pemb[$v->mahasiswa_id]))
            {
                foreach($pemb[$v->mahasiswa_id] as $iddosen=>$val)
                {
                    if(!isset($setuju[$v->id][$iddosen]))
                    {
                        // echo 'Akan Di Acc<nr>';
                        $piv=new PivotSetujuSidang;
                        $piv->dosen_id=$iddosen;
                        $piv->mahasiswa_id=$v->mahasiswa_id;
                        $piv->jenis_bimbingan=$v->jenispengajuan->jenis;
                        $piv->pengajuan_id=$v->id;
                        $piv->status=1;
                        $piv->save();
                    }
                }
            }
        }
        return response()->json(['done']);
    }
}
