<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterJenisPengajuan;
class MasterJenisPengajuanController extends Controller
{
    public function index()
    {
        return view('pages.administrator.jenis-pengajuan.index');
    }
    public function data()
    {
        $jenis=MasterJenisPengajuan::orderBy('jenis')->get();
        return view('pages.administrator.jenis-pengajuan.data')
                ->with('dept',$jenis);
    }
    public function show($id)
    {
        $det=array();
        // $det=MasterJenisPengajuan::find($id);
        // if($id!=-1)
            $det=MasterJenisPengajuan::find($id);
        
        return view('pages.administrator.jenis-pengajuan.form')
                ->with('det',$det)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $jenis=new MasterJenisPengajuan;
        $jenis->code=$request->code;
        $jenis->jenis=$request->jenis;
        $jenis->keterangan=$request->keterangan;
        $jenis->created_at=date('Y-m-d H:i:s');
        $jenis->updated_at=date('Y-m-d H:i:s');
        $cr=$jenis->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $jenis=MasterJenisPengajuan::find($id);
        $jenis->code=$request->code;
        $jenis->jenis=$request->jenis;
        $jenis->keterangan=$request->keterangan;
        $jenis->updated_at=date('Y-m-d H:i:s');
        $up=$jenis->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=MasterJenisPengajuan::find($id)->delete();
        return response()->json([$c]);
    }
}
