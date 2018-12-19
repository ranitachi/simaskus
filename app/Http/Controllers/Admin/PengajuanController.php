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
use App\Model\QuotaPembimbing;
use App\Model\Users;
use App\Model\Staf;
use App\User;
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
        $dept_id=$staf->departemen_id;
        // $idjenis=$mp[strtolower($jenis)];
        $pengajuan=Pengajuan::where('departemen_id',$staf->departemen_id)->where('status_pengajuan',0)
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
        return view('pages.pengajuan.index-sekretariat',compact('jenis','pengajuan','piv','dept_id'));
    }
    public function setujui_pengajuan_bimbingan($pengajuan_id,$mahasiswa_id,$dosen_id)
    {
        $pivot=PivotBimbingan::where('judul_id',$pengajuan_id)->where('mahasiswa_id',$mahasiswa_id)->where('dosen_id',$dosen_id)->first();
        $pivot->status=1;
        $pivot->save();
        return redirect('data-pengajuan')->with('status','Pengajuan Berhasil Di Verifikasi');
    }
    public function hapus_pengajuan_bimbingan($pengajuan_id,$mahasiswa_id,$dosen_id)
    {
        $pivot=PivotBimbingan::where('judul_id',$pengajuan_id)->where('mahasiswa_id',$mahasiswa_id)->where('dosen_id',$dosen_id)->first();
        if($pivot)
            $pivot->forceDelete();


        $user=User::where('id_user',$dosen_id)->where('kat_user',2)->first();
        $notif=Notifikasi::where('to',$user->id)->where('title','like',"%Menunggu Verifikasi Pengajuan%")->first();
        if($notif)
            $notif->forceDelete();

        // $pivot->save();
        return redirect('data-pengajuan')->with('status','Pengajuan Berhasil Di Hapus');
    }
    public function data_bimbingan()
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }

        $staf=Staf::where('id',Auth::user()->id_user)->first();
        $dept_id=$staf->departemen_id;
        // $idjenis=$mp[strtolower($jenis)];
        $pengajuan=Pengajuan::where('departemen_id',$staf->departemen_id)->where('status_pengajuan',1)
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
        return view('pages.pengajuan.index-sekretariat',compact('jenis','pengajuan','piv','dept_id'));
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

        return view('pages.pengajuan.detail',compact('jenis','pengajuan','mp','id'));
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

        return redirect('data-bimbingan')->with('status',"Pengajuan Berhasil Di Verifikasi");
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

    public function generate_pembimbing($dept_id)
    {
        $pengajuan=Pengajuan::where('departemen_id',$dept_id)->where('status_pengajuan',0)->get();
        $piv_bimb=PivotBimbingan::all();
        $piv=array();
        foreach($piv_bimb as $kpiv=>$vpiv)
        {
            $piv[$vpiv->judul_id][$vpiv->dosen_id]=$vpiv;
        }
        $data_rand=array();
        foreach($pengajuan as $kp=>$vp)
        {
            if(isset($piv[$vp->id]))
            {
                foreach($piv[$vp->id] as $kdos=>$vdos)
                {
                    $data_rand[$vp->id][$kdos]=$vdos;
                    // echo $vdos->id.'<br>';
                    // PivotBimbingan::
                    
                }
                PivotBimbingan::where('judul_id',$vp->id)->delete();
            }
        }
        // dd($data_rand);
        foreach($data_rand as $krand=>$vrand)
        {
            // /foreach($vrand as $kvv=>$vvv)
            $pengajuan=Pengajuan::where('id',$krand)->with('jenispengajuan')->first();
            $quota=QuotaPembimbing::where('level',$pengajuan->jenis_id)->where('departemen_id',$dept_id)->first();
            // dd($quota);
            if($quota)
                $qty=$quota->quota;
            else
                $qty=2;

            for($c=1;$c<=$qty;$c++)
            {
                $iddos=array_rand($vrand);
                $id=$vrand[$iddos]->id;

                $insert=new PivotBimbingan;
                $insert->dosen_id=$iddos;
                $insert->mahasiswa_id=$vrand[$iddos]->mahasiswa_id;
                $insert->jenis_bimbingan=$vrand[$iddos]->jenis_bimbingan;
                $insert->judul_id=$krand;
                $insert->status=$vrand[$iddos]->status;
                $insert->keterangan=$vrand[$iddos]->keterangan;
                $insert->save();
                unset($vrand[$iddos]);
                echo $qty.'-'.$c.'-'.$iddos.'<br>';
            }
            // echo $iddos;
            // echo $vrand[$iddos]->dosen_id;
            // $insert->save();
        }
        return redirect('data-pengajuan')->with('status','Generate Pembimbing Berhasil');
    }
}