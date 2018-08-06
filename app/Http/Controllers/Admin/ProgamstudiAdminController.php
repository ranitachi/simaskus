<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterDepartemen;
use App\Model\ProgamStudi;
use App\Model\Dosen;
class ProgamstudiAdminController extends Controller
{
    public function index()
    {
        return view('pages.administrator.program-studi.index');
    }
    public function data()
    {
        $dept=MasterDepartemen::with('pimpinan')->orderBy('nama_departemen')->get();
        $prodi=ProgamStudi::with('pimpinan')->orderBy('departemen_id')->orderBy('nama_program_studi')->get();
        return view('pages.administrator.program-studi.data')
                ->with('prodi',$prodi)
                ->with('dept',$dept);
    }
    public function show($id)
    {
        $det=array();
        $dosen=Dosen::all();
        $dept=MasterDepartemen::all();
        if($id!=-1)
            $det=ProgamStudi::find($id);
        
        return view('pages.administrator.program-studi.form')
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('dept',$dept)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $prodi=new ProgamStudi;
        // $prodi->code=$request->code;
        $prodi->nama_program_studi=$request->nama_program_studi;
        $prodi->departemen_id=$request->departemen_id;
        $prodi->keterangan=$request->keterangan;
        $prodi->pimpinan_id=$request->pimpinan_id;
        $prodi->created_at=date('Y-m-d H:i:s');
        $prodi->updated_at=date('Y-m-d H:i:s');
        $cr=$prodi->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $prodi=ProgamStudi::find($id);
        // $prodi->code=$request->code;
        $prodi->nama_program_studi=$request->nama_program_studi;
        $prodi->departemen_id=$request->departemen_id;
        $prodi->keterangan=$request->keterangan;
        $prodi->pimpinan_id=$request->pimpinan_id;
        $prodi->updated_at=date('Y-m-d H:i:s');
        $up=$prodi->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=ProgamStudi::find($id)->delete();
        return response()->json([$c]);
    }
}
