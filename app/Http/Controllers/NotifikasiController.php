<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Notifikasi;
use App\Model\Staf;
use App\Model\Mahasiswa;
use App\Model\Dosen;
use App\User;
use Auth;
class NotifikasiController extends Controller
{
    public function index()
    {
        return view('pages.staf.notifikasi.index');
    }
    public function data()
    {
        $notif=Notifikasi::where('to',Auth::user()->id)->with('user')->orderBy('created_at','desc')->get();
        return view('pages.staf.notifikasi.data')
                ->with('notif',$notif);
    }
    public function baca($id,$st)
    {
        $notif=Notifikasi::find($id);
        $notif->flag_active=$st;
        $notif->updated_at=date('Y-m-d H:i:s');
        $c=$notif->save();
        return response()->json([$c]);
    }

    public function show($id)
    {
        $notif=Notifikasi::where('id',$id)->with('user')->first();
        if($notif)
        {
            $notif->flag_active=0;
            $notif->save();
        }
        
        return view('pages.staf.notifikasi.detail')
                ->with('notif',$notif)
                ->with('id',$id);
    }

    public function update_notif($id)
    {
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $d=Staf::where('id',Auth::user()->id_user)->first();
        }
        elseif(Auth::user()->kat_user==2)
        {
            $d=Dosen::where('id',Auth::user()->id_user)->first();
        }
        elseif(Auth::user()->kat_user==3)
        {
            $d=Mahasiswa::where('id',Auth::user()->id_user)->first();
        }
        $dept_id=$d->departemen_id;

        $notif=Notifikasi::find($id);
        $notif->flag_active=0;
        $notif->save();

        $jumlah=Notifikasi::where('to',Auth::user()->id)->where('flag_active',1)->orderBy('created_at','desc')->get();
        echo $jumlah->count();
    }
}
