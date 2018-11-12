<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Jenjang;
use App\Model\MasterDepartemen;
use App\Model\Pengajuan;
use App\Model\MasterJenisPengajuan;
use App\Model\PivotBimbingan;
use App\Model\Notifikasi;
use App\Model\Users;
use App\Model\Staf;
use Auth;
class PengajuanController extends Controller
{
    public function pengajuan()
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }

         $staf=Staf::where('id',Auth::user()->id_user)->first();
        
        // $idjenis=$mp[strtolower($jenis)];
        $pengajuan=Pengajuan::where('departemen_id',$staf->departemen_id)
                ->with('jenispengajuan')
                ->with('mahasiswa')
                ->with('tahunajaran')
                ->with('dospem_1')
                ->with('dospem_2')
                ->with('dospem_3')
                ->orderBy('created_at','desc')->get();

        $pivot=PivotBimbingan::all();
        $piv=array();
        foreach($pivot as $k =>$v)
        {
            $piv[$v->mahasiswa_id][$v->dosen_id]=$v;
        }
        return view('pages.pengajuan.index-sekretariat',compact('jenis','pengajuan','piv'));
    }
    public function detail($id)
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }



        $pengajuan=Pengajuan::where('id',$id)                
                ->with('mahasiswa')
                ->with('dospem_1')
                ->with('dospem_2')
                ->with('dospem_3')
                ->orderBy('created_at','desc')->first();

        return view('pages.pengajuan.detail',compact('jenis','pengajuan','mp'));
    }

    public function verifikasi($id,$jenis)
    {
        $pengajuan=Pengajuan::find($id);
        $pengajuan->status_pengajuan=1;
        $pengajuan->save();
        $user=Users::where('id_user',$pengajuan->mahasiswa_id)->with('mahasiswa')->first();

        $notif=new Notifikasi;
        $notif->title="Pengajuan Telah Di Verifikasi";
        $notif->from=Auth::user()->id_user;
        $notif->to=$user->id;
        $notif->flag_active=1;
        $notif->pesan="Staf : Pengajuan Anda dengan Judul <b>".$pengajuan->judul_ind."</b>Telah Di Verifikasi";
        $notif->save();

        return redirect('data-pengajuan')->with('status',"Pengajuan Berhasil Di Verifikasi");
    }
    public function tolak($id,$jenis)
    {
        $pengajuan=Pengajuan::find($id);
        $pengajuan->status_pengajuan=2;
        $pengajuan->save();

        return redirect('data-pengajuan')->with('status',"Pengajuan Sudah Ditolak");
    }
    public function destroy($id,$jenis)
    {
        $pengajuan=Pengajuan::find($id)->delete();
        return redirect('data-pengajuan')->with('status',"Pengajuan Sudah Dihapus");
    }

    public function verifikasi_pengajuan($id)
    {
        $pengajuan=Pengajuan::find($id);
        $pengajuan->status_pengajuan=1;
        $c=$pengajuan->save();
        if($c)
            echo 1;
        else
            echo 0;
    }
}