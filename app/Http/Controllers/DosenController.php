<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dosen;
use App\Model\Users;
use App\Model\MasterDepartemen;

use App\Model\PivotJadwal;
use App\Model\PivotPenguji;
use App\Model\Pengajuan;
use App\User;
use App\Model\Notifikasi;
use Auth;
class DosenController extends Controller
{
    public function profil()
    {
        $dept=MasterDepartemen::all();
        $profil=Dosen::find(Auth::user()->id_user);
        return view('pages.dosen.profile.index')
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
        return redirect('profil-dosen')->with('status','Ubah Password Berhasil');
    }
    
    public function simpanprofil(Request $request)
    {
        // dd($request->all());
        $mh=Dosen::find(Auth::user()->id_user);
        $mh->nama=$request->nama;
        $mh->tempat_lahir=$request->tempat_lahir; 
        $mh->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $mh->email=$request->email;
        $mh->hp=$request->hp;
        $mh->gender=$request->gender;
        $mh->alamat=$request->alamat;
        $mh->departemen_id=$request->departemen;
        $mh->kota=$request->kota;

        if ($request->hasFile('foto')) {
            $user=Users::where('id_user',$mh->id)->where('kat_user',2)->first();
            $val_foto=$request->foto;
            $val_foto->storeAs('public/foto_dosen',$val_foto->getClientOriginalName());
            $foto='foto_dosen/'.$val_foto->getClientOriginalName();
            // $foto='foto_dosen/'.$val_foto->getClientOriginalName();
            
            $user->foto=$foto;
            $user->save();
        }
        

        $mh->save();
        return redirect('profil-dosen')->with('status','Data Profil Dosen Berhasil Di Edit');
    }

    public function formadd_penguji()
    {                                                         
        $user=Users::where('id',Auth::user()->id)->with('dosen')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==2)
        {
            $dept_id=$user->dosen->departemen_id;
        }    
        
        $dosen=Dosen::where('departemen_id',$dept_id)->get();

        return view('pages.dosen.sidang.form-add-penguji')
                ->with('dosen',$dosen)
                ->with('dept_id',$dept_id);
    }

    public function add_penguji(Request $request,$idpengajuan)
    {
        $pengajuan=Pengajuan::find($idpengajuan);
        $iddosen=$request->dosen_id;    
        $jadwal=PivotJadwal::where('judul_id',$idpengajuan)->first();
        
        $cekpenguji=PivotPenguji::where('penguji_id',$iddosen)->where('pivot_jadwal_id',$jadwal->id)->get();
        if($cekpenguji->count()==0)
        {
            $penguji=New PivotPenguji;
            $penguji->pivot_jadwal_id=$jadwal->id;
            $penguji->penguji_id=$iddosen;
            $penguji->pengajuan_id=$idpengajuan;
            $penguji->mahasiswa_id=$request->mahasiswa_id;
            $penguji->status=0;
            $penguji->save();
        }

        return response()->json(['done']);
    }

    
}
