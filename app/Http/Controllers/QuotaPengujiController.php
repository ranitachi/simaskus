<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QuotaPenguji;
use App\Model\MasterDepartemen;
use App\Model\Users;
use App\Model\MasterJenisPengajuan;
use Auth;
class QuotaPengujiController extends Controller
{
    public function index()
    {
        return view('pages.staf.quota-penguji.index');
    }
    public function data()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        $jenis=MasterJenisPengajuan::all();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $quota=QuotaPenguji::where('departemen_id',$dept_id)->with('departemen')->get();
        return view('pages.staf.quota-penguji.data')
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

        $quota=QuotaPenguji::where('departemen_id',$dept_id)->get();
        $quo=$quodet=array();
        foreach($quota as $k=>$v)
        {
            $quo[$v->level]=$v;
            $quodet[$v->id]=$v;
        }

        $det=array();
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $jenis=MasterJenisPengajuan::where('keterangan','not like',"%Tugas%")->orderBy('keterangan')->orderBy('urutan')->get();
        if($id!=-1)
        {
            // $det=QuotaPenguji::find($id);
            $det=$quodet[$id];
        }
        
        return view('pages.staf.quota-penguji.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('jenis',$jenis)
                ->with('quo',$quo)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $quota=new QuotaPenguji;
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $quota->minimal=$request->minimal;
        $cr=$quota->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $quota= QuotaPenguji::find($id);
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $quota->minimal=$request->minimal;
        $cr=$quota->save();
        return response()->json([$cr]);
    }

    public function destroy($id)
    {
        $c=QuotaPenguji::find($id)->delete();
        return response()->json([$c]);
    }
}
