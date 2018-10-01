<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dosen;
use App\Model\IzinDosen;
use App\Model\Users;
use Auth;
class IzinDosenController extends Controller
{
    public function index()
    {
        return view('pages.dosen.izin-dosen.index');
    }
    public function data()
    {
        $katuser=Auth::user()->kat_user;
        $dept_id=0;
        $user=Users::where('id',Auth::user()->id)->with('dosen')->with('mahasiswa')->with('staf')->first();
        if($katuser==1)
        {
            $dept_id=$user->staf->departemen_id;
            // $dosen=Dosen::where('departemen_id',$dept_id)->get();
            $data=IzinDosen::with('dosen')->get();
        } 
        elseif($katuser==2)
        {
            $id_dosen=Auth::user()->id_user;
            $data=IzinDosen::where('dosen_id',$id_dosen)->with('dosen')->get();
        } 
        
        return view('pages.dosen.izin-dosen.data')
            ->with('dept_id',$dept_id)
            ->with('data',$data);
    } 
    
    public function show($id)
    {
        $det=array();
        
        $user=Users::where('id',Auth::user()->id)->with('dosen')->with('mahasiswa')->with('staf')->first();
        $dept_id=0;
        $dosen=array();
        $katuser=Auth::user()->kat_user;
        if($katuser==1)
        {
            $dept_id=$user->staf->departemen_id;
            $dosen=Dosen::where('departemen_id',$dept_id)->get();
        } 
        elseif($katuser==2)
        {
            $dept_id=$user->dosen->departemen_id;
        } 



        if($id!=-1)
            $det=IzinDosen::find($id);

        return view('pages.dosen.izin-dosen.form')
            ->with('det',$det)
            ->with('dosen',$dosen)
            ->with('dept_id',$dept_id)
            ->with('katuser',$katuser)
            ->with('id',$id); 
    }

    public function store(Request $request)
    {
        list($tg1,$bl1,$th1)=explode('-',$request->start_date);
        list($tg2,$bl2,$th2)=explode('-',$request->end_date);

        $katuser=Auth::user()->kat_user;
        $dosen=Auth::user()->id_user;
        if($katuser==1)
        {
            $dosen=$request->dosen;
        } 

        $save=new IzinDosen;
        $save->dosen_id=$dosen;
        $save->start_date=$th1.'-'.$bl1.'-'.$tg1;
        $save->end_date=$th2.'-'.$bl2.'-'.$tg2;
        $save->start_time=$request->start_time;
        $save->end_time=$request->end_time;
        $save->keterangan=$request->keterangan;
        $save->status=1;
        $c=$save->save();
        return response()->json([$c]);
    }

    public function update(Request $request,$id)
    {
        list($tg1,$bl1,$th1)=explode('-',$request->start_date);
        list($tg2,$bl2,$th2)=explode('-',$request->end_date);

        $katuser=Auth::user()->kat_user;
        $dosen=Auth::user()->id_user;
        if($katuser==1)
        {
            $dosen=$request->dosen;
        } 

        $save=IzinDosen::find($id);
        $save->dosen_id=$dosen;
        $save->start_date=$th1.'-'.$bl1.'-'.$tg1;
        $save->end_date=$th2.'-'.$bl2.'-'.$tg2;
        $save->start_time=$request->start_time;
        $save->end_time=$request->end_time;
        $save->keterangan=$request->keterangan;
        $save->status=1;
        $c=$save->save();
        return response()->json([$c]);
    }

    public function destroy($id)
    {
        IzinDosen::find($id)->delete();
        return response()->json(["done"]);
    }
}
