<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Module;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Users;
use App\Model\Component;
use Auth;
class ComponentController extends Controller
{
    public function index()
    {
        $jenis=MasterJenisPengajuan::all();
        return view('pages.administrator.component.index')->with('jenis',$jenis);
    }
    public function data($id)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        
        $component=Component::with('module')->orderBy('code_component')->get();
        
        return view('pages.administrator.component.data')
                ->with('dept_id',$dept_id)
                ->with('id',$id)
                ->with('component',$component);
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

        $category=array('-None-','Pembimbing','Penguji','Penguji dan Pembimbing','Pembimbing Lapangan');

        if($id!=-1)
            $det=Component::find($id);
        
        $dept=MasterDepartemen::all();
        // dd($dept);        
        $module=Module::where('departemen_id',$dept_id)->with('jenis')->get();
        return view('pages.administrator.component.form')
                ->with('det',$det)
                ->with('module',$module)
                ->with('dept',$dept)
                ->with('dept_id',$dept_id)
                ->with('category',$category)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        // $code='com-'.$request->id_dept.'-'.$request->module_id.'-'.substr(abs(crc32(rand())),0,3);
        $com=new Component;
        $com->code_component=$request->code_component;
        // $com->category_component=$request->category;
        $com->nama_component=$request->nama_component;
        $com->bobot_component=str_replace(array(',','.'),'',$request->bobot);
        $com->bobot_penguji=str_replace(array(',','.'),'',$request->bobot_penguji);
        $com->bobot_pembimbing_lapangan=str_replace(array(',','.'),'',$request->bobot_pembimbing_lapangan);
        $com->module_id=$request->module_id;
        $c=$com->save();
        return response()->json([$c]);
    }
    public function update(Request $request,$id)
    {
        $com=Component::find($id);
        $com->code_component=$request->code_component;
         $com->nama_component=$request->nama_component;
        $com->bobot_penguji=str_replace(array(',','.'),'',$request->bobot_penguji);
        $com->bobot_pembimbing_lapangan=str_replace(array(',','.'),'',$request->bobot_pembimbing_lapangan);
        $com->bobot_component=str_replace(array(',','.'),'',$request->bobot);
        $com->module_id=$request->module_id;
        // $com->category_component=$request->category;
        $c=$com->save();
        return response()->json([$c]);
    }
    public function destroy($id)
    {
        $c=Component::find($id)->delete();
        return response()->json([$c]);
    }
}
