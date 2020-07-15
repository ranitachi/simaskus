<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Staf;
use App\Model\Dosen;
use App\Model\Mahasiswa;
use App\Model\PivotJadwal;
use App\Model\PivotBimbingan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datauser()
    {
        $katuser=Auth::user()->kat_user;

        if($katuser==1)
        {
            $user=User::where('id_user',Auth::user()->id_user)->where('kat_user',1)->first();
            $data = Staf::find(Auth::user()->id_user);
        }
        elseif($katuser==2)
        {
            $user=User::where('id_user',Auth::user()->id_user)->where('kat_user',2)->first();
            $data = Dosen::find(Auth::user()->id_user);
        }
        elseif($katuser==3)
        {
            $user=User::where('id_user',Auth::user()->id_user)->where('kat_user',3)->first();
            $data = Mahasiswa::find(Auth::user()->id_user);
        }

        return ['data'=>$data, 'user'=>$user]; 
    }

    public function cekstatus_fix()
    {
        $jadwal=PivotJadwal::all();
        foreach($jadwal as $k=>$v)
        {
            $judul_id=$v->judul_id;
            $mahasiswa_id=$v->mahasiswa_id;
            $bimbingan=PivotBimbingan::where('judul_id',$judul_id)->where('mahasiswa_id',$mahasiswa_id)->get();
            foreach($bimbingan as $ipb=>$vpb)
            {
                $vpb->status_fix=1;
                $vpb->save();
                echo $vpb->id.'<br>';
            }
        }
    }
}
