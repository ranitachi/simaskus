<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterPimpinan;
use App\Model\Dosen;
use App\Model\MasterDepartemen;
use App\Model\Users;
use Auth;
class PimpinanController extends Controller
{
    public function index()
    {
        $dosen=Dosen::with('departemen')->orderBy('nama')->get();
        $pimpinan=MasterPimpinan::where('status',1)->where('jabatan','not like',"%departemen%")->with('dosen')->with('departemen')->orderBy('jabatan')->get();
        return view('pages.administrator.pimpinan.index')
            ->with('dosen',$dosen)
            ->with('pimpinan',$pimpinan);
    }

    public function show($id)
    {
        $dept=MasterDepartemen::all();
        $dosen=Dosen::all();
        $det=array();
        if($id!=-1)
            $det=MasterPimpinan::find($id);
        
        return view('pages.administrator.pimpinan.form')
                ->with('dept',$dept)
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('id',$id);
    }

    public function simpan(Request $request,$id=-1)
    {
        if($id==-1)
        {
            $cek=MasterPimpinan::where('jabatan','like',"%$request->jabatan%")->where('dosen_id',$request->dosen_id)->get();

            foreach($cek as $k=>$v)
            {
                    $v->status=0;
                    $v->deleted_at=date('Y-m-d H:i:s');
                    $v->save();
            }

            $pimp=new MasterPimpinan;
        }
        else
            $pimp=MasterPimpinan::find($id);

        $pimp->dosen_id=$request->dosen_id;
        $pimp->jabatan=$request->jabatan;
        $pimp->departemen_id=0;
        $pimp->status=1;
        $pimp->save();
        
        if($id==-1)
            return redirect('pimpinan-fakultas')->with('status','Data Pimpinan Fakultas Berhasil Di Tambah');
        else
            return redirect('pimpinan-fakultas')->with('status','Data Pimpinan Fakultas Berhasil Di Edit');
        // return $cek;
        // return $request->all();
    }
}
