<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QuotaBimbingan;
use App\Model\MasterDepartemen;
use App\Model\Users;
use Auth;
class QuotaBimbinganController extends Controller
{
    public function index()
    {
        return view('pages.staf.quota-bimbingan.index');
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
        $quota=QuotaBimbingan::where('departemen_id',$dept_id)->with('departemen')->get();
        return view('pages.staf.quota-bimbingan.data')
                ->with('quota',$quota)
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

        $quota=QuotaBimbingan::where('departemen_id',$dept_id)->get();
        $quo=$quodet=array();
        foreach($quota as $k=>$v)
        {
            $quo[$v->level]=$v;
            $quodet[$v->id]=$v;
        }

        $det=array();
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        if($id!=-1)
        {
            // $det=QuotaPenguji::find($id);
            $det=$quodet[$id];
        }
        
        return view('pages.staf.quota-bimbingan.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('quo',$quo)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $quota=new QuotaBimbingan;
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $cr=$quota->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $quota= QuotaBimbingan::find($id);
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $cr=$quota->save();
        return response()->json([$cr]);
    }

    public function destroy($id)
    {
        $c=QuotaBimbingan::find($id)->delete();
        return response()->json([$c]);
    }
}
