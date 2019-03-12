<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QuotaBimbingan;
use App\Model\QuotaPembimbing;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Dosen;
use App\Model\PivotBimbingan;
use App\Model\Pengajuan;
use App\Model\Users;
use Auth;
class QuotaPembimbingController extends Controller
{
    public function index()
    {
        return view('pages.staf.quota-pembimbing.index');
    }
    public function data()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $quota=QuotaPembimbing::where('departemen_id',$dept_id)->with('departemen')->get();

        $jenis=MasterJenisPengajuan::where('departemen_id',$dept_id)->orderBy('keterangan')->orderBy('urutan')->get();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        return view('pages.staf.quota-pembimbing.data')
                ->with('quota',$quota)
                ->with('jns',$jns)
                ->with('dept',$dept);
    }
    public function show($id)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $quota=QuotaPembimbing::where('departemen_id',$dept_id)->get();
        $quo=$quodet=array();
        foreach($quota as $k=>$v)
        {
            $quo[$v->level]=$v;
            $quodet[$v->id]=$v;
        }

        $det=array();
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $jenis=MasterJenisPengajuan::where('departemen_id',$dept_id)->orderBy('keterangan')->orderBy('urutan')->get();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        if($id!=-1)
        {
            // $det=QuotaPembimbing::find($id);
            $det=$quodet[$id];
        }
        // return $dept_id;
        return view('pages.staf.quota-pembimbing.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('jenis',$jenis)
                ->with('quo',$quo)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $quota=new QuotaPembimbing;
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $quota->maksimal=$request->maksimal;
        $quota->keterangan=$request->keterangan;
        $cr=$quota->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $quota= QuotaPembimbing::find($id);
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->maksimal=$request->maksimal;
        $quota->quota=$request->quota;
        $quota->keterangan=$request->keterangan;
        $cr=$quota->save();
        return response()->json([$cr]);
    }

    public function destroy($id)
    {
        $c=QuotaPembimbing::find($id)->delete();
        return response()->json([$c]);
    }

    public function jlh_pembimbing($idjenis,$kat_dosen=null,$idpengajuan=null)
    {
        $jenis=MasterJenisPengajuan::find($idjenis);                     
        $quota=QuotaPembimbing::where('level',$idjenis)->first();

        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        } 
        if($kat_dosen==null || $kat_dosen==1)
            $dosen=Dosen::where('departemen_id',$dept_id)->get();
        else
            $dosen=Dosen::all();
        
        // dd($dosen);
        $p_ajuan=array();

        if($idpengajuan!=null)
        {
            $pengajuan=Pengajuan::where('id',$idpengajuan)->get();
            foreach($pengajuan as $k=>$v)
            {
                $p_ajuan[$v->id]=$v;
            }
        }

        $pivot=PivotBimbingan::with('dosen')->get();
        $piv=array();
        $promotor=$copromotor=array();
        foreach($pivot as $kp=>$vp)
        {
            if($vp->dosen->departemen_id==$dept_id)
            {
                $piv[$vp->dosen_id][]=$vp;
            }
            if($idpengajuan!=null)
            {
                if($pengajuan[0]->id==$vp->judul_id)
                {
                    if($vp->keterangan=='promotor')
                    {
                        $promotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                    elseif($vp->keterangan=='co-promotor')
                    {
                        $copromotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                }
            }
        }
        // dd($p_ajuan);
        $qut_bim=QuotaBimbingan::all();
        $qb=array();
        foreach($qut_bim as $kq=>$vq)
        {
            $qb[$vq->level]=$vq;
        }
        // dd($qb);
        return view('pages.administrator.dosen.jumlah-pembimbing')
                ->with('dosen',$dosen)
                ->with('piv',$piv)
                ->with('pengajuan',$p_ajuan)
                ->with('promotor',$promotor)
                ->with('copromotor',$copromotor)
                ->with('quota_bim',$qb)
                ->with('jenis',$jenis)
                ->with('kat_dosen',$kat_dosen)
                ->with('quota',$quota);
    }
}
