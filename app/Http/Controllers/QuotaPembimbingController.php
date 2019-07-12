<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QuotaBimbingan;
use App\Model\QuotaPembimbing;
use App\Model\MasterDepartemen;
use App\Model\MasterJenisPengajuan;
use App\Model\Dosen;
use App\Model\PivotBimbingan;
use App\Model\Pengajuan;
use App\Model\Users;
use App\Model\Mahasiswa;
use Auth;
class QuotaPembimbingController extends Controller
{
    public function index()
    {
        return view('pages.staf.quota-pembimbing.index');
    }
    public function data()
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $quota=QuotaPembimbing::where('departemen_id',$dept_id)->with('departemen')->get();

        $jenis=MasterJenisPengajuan::where('departemen_id',$dept_id)->orderBy('keterangan')->orderBy('urutan')->get();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        return view('pages.staf.quota-pembimbing.data')
                ->with('quota',$quota)
                ->with('jns',$jns)
                ->with('dept',$dept);
    }
    public function show($id)
    {
        $user=Users::where('id',Auth::user()->id)->with('staf')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==1)
        {
            $dept_id=$user->staf->departemen_id;
        }

        $quota=QuotaPembimbing::where('departemen_id',$dept_id)->get();
        $quo=$quodet=array();
        foreach($quota as $k=>$v)
        {
            $quo[$v->level]=$v;
            $quodet[$v->id]=$v;
        }

        $det=array();
        $dept=MasterDepartemen::where('id',$dept_id)->with('pimpinan')->orderBy('nama_departemen')->get();
        $jenis=MasterJenisPengajuan::where('departemen_id',$dept_id)->orderBy('keterangan')->orderBy('urutan')->get();
        $jns=array();
        foreach($jenis as $kj=>$vj)
        {
            $jns[$vj->id]=$vj;
        }

        if($id!=-1)
        {
            // $det=QuotaPembimbing::find($id);
            $det=$quodet[$id];
        }
        // return $dept_id;
        return view('pages.staf.quota-pembimbing.form')
                ->with('det',$det)
                ->with('dept',$dept)
                ->with('jenis',$jenis)
                ->with('quo',$quo)
                ->with('dept_id',$dept_id)
                ->with('id',$id);
    }
    public function store(Request $request)
    {
        $quota=new QuotaPembimbing;
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->quota=$request->quota;
        $quota->maksimal=$request->maksimal;
        $quota->keterangan=$request->keterangan;
        $cr=$quota->save();
        return response()->json([$cr]);
        // return redirect('dosen-admin')->with('status',$pesan);
    }

    public function update(Request $request,$id)
    {
        $quota= QuotaPembimbing::find($id);
        $quota->departemen_id=$request->departemen_id;
        $quota->level=$request->level;
        $quota->maksimal=$request->maksimal;
        $quota->quota=$request->quota;
        $quota->keterangan=$request->keterangan;
        $cr=$quota->save();
        return response()->json([$cr]);
    }

    public function destroy($id)
    {
        $c=QuotaPembimbing::find($id)->delete();
        return response()->json([$c]);
    }

    public function jlh_pembimbing($idjenis,$kat_dosen=null,$idpengajuan=null)
    {
        $jenis=MasterJenisPengajuan::find($idjenis);                     
        $quota=QuotaPembimbing::where('level',$idjenis)->first();

        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        } 
        if($kat_dosen==null || $kat_dosen==1)
            $dosen=Dosen::where('departemen_id',$dept_id)->get();
        else
            $dosen=Dosen::all();
        
        // dd($dosen);
        $p_ajuan=array();

        if($idpengajuan!=null)
        {
            $pengajuan=Pengajuan::where('id',$idpengajuan)->get();
            foreach($pengajuan as $k=>$v)
            {
                $p_ajuan[$v->id]=$v;
            }
        }

        $pivot=PivotBimbingan::where('status_fix',1)->with('dosen')->get();
        $piv=array();
        $promotor=$copromotor=array();
        $piv_jenjang=array();
        foreach($pivot as $kp=>$vp)
        {
            if($vp->dosen->departemen_id==$dept_id)
            {
                $piv[$vp->dosen_id][]=$vp;
                $piv_jenjang[$vp->mahasiswa->programstudi->jenjang][]=$vp;
            }
            if($idpengajuan!=null)
            {
                if($pengajuan[0]->id==$vp->judul_id)
                {
                    if($vp->keterangan=='promotor')
                    {
                        $promotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                    elseif($vp->keterangan=='co-promotor')
                    {
                        $copromotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                }
            }
        }
        // dd($p_ajuan);
        $qut_bim=QuotaBimbingan::all();
        $qb=array();
        foreach($qut_bim as $kq=>$vq)
        {
            $qb[$vq->level]=$vq;
        }
        if(isset($qb['Total']))
            $total=$qb['Total']->quota;
        else
            $total=14;
        
        $qut_s3=2;

        if(isset($qb['S3']))
            $qut_s3=$qb['S3'];
        // dd($qb);
    // return $jenis;
        return view('pages.administrator.dosen.jumlah-pembimbing')
                ->with('dosen',$dosen)
                ->with('piv',$piv)
                ->with('qut_s3',$qut_s3)
                ->with('qb',$qb)
                ->with('pengajuan',$p_ajuan)
                ->with('promotor',$promotor)
                ->with('copromotor',$copromotor)
                ->with('quota_bim',$qb)
                ->with('jenis',$jenis)
                ->with('idjenis',$idjenis)
                ->with('idpengajuan',$idpengajuan)
                ->with('kat_dosen',$kat_dosen)
                ->with('quota',$quota);
    }

    public function getdatapembimbing($idjenis,$iddosen,$i,$kuota,$kat_dosen=null,$idpengajuan=null)
    {
        $dos_id=explode('_',$iddosen);
        $jenis=MasterJenisPengajuan::find($idjenis);                     
        $quota=QuotaPembimbing::where('level',$idjenis)->first();

        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        } 
        if($kat_dosen==null || $kat_dosen==1)
            $dosen=Dosen::where('departemen_id',$dept_id)->get();
        else
            $dosen=Dosen::all();
        
        // dd($dosen);
        $p_ajuan=array();

        if($idpengajuan!=null)
        {
            $pengajuan=Pengajuan::where('id',$idpengajuan)->get();
            foreach($pengajuan as $k=>$v)
            {
                $p_ajuan[$v->id]=$v;
            }
        }

        $pivot=PivotBimbingan::with('dosen')->get();
        $piv=array();
        $promotor=$copromotor=array();
        foreach($pivot as $kp=>$vp)
        {
            if($vp->dosen->departemen_id==$dept_id)
            {
                $piv[$vp->dosen_id][]=$vp;
            }
            if($idpengajuan!=null)
            {
                if($pengajuan[0]->id==$vp->judul_id)
                {
                    if($vp->keterangan=='promotor')
                    {
                        $promotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                    elseif($vp->keterangan=='co-promotor')
                    {
                        $copromotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                }
            }
        }
        // dd($p_ajuan);
        $qut_bim=QuotaBimbingan::all();
        $qb=array();
        foreach($qut_bim as $kq=>$vq)
        {
            $qb[$vq->level]=$vq;
        }

        $mhs=Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
        $jenjang=isset($mhs->programstudi->jenjang) ? $mhs->programstudi->jenjang : 'S1';

        $sel='';
        for($x=1;$x<=$kuota;$x++)
        {
            if($x%2!=0)
            {
                $border='background:#eee;';
            }
            else
            {
                $border='border:1px solid #eee;';
            }
            // if($i!=)
            $sel.='<div class="row" style="margin:2px 0px;padding:10px 0;'.$border.';height:116px">
                        <div class="col-md-12" style="">
                            <span id="pilihan_'.$i.'">';
            $sel.='<select class="form-control select2 dosen_pem" data-placeholder="Pilih Dosen" name="dospem[]" id="dosen_pem_'.$i.'" onchange="pilihdosen(this.value,'.$i.')" '.($i!=1 ? 'disabled="disabled' : '').'>';
            // $sel.='<option value="0">- Pilih Dosen Pembimbing '.$i.' -</option>';
            
            foreach ($dosen as $idx => $v)
            {
                if ($jenjang=='S2')
                {
                    if ($v->pendidikan=='S3')
                    {
                        if (isset($piv[$v->id]))
                        {
                            $sel.='<option id="'.$v->id.'" value="'.$v->id.'">['.count($piv[$v->id]).'] - '.$v->nama.' </option>';
                        }
                        else
                        {   
                            $sel.='<option id="'.$v->id.'" value="'.$v->id.'">[0] - '.$v->nama.' </option>';
                        }
                    }
                }
                else
                {
                    if(in_array($v->id,$dos_id))
                        $selected='disabled="disabled"';
                    else
                        $selected='';

                    if (isset($piv[$v->id]))
                    {
                        $sel.='<option id="'.$v->id.'" value="'.$v->id.'" '.$selected.'>['.count($piv[$v->id]).'] - '.$v->nama.' </option>';
                    }
                    else
                    {
                        $sel.='<option id="'.$v->id.'" value="'.$v->id.'" '.$selected.'>[0] - '.$v->nama.' </option>';
                    }
                }
            }

            $sel.='</select></span></div></div>';
        }
        echo $sel;
    }

    public function get_pembimbing($idjenis,$i,$idpm=null,$kat_dosen=null,$idpengajuan=null)
    {
        $dos_id=array();
        if($idpm!=null)
            $dos_id=explode('_',$idpm);

        $jenis=MasterJenisPengajuan::find($idjenis);                     
        $quota=QuotaPembimbing::where('level',$idjenis)->first();

        $user=Users::where('id',Auth::user()->id)->with('mahasiswa')->first();
        $dept_id=0;
        if(Auth::user()->kat_user==3)
        {
            $dept_id=$user->mahasiswa->departemen_id;
        } 
        if($kat_dosen==null || $kat_dosen==1)
            $dosen=Dosen::where('departemen_id',$dept_id)->get();
        else
            $dosen=Dosen::all();
        
        // dd($dosen);
        $p_ajuan=array();

        if($idpengajuan!=null)
        {
            $pengajuan=Pengajuan::where('id',$idpengajuan)->get();
            foreach($pengajuan as $k=>$v)
            {
                $p_ajuan[$v->id]=$v;
            }
        }

        $pivot=PivotBimbingan::where('status_fix',1)->with('dosen')->with('mahasiswa')->get();
        $piv=$piv_jenjang=array();
        $promotor=$copromotor=array();
        foreach($pivot as $kp=>$vp)
        {
            if($vp->dosen->departemen_id==$dept_id)
            {
                $piv[$vp->dosen_id][]=$vp;
                $piv_jenjang[$vp->mahasiswa->programstudi->jenjang][]=$vp;
            }
            if($idpengajuan!=null)
            {
                if($pengajuan[0]->id==$vp->judul_id)
                {
                    if($vp->keterangan=='promotor')
                    {
                        $promotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                    elseif($vp->keterangan=='co-promotor')
                    {
                        $copromotor[$vp->dosen_id]=$vp->dosen_id;
                    }
                }
            }
        }
        // dd($p_ajuan);
        $qut_bim=QuotaBimbingan::where('departemen_id',$dept_id)->get();
        $qb=array();
        foreach($qut_bim as $kq=>$vq)
        {
            $qb[$vq->level]=$vq;
        }
        if(isset($qb['Total']))
            $total=$qb['Total']->quota;
        else
            $total=14;

        $mhs=Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
        $jenjang=isset($mhs->programstudi->jenjang) ? $mhs->programstudi->jenjang : 'S1';
        $qut_s1=8;
        $qut_s2=4;
        $qut_s3=2;

        if(isset($qb['S1']))
            $qut_s1=$qb['S1'];
        if(isset($qb['S2']))
            $qut_s2=$qb['S2'];
        if(isset($qb['S3']))
            $qut_s3=$qb['S3'];
        
        // return ($piv_jenjang['S3']);
        
        $sel='';

        $sel.='<div class="row" style="margin:2px 0px;padding:10px 0;height:116px">
                        <div class="col-md-3 text-right">Pilih Nama Dosen</div>
                        <div class="col-md-9" style="">';
        $sel.='<select class="form-control select2" data-placeholder="Pilih Dosen" id="dosen_pemb_'.$i.'" onchange="pilihdos(this.value,\''.$i.'\')">
                <option value="">Pilih</option>';
                
        foreach ($dosen as $idx => $v)
        {
            if(in_array($v->id,$dos_id))
                $disable='disabled';
            else
                $disable='';


            if (isset($piv[$v->id]))
            {
                if(count($piv[$v->id])>=$total)
                    $disable='disabled';
                else
                {
                     if($jenjang=='S1')
                     {
                         if(isset($piv_jenjang['S1']))
                         {
                             if(count($piv_jenjang['S1'])>=$qut_s1->quota)
                                $disable='disabled';
                         }
                     }
                     if($jenjang=='S2')
                     {
                         if(isset($piv_jenjang['S2']))
                         {
                             if(count($piv_jenjang['S2'])>=$qut_s2->quota)
                                $disable='disabled';
                         }
                     }
                     if($jenjang=='S3')
                     {
                         if(isset($piv_jenjang['S3']))
                         {
                             if(count($piv_jenjang['S3'])>=$qut_s3->quota)
                                $disable='disabled';
                         }
                     }
                }
                $sel.='<option value="'.$v->id.'__'.$v->nama.'" '.$disable.'>['.count($piv[$v->id]).'] - '.$v->nama.' </option>';
            }
            else
            {
                $sel.='<option value="'.$v->id.'__'.$v->nama.'" '.$disable.'>[0] - '.$v->nama.' </option>';
            }
        }
        $sel.='</select>';
        echo $sel;
    }
}
