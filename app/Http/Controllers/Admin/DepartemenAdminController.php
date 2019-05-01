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
        // $comparison = new \Atomescrochus\StringSimilarities\Compare(); 
        // $s1='Departemen Arsitektur';
        // $s2='departemen arsitektur';
        // $all = $comparison->jaroWinkler($s1,$s2);
        // return $all;
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
        // $comparison = new \Atomescrochus\StringSimilarities\Compare();
        $s1=str_slug($request->nama_departemen);
        $mdept=MasterDepartemen::all();
        foreach($mdept as $v)
        {
            $s2=str_slug($v->nama_departemen);
            // $cek=$comparison->jaroWinkler($s1,$s2);
            if($s1==$s2)
            {
                return response()->json(['status'=>'0','pesan'=>'Data Yang Anda Kirim Sudah Ada Di Database']);
            }
        }

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
        $n_dept=$dept->nama_departemen;
        $dept->code=$request->code;
        $dept->nama_departemen=$request->nama_departemen;
        // $dept->pimpinan_id=$request->pimpinan_id;
        $dept->flag='1';
        $dept->updated_at=date('Y-m-d H:i:s');


        // $comparison = new \Atomescrochus\StringSimilarities\Compare();
        $s1=str_slug($request->nama_departemen);
        $s2=str_slug($n_dept);
        
        if($s1==$s2)
        {
            return response()->json(['status'=>'0','pesan'=>'Data Yang Anda Kirim Sudah Ada Di Database']);
        }
        else
        {
            $up=$dept->save();
            return response()->json([$up]);
        }
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=MasterDepartemen::find($id)->delete();
        return response()->json([$c]);
    }
}
