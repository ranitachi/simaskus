<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function unduhfile($dir,$file)
    {
        return response()->download(storage_path('app/' .$dir.'/'. $file));
    }

    public function dataruangan()
    {
        $filename=public_path('ruangan.txt');
        $content = File::get($filename);
        $data=explode("\n",$content);
        foreach($data as $k => $v)
        {
            $ruangan=explode('::',$v);
            $gedung=trim($ruangan[0]);
            $nama_ruangan=trim($ruangan[1]);
            $d=new \App\Model\MasterRuangan;
            $d->nama_ruangan=$nama_ruangan;
            $d->departemen_id=1;
            $d->lokasi=$gedung;
            $d->save();
        }
    }

    public function datadosen()
    {
        $filename=public_path('dosen.txt');
        $content = File::get($filename);
        $data=explode("\n",$content);
        foreach($data as $k => $v)
        {
            $dosen=explode(';',$v);
            $nama=trim($dosen[0]);
            $email=trim($dosen[1]);
            $nip=trim($dosen[2]);
            $penugasan=trim($dosen[3]);
            $status_ketua_kelompok=trim($dosen[4]);
            
            $d=new \App\Model\Dosen;
            $d->nama=$nama;
            $d->email=$email;
            $d->nip=$nip;
            $d->penugasan=$penugasan;
            $d->status_ketua_kelompok=$status_ketua_kelompok;
            $d->departemen_id=1;
            $d->save();

            $iduser=$d->id;

            $us=new \App\Model\Users;
            $us->name=$nama;
            $us->email=$email;
            $us->password=bcrypt('11');
            $us->flag=1;
            $us->kat_user=1;
            $us->id_user=$iduser;
            $us->save();
        }
    }
}
