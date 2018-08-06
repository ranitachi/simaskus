<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MasterPimpinan;
use App\Model\MasterDepartemen;
use App\Model\Dosen;
use Auth;
class MasterPimpinanController extends Controller
{
    public function index()
    {
        return view('pages.staf.pimpinan.index');
    }
    public function data()
    {
        $deptId=Auth::user()->staf_user->departemen_id;
        $pimpinan=MasterPimpinan::where('departemen_id',$deptId)->with('dosen')->with('departemen')->get();
        return view('pages.staf.pimpinan.data')
                ->with('pimpinan',$pimpinan);
    }
    public function show($id)
    {
        $deptId=Auth::user()->staf_user->departemen_id;
        $dept=MasterDepartemen::all();
        // $dosen=Dosen::where('departemen_id',$deptId)->get();
        $dosen=Dosen::all();
        $det=array();
        if($id!=-1)
            $det=MasterPimpinan::find($id);
        
        return view('pages.staf.pimpinan.form')
                ->with('dept',$dept)
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $pimpinan=new MasterPimpinan;
        $pimpinan->dosen_id=$request->dosen_id;
        $pimpinan->departemen_id=$request->departemen_id;
        $pimpinan->jabatan=$request->jabatan;
        $pimpinan->status='1';
        $pimpinan->created_at=date('Y-m-d H:i:s');
        $pimpinan->updated_at=date('Y-m-d H:i:s');
        $cr=$pimpinan->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $pimpinan=MasterPimpinan::find($id);
        $pimpinan->dosen_id=$request->dosen_id;
        $pimpinan->departemen_id=$request->departemen_id;
        $pimpinan->jabatan=$request->jabatan;
        $pimpinan->updated_at=date('Y-m-d H:i:s');
        $up=$pimpinan->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=MasterPimpinan::find($id)->delete();
        return response()->json([$c]);
    }
}
