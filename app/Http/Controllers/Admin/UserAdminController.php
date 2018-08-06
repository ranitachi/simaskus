<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Staf;
use App\Model\Users;
use App\Model\MasterDepartemen;
use Auth;
class UserAdminController extends Controller
{
    public function index()
    {
        return view('pages.administrator.staf.index');
    }
    public function show($id)
    {
        $det=array();
        $departemen=MasterDepartemen::all();
        if($id!=-1)
        {
            $det=Staf::find($id);
        }
        return view('pages.administrator.staf.form')
                ->with('id',$id)
                ->with('det',$det)
                ->with('departemen',$departemen);
    }

    public function data()
    {
        $departemen=MasterDepartemen::all();
        $mhs=Staf::orderBy('departemen_id','nama')
                ->with('departemen')
                ->get();
        return view('pages.administrator.staf.data')
            ->with('mhs',$mhs)
            ->with('departemen',$departemen);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $m=new Staf;
        $m->nip=$request->nip;
        $m->inisial=$request->inisial;
        $m->nama=$request->nama;
        $m->tempat_lahir=$request->tempat_lahir;
        $m->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $m->gender=$request->gender;
        $m->alamat=$request->alamat;
        $m->kota=$request->kota;
        $m->email=$request->email;
        $m->hp=$request->hp;
        $m->departemen_id=$request->departemen;
        $m->created_at=date('Y-m-d H:i:s');
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();

        $user_id=$m->id;
        $user=new Users;
        $user->name=$request->nama;
        $user->email=$request->email;
        $user->password=bcrypt($request->npm);
        $user->flag=1;
        $user->kat_user=1;
        $user->id_user=$user_id;
        $user->created_at=date('Y-m-d H:i:s');
        $user->updated_at=date('Y-m-d H:i:s');
        $user->save();

        if($cr)
            $pesan="Data Staf Berhasil Di Simpan";
        else
            $pesan="Data Staf Gagal Di Simpan";

        return redirect('staf-admin')->with('status',$pesan);
    }
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $m=Staf::find($id);
        $m->nip=$request->nip;
        $m->inisial=$request->inisial;
        $m->nama=$request->nama;
        $m->tempat_lahir=$request->tempat_lahir;
        $m->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $m->gender=$request->gender;
        $m->alamat=$request->alamat;
        $m->kota=$request->kota;
        $m->email=$request->email;
        $m->hp=$request->hp;
        $m->departemen_id=$request->departemen;
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();

        if($cr)
            $pesan="Data Staf Berhasil Di Edit";
        else
            $pesan="Data Staf Gagal Di Edit";

        return redirect('staf-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=Staf::find($id)->delete();
        return response()->json([$c]);
    }
}
