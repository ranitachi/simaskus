<?php
namespace App\Http\Controllers\Admin;

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
class PenilaianControllerStaf extends Controller
{
    public function form_pembimbing($idjadwal,$idpengajuan)
    {
        $dos=array();
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->with('jenispengajuan')->first();
        $jadwal=Jadwal::selectRaw('pivot_jadwal.*,jadwals.*, pivot_jadwal.id as pj_id')
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->get();

        $jad=array();
        foreach($jadwal as $kj=>$vj)
        {
            $jad[$vj->pj_id]=$vj;
        }

        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }  

        $pivot=PivotBimbingan::where('judul_id',$idpengajuan)->with('dosen')->get();
        $piv=$bimb=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
            $dd['nama']=$v->dosen->nama;
            $dd['nip']=$v->dosen->nip;
            $dd['iddosen']=$v->dosen_id;
            $dd['kategori']=$kat='pembimbing';
            $dos[$v->dosen_id][$kat]=$dd;
        }

        $penguji=PivotPenguji::where('pengajuan_id',$idpengajuan)->with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
            $dd['nama']=$v->dosen->nama;
            $dd['nip']=$v->dosen->nip;
            $dd['iddosen']=$v->penguji_id;
            $dd['kategori']=$kat='penguji';
            if(!isset($dos[$v->penguji_id]['pembimbing']))
                $dos[$v->penguji_id][$kat]=$dd;
        }

        
        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('component.module_id',1)->get();

        $nilai=Nilai::where('jadwal_id',$idjadwal)->with('dosen')->with('komponen')->get();

        $n=$n2=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->penilai][$vn->dosen_id]=$vn;
            $n2[$vn->dosen_id][$vn->komponen_id]=$vn;
        }

        $perbaikan=PerbaikanSkripsi::get();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id][$vn->pembimbing_id]=$vn;
        }

        $penetapan=PerubahanJudul::all();
        $penp=array();
        foreach($penetapan as $kn => $vn)
        {
            $penp[$vn->pengajuan_id]=$vn;
        }

        $idjenis=isset($pengajuan->jenispengajuan->id) ? $pengajuan->jenispengajuan->id : -1;
        if($idjenis!=-1)
        {
            $pen=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('module.jenis_id',$idjenis)->get();
            if($pen->count()!=0)
                $penilaian=$pen;

        }
        // return ($penilaian);
        return view('pages.staf.penilaian.index',
            compact('pengajuan','jad','jadwal','penilaian','uji','n','n2','idjadwal','idpengajuan','dos','perb','penp'));
    }

    public function form($idjadwal,$idpengajuan,$iddosen)
    {
        list($kategori,$iddosen)=explode('-',$iddosen);
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->with('jenispengajuan')->first();
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if($iddosen==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }

        $penilaian=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('component.module_id',1)->get();
        // dd(Auth::user()->id_user);

        $nilai=Nilai::where('jadwal_id',$idjadwal)->where('dosen_id',$iddosen)->with('dosen')->with('komponen')->get();

        $n=array();
        foreach($nilai as $kn => $vn)
        {
            $n[$vn->komponen_id]=$vn;
        }

        $dosen=Dosen::find($iddosen);
        $idjenis=isset($pengajuan->jenispengajuan->id) ? $pengajuan->jenispengajuan->id : -1;
        if($idjenis!=-1)
        {
            $pen=Component::select('*',DB::raw('component.id as c_id'))
                    ->join('module','module.id','=','component.module_id')
                    ->where('module.departemen_id',$dept_id)
                    ->where('module.jenis_id',$idjenis)->get();
            if($pen->count()!=0)
                $penilaian=$pen;

        }
        // dd(Auth::user()->id_user);

        return view('pages.staf.penilaian.form',
            compact('pengajuan','jadwal','penilaian','uji','n','idjadwal','idpengajuan','iddosen','dosen','kategori'));
    }

    public function simpan_nilai(Request $request)
    {
        // dd($request->all());
        $persen=$request->persen;
        $subtotal=$request->subtotal;
        $status=0;

        $dt['jadwal_id'] = $request->idjadwal;
        $dt['pengajuan_id'] = $request->idpengajuan;
        $dt['dosen_id'] = $request->iddosen;
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
                $insert->dosen_id = $request->iddosen;
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

    public function perbaikan($idjadwal,$idpengajuan,$iddosen)
    {
        // list($kategori,$iddosen)=explode('-',$request->pembimbing_id);
        list($kategori,$iddosen)=explode('-',$iddosen);
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::select('*',DB::raw('pivot_jadwal.id as pj_id'))
                    ->join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if($iddosen==$v->penguji_id)
                $uji[$v->pivot_jadwal_id][$v->penguji_id]=$v;
        }
        $perbaikan=PerbaikanSkripsi::all();
        $perb=array();
        foreach($perbaikan as $kn => $vn)
        {
            $perb[$vn->jadwal_id][$vn->mahasiswa_id][$vn->pembimbing_id]=$vn;
        }
        return view('pages.staf.penilaian.daftar-perbaikan',
            compact('pengajuan','jadwal','penilaian','uji','perb','iddosen','idjadwal'));
    }

    public function daftar_perbaikan(Request $request)
    {
        // dd($request->all());
        list($tgl,$bln,$thn)=explode('-',$request->start_date);
        $date=$thn.'-'.$bln.'-'.$tgl;
        // list($kategori,$iddosen)=explode('-',$request->pembimbing_id);
        $iddosen=$request->pembimbing_id;
        $dt['jadwal_id'] = $request->jadwal_id;
        $dt['mahasiswa_id'] = $request->mahasiswa_id;
        $dt['pembimbing_id'] = $iddosen;
        PerbaikanSkripsi::where($dt)->forceDelete();

        $insert=new PerbaikanSkripsi;
        $insert->jadwal_id	 = $request->jadwal_id;
        $insert->mahasiswa_id	 = $request->mahasiswa_id;
        $insert->pembimbing_id	 = $iddosen;
        $insert->perbaikan	 = '<pre>'.$request->perbaikan.'</pre>';
        $insert->batas_waktu = $date;
        $c=$insert->save();

        if($c)
            $ps="Daftar Perbaikan Berhasil Disimpan";
        else
            $ps="Daftar Perbaikan Gagal Disimpan";

        return Redirect::back()->with('status',$ps);
    }

    public function penetapan($idjadwal,$idpengajuan,$iddosen)
    {
        list($kategori,$iddosen)=explode('-',$iddosen);
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('mahasiswa')->first();
        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.id',$idjadwal)
                    ->with('ruangan')
                    ->first();

        $user=Users::where('id',Auth::user()->id)->with('dosen')->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }  

        $penguji=PivotPenguji::with('dosen')->get();
        $uji=array();
        foreach($penguji as $k => $v)
        {
            if($iddosen==$v->penguji_id)
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
        // dd($penp);
        return view('pages.staf.penilaian.penetapan-judul',
            compact('pengajuan','jadwal','penilaian','penp','iddosen'))->with('penetapan',$penp);
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
