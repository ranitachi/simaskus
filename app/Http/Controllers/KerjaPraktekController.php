<?php

namespace App\Http\Controllers;

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
use App\Model\MasterRuangan;
use App\Model\TahunAjaran;
use App\Model\KerjaPraktek;
use App\Model\KelompokKP;
use App\Model\PembimbingKP;
use App\Model\ProgamStudi;
use App\Model\JadwalSidangKP;
use App\Model\InformasiKP;
use App\Model\PengujiKP;
use App\Model\MasterPimpinan;
use App\Model\MasterDepartemen;
use Auth;
use PDF;
class KerjaPraktekController extends Controller
{
    //
    public function index()
    {
        $level=Auth::user()->kat_user;
        if($level==3)
        {
            return view('pages.mahasiswa.kerja-praktek.index');
        }
        else if($level==1)
        {
            return view('pages.staf.kerja-praktek.index');
        }
    }

    public function data()
    {
        $level=Auth::user()->kat_user;
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        if($level==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
        elseif($level==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

       $jdwl=JadwalSidangKP::where('departemen_id',$dept_id)->get();
       $jadwal=array();
       foreach($jdwl as $kj=>$vj)
       {
            $jadwal[$vj->id_grup][]=$vj;
       }

        if($level==3)
        {
            $pengajuan=KerjaPraktek::where('mahasiswa_id',Auth::user()->id_user)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->orderBy('created_at')->get();
                        
            $pivot=PivotBimbingan::all();
            $piv=array();
            foreach($pivot as $k =>$v)
            {
                $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
            }

            $grup=KelompokKP::where('departemen_id',$dept_id)->with('mahasiswa')->get();
            $idgrup='-1';
            $ketua=0;
            foreach($grup as $k=>$v)
            {
                // echo $v->mahasiswa_id.':'.Auth::user()->id.'<br>';
                if($v->mahasiswa_id==Auth::user()->id_user)
                {
                    $idgrup=$v->code;
                    if($v->kategori=='ketua')
                        $ketua=1;
                    else
                        $ketua=0;
                }
            }
            $grupkp=array();
            foreach($grup as $kg=>$vg)
            {          
                if($vg->code==$idgrup)
                {
                    $grupkp[]=$vg;
                }
            }

            
            // dd($grupkp);
            return view('pages.mahasiswa.kerja-praktek.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('ketua',$ketua)
                    ->with('jadwal',$jadwal)
                    ->with('grupkp',$grupkp)
                    ->with('piv',$piv);
        }
        else if($level==1)
        {
            $pengajuan=KerjaPraktek::where('departemen_id',$dept_id)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->orderBy('created_at')
                        ->get();
                        
                        
            $pivot=PivotBimbingan::all();
            $piv=array();
            foreach($pivot as $k =>$v)
            {
                $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
            }

            $grup=KelompokKP::where('departemen_id',$dept_id)->with('mahasiswa')->get();
            $idgrup='-1';
            $ketua=0;
            foreach($grup as $k=>$v)
            {
                $idgrup=$v->code;
            }
            $grupkp=array();
            foreach($grup as $kg=>$vg)
            {          
                $grupkp[$vg->mahasiswa_id][$vg->code]=$vg;
            }

            $info=InformasiKP::where('departemen_id',$dept_id)->get();
            $infokp=array();
            foreach($info as $kg=>$vg)
            {          
                $infokp[$vg->grup_id][str_slug($vg->judul)]=$vg;
            }
            // dd($infokp);
            return view('pages.staf.kerja-praktek.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('ketua',$ketua)
                    ->with('infokp',$infokp)
                    ->with('grupkp',$grupkp)
                    ->with('jadwal',$jadwal)
                    ->with('piv',$piv);
        }
    }

    public function form($id,$kat_user)
    {
        $det=array();
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        $mhs=Mahasiswa::find(Auth::user()->id_user);
        $dosen=Dosen::where('departemen_id',$mhs->departemen_id)->get();
        $judul=JudulTugasAkhir::all();
        $jenispengajuan=MasterJenisPengajuan::all();
        if($id!=-1)
            $det=KerjaPraktek::where('id',$id)
                    ->with('jenispengajuan')
                    ->with('tahunajaran')
                    ->with('mahasiswa')->first();

        return view('pages.mahasiswa.kerja-praktek.form')
                ->with('judul',$judul)
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('ta',$ta)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
    }
    public function detail($id,$kat_user)
    {
        $level=Auth::user()->kat_user;
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        if($level==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
        elseif($level==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $det=array();
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        $mhs=Mahasiswa::find(Auth::user()->id_user);
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        $judul=JudulTugasAkhir::all();

        $jenispengajuan=MasterJenisPengajuan::all();
        
        $det=KerjaPraktek::where('id',$id)
                    ->with('jenispengajuan')
                    ->with('tahunajaran')
                    ->with('mahasiswa')->first();

        $grup=KelompokKP::where('departemen_id',$dept_id)->with('mahasiswa')->get();
        $idgrup='-1';
        $ketua=0;

        $anggota=KerjaPraktek::where([
            'status_pengajuan'=>1,
            'departemen_id'=>$dept_id
            ])->with('mahasiswa')->get();

        foreach($grup as $k=>$v)
        {
            // echo $v->mahasiswa_id.':'.Auth::user()->id.'<br>';
            if($v->mahasiswa_id==Auth::user()->id_user)
            {
                $idgrup=$v->code;
                if($v->kategori=='ketua')
                    $ketua=1;
                else
                    $ketua=0;
            }

            if(Auth::user()->kat_user==1)
                $idgrup=$v->code;
        }
        // return $idgrup;
        $grupkp=array();
        foreach($grup as $kg=>$vg)
        {          
            if($vg->code==$idgrup)
            {
                $grupkp[]=$vg;
            }
        }
        $level=Auth::user()->kat_user;
        $info=array();
        $informasi=InformasiKP::where(['departemen_id'=>$dept_id,'grup_id'=>$idgrup])->get();
        foreach($informasi as $k=>$v)
        {
            $info[str_slug($v->judul)]=$v;
        }
        
        $pembimbing=PembimbingKP::where('grup_id',$idgrup)->with('dosen')->get();
        $pemb=array();
        foreach($pembimbing as $k=>$vv)
        {
            if($vv->kategori=='dosen')
                $pemb[$vv->kategori][$vv->dosen_id]=$vv;
            else
                $pemb[$vv->kategori][]=$vv;

        }
        
        $penguji_kp=PengujiKP::where('grup_id',$idgrup)->where('departemen_id',$dept_id)->with('dosen')->get();
        // $peng_kp=array();
        // foreach($pembimbing as $k=>$vv)
        // {
        //     $pemb[$vv->kategori][]=$vv;
        // }

        $jdwl=JadwalSidangKP::where('departemen_id',$dept_id)->get();
        $jadwal=array();
        foreach($jdwl as $kj=>$vj)
        {
            $jadwal[$vj->id_grup][]=$vj;
        }

        $ruangan=MasterRuangan::where('departemen_id',$dept_id)->with('departemen')->get();

        if($level==3)
        {
            return view('pages.mahasiswa.kerja-praktek.detail')
                ->with('judul',$judul)
                ->with('ketua',$ketua)
                ->with('pemb',$pemb)
                ->with('ruangan',$ruangan)
                ->with('det',$det)
                ->with('anggota',$anggota)
                ->with('info',$info)
                ->with('dosen',$dosen)
                ->with('grupkp',$grupkp)
                ->with('dept_id',$dept_id)
                ->with('jadwal',$jadwal)
                ->with('ta',$ta)
                ->with('idgrup',$idgrup)
                ->with('penguji_kp',$penguji_kp)
                ->with('kat_user',$kat_user)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
        }   
        else if($level==1)
        {
            return view('pages.staf.kerja-praktek.detail')
                ->with('judul',$judul)
                ->with('ketua',$ketua)
                ->with('pemb',$pemb)
                ->with('det',$det)
                ->with('ruangan',$ruangan)
                ->with('anggota',$anggota)
                ->with('info',$info)
                ->with('dosen',$dosen)
                ->with('grupkp',$grupkp)
                ->with('dept_id',$dept_id)
                ->with('ta',$ta)
                ->with('idgrup',$idgrup)
                ->with('penguji_kp',$penguji_kp)
                ->with('kat_user',$kat_user)
                ->with('jadwal',$jadwal)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
        }        
        
    }

    public function proses(Request $request,$id)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
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
        $idpengajuan=-1;
        

        // $file=$request->bukti_bimbingan;
        // $tipedata=$file->getClientOriginalExtension();
        // $nama_file='kp-'.Auth::user()->id_user.'-'.date('ymd').'-'.$file->getClientOriginalName();
        // $file->storeAs('dokumen_pdf',$nama_file);
        // $dir='dokumen_pdf/'.$nama_file; 
        $dir='';
        $pengajuan=new KerjaPraktek;
        $pengajuan->jenis_id=$request->jenis_id;
        $pengajuan->mahasiswa_id=Auth::user()->id_user;
        $pengajuan->file_riwayat_akademis=$dir;
        $pengajuan->departemen_id=$dept_id;
        $pengajuan->status_pengajuan=0;
        $pengajuan->tahunajaran_id=$request->tahun_ajaran;
        $pengajuan->save();

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        $idpengajuan=$pengajuan->id;
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Menunggu Verifikasi Pengajuan Kerja Praktek";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : <b><u>".$user->name."</u></b> Melakukan Pengajuan Kerja Praktek, Harap Segera Di Verifikasi <br> 
                <a href='".url('data-kp-detail/'.$idpengajuan.'/-1')."'>Klik Disini</a>";
                $notif->save();
            }
        }

        return redirect('data-kp')->with('status','Pengajuan Kerja Praktek Anda Berhasil Di Simpan, Akan Segera Di Verifikasi Oleh Sekretariat.');
        // dd($dir);
        // dd($request->all());
    }

    public function verifikasi($id,$status)
    {
        $pengajuan= KerjaPraktek::where('id',$id)->with('mahasiswa')->first();
        $pengajuan->status_pengajuan=$status;
        $pengajuan->save();
        // dd($pengajuan->mahasiswa->mahasiswa_user);
        if($status==1)
        {
            $mhs=Users::where('kat_user',3)->where('id_user',$pengajuan->mahasiswa->id)->first();
            $notif=new Notifikasi;
            $notif->title="Pengajuan Kerja Praktek Telah Di Verifikasi";
            $notif->from=Auth::user()->id_user;
            $notif->to=$mhs->id;
            $notif->flag_active=1;
            $notif->pesan="Pengajuan Kerja Praktek Anda telah Di Verifikasi dan Diterima Oleh Sekretariat, anda sudah dapat menambah grup dan melengkapi data Kerja Praktek Anda <br> 
            <a href='".url('data-kp')."'>Klik Disini</a>";
            $notif->save();
        }

        // return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Hapus');
        return response()->json(['done']);
    }

    public function destroy($id)
    {
        $pengajuan= KerjaPraktek::find($id)->delete();
        // return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Hapus');
        return response()->json(['done']);
    }

    public function grup_kp($idkp,$idmhs,$idgrup=-1)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $kp=KerjaPraktek::where('id',$idkp)->with('mahasiswa')->first();
        $mhs=Users::where('kat_user',3)->where('id_user',$idmhs)->with('mahasiswa')->first();
        $dosen=Dosen::where('departemen_id',$mhs->mahasiswa->departemen_id)->get();
        $anggota=KerjaPraktek::where([
            'status_pengajuan'=>1,
            'departemen_id'=>$dept_id
            ])->with('mahasiswa')->get();
        // dd($dosen);
        $det=array();
        if($idgrup!=0)
        {
            $det=KelompokKP::find($idgrup);
        }
        return view('pages.mahasiswa.kerja-praktek.form-grup')
                ->with('det',$det)
                ->with('anggota',$anggota)
                ->with('kp',$kp)
                ->with('idkp',$idkp)
                ->with('id',$idgrup)
                ->with('dosen',$dosen)
                ->with('idmhs',$idmhs)
                ->with('mhs',$mhs);
    }

    public function grup_kp_simpan(Request $request,$idkp,$idmhs,$idgrup=-1)
    {
        // dd($request->all());
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $c=abs(crc32(sha1(rand())));
        $code=substr($c,0,7);
        $nm_grup=$request->nama_grup;

        $ketua=$request->ketua_kelompok;
        $grup=new KelompokKP;
        $grup->code=$code;
        $grup->nama_kelompok=$nm_grup;
        $grup->kategori='ketua';
        $grup->mahasiswa_id=$ketua;
        $grup->departemen_id=$dept_id;
        $grup->save();

        foreach($request->anggota as $k=>$v)
        {
            if($v!=-1)
            {
                $grup=new KelompokKP;
                $grup->code=$code;
                $grup->nama_kelompok=$nm_grup;
                $grup->kategori='anggota';
                $grup->mahasiswa_id=$v;
                $grup->departemen_id=$dept_id;
                $grup->save();
            }
        }

        foreach($request->dospem as $p => $vp)
        {
            if($vp!=0)
            {
                $pembimbing=new PembimbingKP;
                $pembimbing->dosen_id=$vp;
                $pembimbing->grup_id=$code;
                $pembimbing->status=1;
                $pembimbing->departemen_id=$dept_id;
                $pembimbing->save();
            }
        }   
        return redirect('data-kp')->with('status','Data Kelompok Kerja Praktek Berhasil Di Simpan');    
    }

    public function form_anggota($code,$id)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $anggota=KerjaPraktek::where([
            'status_pengajuan'=>1,
            'departemen_id'=>$dept_id
            ])->with('mahasiswa')->get();

        return view('pages.mahasiswa.kerja-praktek.form-anggota')
            ->with(['code'=>$code,'anggota'=>$anggota,'id'=>$id]); 
    }

    public function form_anggota_proses(Request $request,$code,$id)
    {
        // $code=$code;
        $grup=KelompokKP::where('code','like',"%$code%")->first();
        // dd($grup);
        foreach($request->anggota as $k=>$v)
        {
            $ang=new KelompokKP;
            $ang->code=$code;
            $ang->nama_kelompok=$grup->nama_kelompok;
            $ang->departemen_id=$grup->departemen_id;
            $ang->kategori='anggota';
            $ang->mahasiswa_id=$v;
            $ang->save();
        }
        // $data=$request->all();
        // $data['id']=$id;
        // $data['code']=$code;
        // dd($data);
        return response()->json(['done']);
    }
    public function hapus_anggota($id)
    {
        KelompokKP::find($id)->delete();
        return response()->json(['done']);
    }

    public function informasi_kp_proses(Request $request,$idgrup,$id)
    {
        // dd($request->all());
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $kat_user=$request->kat_user;
        InformasiKP::where('grup_id',$idgrup)->forceDelete();
        if($id==-1)
        {
            foreach($request->title_tambahan as $k=>$v)
            {
                if($v!=null)
                {
                    if(strpos($v,'utama__')!==false)
                    {
                        // $status='utama';
                        list($status,$judul)=explode('__',$v);
                    }
                    else
                    {
                        $judul=$v;
                        $status='tambahan';
                    }
                    $cek=InformasiKP::where('judul','like',$v)->where('grup_id',$idgrup)->where('departemen_id',$dept_id);
                    
                    $info=new InformasiKP; 
                    $info->judul=$judul;
                    $isi=$request->isi_tambahan[$k];
                    $info->isi=$isi;
                    $info->status=$status;
                    $info->departemen_id=$dept_id;
                    $info->grup_id=$idgrup;
                    $info->save();
                    
                }
                    // echo $v.'-'.$isi.'<br>';
                
            }
            return redirect('data-kp-detail/'.$idd.'/'.$kat_user.'/#'.$url)->with('status','Informasi Detail Kerja Praktek Berhasil Di Simpan');
        }
    }

    public function anggota_kelompok_proses(Request $request,$idgrup,$id)
    {
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $kat_user=$request->kat_user;
        // dd($request->all());
        $cek=KelompokKP::where('code',$idgrup);
        $c=$cek->get();
        $nama_grup=$c[0]->nama_kelompok;
        $cek->forceDelete();

        $ketua=new KelompokKP;
        $ketua->code=$idgrup;
        $ketua->nama_kelompok=$nama_grup;
        $ketua->departemen_id=$dept_id;
        $ketua->kategori='ketua';
        $ketua->mahasiswa_id=$request->ketua;
        $ketua->save();

        foreach($request->anggota as $k=>$v)
        {
            if($v!=-1)
            {
                $anggota=new KelompokKP;
                $anggota->code=$idgrup;
                $anggota->nama_kelompok=$nama_grup;
                $anggota->departemen_id=$dept_id;
                $anggota->kategori='anggota';
                $anggota->mahasiswa_id=$v;
                $anggota->save();
            }
        }
        return redirect('data-kp-detail/'.$idd.'/'.$kat_user.'/#'.$url)->with('status','Data Anggota Kelompok Berhasil Disimpan');
        // echo $nama_grup;
    }
    public function pembimbing_proses(Request $request,$idgrup,$id)
    {
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $kat_user=$request->kat_user;
        // dd($request->all());
        $cek=PembimbingKP::where('grup_id',$idgrup)->forceDelete();
        foreach($request->pembimbing as $k => $p)
        {
            if($p!=-1)
            {
                $ins=new PembimbingKP;
                $ins->dosen_id=$p;
                $ins->departemen_id=$dept_id;
                $ins->grup_id=$idgrup;
                $ins->status=1;
                $ins->nama='-';
                $ins->kategori='dosen';
                $ins->save();
            }
        }
        foreach($request->pembimbing_lapangan as $k => $p)
        {
            if($p!=null)
            {
                $ins=new PembimbingKP;
                $ins->dosen_id=0;
                $ins->departemen_id=$dept_id;
                $ins->grup_id=$idgrup;
                $ins->status=1;
                $ins->kategori='lapangan';
                $ins->nama=$p;
                $ins->save();
            }
        }
        return redirect('data-kp-detail/'.$idd.'/'.$kat_user.'/#'.$url)->with('status','Data Anggota Kelompok Berhasil Disimpan');
    }
    public function hapus_pembimbing($id,$kat_user,$idp)
    {
        PembimbingKP::find($idp)->delete();
        return redirect('data-kp-detail/'.$id.'/'.$kat_user.'/#tab_1_1_4')->with('status','Data Pembimbing Berhasil Disimpan');
    }

    //---------Cetak Berkas-----------
    public function cetak_berkas($code_grup,$kat_user,$jenis,$idkp=null)
    {
        $level=Auth::user()->kat_user;
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->with('dosen')->with('staf')->first();
        $dept_id=0;
        $mhs=array();
        if($level==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
            $mhs=Mahasiswa::find(Auth::user()->id_user);
        }
        elseif($level==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        elseif($level==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }

        $berkas=array('Surat Keterangan / Penghantar KP','Surat Permohonan Izin KP/Surat Balasan Untuk Perusahaan Indonesia','Surat Permohonan Izin KP/Surat Balasan Untuk Perusahaan Inggris','Form Asistensi Bimbingan Dosen','Form Asistensi Bimbingan Lapangan (Log Book)','Upload Surat Balasan Dari Perusahaan','Upload Surat Pernyataan Selesai KP Dari Perusahaan','Cetak Undangan Sidang');
        $brks=array();
        foreach($berkas as $k=>$v)
        {
            $brks[str_slug($v)]=$v;
            // echo str_slug($v).'<br>';
        }

        $grup=KelompokKP::where('code',$code_grup)->with('mahasiswa')->get();
        $det=array();
        if($idkp!=null)
        {
            $det=KerjaPraktek::where('id',$idkp)
                    ->with('jenispengajuan')
                    ->with('tahunajaran')
                    ->with('mahasiswa')->first();
        }
        // return $det;

        $info=InformasiKP::where('grup_id',$code_grup)->get();
        $prod=ProgamStudi::where('departemen_id',$dept_id)->get();
        $prodi=$inf=array();
        foreach($info as $k=>$v)
        {
            $inf[str_slug($v->judul)]=$v;
        }
        foreach($prod as $k=>$v)
        {
            $prodi[$v->id]=$v;
        }
        $pembimbing=PembimbingKP::where('grup_id',$code_grup)->with('dosen')->get();
        $pbb=array();
        foreach($pembimbing as $k=>$v)
        {
            $pbb[$v->kategori][]=$v;
        }
        
        $pimp=MasterPimpinan::where('departemen_id',$dept_id)->get();
        $pimpinan=array();
        foreach($pimp as $k=>$v)
        {
            $pimpinan[str_slug($v->jabatan)]=$v;
        }
        $departemen=MasterDepartemen::find($dept_id);

        $dos=Dosen::where('departemen_id',$dept_id)->get();
        $dosen=array();
        foreach($dos as $k=>$v)
        {
            $dosen[$v->id]=$v;
        }
        // return $inf;

        $periode='';
            if($inf['periode-awal'])
            {
                list($tgl,$bln,$thn)=explode('-',$inf['periode-awal']->isi);
                $periode=tgl_indo($thn.'-'.$bln.'-'.$tgl);

                if($inf['periode-selesai'])
                {
                    list($tgl,$bln,$thn)=explode('-',$inf['periode-selesai']->isi);
                    $periode=$periode.' s.d. '.tgl_indo($thn.'-'.$bln.'-'.$tgl);
                }   

            }
        // $user=Users::where('kat_user',)->first();
        if(strpos($jenis,'log-book')!==false)
        {
            // return $jenis;
            // return $mhs->mahasiswa_user;
            
            $view='pages.mahasiswa.kerja-praktek.berkas.'.$jenis;
            $data['departemen']=$departemen;
            $data['periode']=$periode;
            $data['grup']=$grup;
            $data['pembimbing']=$pbb;
            $data['mhs']=$mhs;
            $data['dosen']=$dosen;
            $data['inf']=$inf;
            $data['det']=$det;
            $data['code_grup']=$code_grup;
            $data['pimpinan']=$pimpinan;
            $data['prodi']=$prodi;
            $pdf = PDF::loadView($view,$data);
		    return $pdf->download('LogBookKP.pdf');
        }

        if(isset($brks[$jenis]))
        {
            return view('pages.mahasiswa.kerja-praktek.berkas.'.$jenis)
                ->with('departemen',$departemen)
                ->with('grup',$grup)
                ->with('pembimbing',$pbb)
                ->with('periode',$periode)
                ->with('det',$det)
                ->with('mhs',$mhs)
                ->with('dosen',$dosen)
                ->with('code_grup',$code_grup)
                ->with('inf',$inf)
                ->with('pimpinan',$pimpinan)
                ->with('prodi',$prodi);
        }
        // dd($brks);
    }

    public function upload_balasan_kp(Request $request)
    {
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $idgrup=$request->idgrup;
        $kat_user=$request->kat_user;
        // dd($request->all());
        // $user=Users::find(Auth::user()->id);
        $file=$request->file;
        $tipedata=$file->getClientOriginalExtension();
        $nama_file='balasan_kp-'.Auth::user()->id_user.'-'.date('ymd').'-'.$file->getClientOriginalName();
        $file->storeAs('dokumen_pdf',$nama_file);
        $dir='dokumen_pdf/'.$nama_file; 

        $grup=KelompokKP::where('code',$idgrup)->get();
        foreach($grup as $kg=>$vg)
        {
            $kp=KerjaPraktek::where('mahasiswa_id',$vg->mahasiswa_id)->first();
            $kp->balasan_surat=$dir;
            $kp->save();
        }

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        $idpengajuan=$idd;
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Mahasiswa Telah Meng Unggah Surat Balasan Kerja Praktek";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : <b><u>".Auth::user()->name."</u></b> Telah Menggungah Surat Balasan Kerja Praktek dari Institusi/Perusahaan <br> 
                <a href='".url('data-kp-detail/'.$idpengajuan.'/'.$v->kat_user.'/#'.$url)."'>Klik Disini</a>";
                $notif->save();
            }
        }
        return redirect('data-kp-detail/'.$idd.'/'.$kat_user.'/#'.$url)->with('status','Data Surat Balasan Perusahaan Berhasil Di Unggah');
    }
    public function upload_selesai_kp(Request $request)
    {
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $idgrup=$request->idgrup;
        $kat_user=$request->kat_user;
        // dd($request->all());
        // $user=Users::find(Auth::user()->id);
        $file=$request->file;
        $tipedata=$file->getClientOriginalExtension();
        $nama_file='balasan_kp-'.Auth::user()->id_user.'-'.date('ymd').'-'.$file->getClientOriginalName();
        $file->storeAs('dokumen_pdf',$nama_file);
        $dir='dokumen_pdf/'.$nama_file; 

        $grup=KelompokKP::where('code',$idgrup)->get();
        foreach($grup as $kg=>$vg)
        {
            $kp=KerjaPraktek::where('mahasiswa_id',$vg->mahasiswa_id)->first();
            $kp->surat_pernyataan_selesai=$dir;
            $kp->save();
        }

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        $idpengajuan=$idd;
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Mahasiswa Telah Meng Unggah Surat Pernyataan Selesai Kerja Praktek";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : <b><u>".Auth::user()->name."</u></b> Telah Menggungah Surat Pernyataan Selesai Kerja Praktek dari Institusi/Perusahaan <br> 
                <a href='".url('data-kp-detail/'.$idpengajuan.'/'.$v->kat_user.'/#'.$url)."'>Klik Disini</a>";
                $notif->save();
            }
        }
        return redirect('data-kp-detail/'.$idd.'/'.$kat_user.'/#'.$url)->with('status','Data Surat Pernyataan Selesai KP dari Perusahaan Berhasil Di Unggah');
    }

    public function data_kp_mulai($idgrup)
    {
        $grup=KelompokKP::where('code',$idgrup)->get();
        foreach($grup as $kg=>$vg)
        {
            $kp=KerjaPraktek::where('mahasiswa_id',$vg->mahasiswa_id)->first();
            $kp->status_kp=1;
            $kp->save();
        }
        return redirect('data-kp')->with('status','Data Kerja Praktek Mahasiswa Sudah Berhasil Di Update');
    }
    public function data_kp_selesai($idgrup)
    {
        $grup=KelompokKP::where('code',$idgrup)->get();
        foreach($grup as $kg=>$vg)
        {
            $kp=KerjaPraktek::where('mahasiswa_id',$vg->mahasiswa_id)->first();
            $kp->status_kp=2;
            $kp->save();
        }
        return redirect('data-kp')->with('status','Data Kerja Praktek Mahasiswa Sudah Selesai Di Laksanakan');
    }

    public function simpan_jadwal_sidang_kp(Request $request,$idgrup)
    {
        $dept_id=$request->dept_id;
        $url=$request->url;
        $idd=$request->id;
        $idgrup=$request->idgrup;
        $kat_user=$request->kat_user;
        $publish=$request->publish;

        $cek=JadwalSidangKP::where('id_grup',$idgrup)->get();
        if($cek->count()!=0)
        {
            PengujiKP::where('grup_id',$idgrup)->forceDelete();
            JadwalSidangKP::where('id_grup',$idgrup)->forceDelete();
        }

        list($tgl,$bln,$thn)=explode('-',$request->tanggal);
        $tanggal=$thn.'-'.$bln.'-'.$tgl;
        // dd($request->all());
        $day=hari(date('D',strtotime($tanggal)));
        // echo $tanggal.'-'.$day;
        $jadwal=new JadwalSidangKP;
        $jadwal->id_grup= $idgrup;
        $jadwal->ruangan_id	= $request->ruangan;
        $jadwal->departemen_id	= $dept_id;
        $jadwal->tanggal	= $tanggal;
        $jadwal->waktu	= $request->waktu;
        $jadwal->hari	= $day;
        $jadwal->jenis_jadwal= 'Sidang KP';
        $jadwal->save();

        $ruangan=MasterRuangan::find($request->ruangan);
        $kp=KelompokKP::where('code',$idgrup)->first();

        $grup=KelompokKP::where('code',$idgrup)->get();
        foreach($grup as $kg=>$vg)
        {
            $det=KerjaPraktek::where('mahasiswa_id',$vg->mahasiswa_id)->first();
            $det->publish_date=date('Y-m-d H:i:s');
            $det->save();
        }
        // $det=KerjaPraktek::find($idd);
        // $det->publish_date=date('Y-m-d H:i:s');
        // $det->save();

        foreach($request->penguji as $k => $v)
        {
            if($v!=-1)
            {
                $dosen=Users::where('id_user',$v)->where('kat_user',2)->with('dosen')->first();
                $penguji=new PengujiKP;
                $penguji->pivot_jadwal_id=$jadwal->id;
                $penguji->grup_id=$idgrup;
                $penguji->penguji_id=$v;
                $penguji->status=1;
                $penguji->departemen_id=$dept_id;
                $penguji->save();

                $notif=new Notifikasi;
                $notif->title="Jadwal Menguji Sidang Kerja Praktek";
                $notif->from=Auth::user()->id_user;
                $notif->to=$dosen->id;
                $notif->flag_active=1;
                $notif->pesan="Anda Telah Dijadwal untuk Menguji Kelompok <b>".$kp->nama_kelompok."</b> Pada <br>
                Tanggal : ".$request->tanggal."<br>
                Waktu : ".$request->waktu."<br>
                Ruangan : ".$ruangan->nama_ruangan."
                <a href='".url('jadwal-sidang-kp/'.$idgrup.'/'.$dosen->kat_user)."'>Klik Disini</a>";
                $notif->save();

            }
        }

        if($publish==0)
            return redirect('data-jadwal-kp')->with('status','Jadwal Sidang Kerja Praktek Telah berhasil, dan Sudah Dapat Di Publish');
        else
            return redirect('data-jadwal-kp')->with('status','Jadwal Sidang Kerja Praktek Telah berhasil, dan Telah Di Publish');
    }
}
