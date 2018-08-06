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
use App\Model\Jadwal;
use App\Model\PivotJadwal;
use App\Model\PivotPenguji;
use App\Model\PivotSetujuSidang;
use App\Model\Mahasiswa;
use App\Model\PivotDocumentSidang;
use Auth;
class DaftarSidangController extends Controller
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
        return view('pages.mahasiswa.sidang.index')
            ->with('dosen',$dosen)
            ->with('dept_id',$dept_id);
        ;
    }
    public function data()
    {
        $pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id_user)
                    ->where('status_pengajuan',1)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('pivot_jadwal.mahasiswa_id',Auth::user()->id_user)
                    ->with('ruangan')
                    ->get();

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

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
            $acc_sid[$v->mahasiswa_id][$v->dosen_id]=$v;
        }
        
        $dokumen=PivotDocumentSidang::where('mahasiswa_id',Auth::user()->id_user)->get();
        $dok=array();
        foreach($dokumen as $kd => $vd)
        {
            $dok[$vd->jenis_dokumen]=$vd;
        }

        return view('pages.mahasiswa.sidang.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('dok',$dok)
                    ->with('uji',$uji)
                    ->with('jadwal',$jadwal)
                    ->with('acc_sid',$acc_sid)
                    ->with('piv',$piv);
    }
    public function show($id)
    {
        $det=Pengajuan::find($id);
        $mhs=Mahasiswa::find(Auth::user()->id_user);
        $dosen=Dosen::where('departemen_id',$mhs->departemen_id)->get();
        return view('pages.mahasiswa.sidang.form',compact('id','det','dosen','mhs'));
    }
    public function update(Request $request, $idpengajuan)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('jenispengajuan')->first();
        $dospem=array();
        // dd($pengajuan->dospem1);
        // foreach($pengajuan as $pk => $vp)
        // {   
            if($pengajuan->dospem1!=0)
            {
                $dospem[$pengajuan->dospem1]=$pengajuan;
            }
            if($pengajuan->dospem2!=0)
            {
                $dospem[$pengajuan->dospem2]=$pengajuan;
            }
            if($pengajuan->dospem3!=0)
            {
                $dospem[$pengajuan->dospem3]=$pengajuan;
            }
        // }
        // dd($request->file('dokumen'));

        $jadwal=new Jadwal;
        $jadwal->departemen_id=$dept_id;
        $jadwal->jenis_jadwal=$pengajuan->jenispengajuan->jenis;
        $jadwal->created_at=date('Y-m-d H:i:s');
        $jadwal->updated_at=date('Y-m-d H:i:s');
        $jadwal->save();

        $id_jadwal=$jadwal->id;
        $pivot=new PivotJadwal;
        $pivot->jadwal_id=$id_jadwal;
        $pivot->mahasiswa_id=$pengajuan->mahasiswa_id;
        $pivot->judul_id=$idpengajuan;
        $pivot->status=0;
        $pivot->created_at=date('Y-m-d H:i:s');
        $pivot->updated_at=date('Y-m-d H:i:s');
        $pivot->save();

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Menunggu Verifikasi Pengajuan Sidang";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".Auth::user()->name." Melakukan Pengajuan Sidang, Harap Segera Di Verifikasi";
                $notif->save();
            }
        }

        foreach($request->penguji as $k => $v)
        {
            if($v!='-1')
            {
                $penguji=New PivotPenguji;
                $penguji->pivot_jadwal_id=$id_jadwal;
                $penguji->penguji_id=$v;
                $penguji->status=0;
                $penguji->save();

                // $notif=new Notifikasi;
                // $notif->title="Jadwal Sidang";
                // $notif->from=Auth::user()->id_user;
                // $notif->to=$dk;
                // $notif->flag_active=1;
                // $notif->pesan="Anda  : ".Auth::user()->name." Melakukan Pengajuan Sidang";
                // $notif->save();
            }
        }

        foreach($dospem as $dk => $vk)
        {
            $notif=new Notifikasi;
            $notif->title="Mahasiswa Melakukan Pengajuan Sidang";
            $notif->from=Auth::user()->id_user;
            $notif->to=$dk;
            $notif->flag_active=1;
            $notif->pesan="Mahasiswa : ".Auth::user()->name." Melakukan Pengajuan Sidang";
            $notif->save();
        }

        foreach($request->dokumen as $idx => $val)
        {
            $tipedata=$val->getClientOriginalExtension();
            list($dok,$type)=explode('_',$idx);
            if(strpos($type,'doc')!==false)
            {
                $val->storeAs('dokumen_doc',$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName());
                $dir='dokumen_doc/'.$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName(); 
            }
            elseif(strpos($type,'pdf')!==false)
            {
                $val->storeAs('dokumen_pdf',$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName());
                $dir='dokumen_pdf/'.$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName();
            }
            elseif(strpos($type,'ppt')!==false)
            {
                $val->storeAs('dokumen_ppt',$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName());
                $dir='dokumen_ppt/'.$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName();
            }
            else
            {
                $val->storeAs('dokumen_bimbingan',$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName());
                $dir='dokumen_bimbingan/'.$pengajuan->mahasiswa_id.'-'.date('ymd').'-'.$val->getClientOriginalName();
            }
            $dokumen=new PivotDocumentSidang;
            $dokumen->file=$dir;
            $dokumen->type=$tipedata;
            $dokumen->departemen_id=$dept_id;
            $dokumen->jenis_dokumen=$idx;
            $dokumen->pengajuan_id=$idpengajuan;
            $dokumen->mahasiswa_id=$pengajuan->mahasiswa_id;
            $dokumen->jadwal_id=$id_jadwal;
            $dokumen->save();
            // echo storage_path('app/public/'.$dir).'<br>';
        }

        return redirect('daftar-sidang')->with('status','Pengajuan Sidang Berhasil Di Simpan, Akan Segera Di Verifikasi Oleh Sekretariat');
    }
}
