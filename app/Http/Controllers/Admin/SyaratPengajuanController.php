<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterJenisPengajuan;
use App\Model\SyaratPengajuan;
class SyaratPengajuanController extends Controller
{
    public function index()
    {
        return view('pages.administrator.syarat-pengajuan.index');
    }
    public function data()
    {
        $jenis=MasterJenisPengajuan::orderBy('jenis')->get();
        $syarat=SyaratPengajuan::where('flag',1)->with('pengajuan')->get();
        return view('pages.administrator.syarat-pengajuan.data')
                ->with('jenis',$jenis)
                ->with('syarat',$syarat);
    }
    public function show($id)
    {
        $jenis=MasterJenisPengajuan::orderBy('jenis')->get();
        $det=array();
            $det=SyaratPengajuan::find($id);
        
        return view('pages.administrator.syarat-pengajuan.form')
                ->with('det',$det)
                ->with('jenis',$jenis)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $jenis=new SyaratPengajuan;
        $jenis->code=$request->code;
        $jenis->syarat=$request->syarat;
        $jenis->pengajuan_id=$request->pengajuan_id;
        $jenis->keterangan=$request->keterangan;
        $jenis->flag=1;
        $jenis->created_at=date('Y-m-d H:i:s');
        $jenis->updated_at=date('Y-m-d H:i:s');
        $cr=$jenis->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $jenis=SyaratPengajuan::find($id);
        $jenis->code=$request->code;
        $jenis->syarat=$request->syarat;
        $jenis->pengajuan_id=$request->pengajuan_id;
        $jenis->keterangan=$request->keterangan;
        $jenis->flag=1;
        $jenis->updated_at=date('Y-m-d H:i:s');
        $up=$jenis->save();
        return response()->json([$up]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=SyaratPengajuan::find($id)->delete();
        return response()->json([$c]);
    }
}
