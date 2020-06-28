<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesanLampiran;
use App\Http\Controllers\Controller;

class PesanLampiranController extends Controller
{
    public function store(Request $request)
    {
        $idform=$request->idform;
        $file=$request->file('files');

        $name=$size='';
        if($request->has('files'))
        {
            
            foreach($file as $k=>$val)
            {
                $tipedata=$val->getClientOriginalExtension();
                $newfile=time().'.'.$val->getClientOriginalExtension();
                $val->storeAs('pesan-file',$newfile);
                $dir='pesan-file/'.$newfile;
    
                $simpan = new PesanLampiran;
                $simpan->pesan_id = $idform;
                $simpan->nama_file = $newfile;
                $simpan->lokasi_file = $dir;
                $simpan->save();

                $name=$val->getClientOriginalName();
                $size=$val->getSize();
            }
        }

        $data[0]['name']=$name;
        $data[0]['size']=$size;
        $data[0]['url']='';
        $data[0]['thumbnailUrl']='';
        $data[0]['deleteUrl']='';
        $data[0]['deleteType']='DELETE';
        return ['files'=>$data];
    }
}
