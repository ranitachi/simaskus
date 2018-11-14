<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QuotaJumlahBimbingan;
use App\Model\QuotaBimbingan;
use App\Model\QuotaPembimbing;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Dosen;
use App\Model\PivotBimbingan;
use App\Model\Users;
use Auth;
class QuotaJumlahBimbinganController extends Controller
{
    public function index()
    {
        return view('pages.staf.minimal-bimbingan.index');
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
        $quota=QuotaJumlahBimbingan::where('departemen_id',$dept_id)->with('departemen')->get();

        $jenis=MasterJenisPengajuan::all();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        return view('pages.staf.minimal-bimbingan.data')
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

        $quota=QuotaJumlahBimbingan::where('departemen_id',$dept_id)->get();
        $quo=$quodet=array();
        foreach($quota as $k=>$v)
        {
            $quo[$v->level]=$v;
            $quodet[$v->id]=$v;
        }

        $det=array();
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $jenis=MasterJenisPengajuan::all();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        if($id!=-1)
        {
            // $det=QuotaJumlahBimbingan::find($id);
            $det=$quodet[$id];
        }
        
        return view('pages.staf.minimal-bimbingan.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('jenis',$jenis)
                ->with('quo',$quo)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $quota=new QuotaJumlahBimbingan;
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->minimal=$request->minimal;
        $cr=$quota->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $quota= QuotaJumlahBimbingan::find($id);
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->minimal=$request->minimal;
        $cr=$quota->save();
        return response()->json([$cr]);
    }

    public function destroy($id)
    {
        $c=QuotaJumlahBimbingan::find($id)->delete();
        return response()->json([$c]);
    }

    public function jlh_pembimbing($idjenis)
    {
        $jenis=MasterJenisPengajuan::find($idjenis);                     
        $quota=QuotaJumlahBimbingan::where('level',$idjenis)->first();

        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        } 
        // dd($quota);
        $dosen=Dosen::where('departemen_id',$dept_id)->get();

        $pivot=PivotBimbingan::with('dosen')->get();
        $piv=array();
        foreach($pivot as $kp=>$vp)
        {
            if($vp->dosen->departemen_id==$dept_id)
            {
                $piv[$vp->dosen_id][]=$vp;
            }
        }

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
                ->with('quota_bim',$qb)
                ->with('jenis',$jenis)
                ->with('quota',$quota);
    }
}
