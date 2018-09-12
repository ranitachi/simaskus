<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\IzinDosen;
use Auth;
class IzinDosenController extends Controller
{
    public function index()
    {
        return view('pages.dosen.izin-dosen.index');
    }
    public function data()
    {
        $id_dosen=Auth::user()->id_user;
        $data=IzinDosen::where('dosen_id',$id_dosen)->get();
        return view('pages.dosen.izin-dosen.data')
            ->with('data',$data);
    } 
    
    public function show($id)
    {
        $det=array();
        if($id!=-1)
            $det=IzinDosen::find($id);

        return view('pages.dosen.izin-dosen.form')
            ->with('det',$det)
            ->with('id',$id); 
    }

    public function store(Request $request)
    {
        list($tg1,$bl1,$th1)=explode('-',$request->start_date);
        list($tg2,$bl2,$th2)=explode('-',$request->end_date);

        $save=new IzinDosen;
        $save->dosen_id=Auth::user()->id_user;
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

        $save=IzinDosen::find($id);
        $save->dosen_id=Auth::user()->id_user;
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
