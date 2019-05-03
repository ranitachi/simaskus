<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterRuangan;
use App\Model\Staf;
use App\Model\MasterDepartemen;
use Auth;
class MasterRuanganController extends Controller
{
    public function index()
    {
        return view('pages.administrator.ruangan.index');
    }
    public function data()
    {
        if(Auth::user()->kat_user==1)
        {
            $user=Staf::find(Auth::user()->id_user);
            $ruangan=MasterRuangan::where('departemen_id',$user->departemen_id)->with('departemen')->orderBy('nama_ruangan')->get();
        }
        else
            $ruangan=MasterRuangan::with('departemen')->orderBy('nama_ruangan')->get();
            
        return view('pages.administrator.ruangan.data')
                ->with('ruangan',$ruangan);
    }
    public function show($id)
    {
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $user=Staf::find(Auth::user()->id_user);
            $dept=MasterDepartemen::where('id',$user->departemen_id)->get();
            $dept_id=$user->departemen_id;
        }
        else
            $dept=MasterDepartemen::all();
        $det=array();
            $det=MasterRuangan::find($id);
        
        return view('pages.administrator.ruangan.form')
                ->with('dept_id',$dept_id)
                ->with('dept',$dept)
                ->with('det',$det)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $ruangan=new MasterRuangan;
        $ruangan->code_ruangan=$request->code_ruangan;
        $ruangan->nama_ruangan=$request->nama_ruangan;
        $ruangan->deskripsi=$request->deskripsi;
        $ruangan->departemen_id=$request->departemen_id;
        $ruangan->lokasi=$request->lokasi;
        $ruangan->lokasi_kuliah=$request->lokasi_kuliah;
        $ruangan->ruang_sidang_promosi=$request->sidang_promosi;
        $ruangan->created_at=date('Y-m-d H:i:s');
        $ruangan->updated_at=date('Y-m-d H:i:s');
        $cr=$ruangan->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $ruangan=MasterRuangan::find($id);
        $ruangan->code_ruangan=$request->code_ruangan;
        $ruangan->nama_ruangan=$request->nama_ruangan;
        $ruangan->deskripsi=$request->deskripsi;
        $ruangan->departemen_id=$request->departemen_id;
        $ruangan->lokasi_kuliah=$request->lokasi_kuliah;
        $ruangan->lokasi=$request->lokasi;
        $ruangan->ruang_sidang_promosi=$request->sidang_promosi;
        $ruangan->updated_at=date('Y-m-d H:i:s');
        $up=$ruangan->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=MasterRuangan::find($id)->delete();
        return response()->json([$c]);
    }
}
