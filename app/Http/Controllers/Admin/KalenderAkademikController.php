<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MasterRuangan;
use App\Model\MasterDepartemen;
use App\Model\KalenderAkademik;
use App\Model\TahunAjaran;
use App\Model\Users;
use Auth;
class KalenderAkademikController extends Controller
{
    public function index()
    {
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->get();
        return view('pages.administrator.kalender-akademik.index')->with('ta',$ta);
    }
    public function data($ta)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }
        $dept=MasterDepartemen::find($dept_id);
        //if()
        $kalender=KalenderAkademik::where('departemen_id',$dept_id)->where('tahunajaran_id',$ta)->orderBy('start_date')->get();
        return view('pages.administrator.kalender-akademik.data')
                ->with('kalender',$kalender)
                ->with('dept',$dept);
    }
    public function show($idta,$id)
    {
        $dept=MasterDepartemen::all();
        $det=array();
        if($id!=-1)
            $det=KalenderAkademik::find($id);

        // dd($det  );
        $ta=TahunAjaran::all();
        $tahunajaran=array();
        foreach($ta as $t=>$a)
        {
            $tahunajaran[$a->id]=$a;
        }

        return view('pages.administrator.kalender-akademik.form')
                ->with('dept',$dept)
                ->with('det',$det)
                ->with('tahunajaran',$tahunajaran[$idta])
                ->with('idta',$idta)
                ->with('id',$id);
    }
    public function proses(Request $request,$idta,$id)
    {
        if($id!=-1)
        {
            $kalender=KalenderAkademik::find($id);
        }
        else
        {
            $kalender=new KalenderAkademik;
        }
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=$user->staf->departemen_id;
        // dd($dept_id); 
        $kalender->start_date=date('Y-m-d',strtotime($request->start_date));
        $kalender->end_date=date('Y-m-d',strtotime($request->end_date));
        $kalender->keterangan=$request->deskripsi;
        $kalender->kegiatan=$request->kegiatan;
        $kalender->tahunajaran_id=$idta;
        $kalender->kategori_khusus=$request->kategori_khusus;
        $kalender->status_sidang=$request->status_sidang;
        $kalender->departemen_id=$dept_id;
        $cr=$kalender->save();
        // return response()->json([$cr]);

        return redirect('kalender-akademik')->with('status','Data Kalender Akademik Berhasil Di Simpan')->with('idta',$idta);
    }

    public function destroy($id)
    {
        $c=KalenderAkademik::find($id)->delete();
        return response()->json([$c]);
    }
}
