<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Publikasi;
use App\Model\MasterPimpinan;
use App\Model\Users;
use App\Model\Mahasiswa;
use App\Model\Notifikasi;
use Auth;
class PublikasiController extends Controller
{
    public function index()
    {
        $mhs_id=Auth::user()->id_user;
        $publikasi=Publikasi::where('mahasiswa_id',$mhs_id)->with('mahasiswa')->get();
        return view('pages.mahasiswa.publikasi.index')
            ->with('publikasi',$publikasi);
    }
    public function detail($id)
    {
        $publikasi=Publikasi::where('id',$id)->with('mahasiswa')->first();
        return view('pages.mahasiswa.publikasi.detail')->with('publikasi',$publikasi);
    }
    public function form($id=-1)
    {
        $det=array();
        if($id!=-1)
        {
            $det=Publikasi::where('id',$id)->with('mahasiswa')->first();
        }
        return view('pages.mahasiswa.publikasi.form')
            ->with('det',$det)
            ->with('id',$id);
    }

    public function simpan(Request $request,$id=-1)
    {
        if($id==-1)
            $publikasi=new Publikasi;
        else
            $publikasi=Publikasi::find($id);

        $penulis='';
        foreach($request->penulis as $k=>$v)
        {
            $penulis.=$v.';';
        }

        $publikasi->judul=$request->judul;
        $publikasi->lokasi_publikasi=$request->lokasi_publikasi;
        $publikasi->deskripsi=$request->deskripsi;
        $publikasi->url=$request->url;
        $publikasi->judul=$request->judul;
        $publikasi->penulis=$penulis;
        $publikasi->mahasiswa_id=Auth::user()->id_user;
        $publikasi->status=0;
        $publikasi->acc_dep=0;
        $publikasi->acc_mandik=0;

        if ($request->hasFile('file')) {
            $file_publikasi=$request->file;
            $newfile=time().'-'.$file_publikasi->getClientOriginalName();
            $file_publikasi->storeAs('public/publikasi-file',$newfile);
            $file='publikasi-file/'.$newfile;
            $publikasi->file=$file;
        }

        $publikasi->save();

        if($id==-1)
        {
            $mhs=Mahasiswa::find(Auth::user()->id_user);
            $u_id=MasterPimpinan::where('departemen_id',$mhs->departemen_id)->where('status',1)->with('dosen')->get();
            // return $u_id;
            foreach($u_id as $k=>$v)
            {
                $user=Users::where('kat_user',2)->where('id_user',$v->dosen_id)->first();
                $notif=new Notifikasi;
                $notif->title="Pengajuan Publikasi Ilmiah";
                $notif->from=Auth::user()->id;
                $notif->to=$user->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : <b>".Auth::user()->name."</b> Mengajukan Publikasi Ilmiah Untuk Di Verifikasi<br><a href='".url('dosen-publikasi-ilmiah')."'>Klik Disini</a>";
                $notif->save();
            }
        }

        if($id==-1)
            return redirect('publikasi')->with('status','Data Publikasi Berhasil Ditambah, Akan Segera Di Verifikasi Oleh Pimpinan Departemen');
        else
            return redirect('publikasi')->with('status','Data Publikasi Berhasil Di Edit');
    }

    public function destroy($id)
    {
        Publikasi::find($id)->delete();
        return redirect('publikasi')->with('status','Data Publikasi Berhasil Dihapus');
    }
}
