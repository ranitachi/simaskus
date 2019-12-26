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
use App\Model\QuotaBimbingan;
use App\Model\PivotSetujuSidang;
use App\Model\Users;
use App\Model\Staf;
use App\Model\Jadwal;
use App\Model\Dosen;
use App\Model\TopikPengajuan;
use App\User;
use App\Model\KalenderAkademik;
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

        $tahun=date('Y-m-d');
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->whereDate('start_date','<=',$tahun)->whereDate('end_date','>=',$tahun)->get();
        $kalender=array();
        foreach($kal as $val)
        {
            $kalender[$val->kategori_khusus]=$val;
        }
        $jns='pengajuan';
        $setujusidang=PivotSetujuSidang::all();
        $acc=array();
        foreach($setujusidang as $ks=>$vs)
        {
            $acc[$vs->pengajuan_id][$vs->dosen_id]=$vs;
        }
        // return $acc;
        return view('pages.pengajuan.index-sekretariat',compact('jenis','pengajuan','piv','dept_id','kalender','jns','acc'));
    }
    public function setujui_pengajuan_bimbingan($pengajuan_id,$mahasiswa_id,$dosen_id)
    {
        $staf=Staf::where('id',Auth::user()->id_user)->first();
        $dept_id=$staf->departemen_id;

        $pivot=PivotBimbingan::where('judul_id',$pengajuan_id)->where('mahasiswa_id',$mahasiswa_id)->where('dosen_id',$dosen_id)->first();
        $pivot->status=1;

        if($dept_id==8)
            $pivot->status_fix=1;

        $pivot->save();
        return redirect()->back()->with('status','Pengajuan Dosen Bimbingan Telah Disetujui');
        // return redirect('data-pengajuan')->with('status','Pengajuan Dosen Bimbingan Telah Disetujui');
    }
    public function setujui_pengajuan_bimbingan_semua($pengajuan_id)
    {
        $staf=Staf::where('id',Auth::user()->id_user)->first();
        $dept_id=$staf->departemen_id;

        $pivot=PivotBimbingan::where('judul_id',$pengajuan_id)->get();
        foreach($pivot as $k=>$v)
        {
            $v->status=1;
            
            if($dept_id==8)
                $v->status_fix=1;

            $v->save();
        }
        return redirect()->back()->with('status','Pengajuan Dosen Bimbingan Telah Disetujui');
        // return redirect('data-pengajuan')->with('status','Pengajuan Dosen Bimbingan Telah Disetujui');
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

        $jadwal=Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                    ->where('jadwals.departemen_id',$dept_id)
                    ->with('ruangan')
                    ->get();

        // dd($pengajuan);
        $jdwl=array();
        foreach($jadwal as $kj=>$vjj)
        {
            $jdwl[$vjj->judul_id]=$vjj;
        }
        $tahun=date('Y-m-d');
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->whereDate('start_date','<=',$tahun)->whereDate('end_date','>=',$tahun)->get();
        $kalender=array();
        foreach($kal as $val)
        {
            $kalender[$val->kategori_khusus]=$val;
        }
        $jns='bimbingan';
        $setujusidang=PivotSetujuSidang::all();
        $acc=array();
        foreach($setujusidang as $ks=>$vs)
        {
            $acc[$vs->pengajuan_id][$vs->dosen_id]=$vs;
        }
        return view('pages.pengajuan.index-sekretariat',compact('jenis','pengajuan','piv','dept_id','jdwl','kalender','jns','acc'));
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
    
    public function verifikasi_semua()
    {
        $pengajuan=Pengajuan::where('status_pengajuan',0)->get();
        foreach($pengajuan as $k=>$v)
        {
            $v->status_pengajuan=1;
            $v->save();

            $user=Users::where('id_user',$v->mahasiswa_id)->with('mahasiswa')->first();
    
            $notif=new Notifikasi;
            $notif->title="Pengajuan Telah Di Verifikasi";
            $notif->from=Auth::user()->id_user;
            $notif->to=$user->id;
            $notif->flag_active=1;
            $notif->pesan="Staf : Pengajuan Anda dengan Judul <b>".$v->judul_ind."</b> Telah Di Verifikasi";
            $notif->save();
        }

        return redirect('data-bimbingan')->with('status',"Seluruh Pengajuan Berhasil Di Verifikasi");
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
        $pengajuan=Pengajuan::where('departemen_id',$dept_id)->where('status_pengajuan',1)->with('jenispengajuan')->with('mahasiswa')->get();
        $piv_bimb=PivotBimbingan::where('status',1)->with('pengajuan')->with('mahasiswa')->orderBy('judul_id')->get();
        $piv=$urutan=$exist_bimb=array();
        $count_bimbingan_perdosen=array();
        foreach($piv_bimb as $kpiv=>$vpiv)
        {
            $piv[$vpiv->judul_id][$vpiv->dosen_id]=$vpiv;
            if(isset($vpiv->pengajuan->status_pengajuan))
            {
                // echo $vpiv->judul_id.'-'.$vpiv->pengajuan->status_pengajuan.'<br>';
                if($vpiv->pengajuan->status_pengajuan!=100)
                {
                    if($vpiv->status_fix==1)
                    {
                        $exist_bimb[$vpiv->dosen_id][]=$vpiv;
                        $count_bimbingan_perdosen[$vpiv->mahasiswa->programstudi->jenjang][$vpiv->dosen_id]=$vpiv->judul_id;
                    }
                }
            }
        }
        
        $count_bimbingan=$tot_count=array();
        foreach($piv as $idx=>$val)
        {
            $i=1;
            foreach($val as $key=>$item)
            {
                if($item->status_fix==0)
                {
                    $urutan[$item->judul_id][$i]=$item->dosen_id;
                    
                    if(isset($exist_bimb[$vpiv->dosen_id]))
                        $count_bimbingan[$item->dosen_id]=count($exist_bimb[$vpiv->dosen_id]);
                    else
                        $count_bimbingan[$item->dosen_id]=0;

                    $i++;

                    $tot_count[$item->judul_id]=count($urutan[$item->judul_id]);
                }
            }
        }

        $quota=QuotaPembimbing::where('departemen_id',$dept_id)->get();
        $max_pembimbing=array();
        foreach($quota as $k=>$v)
        {
            $max_pembimbing[$v->level]=$v->quota;
        }
        
        $quota_bimbingan=QuotaBimbingan::where('departemen_id',$dept_id)->get();
        $max_bimbingan=array();
        foreach($quota_bimbingan as $k=>$v)
        {
            $max_bimbingan[$v->level]=$v->quota;
        }

        $master_pengajuan=MasterJenisPengajuan::all();
        $mp_id=$mp_jenjang=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp_id[$v->id]=$v;
            $mp_jenjang[$v->keterangan]=$v;
        }
        // return $urutan;

        

        $data_rand=array();
        $max_pemb=3;
        $max_bimb=8;
        
        $per_jenjang=array();
        foreach($pengajuan as $kp=>$vp)
        {
            $jenjang=$vp->mahasiswa->programstudi->jenjang;
            if(isset($mp_jenjang[$jenjang]))
            {
                $mp=$mp_jenjang[$jenjang];
                if(isset($max_bimbingan[$jenjang]))
                {
                    // $max_bimb=5;
                    $max_bimb=$max_bimbingan[$jenjang];
                }
                
                if(isset($max_pembimbing[$mp->id]))
                {
                    $max_pemb=$max_pembimbing[$mp->id];
                }
            }

            $total_bimb=isset($max_bimbingan['Total']) ? $max_bimbingan['Total'] : 14;
            $max_total=array();
            
            $get=1;
            $cnt_bm=$cnt_p_d=0;
            $cnt_per_dosen=isset($count_bimbingan_perdosen[$jenjang]) ? $count_bimbingan_perdosen[$jenjang] : 0;
            
            if(count($tot_count)!=0)
            {
            for($f=1;$f<=max($tot_count);$f++)
            {
                if(isset($urutan[$vp->id][$f]))
                {
                    $id_dos = $urutan[$vp->id][$f];

                    if(isset($count_bimbingan[$id_dos]))
                    {
                        if($count_bimbingan[$id_dos]<=$total_bimb)
                        {
                            // if(isset($count_bimbingan_perdosen[$id_dos][$jenjang]))
                            // {
                                // if($cnt_per_dosen<$max_bimb)
                                // {
                                    if($get<=$max_pemb)
                                    {
                                        // echo $vp->id.':'.$jenjang.'-'.$id_dos.' max : '.$max_pemb.' -- max bimb : '.$max_bimb.'<br> ';
                                        // echo $max_bimb.'-'.$count_bimbingan[$id_dos].'<br> ';
                                        $cnt_bm++;
                                        $get++;
                                        $count_bimbingan[$id_dos]++;
                                        $per_jenjang[$id_dos][$jenjang][]=$vp->id;
                                        $cnt_p_d++;
                                        // $count_bimbingan_perdosen[$jenjang][$id_dos]=$cnt_p_d;
                                    }
                                // }
                            // }
                        }
                    }
                }
            }
            // echo '<br>';
            // echo '<br>';
            // echo '<pre>';
            // print_r($count_bimbingan);
            // echo '</pre>';
            
            // echo $jenjang.'-',count($piv[$vp->id]).'-'.$max_pemb.'-'.$max_bimb.'<br>';

            // if(isset($piv[$vp->id]))
            // {
            //     foreach($piv[$vp->id] as $kdos=>$vdos)
            //     {
            //         $data_rand[$vp->id][$kdos]=$vdos;
            //         // echo $vdos->id.'<br>';
            //         // PivotBimbingan::
                    
            //     }
            //     PivotBimbingan::where('judul_id',$vp->id)->delete();
            // }
            }
        }
        // return $per_jenjang;
        $id_pengajuan=array();
        if(count($per_jenjang)!=0)
        {
            foreach($per_jenjang as $iddosen=>$data)
            {
                foreach($data as $jenjang=>$item)
                {
                    foreach($item as $idx=>$pengajuan_id)
                    {
                        // echo $iddosen.'-'.$pengajuan_id.'|';
                        $pivot=PivotBimbingan::where('dosen_id',$iddosen)->where('judul_id',$pengajuan_id)->first();
                        $id_pengajuan[]=$pengajuan_id;
                        // echo $pengajuan_id.'::'.$pivot->id.'-';
                        $pivot->status_fix=1;
                        $pivot->save();
                    }
                }
                echo '<br>';
            }

            $remove=PivotBimbingan::whereIn('judul_id',array_unique($id_pengajuan))->where('status_fix','=',0)->get();
            foreach($remove as $v)
            {
                $v->delete();
            }

            return redirect('data-bimbingan')->with('status','Generate Pembimbing Berhasil');
        }
        else
            return redirect('data-bimbingan')->with('status','Tidak Ada Data Yang DI Generate');
        // return $remove;
        // dd($data_rand);
        // foreach($data_rand as $krand=>$vrand)
        // {
        //     // /foreach($vrand as $kvv=>$vvv)
        //     $pengajuan=Pengajuan::where('id',$krand)->with('jenispengajuan')->first();
        //     $quota=QuotaPembimbing::where('level',$pengajuan->jenis_id)->where('departemen_id',$dept_id)->first();
        //     // dd($quota);
        //     if($quota)
        //         $qty=$quota->quota;
        //     else
        //         $qty=2;

        //     for($c=1;$c<=$qty;$c++)
        //     {
        //         $iddos=array_rand($vrand);
        //         $id=$vrand[$iddos]->id;

        //         $insert=new PivotBimbingan;
        //         $insert->dosen_id=$iddos;
        //         $insert->mahasiswa_id=$vrand[$iddos]->mahasiswa_id;
        //         $insert->jenis_bimbingan=$vrand[$iddos]->jenis_bimbingan;
        //         $insert->judul_id=$krand;
        //         $insert->status=$vrand[$iddos]->status;
        //         $insert->keterangan=$vrand[$iddos]->keterangan;
        //         $insert->status_fix=1;
        //         $insert->save();
        //         unset($vrand[$iddos]);
        //         echo $qty.'-'.$c.'-'.$iddos.'<br>';
        //     }
            // echo $iddos;
            // echo $vrand[$iddos]->dosen_id;
            // $insert->save();
        // }
        
    }

    public function acc_sidang($idpengajuan,$iddosen)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('jenispengajuan')->first();
        $acc=new PivotSetujuSidang;
        $acc->dosen_id=$iddosen;
        $acc->mahasiswa_id=$pengajuan->mahasiswa_id;
        $acc->pengajuan_id=$idpengajuan;
        $acc->status=1;
        if($pengajuan->jenispengajuan->keterangan=='S1')
            $acc->jenis_bimbingan='Skripsi';
        elseif($pengajuan->jenispengajuan->keterangan=='S2')
            $acc->jenis_bimbingan='Tesis';
        elseif($pengajuan->jenispengajuan->keterangan=='S3')
            $acc->jenis_bimbingan='Disertasi';

        $acc->save();
        return redirect('data-bimbingan')->with('status','Persetujuan ACC SIdang Dosen Telah Berhasil');
    }

    public function edit_pembimbing($idpengajuan)
    {
        $pengajuan=Pengajuan::where('id',$idpengajuan)->with('jenispengajuan')->first();
        $dosen=Dosen::with('departemen')->orderBy('nama')->get();
        $pivot=PivotBimbingan::where('judul_id',$idpengajuan)->with('dosen')->get();
        return view('pages.pengajuan.editpembimbing')
                ->with('pembimbing',$pivot)
                ->with('dosen',$dosen)
                ->with('idpengajuan',$idpengajuan)
                ->with('jenis_id',$pengajuan->jenis_id)
                ->with('idjenis',$pengajuan->jenis_id)
                ->with('pengajuan',$pengajuan);
    }
    public function edit_pembimbing_simpan(Request $request,$idpengajuan)
    {
        // return $request->all();
        $pengajuan=Pengajuan::find($idpengajuan);
        $jenis_pn=MasterJenisPengajuan::find($pengajuan->jenis_id);
        $pivot=PivotBimbingan::where('judul_id',$idpengajuan)->get();
        $topik=TopikPengajuan::where('pengajuan_id',$idpengajuan)->get();
        foreach($pivot as $k=>$v)
        {
            $v->deleted_at=date('Y-m-d H:i:s');
            $v->save();
        }
        foreach($topik as $k=>$v)
        {
            $v->deleted_at=date('Y-m-d H:i:s');
            $v->save();
        }

        foreach($request->dospem as $k=>$v)
        {
            if($v!='' && $v!=0)
            {
                $pivot=new PivotBimbingan;
                $pivot->dosen_id=$v;
                $pivot->mahasiswa_id=$pengajuan->mahasiswa_id;
                $pivot->jenis_bimbingan=$jenis_pn->jenis;
                $pivot->judul_id=$pengajuan->id;
                $pivot->status=1;
                $pivot->created_at=date('Y-m-d H:i:s');
                $pivot->updated_at=date('Y-m-d H:i:s');
                $pivot->save();

                // $u_id=Users::where('id_user',$v)->where('kat_user',2)->first();
                // if($u_id)
                // {
                //     $notif=new Notifikasi;
                //     $notif->title="Pengajuan Dosen Pembimbing";
                //     $notif->from=Auth::user()->id;
                //     $notif->to=$u_id->id;
                //     $notif->flag_active=1;
                //     $notif->pesan="Mahasiswa : ".$user->name." Mengajukan untuk menjadi Dosen Pembimbing ".ucwords($jns_pengajuan)."<br><a href='".url('pengajuan-detail/'.$pengajuan->id)."'>Klik Disini</a>";
                //     $notif->save();
                // }

                $ds[$k]=$v;
            }
        }
        foreach($request->kolom_topik as $k=>$v)
        {
            if($v!='')
            {
                $desc=$request->deskripsi_topik[$k];
                $topik=new TopikPengajuan;
                $topik->pengajuan_id=$idpengajuan;
                $topik->deskripsi=$desc;

                if(isset($ds[$k]))
                {
                    $topik->dosen_id=$ds[$k];
                    $topik->topik=$v;
                    $topik->save();
                }

            }
        }

        return redirect()->back()->with('status','Data Pembimbing Berhasil Di Rubah');
    }
}