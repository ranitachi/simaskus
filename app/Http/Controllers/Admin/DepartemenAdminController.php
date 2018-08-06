<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterDepartemen;
use App\Model\Dosen;
class DepartemenAdminController extends Controller
{
    public function index()
    {
        return view('pages.administrator.departemen.index');
    }
    public function data()
    {
        $dept=MasterDepartemen::with('pimpinan')->orderBy('nama_departemen')->get();
        return view('pages.administrator.departemen.data')
                ->with('dept',$dept);
    }
    public function show($id)
    {
        $det=array();
        $dosen=Dosen::all();
        if($id!=-1)
            $det=MasterDepartemen::find($id);
        
        return view('pages.administrator.departemen.form')
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $dept=new MasterDepartemen;
        $dept->code=$request->code;
        $dept->nama_departemen=$request->nama_departemen;
        // $dept->pimpinan_id=$request->pimpinan_id;
        $dept->flag='1';
        $dept->created_at=date('Y-m-d H:i:s');
        $dept->updated_at=date('Y-m-d H:i:s');
        $cr=$dept->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $dept=MasterDepartemen::find($id);
        $dept->code=$request->code;
        $dept->nama_departemen=$request->nama_departemen;
        // $dept->pimpinan_id=$request->pimpinan_id;
        $dept->flag='1';
        $dept->updated_at=date('Y-m-d H:i:s');
        $up=$dept->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=MasterDepartemen::find($id)->delete();
        return response()->json([$c]);
    }
}
