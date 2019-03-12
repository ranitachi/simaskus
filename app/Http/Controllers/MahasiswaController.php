<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Mahasiswa;
use App\Model\Users;
use App\Model\MasterDepartemen;
use App\Model\Jenjang;
use App\User;
use App\Model\Notifikasi;
use Auth;
class MahasiswaController extends Controller
{
    public function get_by_npm($npm)
    {
        $mhs=Mahasiswa::where('npm',$npm)->first();
        echo json_encode($mhs);
    }
    public function get_by_email($npm)
    {
        $mhs=Mahasiswa::where('email',$npm)->first();
        echo json_encode($mhs);
    }
    public function profil()
    {
        if(Auth::user()->kat_user==1)
            return redirect('profil-staf');

        $dept=MasterDepartemen::all();
        $profil=Mahasiswa::find(Auth::user()->id_user);
        $jenjang=Jenjang::all();
        return view('pages.mahasiswa.profile.index')
            ->with('dept',$dept)
            ->with('jenjang',$jenjang)
            ->with('profil',$profil);
    }

    public function cekpass($pass)
    {
        $ps=bcrypt($pass);
        $cek=Users::where('email',Auth::user()->email)->where('password',$ps)->first();
        if(count($cek)!=0)
            echo 1;
        else
            echo 0;
    }

    public function simpanpassword(Request $request)
    {
        // dd($request);
        $us=Users::where('email',Auth::user()->email)->first();
        $us->password=bcrypt($request->newpassword);
        $c=$us->save();
        //$url=$request->url();
        // return response()->json([$c]);
        return redirect('profil')->with('status','Ubah Password Berhasil');
    }
    public function simpancollege(Request $request)
    {
        // dd($request->all());
        $mh=Mahasiswa::find(Auth::user()->id_user);
        $mh->departemen_id=$request->departemen;
        $mh->program_studi_id=$request->program_studi;
        $mh->tahun_masuk=$request->tahun_masuk;
        $mh->jenjang_id=$request->program_studi;
        $mh->save();
        return redirect('profil')->with('status','Data Departemen dan Program Studi Berhasil Di Edit');
    }
    public function simpanprofil(Request $request)
    {
        // dd($request->all());
        $mh=Mahasiswa::find(Auth::user()->id_user);
        $mh->nama=$request->nama;
        $mh->tempat_lahir=$request->tempat_lahir;
        $mh->tanggal_lahir=date('Y-m-d',strtotime($request->tanggal_lahir));
        $mh->email=$request->email;
        $mh->hp=$request->hp;
        $mh->gender=$request->gender;
        $mh->alamat=$request->alamat;
        $mh->kota=$request->kota;

        if ($request->hasFile('foto')) {
            $user=Users::where('id_user',$mh->id)->where('kat_user',3)->first();
            $val_foto=$request->foto;
            $val_foto->storeAs('foto_mhs',$val_foto->getClientOriginalName());
            $foto='foto_mhs/'.$val_foto->getClientOriginalName();
            
            $user->foto=$foto;
            $user->save();
        }

        $mh->save();
        return redirect('profil')->with('status','Data Profil Mahasiswa Berhasil Di Edit');
    }
    public function registrasi(Request $request)
    {
        //dd($request->all());
        $val=$request->file_upload;
        $val->storeAs('siak-ng',$val->getClientOriginalName());
        $dir='siak-ng/'.$val->getClientOriginalName(); 

        $mhs=new Mahasiswa;
        $mhs->npm=$request->npm;
        $mhs->nama=$request->nama;
        $mhs->email=$request->email_regis;
        $mhs->departemen_id=$request->departemen_id;
        $mhs->jenjang_id=$request->program_studi;
        $mhs->bukti_siak_ng=$dir;
        $mhs->program_studi_id=$request->program_studi;
        $mhs->hp=$request->hp;
        $mhs->save();

        $us=new Users;
        $us->id_user=$mhs->id;
        $us->email=$request->email_regis;
        $us->name=$request->nama;
        $us->flag=0;
        $us->kat_user=3;
        $us->password=bcrypt($request->password);
        $us->save();

        $usr = User::where('id',$us->id)->first();
        Auth::login($usr);

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$request->departemen_id)
            {
                $notif=new Notifikasi;
                $notif->title="Menunggu Verifikasi";
                $notif->from=$us->id;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".$request->nama." Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href='".url('mahasiswa-detail/'.$mhs->id)."'>Klik Disini</a>";
                $notif->save();
            }
        }
        
        return redirect('profil')->with('status','Anda Sudah Berhasil Registrasi, Status Akun Anda Akan DI Verifikasi Oleh Sekretariat');
       
    }

    
}
