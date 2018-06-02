<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Mahasiswa;
use App\Model\Users;
use App\Model\MasterDepartemen;
use Auth;
class MahasiswaAdminController extends Controller
{
    public function index()
    {
        return view('pages.administrator.mahasiswa.index');
    }
    public function show($id)
    {
        $det=array();
        $departemen=MasterDepartemen::all();
        if($id!=-1)
        {
            $det=Mahasiswa::find($id);
        }
        return view('pages.administrator.mahasiswa.form')
                ->with('id',$id)
                ->with('det',$det)
                ->with('departemen',$departemen);
    }

    public function data()
    {
        $departemen=MasterDepartemen::all();
        $mhs=Mahasiswa::orderBy('departemen_id','nama')
                ->with('departemen')
                ->with('programstudi')
                ->get();
        return view('pages.administrator.mahasiswa.data')
            ->with('mhs',$mhs)
            ->with('departemen',$departemen);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $m=new Mahasiswa;
        $m->npm=$request->npm;
        $m->nama=$request->nama;
        $m->tempat_lahir=$request->tempat_lahir;
        $m->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $m->gender=$request->gender;
        $m->alamat=$request->alamat;
        $m->kota=$request->kota;
        $m->email=$request->email;
        $m->hp=$request->hp;
        $m->tahun_masuk=$request->tahun_masuk;
        $m->departemen_id=$request->departemen;
        $m->program_studi_id=$request->program_studi;
        $m->created_at=date('Y-m-d H:i:s');
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();
        
        $user_id=$m->id;
        $user=new Users;
        $user->name=$request->nama;
        $user->email=$request->email;
        $user->password=bcrypt($request->npm);
        $user->flag=1;
        $user->kat_user=3;
        $user->id_user=$user_id;
        $user->created_at=date('Y-m-d H:i:s');
        $user->updated_at=date('Y-m-d H:i:s');
        $user->save();

        if($cr)
            $pesan="Data Mahasiswa Berhasil Di Simpan";
        else
            $pesan="Data Mahasiswa Gagal Di Simpan";

        return redirect('mahasiswa-admin')->with('status',$pesan);
    }
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $m=Mahasiswa::find($id);
        $m->npm=$request->npm;
        $m->nama=$request->nama;
        $m->tempat_lahir=$request->tempat_lahir;
        $m->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $m->gender=$request->gender;
        $m->alamat=$request->alamat;
        $m->kota=$request->kota;
        $m->email=$request->email;
        $m->hp=$request->hp;
        $m->tahun_masuk=$request->tahun_masuk;
        $m->departemen_id=$request->departemen;
        $m->program_studi_id=$request->program_studi;
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();
        if($cr)
            $pesan="Data Mahasiswa Berhasil Di Edit";
        else
            $pesan="Data Mahasiswa Gagal Di Edit";

        return redirect('mahasiswa-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=Mahasiswa::find($id)->delete();
        return response()->json([$c]);
    }
}
