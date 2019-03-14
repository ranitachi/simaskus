<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Module;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Users;
use Auth;
class ModuleController extends Controller
{
    public function index()
    {
        return view('pages.administrator.module.index');
    }
    public function data()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        
        $module=Module::where('departemen_id',$dept_id)->with('departemen')->with('jenis')->orderBy('nama_module')->get();
        return view('pages.administrator.module.data')
                ->with('dept_id',$dept_id)
                ->with('module',$module);
    }

    public function show($id)
    {
        $det=array();
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        if($id!=-1)
            $det=Module::find($id);
        
        $dept=MasterDepartemen::all();
        // dd($dept);        
        $jenis=MasterJenisPengajuan::orderBy('keterangan')->get();
        return view('pages.administrator.module.form')
                ->with('det',$det)
                ->with('jenis',$jenis)
                ->with('dept',$dept)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $code='mod-'.$request->id_dept.'-'.substr(abs(crc32(rand())),0,3);
        $mod=new Module;
        $mod->code_module=$code;
        $mod->nama_module=$request->nama_module;
        $mod->bobot_module=$request->bobot;
        $mod->jenis_id=$request->jenis_id;
        $mod->departemen_id=$request->id_dept;
        $c=$mod->save();
        return response()->json([$c]);
    }
    public function update(Request $request,$id)
    {
        $mod=Module::find($id);
        $mod->nama_module=$request->nama_module;
        $mod->bobot_module=$request->bobot;
        $mod->jenis_id=$request->jenis_id;
        $mod->departemen_id=$request->id_dept;
        $c=$mod->save();
        return response()->json([$c]);
    }
    public function destroy($id)
    {
        $c=Module::find($id)->delete();
        return response()->json([$c]);
    }
}
