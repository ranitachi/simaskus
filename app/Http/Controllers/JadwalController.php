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
use App\Model\MasterDepartemen;
use App\Model\PivotBimbingan;
use App\Model\MasterRuangan;
use App\Model\Jadwal;
use App\Model\PivotJadwal;
use App\Model\PivotPenguji;
use App\Model\PivotDocumentSidang;
use App\Model\TahunAjaran;
use App\Model\KalenderAkademik;
use App\Model\Mahasiswa;
use App\Model\KerjaPraktek;
use App\Model\KelompokKP;
use App\Model\PembimbingKP;
use App\Model\JadwalSidangKP;
use App\Model\InformasiKP;
use App\Model\PengujiKP;
use App\Model\MasterPimpinan;
use App\Model\Component;
use Auth;
use DB;
class JadwalController extends Controller
{
    public function index($jenis)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        } 
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.front.jadwal.index')
                ->with('ta',$ta)
                ->with('dept_id',$dept_id)
                ->with('dosen',$dosen)
                ->with('jenis',$jenis);
    }

    public function sidang()
    {
        return view('pages.jadwal.jadwal-mhs');
    }

    public function pengajuan_sidang_mhs_data($jenis)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
        // dd( $dept_id);
        $pengajuan=Pengajuan::where('departemen_id',$dept_id)
                    ->where('status_pengajuan',$jenis)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('tahunajaran')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->first();

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

        $dokumen=PivotDocumentSidang::where('departemen_id',$dept_id)->get();
        $dok=array();
        foreach($dokumen as $kd => $vd)
        {
            $dok[$vd->pengajuan_id][$vd->jenis_dokumen]=$vd;
        }

        return view('pages.jadwal.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('uji',$uji)
                    ->with('dok',$dok)
                    ->with('jadwal',$jadwal)
                    ->with('jenis',$jenis)
                    ->with('piv',$piv);
    }

    public function pengajuan_sidang_staf($jenis)
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
        $jadwals=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();

        $jadwal=array();
        foreach($jadwals as $kj=>$vjj)
        {
            $jadwal[$vjj->judul_id]=$vjj;
        }
        // dd($jdwl );
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
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.staf.jadwal.index',compact('jenis','ta','dept_id','dosen','jadwal','uji','piv'));
    }

    
    public function pengajuan_sidang_staf_data($jenis)
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
        // dd( $dept_id);
        $pengajuan=Pengajuan::where('departemen_id',$dept_id)
                    ->where('status_pengajuan',$jenis)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('tahunajaran')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();

        $jdwl=array();
        foreach($jadwal as $kj=>$vjj)
        {
            $jdwl[$vjj->judul_id]=$vjj;
        }
        // dd($jdwl );
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

        $dokumen=PivotDocumentSidang::where('departemen_id',$dept_id)->get();
        $dok=array();
        foreach($dokumen as $kd => $vd)
        {
            $dok[$vd->pengajuan_id][$vd->jenis_dokumen]=$vd;
        }
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        if($jenis==2)
        {
            return view('pages.staf.jadwal.jadwal')
                    ->with('pengajuan',$pengajuan)
                    ->with('uji',$uji)
                    ->with('dok',$dok)
                    ->with('dept_id',$dept_id)
                    ->with('dosen',$dosen)
                    ->with('jadwal',$jdwl)
                    ->with('jenis',$jenis)
                    ->with('piv',$piv);
        }
        else
        {
            return view('pages.staf.jadwal.data')
                    ->with('pengajuan',$pengajuan)
                    ->with('uji',$uji)
                    ->with('dok',$dok)
                    ->with('dept_id',$dept_id)
                    ->with('dosen',$dosen)
                    ->with('jadwal',$jdwl)
                    ->with('jenis',$jenis)
                    ->with('piv',$piv);
        }
    }
    
    

    public function pengajuan_sidang_verifikasi($id,$jns)
    {
        $pivot=PivotJadwal::where('jadwal_id',$id)->with('jadwal')->first();
        $pivot->status=1;
        $pivot->save();

        $users=Users::where('id_user',$pivot->mahasiswa_id)->first();
        $notif=new Notifikasi;
        $notif->title="Pengajuan Sudang Sudah Di Verifikasi";
        $notif->from=Auth::user()->id_user;
        $notif->to=$users->id;
        $notif->flag_active=1;
        $notif->pesan="Staf : Telah Memverifikasi Pengajuan Sidang Mahasiswa : ".$users->name." ";
        $notif->save();


        // return response()->json(['done']);
        return redirect('data-jadwal/2')->with('pesan','Jadwal Sudah Selesai Digenerate');
    }
    
    public function dokumen_verifikasi($id,$jns)
    {
        $pivot=PivotDocumentSidang::find($id);
        $pivot->status=1;
        $pivot->save();

        return response()->json(['done']);
    }

    public function generate(Request $reqeuest, $dept_id)
    {
        $dept=MasterDepartemen::find($dept_id);
        $idta=$reqeuest->tahunajaran_id;
        $kalender=KalenderAkademik::where('departemen_id',$dept_id)->where('tahunajaran_id',$idta)->get();
        $tanggal=$tgl=array();
        foreach($kalender as $k=>$v)
        {
            $tanggal[]=createDateRange($v->start_date,$v->end_date);
        }
        foreach($tanggal as $kt => $vt)
        {
            foreach($vt as $idkt=> $vvt)
            {
                $tgl[$vvt]=$vvt;
            }
        }

        $ruangan=MasterRuangan::where('departemen_id',$dept_id)->get();
        $d_ruang=array();
        foreach($ruangan as $kr => $vr)
        {
            $d_ruang[]=$vr->id.'__'.$vr->code_ruangan.'__'.$vr->nama_ruangan;
        }

        $pengajuan=Pengajuan::where('departemen_id',$dept_id)->where('tahunajaran_id',$idta)->where('status_pengajuan',1)->get();

        $penguji=PivotPenguji::with('dosen')->get();
        $p_uji=array();
        foreach($penguji as $k => $v)
        {
            $p_uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->with('ruangan')
                    ->get();
        $p_jdwl=array();
        foreach($jadwal as $kj => $vj)
        {
            $p_jdwl[$vj->mahasiswa_id][]=$vj;
        }
        if(count($tgl)!=0)
        {
            foreach($pengajuan as $kp => $vp)
            {
                // $p_aju=Pengajuan::find($vp->id);
                $vp->status_pengajuan=2;
                $vp->save();

                $idmhs=$vp->mahasiswa_id;
                $mhs=Mahasiswa::find($idmhs);
                $idjadwal=$p_jdwl[$idmhs][0];
                $date=array_rand($tgl);
                $ruang=array_rand($d_ruang);
                // dd($idjadwal);
                $r=explode('__',$d_ruang[$ruang]);

                $waktu=array_rand(waktu(),1);
                $wkt=waktu();
                $jadw=Jadwal::find($idjadwal->id);
                $jadw->ruangan_id=$r[0];
                $jadw->tanggal=$date;
                $jadw->hari=date('D',strtotime($date));
                $jadw->waktu=$wkt[$waktu];
                $jadw->save();

                $piv_jad=PivotJadwal::where('jadwal_id',$idjadwal->id)->first();
                $piv_jad->ruangan_id=$r[0];
                $piv_jad->save();

                foreach($p_uji[$idjadwal->id] as $ku=>$vu)
                {
                    $user=Users::where('id_user',$ku)->first();
                    $notif=new Notifikasi;
                    $notif->title="Jadwal Menguji Sidang";
                    $notif->from=Auth::user()->id;
                    $notif->to=$user->id;
                    $notif->flag_active=1;
                    $notif->pesan="Anda Mendapatkan Jadwal Menguji Sidang Mahasiswa :<u>".$mhs->name."</u> <br>Pada Tanggal : <u>".tgl_indo($date)." </u>
                    <br>Ruangan : ".$r[1]." - ".$r[2];
                    $notif->save();
                }

                // dd($ruang);
            }
            return redirect('data-jadwal/2')->with('status','Jadwal Sidang Berhasil Di Generate');
        }
        else
        {
            return redirect('data-pengajuan-sidang/1')->with('gagal','Generate Tidak Berhasil Karena Tanggal Jadwal Sidang Belum DItambahkan di Kalender Akademik');
        }
    }

    //KP

    public function pengajuan_sidang_kp()
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
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        return view('pages.staf.kerja-praktek.jadwal-sidang.index',compact('jenis','ta','dept_id'));
    }
    public function pengajuan_sidang_staf_kp()
    {

    }
    public function pengajuan_sidang_staf_kp_data()
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
        // dd( $dept_id);
        $pengajuan=KerjaPraktek::where('departemen_id',$dept_id)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->orderBy('created_at')
                        ->get();

        // dd($pengajuan);
        $kpp=array();
        foreach($pengajuan as $kp => $vp)
        {
            // print_r($vp);
            $kpp[$vp->mahasiswa_id]=$vp;
        }

        $kelompok_kp=KelompokKP::where('departemen_id',$dept_id)->get();
        $klp=array();
        foreach($kelompok_kp as $kkp=>$vkp)
        {
            $klp[$vkp->code][]=$vkp;
        }

        $jadwal=JadwalSidangKP::where('departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();
                    
        $jdwl=array();
        foreach($jadwal as $kj=>$vj)
        {
            $jdwl[$vj->id_grup][]=$vj;
        }

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $pivot=PembimbingKP::all();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
        }

        $info=InformasiKP::where('departemen_id',$dept_id)->get();
        $infokp=array();
        foreach($info as $kg=>$vg)
        {          
            $infokp[$vg->grup_id][str_slug($vg->judul)]=$vg;
        }
        
        $pembimbing=PembimbingKP::where('kategori','like','dosen')->with('dosen')->get();
        $pemb=array();
        foreach($pembimbing as $k=>$vv)
        {
            $pemb[$vv->grup_id][$vv->dosen_id]=$vv;
            
        }

        $penguji_kp=PengujiKP::where('departemen_id',$dept_id)->with('dosen')->get();
        $peng_kp=array();
        foreach($penguji_kp as $ku => $vu)
        {
            $peng_kp[$vu->grup_id][$vu->penguji_id]=$vu;
        }
        // dd($infokp);
        return view('pages.staf.kerja-praktek.jadwal-sidang.data')
                    ->with('pengajuan',$kpp)
                    ->with('uji',$uji)
                    ->with('klp',$klp)
                    ->with('infokp',$infokp)
                    ->with('pemb',$pemb)
                    ->with('penguji',$peng_kp)
                    ->with('jadwal',$jdwl)
                    ->with('piv',$piv);

    }
    public function pengajuan_sidang_verifikasi_kp($id)
    {

    }

    public function berkas_sidang($jenis,$jadwal_id,$pengajuan_id)
    {
        $jadwal=Jadwal::select('*',DB::raw('pivot_jadwal.id as pj_id'))
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$jadwal_id)
                    ->with('ruangan')
                    ->first();

        $pengajuan=Pengajuan::where('id',$pengajuan_id)->with('mahasiswa')->with('departemen')->first();

        $penguji=PivotPenguji::where('pivot_jadwal_id',$jadwal->pj_id)->with('dosen')->get();
        $pembimbing=PivotBimbingan::where('mahasiswa_id',$pengajuan->mahasiswa_id)->with('mahasiswa')->get();
        $pimp=MasterPimpinan::where('departemen_id',$pengajuan->departemen_id)->with(['dosen','departemen'])->get();
        $pimpinan=array();
        foreach($pimp as $k =>$v)
        {
            $pimpinan[str_slug($v->jabatan)]=$v;
        }
        
        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$pengajuan->departemen_id)
                    ->where('module.nama_module','like',"%Penilaian Skripsi%")->get();

        return view('pages.staf.jadwal.berkas.'.$jenis,compact('jadwal','pengajuan','penguji','pimpinan','penilaian','pembimbing'));
    }
}
