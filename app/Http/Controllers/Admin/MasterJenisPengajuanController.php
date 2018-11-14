<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterJenisPengajuan;
use App\User;
use App\Model\Staf;
use Auth;
class MasterJenisPengajuanController extends Controller
{
    public function index()
    {
        $dept_id=0;
        $staf=Staf::find(Auth::user()->id_user);
        if($staf)
            $dept_id=$staf->departemen_id;
        return view('pages.administrator.jenis-pengajuan.index')->with('dept_id',$dept_id);
    }
    public function data($dept_id=null)
    {
        if($dept_id==null || $dept_id==0)
            $jenis=MasterJenisPengajuan::orderBy('jenis')->get();
        else
        {
            $jenis=MasterJenisPengajuan::where('departemen_id',$dept_id)->orderBy('jenis')->get();
        }

        return view('pages.administrator.jenis-pengajuan.data')
                ->with('dept',$jenis);
    }
    public function show($id)
    {
        $det=array();
        // $det=MasterJenisPengajuan::find($id);
        // if($id!=-1)
            $det=MasterJenisPengajuan::find($id);
        
        $dept_id=0;
        $staf=Staf::find(Auth::user()->id_user);
        if($staf)
            $dept_id=$staf->departemen_id;

        return view('pages.administrator.jenis-pengajuan.form')
                ->with('det',$det)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $jenis=new MasterJenisPengajuan;
        $jenis->code=$request->code;
        $jenis->jenis=$request->jenis;
        $jenis->keterangan=$request->keterangan;
        $jenis->departemen_id=$request->departemen_id;
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
        $jenis->departemen_id=$request->departemen_id;
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
