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
use App\Model\IzinDosen;
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

        $jadwal=Jadwal::select()
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();
        
        $jdwl=array();
        foreach($jadwal as $idx=>$vj)
        {
            $jdwl[$vj->judul_id]=$vj;
        }
        // dd($jdwl);
        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pengajuan_id][$v->penguji_id]=$v;
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
                    ->with('jadwal',$jdwl)
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
        // dd($jdwl);
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


        $tahun=date('Y-m-d');
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->whereDate('start_date','<=',$tahun)->whereDate('end_date','>=',$tahun)->get();
        $kalender=array();
        $start_date=$end_date='';
        foreach($kal as $val)
        {
            $kalender[$val->kategori_khusus]=$val;
            $start_date=$val->start_date;
            $end_date=$val->end_date;
        }
        // return $start_date;
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->orderBy('start_date')->get();
        $kalamik=array();
        foreach($kal as $k=>$v)
        {
            $kalamik[$v->kategori_khusus]=$v;
        }
        return view('pages.staf.jadwal.index',compact('kalamik','jenis','ta','dept_id','dosen','jadwal','uji','piv','kalender','start_date','end_date'));
    }

    
    public function pengajuan_sidang_staf_data($jenis,$old=null)
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

        
        // dd( $kalamik);
        $pengajuan=Pengajuan::where('departemen_id',$dept_id)
                    ->where('status_pengajuan',$jenis)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('tahunajaran')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();

        // return $pengajuan;
        if($old!=null)
        {
            $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                        ->where('jadwals.departemen_id',$dept_id)
                        ->whereDate('jadwals.tanggal','<',date('Y-m-d'))
                        ->with('ruangan')
                        ->get();
        }
        else
        {
            $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                        ->where('jadwals.departemen_id',$dept_id)
                        ->whereDate('jadwals.tanggal','>=',date('Y-m-d'))
                        ->with('ruangan')
                        ->get();
        }

        // return $jadwal;
        // dd($pengajuan);
        $jdwl=$jdwlold=array();
        foreach($jadwal as $kj=>$vjj)
        {
            if($vjj->tanggal!=NULL)
                $jdwl[$vjj->judul_id]=$vjj;
            // if($old!=null)
            // {
            //     if($vjj->tanggal<date('Y-m-d'))
            //         $jdwlold[$vjj->judul_id]=$vjj;
            // }
            // else
            // {
            //     if($vjj->tanggal>=date('Y-m-d'))
            //         $jdwl[$vjj->judul_id]=$vjj;
            // }
        }
        // return $jdwl;
        // dd($jdwl);
        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pengajuan_id][$v->mahasiswa_id][$v->penguji_id]=$v;
        }
        // dd($uji);
        $pivot=PivotBimbingan::all();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->judul_id][$v->mahasiswa_id][$v->dosen_id]=$v;
        }

        $dokumen=PivotDocumentSidang::where('departemen_id',$dept_id)->get();
        $dok=array();
        foreach($dokumen as $kd => $vd)
        {
            $dok[$vd->pengajuan_id][$vd->jenis_dokumen]=$vd;
        }
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        // return $jdwlold;
        // return $jdwl;

        $pij=PivotJadwal::all();
        $piv_jad=array();
        foreach($pij as $k=>$v)
        {
            $piv_jad[$v->judul_id]=$v;
        }
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->orderBy('start_date')->get();
        $kalamik=array();
        foreach($kal as $k=>$v)
        {
            $kalamik[$v->kategori_khusus]=$v;
        }
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
                    ->with('old',$old)
                    ->with('piv_jad',$piv_jad)
                    ->with('kalamik',$kalamik)
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
                    ->with('old',$old)
                    ->with('piv_jad',$piv_jad)
                    ->with('kalamik',$kalamik)
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
    public function atur_jadwal(Request $reqeuest, $dept_id)
    {
       list($tg1,$bl1,$th1)=explode('/',$reqeuest->datetime);
       $date=$th1.'-'.$bl1.'-'.$tg1;
       $waktu=$reqeuest->waktu; 
       $ruangan_id=$reqeuest->ruangan; 
       $dept=MasterDepartemen::find($dept_id);
        $idta=$reqeuest->tahunajaran_id;
        $ruangan=MasterRuangan::where('departemen_id',$dept_id)->get();
        $d_ruang=array();
        foreach($ruangan as $kr => $vr)
        {
            $d_ruang[]=$vr->id.'__'.$vr->code_ruangan.'__'.$vr->nama_ruangan;
        }

        $pengajuan=Pengajuan::where('departemen_id',$dept_id)->where('tahunajaran_id',$idta)->where('status_pengajuan',1)->get();

        $izin=IzinDosen::where('status',1)->get();
        $iz=array();
        foreach($izin as $k => $v)
        {
            $iz[$v->dosen_id][]=$v;
        }

        $penguji=PivotPenguji::with('dosen')->get();
        $p_uji=array();
        foreach($penguji as $k => $v)
        {
            // echo $v->id.'-';
            $p_uji[$v->pengajuan_id][$v->penguji_id]=$v;
        }

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->with('ruangan')
                    ->get();

        $p_jdwl=array();
        foreach($jadwal as $kj => $vj)
        {
            $p_jdwl[$vj->mahasiswa_id][]=$vj;
        }
            
        foreach($pengajuan as $kp => $vp)
            {
                // $p_aju=Pengajuan::find($vp->id);
                $vp->status_pengajuan=2;
                $vp->save();

                $idmhs=$vp->mahasiswa_id;
                $mhs=Mahasiswa::find($idmhs);
                // $idjadwal=$p_jdwl[$idmhs][0];
                // $date=array_rand($tgl);
                // $ruang=array_rand($d_ruang);
                // dd($idjadwal);
                // $r=explode('__',$d_ruang[$ruang]);

                // $waktu=array_rand(waktu(),1);
                // $wkt=waktu();
                // $jadw=Jadwal::find($idjadwal->id);
                $jadw=new Jadwal;
                $jadw->ruangan_id=$ruangan_id;
                $jadw->departemen_id=$dept_id;
                $jadw->tanggal=$date;
                $jadw->hari=date('D',strtotime($date));
                $jadw->waktu=$waktu;
                $jadw->save();


                // $piv_jad=PivotJadwal::where('jadwal_id',$jadw->id)->first();
                $piv_jad=new PivotJadwal;
                $piv_jad->jadwal_id=$jadw->id;
                $piv_jad->ruangan_id=$ruangan_id;
                $piv_jad->mahasiswa_id=$idmhs;
                $piv_jad->judul_id=$vp->id;
                $piv_jad->status=0;
                $piv_jad->save();

                foreach($p_uji[$vp->id] as $ku=>$vu)
                {
                    // $user=Users::where('id_user',$ku)->first();
                    // $notif=new Notifikasi;
                    // $notif->title="Jadwal Menguji Sidang";
                    // $notif->from=Auth::user()->id;
                    // $notif->to=$user->id;
                    // $notif->flag_active=1;
                    // $notif->pesan="Anda Mendapatkan Jadwal Menguji Sidang Mahasiswa :<u>".$mhs->name."</u> <br>Pada Tanggal : <u>".tgl_indo($date)." </u>
                    // <br>Ruangan : ".$r[1]." - ".$r[2];
                    // $notif->save();
                }

                // dd($ruang);
            }
            return redirect('data-jadwal/2')->with('status','Jadwal Sidang Berhasil Di Generate');
    }
    public function generate(Request $reqeuest, $dept_id)
    {
        // return $request->
        list($date1,$date2)=explode('-',$reqeuest->datetimes);
        $date1=trim($date1);
        $date2=trim($date2);
        list($tg1,$bl1,$th1)=explode('/',$date1);
        list($tg2,$bl2,$th2)=explode('/',$date2);
        $date1=$th1.'-'.$bl1.'-'.$tg1;
        $date2=$th2.'-'.$bl2.'-'.$tg2;
        
        // echo $date1.'-'.$date2;
        // dd($reqeuest->all());
        // return $date1.'-'.$date2;
        $dept=MasterDepartemen::find($dept_id);
        $idta=$reqeuest->tahunajaran_id;
        $tanggal=$tgl=array();
        // $kalender=KalenderAkademik::where('departemen_id',$dept_id)->where('tahunajaran_id',$idta)->where('status_sidang',1)->get();
        // foreach($kalender as $k=>$v)
        // {
        //     $tanggal[]=createDateRange($v->start_date,$v->end_date);
        // }

        $tanggal[]=createDateRange($date1,$date2);
        
        foreach($tanggal as $kt => $vt)
        {
            foreach($vt as $idkt=> $vvt)
            {
                $weekend=array('Sat','Sun');
                $day=date('D',strtotime($vvt));
                if(!in_array($day,$weekend))
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
        $peng=$idpeng=array();
        foreach($pengajuan as $k => $v)
        {
            $peng[$v->id]=$v;
            $idpeng[$v->id]=$v->id;
        }

        $izin=IzinDosen::where('status',1)->get();
        $iz=array();
        foreach($izin as $k => $v)
        {
            $iz[$v->dosen_id]['start_date']=$v->start_date;
            $iz[$v->dosen_id]['end_date']=$v->end_date;
        }

        $penguji=PivotPenguji::with('dosen')->get();
        $p_uji=array();
        foreach($penguji as $k => $v)
        {
            // echo $v->id.'-';
            $p_uji[$v->pengajuan_id][$v->penguji_id]=$v;
        }

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->with('ruangan')
                    ->get();

        $p_jdwl=array();
        foreach($jadwal as $kj => $vj)
        {
            $p_jdwl[$vj->mahasiswa_id][]=$vj;
        }

        // dd($p_jdwl);
        foreach($tgl as $tg)
        {
            $idpengajuan=array_search(array_rand($idpeng),$idpeng);
            
            // echo $idpengajuan.'-';
        }
        // return $p_uji;
        if(count($tgl)!=0)
        {
            foreach($pengajuan as $kp => $vp)
            {
                if(isset($p_uji[$vp->id]))
                {
                    // $p_aju=Pengajuan::find($vp->id);
                    $vp->status_pengajuan=2;
                    $vp->save();

                    $idmhs=$vp->mahasiswa_id;
                    $mhs=Mahasiswa::find($idmhs);
                    // $idjadwal=$p_jdwl[$idmhs][0];
                    $date=array_rand($tgl);
                    $ruang=array_rand($d_ruang);
                    // dd($idjadwal);
                    $r=explode('__',$d_ruang[$ruang]);

                    $waktu=array_rand(waktu2(),1);
                    $wkt=waktu2();
                    // $jadw=Jadwal::find($idjadwal->id);
                    $jadw=new Jadwal;
                    $jadw->ruangan_id=$r[0];
                    $jadw->departemen_id=$dept_id;
                    $jadw->tanggal=$date;
                    $jadw->hari=date('D',strtotime($date));
                    $jadw->waktu=$wkt[$waktu];
                    $jadw->save();


                    // $piv_jad=PivotJadwal::where('jadwal_id',$jadw->id)->first();
                    $piv_jad=new PivotJadwal;
                    $piv_jad->jadwal_id=$jadw->id;
                    $piv_jad->ruangan_id=$r[0];
                    $piv_jad->mahasiswa_id=$idmhs;
                    $piv_jad->judul_id=$vp->id;
                    $piv_jad->status=0;
                    $piv_jad->save();

                    
                        foreach($p_uji[$vp->id] as $ku=>$vu)
                        {
                            PivotPenguji::where('id', $vu->id)->update(['pivot_jadwal_id' => $jadw->id]);

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
    public function pengajuan_sidang_kp_form($id)
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
        $kelompok_kp=KelompokKP::where('departemen_id',$dept_id)->get();
        $klp=$mhs_id=array();
        foreach($kelompok_kp as $kkp=>$vkp)
        {
            $klp[$vkp->code][]=$vkp;
            $mhs_id[$vkp->code][]=$vkp->mahasiswa_id;
        }
        $jadwalkp=array();
        if($id!=-1)
        {
            list($idjadwal,$id_grup)=explode('__',$id);
            $pengajuan=KerjaPraktek::whereIn('mahasiswa_id',$mhs_id[$id_grup])
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->orderBy('created_at')
                        ->get();

            $jadwalkp=JadwalSidangKP::find($idjadwal);
        }
        else
        {
            $pengajuan=KerjaPraktek::where('departemen_id',$dept_id)
                        ->where('status_kp',2)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->orderBy('created_at')
                        ->get();
        }
        // return $pengajuan;
        // dd($pengajuan);
        $kpp=array();
        foreach($pengajuan as $kp => $vp)
        {
            // print_r($vp);
            $kpp[$vp->mahasiswa_id]=$vp;
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

        $ruangan=MasterRuangan::where('departemen_id',$dept_id)->get();
        // dd($infokp);
        // return $klp;
        $waktu=waktu();
        return view('pages.staf.kerja-praktek.jadwal-sidang.form')
                    ->with('pengajuan',$kpp)
                    ->with('uji',$uji)
                    ->with('klp',$klp)
                    ->with('infokp',$infokp)
                    ->with('jadwalkp',$jadwalkp)
                    ->with('ruangan',$ruangan)
                    ->with('waktu',$waktu)
                    ->with('id',$id)
                    ->with('pemb',$pemb)
                    ->with('piv',$piv);
       
    }
    public function pengajuan_sidang_staf_kp_data()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->with('dosen')->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        elseif(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }
        elseif(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
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
    public function setuju_acc_manager($Idpengajuan,$idmahasiswa)
    {
        $pengajuan=Pengajuan::find($Idpengajuan);
        $pengajuan->acc_manager_akademik = 2;
        $pengajuan->save();
        return redirect('data-jadwal/2')->with('status','Pengajuan Telah Di Setujui Oleh Manager Akademik');
    }
    public function berkas_sidang($jenis,$jadwal_id,$pengajuan_id)
    {
        $jadwal=Jadwal::select('*',DB::raw('pivot_jadwal.id as pj_id'))
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$jadwal_id)
                    ->with('ruangan')
                    ->first();

        $pengajuan=Pengajuan::where('id',$pengajuan_id)->with('jenispengajuan')->with('mahasiswa')->with('departemen')->first();

        $penguji=PivotPenguji::where('pengajuan_id',$pengajuan_id)->with('dosen')->get();
        $pembimbing=PivotBimbingan::where('mahasiswa_id',$pengajuan->mahasiswa_id)->with('mahasiswa')->get();
        $pimp=MasterPimpinan::where('departemen_id',$pengajuan->departemen_id)->with(['dosen','departemen'])->get();
        $pimpinan=array();
        $departemen=MasterDepartemen::find($pengajuan->departemen_id);
        foreach($pimp as $k =>$v)
        {
            $pimpinan[str_slug($v->jabatan)]=$v;
        }
        // dd($pimpinan);
        $mahasiswa=Mahasiswa::where('id',$pengajuan->mahasiswa_id)->with('programstudi')->first();
        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$pengajuan->departemen_id)
                    ->where('module.nama_module','like',"%Penilaian Skripsi%")->get();

        return view('pages.staf.jadwal.berkas.'.$jenis,compact('jadwal','pengajuan','penguji','pimpinan','penilaian','pembimbing','mahasiswa','departemen'));
    }

    public function simpan_jadwal_sidang_kp(Request $request,$all_one,$id,$idkp=null)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        if($all_one=='one')
        {
            // return $request->all();
            $idgrup=$request->idgrup;
            $ruangan=$request->ruangan;
            $tanggal=$request->tanggal;
            $waktu=$request->waktu;
            
            list($tgl,$bln,$thn)=explode('-',$tanggal);
            $date=$thn.'-'.$bln.'-'.$tgl;
            $hari=hari(date('D',strtotime($date)));

            if($id!=-1)
            {
                list($idjadwal,$grupid)=explode('__',$id);
                $insert=JadwalSidangKP::find($idjadwal);
                $insert->id_grup=$idgrup;
                $insert->ruangan_id=$ruangan;
                $insert->departemen_id=$dept_id;
                $insert->tanggal=$date;
                $insert->waktu=$waktu;
                $insert->hari=$hari;
                $c=$insert->save();
            }
            else
            {
                $insert=new JadwalSidangKP;
                $insert->id_grup=$idgrup;
                $insert->ruangan_id=$ruangan;
                $insert->departemen_id=$dept_id;
                $insert->tanggal=$date;
                $insert->waktu=$waktu;
                $insert->hari=$hari;
                $c=$insert->save();
            }

            if($idkp!=null)
            {
                $kp=KerjaPraktek::find($idkp);
                $kp->status_kp=10;
                $kp->save();

            }

            if($c)
                $data['status']=1;
            else
                $data['status']=0;

            return $data;
        }
        elseif($all_one=='all')
        {
            $tanggal=$request->tanggal_sidang;
            $ruangan=$request->ruangan_id;
            $waktu=$request->waktu;
            $idkp=$request->idkp;
            foreach($tanggal as $idgrup=>$v)
            {
                list($tgl,$bln,$thn)=explode('-',$v);
                $date=$thn.'-'.$bln.'-'.$tgl;
                $hari=hari(date('D',strtotime($date)));

                $ruangan_id=$ruangan[$idgrup];
                $wkt=$waktu[$idgrup];
                $insert=new JadwalSidangKP;
                $insert->id_grup=$idgrup;
                $insert->departemen_id=$dept_id;
                $insert->ruangan_id=$ruangan_id;
                $insert->tanggal=$date;
                $insert->waktu=$wkt;
                $insert->hari=$hari;
                $insert->save();
                $idk=$idkp[$idgrup];
                if($idk!='')
                {
                    $kp=KerjaPraktek::find($idk);
                    $kp->status_kp=10;
                    $kp->save();
                }
            }
            return redirect('data-jadwal-kp')->with('pesan','Generate Jadwal Berhasil Di Lakukan');
        }
    }
    public function publish_kp($idjadwal)
    {
        if($idjadwal==-1)
        {
            $jadwal=JadwalSidangKP::whereNull('publish_date')->get();
            foreach($jadwal as $k)
            {
                $k->publish_date=date('Y-m-d H:i:s');
                $k->save();
            }
            return redirect('data-jadwal-kp')
                    ->with('status','Jadwal Sidang KP Sudah Di Publish')
                    ->with('pesan','Jadwal Sidang KP Sudah Di Publish');
        }
        else
        {
            $jadwal=JadwalSidangKP::find($idjadwal);
            $jadwal->publish_date=date('Y-m-d H:i:s');
            $c=$jadwal->save();
            if($c)
                echo 1;
            else
                echo 0;
        }
    }

    public function hapusjadwalkp($idjadwal)
    {
        $jadwal=JadwalSidangKP::find($idjadwal);
        $c=$jadwal->delete();
        if($c)
            echo 1;
        else
            echo 0;
        
    }
}
