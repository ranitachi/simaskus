<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PengajuanSkripsi;
use App\Model\JudulTugasAkhir;
use App\Model\Dosen;
use App\Model\MasterJenisPengajuan;
use App\Model\MasterRuangan;
use App\Model\Pengajuan;
use App\Model\Users;
use App\Model\Jadwal;
use App\Model\Notifikasi;
use App\Model\PivotBimbingan;
use App\Model\PivotAccSidang;
use App\Model\PivotDocumentSidang;
use App\Model\PivotSetujuSidang;
use App\Model\PivotPenguji;
use App\Model\Component;
use App\Model\ComponentScore;
use App\Model\Nilai;
use App\Model\PerbaikanSkripsi;
use App\Model\PerubahanJudul;
use Auth;
use DB;
use Redirect;
class PenilaianController extends Controller
{
    public function index()
    {
        return view('pages.dosen.penilaian.view');
    }

    public function pengujikp()
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
        $jenis=2;
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
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();

        // dd($pengajuan);
        $jdwl=array();
        foreach($jadwal as $kj=>$vjj)
        {
            $jdwl[$vjj->judul_id]=$vjj;
        }
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

        $nilai=Nilai::where('dosen_id',Auth::user()->id_user)->with('dosen')->with('komponen')->get();

        $n=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->jadwal_id][$vn->penilai][$vn->dosen_id]=$vn;
        }
        $perbaikan=PerbaikanSkripsi::get();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id][$vn->pembimbing_id]=$vn;
        }
        // dd($n);
        return view('pages.dosen.penilaian.index-kp')
                    ->with('pengajuan',$pengajuan)
                    ->with('uji',$uji)
                    ->with('n',$n)
                    ->with('perb',$perb)
                    ->with('dok',$dok)
                    ->with('dept_id',$dept_id)
                    ->with('dosen',$dosen)
                    ->with('jadwal',$jdwl)
                    ->with('jenis',$jenis)
                    ->with('piv',$piv);
    }
    public function pengujinonkp()
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
        $jenis=2;
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
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();

        // dd($pengajuan);
        $jdwl=array();
        foreach($jadwal as $kj=>$vjj)
        {
            $jdwl[$vjj->judul_id]=$vjj;
        }
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

        $nilai=Nilai::where('dosen_id',Auth::user()->id_user)->with('dosen')->with('komponen')->get();

        $n=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->jadwal_id][$vn->penilai][$vn->dosen_id]=$vn;
        }
        $perbaikan=PerbaikanSkripsi::get();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id][$vn->pembimbing_id]=$vn;
        }
        // dd($n);
        return view('pages.dosen.penilaian.index')
                    ->with('pengajuan',$pengajuan)
                    ->with('uji',$uji)
                    ->with('n',$n)
                    ->with('perb',$perb)
                    ->with('dok',$dok)
                    ->with('dept_id',$dept_id)
                    ->with('dosen',$dosen)
                    ->with('jadwal',$jdwl)
                    ->with('jenis',$jenis)
                    ->with('piv',$piv);

    }
    
    public function penilaian_pembimbing()
    {
        $aju=Pengajuan::where('status_pengajuan',2)
                    ->with('jenispengajuan')
                    ->with('mahasiswa')
                    ->with('dospem_1')
                    ->with('dospem_2')
                    ->with('dospem_3')
                    ->orderBy('created_at')->get();
        $pengajuan=$jenis=array();
        foreach($aju as $ka=>$va)
        {
            if($va->status_pengajuan==2)
            {
                $pengajuan[$va->id]=$va;
                $jenis[$va->jenis_id]=$va->jenispengajuan->jenis;
            }
        }
        $jadwal=Jadwal::selectRaw('pivot_jadwal.*,jadwals.*, pivot_jadwal.id as pj_id')
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->with('ruangan')
                    ->orderBy('pivot_jadwal.created_at','desc')
                    ->get();

        $jad=array();
        foreach($jadwal as $kj=>$vj)
        {
            $jad[$vj->pj_id]=$vj;
        }
        // dd($jad);
        $pivot=PivotBimbingan::with('dosen')->get();
        $piv=$bimb=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
            $bimb[$v->dosen_id][$v->mahasiswa_id]=$v;
        }

        $acc_sidang=PivotSetujuSidang::all();
        $acc_sid=array();
        foreach($acc_sidang as $k =>$v)
        {
            $acc_sid[$v->pengajuan_id][$v->dosen_id]=$v;
        }
        $ruangan=MasterRuangan::all();
        $ruang=array();
        foreach($ruangan as $k =>$v)
        {
            $ruang[$v->id]=$v;
        }

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=$nilai=array();
        foreach($penguji as $k => $v)
        {

            if(Auth::user()->id_user==$v->penguji_id)
            {
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
            }
        }
        // dd($pengajuan);

        $nilai=Nilai::where('dosen_id',Auth::user()->id_user)->with('dosen')->with('komponen')->get();

        $n=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->jadwal_id]=$vn;
        }
        $perbaikan=PerbaikanSkripsi::where('pembimbing_id',Auth::user()->id_user)->get();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id]=$vn;
        }
        
        $penetapan=PerubahanJudul::all();
        $penp=array();
        foreach($penetapan as $kn => $vn)
        {
            $penp[$vn->pengajuan_id]=$vn;
        }
        // dd($perb);
        return view('pages.dosen.penilaian.index-pembimbing')
                    ->with('acc_sid',$acc_sid)
                    ->with('pengajuan',$pengajuan)     
                    ->with('jadwal',$jad)
                    ->with('ruangan',$ruang)
                    ->with('bimb',$bimb)
                    ->with('n',$n)
                    ->with('perbaikan',$perb) 
                    ->with('penetapan',$penp) 
                    ->with('piv',$piv)
                    ->with('jenis',$jenis)
                    ->with('uji',$uji);

    }

    

    public function form($idjadwal,$idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->with('jenispengajuan')->first();
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

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.jenis_id',0)->get();

        // return $penilaian;
        // dd(Auth::user()->id_user);

        $nilai=Nilai::where('jadwal_id',$idjadwal)->where('dosen_id',Auth::user()->id_user)->with('dosen')->with('komponen')->get();

        $n=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->komponen_id]=$vn;
        }

        // $formnilai=
        // return $n;
        $idjenis=isset($pengajuan->jenispengajuan->id) ? $pengajuan->jenispengajuan->id : -1;
        if($idjenis!=-1)
        {
            $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('module.jenis_id',$idjenis)->get();
        }

        // return $penilaian;
        return view('pages.dosen.penilaian.form',
            compact('pengajuan','jadwal','penilaian','uji','n','idjadwal','idpengajuan','penilaian'));
    }
    public function perbaikan($idjadwal,$idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::select('*',DB::raw('pivot_jadwal.id as pj_id'))
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }
        
        // $dt['jadwal_id'] = $request->jadwal_id;
        // $dt['mahasiswa_id'] = $request->mahasiswa_id;
        // $dt['pembimbing_id'] = $request->pembimbing_id;
        $perbaikan=PerbaikanSkripsi::all();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id][$vn->mahasiswa_id][$vn->pembimbing_id]=$vn;
        }
        
        
        // dd(Auth::user()->id_user);

        

        return view('pages.dosen.penilaian.daftar-perbaikan',
            compact('pengajuan','jadwal','penilaian','uji','perb'));
    }
    public function penetapan($idjadwal,$idpengajuan)
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

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if(Auth::user()->id_user==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();
        // dd(Auth::user()->id_user);

        $penetapan=PerubahanJudul::all();
        $penp=array();
        foreach($penetapan as $kn => $vn)
        {
            $penp[$vn->pengajuan_id][$vn->mahasiswa_id]=$vn;
        }
        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('jenis_id',$pengajuan->jenis_id)->get();
        return view('pages.dosen.penilaian.penetapan-judul',
            compact('pengajuan','jadwal','penilaian','penp'));
    }

    public function simpan_nilai(Request $request)
    {
        // dd($request->all());
        $persen=$request->persen;
        $subtotal=$request->subtotal;
        $status=0;

        $dt['jadwal_id'] = $request->idjadwal;
        $dt['pengajuan_id'] = $request->idpengajuan;
        $dt['dosen_id'] = Auth::user()->id_user;
        Nilai::where($dt)->forceDelete();

        foreach($request->nilai_angka as $k=>$v)
        {
            if($v!=null)
            {
                $insert=new Nilai;
                $insert->penilai = $request->penilai;
                $insert->jadwal_id = $request->idjadwal;
                $insert->pengajuan_id = $request->idpengajuan;
                $insert->nilai_angka = $v;
                $insert->persen = $persen[$k];
                $insert->subtotal = $subtotal[$k];
                $insert->total = $request->total;
                $insert->huruf = $request->huruf;
                $insert->dosen_id = $request->id_dosen;
                $insert->komponen_id = $k;
                $c=$insert->save();
                
                if($c)
                    $status=1;
            }
            else
                $status=0;
        }
        if($status==1)
            $ps="Nilai Berhasil Disimpan";
        else
            $ps="Nilai Gagal Disimpan";

        return Redirect::back()->with('status',$ps);
    }
    public function daftar_perbaikan(Request $request)
    {
        // dd($request->all());
        list($tgl,$bln,$thn)=explode('-',$request->start_date);
        $date=$thn.'-'.$bln.'-'.$tgl;
        
        $dt['jadwal_id'] = $request->jadwal_id;
        $dt['mahasiswa_id'] = $request->mahasiswa_id;
        $dt['pembimbing_id'] = $request->pembimbing_id;
        PerbaikanSkripsi::where($dt)->forceDelete();

        $insert=new PerbaikanSkripsi;
        $insert->jadwal_id	 = $request->jadwal_id;
        $insert->mahasiswa_id	 = $request->mahasiswa_id;
        $insert->pembimbing_id	 = $request->pembimbing_id;
        $insert->perbaikan	 = '<pre>'.$request->perbaikan.'</pre>';
        $insert->batas_waktu = $date;
        $c=$insert->save();

        if($c)
            $ps="Daftar Perbaikan Berhasil Disimpan";
        else
            $ps="Daftar Perbaikan Gagal Disimpan";

        return Redirect::back()->with('status',$ps);
    }
    public function penetapan_judul(Request $request)
    {
        // dd($request->all());
        $idpengajuan=$request->pengajuan_id;

        $dt['pengajuan_id'] = $idpengajuan;
        $dt['mahasiswa_id'] = $request->mahasiswa_id;
        PerubahanJudul::where($dt)->forceDelete();

        $insert = new PerubahanJudul;
        $insert->pengajuan_id = $idpengajuan;
        $insert->mahasiswa_id = $request->mahasiswa_id;
        $insert->judul_ind = $request->judul_indonesia;
        $insert->judul_ing = $request->judul_inggris;
        $insert->status = 0;
        $c=$insert->save();

        if($c)
            $ps="Daftar Perbaikan Berhasil Disimpan";
        else
            $ps="Daftar Perbaikan Gagal Disimpan";

        return Redirect::back()->with('status',$ps);
    }
}
