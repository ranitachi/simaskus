<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Jenjang;
use App\Model\MasterDepartemen;
class JenjangController extends Controller
{
    public function index()
    {
        return view('pages.administrator.jenjang.index');
    }
    public function data()
    {

        $jenjang=Jenjang::orderBy('jenjang')->get();
        return view('pages.administrator.jenjang.data')
                ->with('jenjang',$jenjang);
    }
    public function show($id)
    {
        $dept=MasterDepartemen::all();
        $det=array();
        if($id!=-1)
            $det=Jenjang::find($id);
        
            return view('pages.administrator.jenjang.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $jenjang=new Jenjang;
        $jenjang->jenjang=$request->jenjang;
        $jenjang->desc=$request->desc;
        $jenjang->flag_active=1;
        $jenjang->departemen_id=$request->departemen_id;
        $jenjang->created_at=date('Y-m-d H:i:s');
        $jenjang->updated_at=date('Y-m-d H:i:s');
        $cr=$jenjang->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $jenjang=Jenjang::find($id);
        $jenjang->jenjang=$request->jenjang;
        $jenjang->desc=$request->desc;
        $jenjang->departemen_id=$request->departemen_id;
        $jenjang->updated_at=date('Y-m-d H:i:s');
        $up=$jenjang->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=Jenjang::find($id)->delete();
        return response()->json([$c]);
    }
}
