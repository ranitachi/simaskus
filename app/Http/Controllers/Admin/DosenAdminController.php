<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Dosen;
use App\Model\Users;
use App\Model\MasterDepartemen;
use Auth;
class DosenAdminController extends Controller
{
    public function index()
    {
        return view('pages.administrator.dosen.index');
    }
    public function show($id)
    {
        $det=array();
        $departemen=MasterDepartemen::all();
        if($id!=-1)
        {
            $det=Dosen::find($id);
        }
        return view('pages.administrator.dosen.form')
                ->with('id',$id)
                ->with('det',$det)
                ->with('departemen',$departemen);
    }

    public function data()
    {
        $departemen=MasterDepartemen::all();
        $mhs=Dosen::orderBy('departemen_id','nama')
                ->with('departemen')
                ->get();
        $user=Users::where('kat_user',2)->get();
        $us=array();
        foreach($user as $k=>$v)
        {
            $us[$v->id_user]=$v;
        }
        return view('pages.administrator.dosen.data')
            ->with('mhs',$mhs)
            ->with('us',$us)
            ->with('departemen',$departemen);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $m=new Dosen;
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
        $m->penugasan=$request->penugasan;
        $m->pendidikan=$request->pendidikan;
        $m->status_ketua_kelompok=$request->status_ketua_kelompok;
        $m->status_dosen=$status_dosen=$request->status_dosen;
        $m->jabatan=$request->jabatan;
        $m->nidn=$request->nidn;
        $m->created_at=date('Y-m-d H:i:s');
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();

        if($status_dosen=='Dosen UI')
        {
            $user_id=$m->id;
            $user=new Users;
            $user->name=$request->nama;
            $user->email=$request->email;
            // $user->password=bcrypt($request->nip);
            $user->password=bcrypt($request->password);
            $user->flag=1;
            $user->kat_user=2;
            $user->id_user=$user_id;
            $user->created_at=date('Y-m-d H:i:s');
            $user->updated_at=date('Y-m-d H:i:s');
            $user->save();
        }

        if($cr)
            $pesan="Data Dosen Berhasil Di Simpan";
        else
            $pesan="Data Dosen Gagal Di Simpan";

        $url=$request->input('url_prev');

        //return redirect($url)->with('status',$pesan);
        return redirect('dosen-admin')->with('status',$pesan);
    }
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $m=Dosen::find($id);
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
        $m->pendidikan=$request->pendidikan;
        $m->departemen_id=$request->departemen;
        $m->penugasan=$request->penugasan;
        $m->status_ketua_kelompok=$request->status_ketua_kelompok;
        $m->status_dosen=$status_dosen=$request->status_dosen;
        $m->jabatan=$request->jabatan;
        $m->nidn=$request->nidn;
        $m->updated_at=date('Y-m-d H:i:s');
        $cr=$m->save();

        // $user=Users::find($id);

        $user=Users::where('id_user',$id)->where('kat_user',2)->first();
        if($user)
        {
            $user->email=$request->email;
            if($request->password!='')
                $user->password=bcrypt($request->password);
            $user->save();
        }
        else
        {
            if($status_dosen=='Dosen UI')
            {
                $user_id=$id;
                $user=new Users;
                $user->name=$request->nama;
                $user->email=$request->email;
                // $user->password=bcrypt($request->nip);
                $user->password=bcrypt($request->password);
                $user->flag=1;
                $user->kat_user=2;
                $user->id_user=$user_id;
                $user->created_at=date('Y-m-d H:i:s');
                $user->updated_at=date('Y-m-d H:i:s');
                $user->save();
            }
        }

        if($cr)
            $pesan="Data Dosen Berhasil Di Edit";
        else
            $pesan="Data Dosen Gagal Di Edit";

        return redirect('dosen-admin')->with('status',$pesan);
    }

    public function destroy($id)
    {
        $c=Dosen::find($id)->delete();
        return response()->json([$c]);
    }

    public function verifikasi_dosen($iddosen)
    {
        $user=Users::where('kat_user',2)->where('id_user',$iddosen)->first();
        $user->flag=1;
        $user->save();
        return redirect('dosen-admin')->with('status',"Dosen : ".$user->name." Berhasil Di Verifikasi");
    }
}
