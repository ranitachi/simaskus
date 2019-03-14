<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Mahasiswa;
use App\Model\Dosen;
use App\Model\Staf;
use App\Model\ProgamStudi;
use App\Model\Users;
use App\Model\MasterDepartemen;
use App\User;
use App\Model\Notifikasi;
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
        
        $dept_id=-1;    
        if(Auth::user()->kat_user==2)
        {
            $dos=Dosen::where('id',Auth::user()->id_user)->first();
            $dept_id=$dos->departemen_id;
        }
        elseif(Auth::user()->kat_user==1)
        {
            $staf=Staf::where('id',Auth::user()->id_user)->first();
            $dept_id=$staf->departemen_id;
        }    

        if($dept_id==-1)
            $prodi=ProgamStudi::all();
        else
            $prodi=ProgamStudi::where('departemen_id',$dept_id)->get();

        $prd=array();
        foreach($prodi as $kp => $vp)
        {
            $prd[$vp->departemen_id][]=$vp;
        }

        return view('pages.administrator.mahasiswa.form')
                ->with('id',$id)
                ->with('det',$det)
                ->with('prodi',$prd)
                ->with('dept_id',$dept_id)
                ->with('departemen',$departemen);
    }

    public function data()
    {
        $departemen=MasterDepartemen::all();
        $mhs=Mahasiswa::orderBy('nama')
                ->with('departemen')
                ->with('programstudi')
                ->with('mahasiswa_user')
                ->get();
        $user=Users::all();
        $us=array();
        foreach($user as $k=>$v)
        {
            $us[$v->kat_user][$v->id_user]=$v;
        }

        return view('pages.administrator.mahasiswa.data')
            ->with('mhs',$mhs)
            ->with('user',$us)
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
        $m->status_mahasiswa=$request->status_mahasiswa;
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
        $m->status_mahasiswa=$request->status_mahasiswa;
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

    public function detail($id)
    {
        $mhs=Mahasiswa::where('id',$id)->with('departemen')->with('programstudi')->with('mahasiswa_user')->first();
        $user=User::where('id_user',$mhs->id)->where('kat_user',3)->first();
        $dept=MasterDepartemen::all();
        $jenjang=ProgamStudi::all();
        // return $user;
        return view('pages.administrator.mahasiswa.detail')
            ->with('profil',$mhs)
            ->with('id',$id)
            ->with('user',$user)
            ->with('dept',$dept)
            ->with('jenjang',$jenjang);
    }

    public function verifikasi(Request $request)
    {
        $id=$request->idmhs;
        $users=Users::where('kat_user',3)->where('id_user',$id)->first();
        $users->flag=1;
        $users->save();

        $notif=new Notifikasi;
        $notif->title="Sudah Di Verifikasi";
        $notif->from=Auth::user()->id;
        $notif->to=$id;
        $notif->flag_active=1;
        $notif->pesan="Akun Anda Sudah Di Verifikasi Oleh Sekretariat, Silahkan Lakukan Update Profil Anda";
        $notif->save();

        return redirect('mahasiswa-admin')->with('status',"Mahasiswa : ".$users->mahasiswa->nama." Berhasil Di Verifikasi");
    }
    
    public function verifikasi_mahasiswa($id)
    {
        // $id=$request->idmhs;
        $users=Users::where('kat_user',3)->where('id_user',$id)->first();
        $users->flag=1;
        $simpan=$users->save();

        $notif=new Notifikasi;
        $notif->title="Sudah Di Verifikasi";
        $notif->from=Auth::user()->id;
        $notif->to=$users->id;
        $notif->flag_active=1;
        $notif->pesan="Akun Anda Sudah Di Verifikasi Oleh Sekretariat, Silahkan Lakukan Update Profil Anda<br>
                        <a href='".url("/profil")."'>Klik Disini</a>";
        $notif->save();
        
        if($simpan)
            echo 1;
        else
            echo 0;
        // return redirect('mahasiswa-admin')->with('status',"Mahasiswa : ".$users->mahasiswa->nama." Berhasil Di Verifikasi");
    }
}
