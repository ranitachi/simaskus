<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PengajuanSkripsi;
use App\Model\JudulTugasAkhir;
use App\Model\Dosen;
use App\Model\MasterJenisPengajuan;
use App\Model\Pengajuan;
use App\Model\Users;
use App\Model\Notifikasi;
use App\Model\PivotBimbingan;
use App\Model\Mahasiswa;
use App\Model\TahunAjaran;
use App\Model\TopikPengajuan;
use App\Model\KalenderAkademik;
use Auth;
class PengajuanSkripsiController extends Controller
{
    public function index()
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;

        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }   
        
        $status_pengajuan=0;
        $dosen=Dosen::where('departemen_id',$dept_id)->get();

        return view('pages.mahasiswa.pengajuan.index')
            ->with('dosen',$dosen)
            ->with('status_pengajuan',$status_pengajuan)
            ->with('dept_id',$dept_id);
    }
    public function index_bimbingan_mhs()
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }   
        $status_pengajuan=1;
        $dosen=Dosen::where('departemen_id',$dept_id)->get();
        return view('pages.mahasiswa.pengajuan.index')
            ->with('dosen',$dosen)
            ->with('status_pengajuan',$status_pengajuan)
            ->with('dept_id',$dept_id);
    }
    public function data($status_pengajuan=null)
    {
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }  
        
        if($status_pengajuan==null)
        {
            $pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id_user)
                        ->where('status_pengajuan',0)
                        // ->where('status_selesai',0)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->with('dospem_1')
                        ->with('dospem_2')
                        ->with('dospem_3')
                        ->orderBy('created_at')->get();
                        
        }
        else{
            $pengajuan=Pengajuan::where('mahasiswa_id',Auth::user()->id_user)
                        ->where('status_pengajuan',$status_pengajuan)
                        // ->where('status_selesai',0)
                        ->with('jenispengajuan')
                        ->with('tahunajaran')
                        ->with('mahasiswa')
                        ->with('dospem_1')
                        ->with('dospem_2')
                        ->with('dospem_3')
                        ->orderBy('created_at')->get();
            
                    }
                    // return $status_pengajuan.'-'.Auth::user()->id_user;

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
        // return $pengajuan;
        return view('pages.mahasiswa.pengajuan.data')
                    ->with('kalender',$kalender)
                    ->with('pengajuan',$pengajuan)
                    ->with('status_pengajuan',$status_pengajuan)
                    ->with('piv',$piv);
    }
    public function show($id)
    {
        $det=$kolom_topik=$dospem=array();
        $dept_id=0;
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }
        $ta=TahunAjaran::orderBy('tahun_ajaran', 'desc')->orderBy('jenis')->limit(4)->get();
        $mhs=Mahasiswa::find(Auth::user()->id_user);
        $dosen=Dosen::where('departemen_id',$mhs->departemen_id)->get();
        $judul=JudulTugasAkhir::all();
        $jenispengajuan=MasterJenisPengajuan::where('departemen_id',$dept_id)->get();
        if($id!=-1)
        {
            $det=Pengajuan::where('id',$id)->with('mahasiswa')->first();
            $dospem=PivotBimbingan::where('judul_id',$id)->with('dosen')->get()->toArray();
            $kolom=TopikPengajuan::where('pengajuan_id',$id)->get();
            foreach($kolom as $k => $v)
            {
                $kolom_topik[$v->dosen_id]=$v;
            }
        }

        $tahun=date('Y-m-d');
        $kal=KalenderAkademik::where('departemen_id',$dept_id)->whereDate('start_date','<=',$tahun)->whereDate('end_date','>=',$tahun)->get();
        $kalender=array();
        foreach($kal as $val)
        {
            $kalender[$val->kategori_khusus]=$val;
        }

        if($id==-1)
        {
            if (!isset($kalender['masa-pengajuan-mata-kuliah-khusus']))
            {
                return redirect('pengajuan')->with('status','Anda Tidak Dapat Melakukan Pengajuan Di Luar Jadwal Masa Pengajuan');
            }
        }
        // return $dospem;
        return view('pages.mahasiswa.pengajuan.form')
                ->with('judul',$judul)
                ->with('det',$det)
                ->with('dosen',$dosen)
                ->with('ta',$ta)
                ->with('dospem',$dospem)
                ->with('kolom_topik',$kolom_topik)
                ->with('jenispengajuan',$jenispengajuan)
                ->with('id',$id);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        $jns_pengajuan=$mp[$request->jenis_id]->jenis;

        // dd($request->all());

        $pengajuan=new Pengajuan;
        $pengajuan->jenis_id=$request->jenis_id;
        $pengajuan->ipk_terakhir=str_replace(array(',','.'),'.',$request->ipk_terakhir);
        $pengajuan->jumlah_sks_lulus=$request->jumlah_sks_lulus;
        $pengajuan->topik_diajukan=$request->topik_diajukan;
        $pengajuan->bidang=$request->bidang;
        $pengajuan->tahunajaran_id=$request->tahun_ajaran;
        $pengajuan->skema=$request->skema;
        $pengajuan->judul_ind=$request->judul_ind;
        $pengajuan->judul_eng=$request->judul_eng;
        $pengajuan->deskripsi_rencana=$request->deskripsi_rencana;
        $pengajuan->abstrak_ind=$request->abstrak_ind;
        $pengajuan->abstrak_eng=$request->abstrak_eng;
        $pengajuan->pengambilan_ke=$request->pengambilan_ke;
        
    
        // $pengajuan->dosen_ketua=$request->dosen_ketua;
        $pengajuan->dosen_ketua='-1';
        $pengajuan->pembimbing_sebelumnya=$request->pembimbing_sebelumnya;
        $pengajuan->alasan_mengulang=$request->alasan_mengulang;
        $pengajuan->status_pengajuan=0;
        $pengajuan->departemen_id=$dept_id;
        $pengajuan->mahasiswa_id=Auth::user()->id_user;
        $pengajuan->created_at=date('Y-m-d H:i:s');
        $pengajuan->updated_at=date('Y-m-d H:i:s');
        $pengajuan->save();

        $idpengajuan=$pengajuan->id;

        

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                $notif=new Notifikasi;
                $notif->title="Menunggu Verifikasi Pengajuan";
                $notif->from=Auth::user()->id_user;
                $notif->to=$v->id;
                $notif->flag_active=1;
                $notif->pesan="Mahasiswa : ".$user->name." Melakukan Pengajuan, Harap Segera Di Verifikasi<br>
                <a href='".url('pengajuan-detail/'.$pengajuan->id)."'>Klik Disini</a>";
                $notif->save();
            }
        }
        
        // $dospem[0]=$request->dospem1;
        // $dospem[1]=$request->dospem2;
        // $dospem[2]=$request->dospem3;
        $ds=array();
        foreach($request->dospem as $k=>$v)
        {
            if($v!='' && $v!=0)
            {
                $pivot=new PivotBimbingan;
                $pivot->dosen_id=$v;
                $pivot->mahasiswa_id=Auth::user()->id_user;
                $pivot->jenis_bimbingan=$jns_pengajuan;
                $pivot->judul_id=$pengajuan->id;
                $pivot->status=0;
                $pivot->created_at=date('Y-m-d H:i:s');
                $pivot->updated_at=date('Y-m-d H:i:s');
                $pivot->save();

                $u_id=Users::where('id_user',$v)->where('kat_user',2)->first();
                if($u_id)
                {
                    $notif=new Notifikasi;
                    $notif->title="Pengajuan Dosen Pembimbing";
                    $notif->from=Auth::user()->id;
                    $notif->to=$u_id->id;
                    $notif->flag_active=1;
                    $notif->pesan="Mahasiswa : ".$user->name." Mengajukan untuk menjadi Dosen Pembimbing ".ucwords($jns_pengajuan)."<br><a href='".url('pengajuan-detail/'.$pengajuan->id)."'>Klik Disini</a>";
                    $notif->save();
                }

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
        return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Diinput, dan Akan Segera Di Verifikasi Oleh Sekretariat');
    }
    
    public function update(Request $request,$id)
    {
        // return $request->all();
        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        }

        $pengajuan= Pengajuan::find($id);
        $pengajuan->jenis_id=$request->jenis_id;
        $pengajuan->ipk_terakhir=str_replace(array(',','.'),'.',$request->ipk_terakhir);
        $pengajuan->jumlah_sks_lulus=$request->jumlah_sks_lulus;
        $pengajuan->topik_diajukan=$request->topik_diajukan;
        $pengajuan->bidang=$request->bidang;
        $pengajuan->tahunajaran_id=$request->tahun_ajaran;
        $pengajuan->skema=$request->skema;
        $pengajuan->judul_ind=$request->judul_ind;
        $pengajuan->judul_eng=$request->judul_eng;
        $pengajuan->deskripsi_rencana=$request->deskripsi_rencana;
        $pengajuan->abstrak_ind=$request->abstrak_ind;
        $pengajuan->abstrak_eng=$request->abstrak_eng;
        $pengajuan->pengambilan_ke=$request->pengambilan_ke;
        $pengajuan->dosen_ketua='-1';
        $pengajuan->pembimbing_sebelumnya=$request->pembimbing_sebelumnya;
        $pengajuan->alasan_mengulang=$request->alasan_mengulang;
        // $pengajuan->status_pengajuan=0;
        $pengajuan->departemen_id=$dept_id;
        $pengajuan->mahasiswa_id=Auth::user()->id_user;
        $pengajuan->updated_at=date('Y-m-d H:i:s');
        $pengajuan->save();

        $getsekre=Users::where('kat_user',1)->with('staf')->get();
        foreach($getsekre as $k => $v)
        {
            if($v->staf->departemen_id==$dept_id)
            {
                // $wh="Mahasiswa : ".$user->name." Melakukan Pengajuan, Harap Segera Di Verifikasi";
                // $notif=Notifikasi::where('pesan','like',$wh)->first();
                // $notif->title="Menunggu Verifikasi Perbaikan Pengajuan";
                // $notif->from=Auth::user()->id;
                // $notif->to=$v->id;
                // $notif->flag_active=1;
                // $notif->pesan="Mahasiswa : ".$user->name." Melakukan Perbaikan Pengajuan, Harap Segera Di Verifikasi";
                // $notif->save();
            }
        }
        if(isset($request->kolom_topik))
        {
            TopikPengajuan::where('pengajuan_id',$id)->forceDelete();
            foreach($request->kolom_topik as $iddos=>$v)
            {
                if($v!='')
                {
                    $desc=$request->deskripsi_topik[$iddos];
                    $topik=new TopikPengajuan;
                    $topik->pengajuan_id=$id;
                    $topik->deskripsi=$desc;
                    $topik->dosen_id=$iddos;
                    $topik->topik=$v;
                    $topik->save();
                }
            }
        }
        if($pengajuan->status_pengajuan==0)
            return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Edit, dan Akan Segera Di Verifikasi Oleh Sekretariat');
        else
            return redirect('data-bimbingan-mhs')->with('status','Data Pengajuan Berhasil Di Edit, dan Akan Segera Di Verifikasi Oleh Sekretariat');
    }

    public function destroy($id)
    {
        $pengajuan= Pengajuan::find($id)->delete();
        // return redirect('pengajuan')->with('status','Data Pengajuan Berhasil Di Hapus');
        return response()->json(['done']);
    } 

    public function detail($id)
    {
        $master_pengajuan=MasterJenisPengajuan::all();
        $mp=array();
        foreach($master_pengajuan as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        $jenis='';
        $pengajuan=Pengajuan::where('id',$id)
                ->with('jenispengajuan')
                ->with('mahasiswa')
                ->with('dospem_1')
                ->with('dospem_2')
                ->with('dospem_3')
                ->with('dosenketua')
                ->with('pembimbing_sebelum')->first();

        // return $pengajuan;
        
        return view('pages.mahasiswa.pengajuan.detail',compact('jenis','pengajuan','mp','jenis','id'));
    }

    public function cek_pengajuan_mahasiswa($idmhs)
    {
        $cek=Pengajuan::where('mahasiswa_id',$idmhs)->with('tahunajaran')->with('topik')->with('datapembimbing')->with('jenispengajuan')->orderBy('id','desc')->limit(1)->first();
        if($cek)
        {
            $pesan='<div class="row" style="margin-bottom:10px;">
                <div class="col-md-12" style="margin-bottom:10px;"><h3>Anda Memiliki Data Pengajuan Sebelumnya, Apakah Ingin Menggunakan Data tersebut untuk Pengajuan Kali ini ?</h3></div>
                <div class="col-md-12" style="margin-bottom:10px;">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Tahun Ajaran</div>
                        <div class="col-md-9"><b>'.$cek->tahunajaran->tahun_ajaran.' '.$cek->tahunajaran->jenis.'</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Jenis Pengajuan</div>
                        <div class="col-md-9"><b>'.$cek->jenispengajuan->jenis.'</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Judul (Indonesia)</div>
                        <div class="col-md-9"><b>'.$cek->judul_ind.'</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Judul (Inggris)</div>
                        <div class="col-md-9"><b>'.$cek->judul_eng.'</b></div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-bottom:10px;">
                     <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Pembimbing</div>
                        <div class="col-md-9"><ul>';
                    if($cek->datapembimbing)
                    {
                        foreach($cek->datapembimbing as $k=>$v)
                        {
                            $pesan.='<li><b>'.$v->dosen->nama.'</b></li>';
                        }
                    }
            $pesan.='</ul></div>
                    </div>
                </div>
                
            </div>';
            

            $dosen='<div class="col-md-12">
                                <div class="form-group has-success">
                                <label class="control-label">Data Dosen Pembimbing Sebelumnya</label>
                            </div>';
            if($cek->topik)
            {
                foreach($cek->topik as $k=>$v)
                {
                    $dosen.='<div class="row" style="margin-bottom:10px;">
                                <div class="col-md-5">
                                    &nbsp;
                                    <input type="text" readonly name="dospemnama['.$v->dosen_id.']" id="dosen_pem_'.$v->dosen_id.'" placeholder="Nama Dosen" class="form-control dosen_pem" value="'.$v->dosen->nama.'"/>
                                    <input type="hidden" readonly name="dospem['.$v->dosen_id.']" id="dosen_pem_id_'.$v->dosen_id.'" class="form-control dosen_pem_id" value="'.$v->dosen_id.'"/>
                                </div>
                                <div class="col-md-7" style="">
                                    <div class="row" style="height:116px">
                                        <div class="col-md-12">
                                            Topik : 
                                            <input type="text" id="kolom_topik" name="kolom_topik['.$v->dosen_id.']" class="form-control" placeholder="Topik" value="'.$v->topik.'" readonly>
                                        </div>
                                        <div class="col-md-12" style="padding-top:10px;">
                                            Keterangan : 
                                            <textarea class="form-control" name="deskripsi_topik['.$v->dosen_id.']" id="deskripsi-topik" placeholder="Deskripsi" readonly>'.$v->deskripsi.'</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            }
            

            $data['status'] = true;
            $data['data'] = $cek;
            $data['pesan']=$pesan;
            $data['dosen']=$dosen;
        }
        else
        {
            $data['status'] = false;
        }

        return $data;
    }
}
