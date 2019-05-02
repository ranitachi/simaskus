<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Staf;
use App\Model\IzinDosen;
use App\Model\Jadwal;
use App\Model\KerjaPraktek;
use App\Model\InformasiKP;
use App\Model\KelompokKP;
use App\Model\KalenderAkademik;
use App\Model\Mahasiswa;
use App\Model\Dosen;
use Carbon\Carbon;
use Auth;
use Storage;
class DashboardController extends Controller
{
    
    public function index()
    {
        $tahun=date('Y-m-d');
        $kalender=$kal_lain=array();
        if(Auth::check())
        {
            if(Auth::user()->kat_user==0)
                return view('pages.dashboard.index');
            else if(Auth::user()->kat_user==1)
            {
                $staf=Staf::where('id',Auth::user()->id_user)->first();
                $dept_id=$staf->departemen_id;
                // $kalender=KalenderAkademik::where('departemen_id',$dept_id)->whereRaw('(start_date like "%'.$tahun.'%" or end_date like "%'.$tahun.'%")')->get()->toArray();
                $kal=KalenderAkademik::where('departemen_id',$dept_id)->orderBy('start_date')->get();
                // return $kalender;
                foreach($kal as $v)
                {
                    if($v->start_date <= $tahun && $v->end_date>=$tahun)
                    {
                        $kalender[]=$v;
                    }
                    else
                        $kal_lain[$v->kategori_khusus]=$v;
                }
                // $kal=array();
                // return $kal_lain;
                return view('pages.dashboard.index-sekretariat')->with('depat_id',$dept_id)->with('kalender',$kalender)->with('kal_lain',$kal_lain);
            }
            else if(Auth::user()->kat_user==3)
            {
                $mhs=Mahasiswa::where('id',Auth::user()->id_user)->first();
                $dept_id=$mhs->departemen_id;
                $kal=KalenderAkademik::where('departemen_id',$dept_id)->orderBy('start_date')->get();
                // return $kalender;
                foreach($kal as $v)
                {
                    if($v->start_date <= $tahun && $v->end_date>=$tahun)
                    {
                        $kalender[]=$v;
                    }
                    else
                        $kal_lain[$v->kategori_khusus]=$v;
                }
                
                return view('pages.dashboard.index-mahasiswa')->with('kalender',$kalender)->with('kal_lain',$kal_lain);
                // return redirect('profil');
            }
            else if(Auth::user()->kat_user==2)
            {
                $dos=Dosen::where('id',Auth::user()->id_user)->first();
                $dept_id=$dos->departemen_id;
                $kal=KalenderAkademik::where('departemen_id',$dept_id)->orderBy('start_date')->get();
                // return $kalender;
                foreach($kal as $v)
                {
                    if($v->start_date <= $tahun && $v->end_date>=$tahun)
                    {
                        $kalender[]=$v;
                    }
                    else
                        $kal_lain[$v->kategori_khusus]=$v;
                }
                return view('pages.dashboard.index-dosen')->with('kalender',$kalender)->with('kal_lain',$kal_lain);
            }
            // dd(Auth::user());
        }
        else
        {
            return redirect('/')->with('pesan',"Login Gagal");
        }
    }

    public function getcontent()
    {
        $username = 'muhammad.teguh61';
        $password = '12QWaszx';
        $url='https://academic.ui.ac.id/main/Academic/Summary';
        $LOGINURL         = "https://academic.ui.ac.id/main/Authentication/Index"; 
        // $context = stream_context_create(array(
        //     'http' => array(
        //         'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        //     )
        // ));
        // $data = file_get_contents($url, false, $context);
        // Storage::put('file.txt', $data);
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // $output = curl_exec($ch);
        // $info = curl_getinfo($ch);
        // curl_close($ch);
        $ch = curl_init();
        $data=array(
        'username'=>$username,
        'pass'=>$password,
        );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $LOGINURL);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, '/Application/XAMPP/xammpfiles/simaskus/public/cookie-name.txt');  
        curl_setopt($ch, CURLOPT_COOKIEFILE, '/Application/XAMPP/xammpfiles/simaskus/public/cookie-name.txt');
        $hasil=curl_exec($ch);
        curl_close ($ch);
        Storage::put('file.txt', $hasil);

    }
    public function updateizindosen()
    {
        $izin=IzinDosen::where('status',1)->whereDate('end_date', '<=', Carbon::now('Asia/Jakarta'))->get();
        // return $izin;
        // $izin=IzinDosen::where('end_date', '<', Carbon::now('Asia/Jakarta'))->get();
        foreach($izin as $k=>$v)
        {
            $time=strtotime($v->end_time);
            $now=strtotime(date('H:i'));
            if(strtotime($v->end_date) < strtotime(date('Y-m-d')))
            {
                // echo $v->end_date.'-'.strtotime($v->end_date).'- || - '.date('Y-m-d').' - '.strtotime(date('Y-m-d')).'<br>';
                IzinDosen::where('id',$v->id)->update(['status'=>0]);
            }
            else
            {
                if($now>$time)
                {
                    IzinDosen::where('id',$v->id)->update(['status'=>0]);
                    // echo $v->end_time.'-'.$time.'- || - '.date('H:i').' - '.$now.'<br>';
                }
            }
        }
    }
    public function updatemulaikp()
    {
        $kp=KerjaPraktek::where('status_kp','0')->get();
        foreach($kp as $k=>$p)
        {
            $grup=KelompokKP::select('code')->where('mahasiswa_id',$p->mahasiswa_id)->first();
            if($grup)
            {
                $info=InformasiKP::where('grup_id',$grup->code)->where('judul','like','%Periode Awal%')->first();
                if($info)
                {
                    list($tgl,$bln,$thn)=explode('-',$info->isi);
                    $date=$thn.'-'.$bln.'-'.$tgl;
                    if(strtotime($date) <= strtotime(date('Y-m-d')))
                    {
                        // echo $p->id.'<br>';
                        KerjaPraktek::where('id',$p->id)->update(['status_kp'=>1]);
                    }
                }
            }

        }
    }  
}
