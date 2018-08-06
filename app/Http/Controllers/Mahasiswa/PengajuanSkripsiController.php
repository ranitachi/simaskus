<?php

namespace App\Http\Controllers\Mahasiswa;
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
use App\Model\Mahasiswa;
use App\Model\TahunAjaran;
use Auth;
class PengajuanSkripsiController extends Controller
{
    public function index()
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }   
         $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.mahasiswa.pengajuan.index')
            ->with('dosen',$dosen)
            ->with('dept_id',$dept_id);
    }
    public function data()
    {
        $pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id_user)
                    ->with('jenispengajuan')
                    ->with('tahunajaran')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();
                    
        $pivot=PivotBimbingan::all();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
        }
        return view('pages.mahasiswa.pengajuan.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('piv',$piv);
    }
    public function show($id)
    {
        $det=array();
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        $mhs=Mahasiswa::find(Auth::user()->id_user);
        $dosen=Dosen::where('departemen_id',$mhs->departemen_id)->get();
        $judul=JudulTugasAkhir::all();
        $jenispengajuan=MasterJenisPengajuan::all();
        if($id!=-1)
            $det=Pengajuan::where('id',$id)->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')->first();

        return view('pages.mahasiswa.pengajuan.form')
                ->with('judul',$judul)
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('ta',$ta)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
    }

    public function store(Request $request)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        $jns_pengajuan=$mp[$request->jenis_id]->jenis;

        $pengajuan=new Pengajuan;
        $pengajuan->jenis_id=$request->jenis_id;
        $pengajuan->ipk_terakhir=str_replace(array(',','.'),'.',$request->ipk_terakhir);
        $pengajuan->jumlah_sks_lulus=$request->jumlah_sks_lulus;
        $pengajuan->topik_diajukan=$request->topik_diajukan;
        $pengajuan->bidang=$request->bidang;
        $pengajuan->tahunajaran_id=$request->tahun_ajaran;
        $pengajuan->skema=$request->skema;
        $pengajuan->judul_ind=$request->judul_ind;
        $pengajuan->judul_eng=$request->judul_eng;
        $pengajuan->deskripsi_rencana=$request->deskripsi_rencana;
        $pengajuan->abstrak_ind=$request->abstrak_ind;
        $pengajuan->abstrak_eng=$request->abstrak_eng;
        $pengajuan->pengambilan_ke=$request->pengambilan_ke;
        $pengajuan->dospem1=$request->dospem1;
        $pengajuan->dospem2=$request->dospem2;
        $pengajuan->dospem3=$request->dospem3;
        $pengajuan->dosen_ketua=$request->dosen_ketua;
        $pengajuan->pembimbing_sebelumnya=$request->pembimbing_sebelumnya;
        $pengajuan->alasan_mengulang=$request->alasan_mengulang;
        $pengajuan->status_pengajuan=0;
        $pengajuan->departemen_id=$dept_id;
        $pengajuan->mahasiswa_id=Auth::user()->id_user;
        $pengajuan->created_at=date('Y-m-d H:i:s');
        $pengajuan->updated_at=date('Y-m-d H:i:s');
        $pengajuan->save();

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Menunggu Verifikasi Pengajuan";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".$user->name." Melakukan Pengajuan, Harap Segera Di Verifikasi<br>
                <a href=''>Klik Disini</a>";
                $notif->save();
            }
        }

        $dospem[0]=$request->dospem1;
        $dospem[1]=$request->dospem2;
        $dospem[2]=$request->dospem3;
        foreach($dospem as $k=>$v)
        {
            if($v!='')
            {
                $pivot=new PivotBimbingan;
                $pivot->dosen_id=$v;
                $pivot->mahasiswa_id=Auth::user()->id_user;
                $pivot->jenis_bimbingan=$jns_pengajuan;
                $pivot->status=0;
                $pivot->created_at=date('Y-m-d H:i:s');
                $pivot->updated_at=date('Y-m-d H:i:s');
                $pivot->save();

                $u_id=Users::where('id_user',$v)->where('kat_user',2)->first();
                $notif=new Notifikasi;
                $notif->title="Pengajuan Dosen Pembimbing";
                $notif->from=Auth::user()->id;
                $notif->to=$u_id->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".$user->name." Mengajukan untuk menjadi Dosen Pembimbing ".ucwords($jns_pengajuan);
                $notif->save();
            }
        }

        return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Diinput, dan Akan Segera Di Verifikasi Oleh Sekretariat');
    }
    
    public function update(Request $request,$id)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $pengajuan= Pengajuan::find($id);
        $pengajuan->jenis_id=$request->jenis_id;
        $pengajuan->ipk_terakhir=str_replace(array(',','.'),'.',$request->ipk_terakhir);
        $pengajuan->jumlah_sks_lulus=$request->jumlah_sks_lulus;
        $pengajuan->topik_diajukan=$request->topik_diajukan;
        $pengajuan->bidang=$request->bidang;
        $pengajuan->skema=$request->skema;
        $pengajuan->judul_ind=$request->judul_ind;
        $pengajuan->judul_eng=$request->judul_eng;
        $pengajuan->deskripsi_rencana=$request->deskripsi_rencana;
        $pengajuan->abstrak_ind=$request->abstrak_ind;
        $pengajuan->abstrak_eng=$request->abstrak_eng;
        $pengajuan->pengambilan_ke=$request->pengambilan_ke;
        $pengajuan->dospem1=$request->dospem1;
        $pengajuan->dospem2=$request->dospem2;
        $pengajuan->dospem3=$request->dospem3;
        $pengajuan->dosen_ketua=$request->dosen_ketua;
        $pengajuan->pembimbing_sebelumnya=$request->pembimbing_sebelumnya;
        $pengajuan->alasan_mengulang=$request->alasan_mengulang;
        $pengajuan->status_pengajuan=0;
        $pengajuan->departemen_id=$dept_id;
        $pengajuan->mahasiswa_id=Auth::user()->id_user;
        $pengajuan->updated_at=date('Y-m-d H:i:s');
        $pengajuan->save();

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $wh="Mahasiswa : ".$user->name." Melakukan Pengajuan, Harap Segera Di Verifikasi";
                $notif=Notifikasi::where('pesan','like',$wh)->first();
                $notif->title="Menunggu Verifikasi Perbaikan Pengajuan";
                $notif->from=Auth::user()->id;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".$user->name." Melakukan Perbaikan Pengajuan, Harap Segera Di Verifikasi";
                $notif->save();
            }
        }

        return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Edit, dan Akan Segera Di Verifikasi Oleh Sekretariat');
    }

    public function destroy($id)
    {
        $pengajuan= Pengajuan::find($id)->delete();
        // return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Hapus');
        return response()->json(['done']);
    } 

    public function detail($id)
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
        return view('pages.mahasiswa.pengajuan.detail',compact('jenis','pengajuan','mp','jenis','id'));
    }
}
