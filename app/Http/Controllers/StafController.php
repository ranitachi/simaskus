<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Staf;
use App\Model\Users;
use App\Model\MasterDepartemen;
use App\User;
use App\Model\Notifikasi;
use Auth;
class StafController extends Controller
{
    public function profil()
    {
        $dept=MasterDepartemen::all();
        $profil=Staf::find(Auth::user()->id_user);
        return view('pages.staf.profile.index')
            ->with('dept',$dept)
            ->with('profil',$profil);
    }
    public function simpanpassword(Request $request)
    {
        // dd($request);
        $us=Users::where('email',Auth::user()->email)->first();
        $us->password=bcrypt($request->newpassword);
        $c=$us->save();
        //$url=$request->url();
        // return response()->json([$c]);
        return redirect('profil-staf')->with('status','Ubah Password Berhasil');
    }
    
    public function simpanprofil(Request $request)
    {
        // dd($request->all());
        $mh=Staf::find(Auth::user()->id_user);
        $mh->nama=$request->nama;
        $mh->tempat_lahir=$request->tempat_lahir;
        $mh->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $mh->email=$request->email;
        $mh->hp=$request->hp;
        $mh->gender=$request->gender;
        $mh->alamat=$request->alamat;
        $mh->departemen_id=$request->departemen;
        $mh->kota=$request->kota;
        $mh->save();
        return redirect('profil-staf')->with('status','Data Profil Staf Berhasil Di Edit');
    }
}
