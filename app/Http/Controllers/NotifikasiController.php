<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Notifikasi;
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
        $notif->flag_active=0;
        $notif->save();
        
        return view('pages.staf.notifikasi.detail')
                ->with('notif',$notif)
                ->with('id',$id);
    }
}
