<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Module;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Users;
use App\Model\Component;
use App\Model\SubComponent;
use Auth;
use DB;
class SubComponentController extends Controller
{
    public function index()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $com_module=Module::select('*', DB::raw('component.id as c_id'))
            ->join('component', 'component.module_id', '=', 'module.id')
            ->join('master_jenis_pengajuan', 'master_jenis_pengajuan.id', '=', 'module.jenis_id')
            ->where('module.departemen_id',$dept_id)
            ->orderBy('component.code_component')->get();

        return view('pages.administrator.sub-component.index')->with('com_module',$com_module);
    }
    public function data($id)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        
        $subcomponent=SubComponent::with('komponen')->orderBy('nama_sub_component')->orderBy('nilai_max','desc')->get();
        $subcom=array();
        foreach($subcomponent as $sc => $vc)
        {
            $subcom[$vc->komponen->code_component][]=$vc;
        }
        return view('pages.administrator.sub-component.data')
                ->with('dept_id',$dept_id)
                ->with('id',$id)
                ->with('subcomponent',$subcomponent);
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
            $det=SubComponent::find($id);
        
        $dept=MasterDepartemen::all();
        // dd($dept);        
        $com_module=Module::select('*', DB::raw('component.id as c_id'))
            ->join('component', 'component.module_id', '=', 'module.id')
            ->join('master_jenis_pengajuan', 'master_jenis_pengajuan.id', '=', 'module.jenis_id')
            ->where('module.departemen_id',$dept_id)
            ->orderBy('component.code_component')->get();


        return view('pages.administrator.sub-component.form')
                ->with('det',$det)
                ->with('com_module',$com_module)
                ->with('dept',$dept)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $code='subcom-'.$request->id_dept.'-'.$request->component.'-'.substr(abs(crc32(rand())),0,3);
        $com=new SubComponent;
        $com->code_sub_component=$request->code_sub_component;
        // $com->category_component=$request->category;
        $com->nama_sub_component=$request->nama_sub_component;
        $com->nilai_min=$request->nilai_min;
        $com->nilai_max=$request->nilai_max;
        $com->huruf_mutu=$request->huruf_mutu;
        $com->component_id=$request->component_id;
        $com->keterangan=$request->keterangan;
        $c=$com->save();
        return response()->json([$c]);
    }
    public function update(Request $request,$id)
    {
        $com=SubComponent::find($id);
        $com->nama_sub_component=$request->nama_sub_component;
        $com->nilai_min=$request->nilai_min;
        $com->nilai_max=$request->nilai_max;
        $com->huruf_mutu=$request->huruf_mutu;
        $com->component_id=$request->component_id;
        $com->keterangan=$request->keterangan;
        $c=$com->save();
        return response()->json([$c]);
    }
    public function destroy($id)
    {
        $c=SubComponent::find($id)->delete();
        return response()->json([$c]);
    }
}
