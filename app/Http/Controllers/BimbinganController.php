<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bimbingan;
use App\Model\PivotBimbingan;
use App\Model\Notifikasi;
use App\Model\Pengajuan;
use App\Model\Users;
use App\Model\Mahasiswa;
use Auth;
class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function data($idmhs=null,$idpengajuan=null)
    {
        if($idmhs==null && $idpengajuan==null)
            $wh=['mahasiswa_id'=>Auth::user()->id_user];
            // $bimbingan=Bimbingan::where('mahasiswa_id',Auth::user()->id_user)->with('dospem')->with('mahasiswa')->get();
        else
            $wh=['mahasiswa_id'=>$idmhs, 'pengajuan_id'=>$idpengajuan];
            
        
        $bimbingan=Bimbingan::where($wh)->with('dospem')->with('mahasiswa')->orderBy('tanggal_bimbingan','asc')->orderBy('created_at','asc')->get();
          
        // return $wh;

        return view('pages.mahasiswa.bimbingan.data',compact('bimbingan','idpengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bimbingan=new Bimbingan;
        $bimbingan->tanggal_bimbingan=date('Y-m-d',strtotime($request->tanggal_bimbingan));
        $bimbingan->bimbingan_ke=$request->bimbingan_ke;
        $bimbingan->judul=$request->judul;
        $bimbingan->dospem_id=$request->dospem_id;
        $bimbingan->mahasiswa_id=Auth::user()->id_user;
        $bimbingan->flag=0;
        $bimbingan->deskripsi_bimbingan=$request->deskripsi_bimbingan;
        $bimbingan->pengajuan_id=$request->pengajuan_id;
        $bimbingan->created_at=date('Y-m-d H:i:s');
        $bimbingan->updated_at=date('Y-m-d H:i:s');
        $c=$bimbingan->save();

        $pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id_user)->first();
        //$pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id)->where('dospem1',$id_user_dospem->id)->orWhere('dospem2',$id_user_dospem->id)->orWhere('dospem3',$id_user_dospem->id)->first();

        $id_user_dospem=Users::where('id_user',$request->dospem_id)->first();
        $notif=new Notifikasi;
        $notif->title="Menunggu Verifikasi Data Bimbingan";
        $notif->from=Auth::user()->id;
        $notif->to=$id_user_dospem->id;
        $notif->flag_active=1;
        //bimbingan-detail/1/2#tab_5_2
        // $notif->pesan="Mahasiswa : ".Auth::user()->name." Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>
        // <a href='".url('daftar-bimbingan')."'>Klik Disini</a>";
        $notif->pesan="Mahasiswa : ".Auth::user()->name." Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>
        <a href='".url('bimbingan-detail/'.$pengajuan->id.'/'.Auth::user()->id_user.'#tab_5_2')."'>Klik Disini</a>";
        $notif->save();

        return response()->json([$c]);
    }

    public function update(Request $request,$id)
    {
        $bimbingan=Bimbingan::find($id);
        $bimbingan->tanggal_bimbingan=date('Y-m-d',strtotime($request->tanggal_bimbingan));
        $bimbingan->bimbingan_ke=$request->bimbingan_ke;
        $bimbingan->judul=$request->judul;
        $bimbingan->dospem_id=$request->dospem_id;
        $bimbingan->mahasiswa_id=Auth::user()->id_user;
        // $bimbingan->flag=0;
        $bimbingan->deskripsi_bimbingan=$request->deskripsi_bimbingan;
        $bimbingan->pengajuan_id=$request->pengajuan_id;
        $c=$bimbingan->save();
         return response()->json([$c]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$idpengajuan)
    {
        $det=array();
        $mhs=Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();

        if($mhs->programstudi->jenjang=='S3')
            $dos=PivotBimbingan::where('mahasiswa_id',Auth::user()->id_user)->where('judul_id',$idpengajuan)->with('dosen')->with('mahasiswa')->get();
        else
            $dos=PivotBimbingan::where('mahasiswa_id',Auth::user()->id_user)->where('judul_id',$idpengajuan)->where('status',1)->with('dosen')->with('mahasiswa')->get();

        $dospem=array();
        foreach($dos as $k=>$v)
        {
            $dospem[$v->dosen_id]=$v;
        }
        if($id!=-1)
            $det=Bimbingan::find($id);

        $count=Bimbingan::where('mahasiswa_id',Auth::user()->id_user)->where('pengajuan_id',$idpengajuan)->count();

        // 

        return view('pages.mahasiswa.bimbingan.form',compact('dospem','det','id','count','mhs','idpengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuan=Bimbingan::find($id)->delete();
        
        return response()->json([$pengajuan]);
        // return redirect('data-pengajuan')->with('status',"Pengajuan Sudah Dihapus");
    }
}
