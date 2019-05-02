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
use App\Model\QuotaPenguji;
use App\Model\Publikasi;
use App\Model\KalenderAkademik;
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
        $det=$kolom_topik=$dospem=array();
        $dept_id=0;
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
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
        // dd($jadwal[0]);
        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pengajuan_id][$v->mahasiswa_id][$v->penguji_id]=$v;
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
            $acc_sid[$v->pengajuan_id][$v->mahasiswa_id][$v->dosen_id]=$v;
        }
        
        $dokumen=PivotDocumentSidang::where('mahasiswa_id',Auth::user()->id_user)->get();
        $dok=array();
        foreach($dokumen as $kd => $vd)
        {
            $dok[$vd->jenis_dokumen]=$vd;
        }
        // dd($jadwal);
        $tahun=date('Y-m-d');
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->whereDate('start_date','<=',$tahun)->whereDate('end_date','>=',$tahun)->get();
        $kalender=array();
        foreach($kal as $val)
        {
            $kalender[$val->kategori_khusus]=$val;
        }
        
        return view('pages.mahasiswa.sidang.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('kalender',$kalender)
                    ->with('dok',$dok)
                    ->with('uji',$uji)
                    ->with('jadwal',$jadwal)
                    ->with('acc_sid',$acc_sid)
                    ->with('piv',$piv);
    }
    public function show($id)
    {
        $idmhs=Auth::user()->id_user;
        $det=Pengajuan::where('id',$id)->with('jenispengajuan')->first();
        $mhs=Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
        $dosen=Dosen::where('departemen_id',$mhs->departemen_id)->get();

        $p_uji=PivotPenguji::where('mahasiswa_id',$idmhs)->with('dosen')->with('mahasiswa')->get();
        $penguji=array();
        foreach($p_uji as $k =>$v)
        {
            $penguji[$v->pengajuan_id][$v->penguji_id]=$v;
        }

        $quota_penguji=QuotaPenguji::where('departemen_id',$mhs->departemen_id)->get();
        $q_penguji=array();
        foreach($quota_penguji as $k=>$vq)
        {
            $q_penguji[$vq->level]=$vq;
        }

        $jlhpenguji=5;
        if(strpos($mhs->programstudi->nama_program_studi,'S1')!==false)
        {
            if(isset($q_penguji['S1']))
                $jlhpenguji=$q_penguji['S1']->quota;
        }
        elseif(strpos($mhs->programstudi->nama_program_studi,'S2')!==false)
        {
            if(isset($q_penguji['S2']))
                $jlhpenguji=$q_penguji['S2']->quota;
        }
        elseif(strpos($mhs->programstudi->nama_program_studi,'S3')!==false)
        {
            if(isset($q_penguji['S3']))
                $jlhpenguji=$q_penguji['S3']->quota;
        }

        return view('pages.mahasiswa.sidang.form',compact('id','det','dosen','mhs','q_penguji','jlhpenguji','penguji'));
    }
    public function update(Request $request, $idpengajuan)
    {
        // dd($request->all());
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        if(isset($request->dynamic_form))
        {
            $post=$request->dynamic_form;
            // dd($post['dynamic_form']);
            foreach($post['dynamic_form'] as $kd=>$vdf)
            {

                $val_publ=$vdf['file'];
                $val_publ->storeAs('publikasi',$val_publ->getClientOriginalName());
                $dir_publ='publikasi/'.$val_publ->getClientOriginalName(); 

                $Publ=new Publikasi;
                $Publ->judul = $vdf['judul'];
                $Publ->pengajuan_id = $idpengajuan;
                $Publ->mahasiswa_id = Auth::user()->id_user;
                $Publ->url = $vdf['url'];
                $Publ->penulis = $vdf['penulis'];
                $Publ->lokasi_publikasi = $vdf['lokasi'];
                $Publ->file = $dir_publ;
                $Publ->save();
            }
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

        if(isset($request->penguji))
        {
            foreach($request->penguji as $k => $v)
            {
                if($v!='-1')
                {
                    // $penguji=New PivotPenguji;
                    // $penguji->pivot_jadwal_id=$id_jadwal;
                    // $penguji->penguji_id=$v;
                    // $penguji->status=0;
                    // $penguji->save();

                    // $notif=new Notifikasi;
                    // $notif->title="Jadwal Sidang";
                    // $notif->from=Auth::user()->id_user;
                    // $notif->to=$dk;
                    // $notif->flag_active=1;
                    // $notif->pesan="Anda  : ".Auth::user()->name." Melakukan Pengajuan Sidang";
                    // $notif->save();
                }
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

        // nilai_ielts
        // file_ielts

        if(isset($request->nilai_ielts))
        {
            $val_ielts=$request->file_ielts;
            $val_ielts->storeAs('ielts',$val->getClientOriginalName());
            $dir_ielts='ielts/'.$val->getClientOriginalName(); 
            
            $pengajuan->ielts=$request->nilai_ielts;
            $pengajuan->file_ielts-$dir_ielts;
            $pengajuan->save();
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
