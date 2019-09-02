<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\Model\Dosen;
use App\Model\Staf;
use App\Model\Mahasiswa;
use App\Model\MasterDepartemen;
use App\Model\ProgamStudi;
use App\Model\Users;
use App\User;
use SSO\SSO;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function unduhfile($dir,$file)
    {
        return response()->download(storage_path('app/' .$dir.'/'. $file));
    }

    public function dataruangan()
    {
        $filename=public_path('ruangan.txt');
        $content = File::get($filename);
        $data=explode("\n",$content);
        foreach($data as $k => $v)
        {
            $ruangan=explode('::',$v);
            $gedung=trim($ruangan[0]);
            $nama_ruangan=trim($ruangan[1]);
            $d=new \App\Model\MasterRuangan;
            $d->nama_ruangan=$nama_ruangan;
            $d->departemen_id=1;
            $d->lokasi=$gedung;
            $d->save();
        }
    }

    public function datadosen()
    {
        $filename=public_path('dosen.txt');
        $content = File::get($filename);
        $data=explode("\n",$content);
        foreach($data as $k => $v)
        {
            $dosen=explode(';',$v);
            $nama=trim($dosen[0]);
            $email=trim($dosen[1]);
            $nip=trim($dosen[2]);
            $penugasan=trim($dosen[3]);
            $status_ketua_kelompok=trim($dosen[4]);
            
            $d=new \App\Model\Dosen;
            $d->nama=$nama;
            $d->email=$email;
            $d->nip=$nip;
            $d->penugasan=$penugasan;
            $d->status_ketua_kelompok=$status_ketua_kelompok;
            $d->departemen_id=1;
            $d->save();

            $iduser=$d->id;

            $us=new \App\Model\Users;
            $us->name=$nama;
            $us->email=$email;
            $us->password=bcrypt('11');
            $us->flag=1;
            $us->kat_user=1;
            $us->id_user=$iduser;
            $us->save();
        }
    }
    public function kolom_topik($id)
    {
        $d=explode(',',$id);
        $text='<div class="form-group has-success"><label class="control-label">Topik</label></div<';
        foreach($d as $k=>$v)
        {
            $text.='<div class="form-group has-success"><input type="text" id="kolom_topik" name="kolom_topik['.$v.']" class="form-control input-circle" placeholder="Topik"></div>';
        }
        echo $text;
    }
    public function add_pendidikan()
    {
        $str="040803012;S-3::197509011999031003;S-3::196707011995121001;S-3::196009101988111001;S-3::198212152018031001;S-3::196004291988111001;S-3::0408050320;S-3::195808201986021001;S-2::195908011989031012;S-3::197608062010121002;S-3::041003025;S-3::196706111992031002;S-3::198612202015041003;S-3::198209272012121001;S-2::197006251995121001;S-3::197301201997021001;S-3::195603181985031002;S-2::196211081987031003;S-2::197812252010122002;S-3::195706221985031001;S-2::196104241989032002;S-3::100111610231103891;S-3::195903311986031001;S-3::196103231986092001;S-3::196901171993031001;S-3::195907041993031001;S-3::197908052008121001;S-3::197904022008121001;S-3::197003311995121001;S-3::197604261999031002;S-3::100111610250210991;S-2::196501251993031002;S-3::198205172008122001;S-3::197407051998031004;S-3::197005271997021001;S-3::196604141991031002;S-3::196107131986021001;S-3::196304221989031005;S-3::197911032012121002;S-3::195711171987031001;S-3::100111610291707891;S-2::196904211992022001;S-3::195511031985031003;S-2::195003231979031003;S-3::197907312008121003;S-3::195410271980031012;S-3::100111610250017891;S-3::040903027;S-3::100211610211806891;S-2::198401302012122001;S-3::195810141985031005;S-3::196201301991031003;S-3::195910171988111001;S-3::197705282008121001;S-3::195908121989032001;S-3::100211610202908891;S-2::197201211997022001;S-3::195812081988111001;S-2::197404301999031004;S-2::195209011980031005;S-3::195508041984031002;S-3::196601081991031001;S-3::196403261991031008;S-3::197503181998021001;S-3::195210291979032001;S-3::195603081983031002;S-3::040803032;S-3::195804221982031003;S-3::195612081986102001;S-2::195402201981032001;S-3::195906061992031001;S-3::100220310282100891;S-2::197610232010122002;S-3::196010281988112001;S-2::0407050191;S-2::197103101997022001;S-3::196203161991022001;S-3::040803030;S-3::197210041997021002;S-2::196901231994032002;S-2::196710081994031002;S-3::196104211990031001;S-3::100120710222508891;S-2::197407191998022001;S-3::196602201993032001;S-3::197204201996091001;S-3::195903281986031002;S-3::199009202015041002;S-2::196602221991031003;S-3::195510171984031002;S-2::196810301993031001;S-3::195212311980111001;S-3::195604291986031002;S-3::196009091986021001;S-3::196407091989031001;S-3::196010121990031002;S-3::197601181999031002;S-3::196708101993032001;S-2::195501241985031002;S-3::195806281986091001;S-3::100120310270012891;S-2::195907051986021001;S-2::195004091979021001;S-3::196811291995011001;S-3::198606022012122001;S-2::195501031985032001;S-2::195811131986021001;S-3::196309151990032002;S-3::196105071989031004;S-3::198506202018031001;S-3::100211610210215891;S-3::195609171986031003;S-3::040903057;S-3::197008131998031010;S-3::0400500018;S-3::196807151994031003;S-3::196001071986031003;S-3::197101281995121001;S-3::041003005;S-3::198605192012122003;S-2::0407050182;S-3::196308181988111001;S-3::196409241989032002;S-2::195911201986031002;S-3::100220310231507891;S-3::100111610260100991;S-2::196809221994031001;S-3::197104171997031006;S-3::197703022008121002;S-3::197605282010121001;S-2::196105011986091001;S-3::197606152010121002;S-3::196804061994031014;S-3::198007162015041002;S-3::195706261985031002;S-3::195405121980031002;S-3::196903291997031002;S-2::198105142012121001;S-3::197203061998022001;S-2::196004201987032001;S-3::196605301991032001;S-3::197010251995021001;S-3::197204111995121001;S-3::196711081994031002;S-3::198704082015042002;S-2::196101241986022001;S-3::196712151993031003;S-3::041003015;S-3::197203251998032001;S-3::196805061992032001;S-3::198407132008122003;S-3::0407050192;S-3::198003102008122001;S-3::100111610242706891;S-3::196906021995121001;S-3::196909221995021001;S-3::195409211979031001;S-3::195903071985031001;S-3::196203231987032001;S-3::195604241985031002;S-3::195901051986032001;S-3::100220310242209791;S-2::197007071995012003;S-3::196902021995122001;S-2::196205281991031009;S-3::100211610232806891;S-2::195410071984031001;S-3::196008191987031001;S-3::196005141986031001;S-3::195603241985031003;S-3::195805301986091001;S-3::195512281980032001;S-2::196605041993031002;S-3::196705101992032002;S-3::196905261994031002;S-3::198207282008121002;S-3::196102281989031002;S-3::195408031985031001;S-3::196205061987031003;S-3::196301061988111001;S-3::197405121998022001;S-3::195509081984031001;S-2::196303201989031002;S-3::195401251986031001;S-3::0407050188;S-2::195105051978021001;S-3::100140310203217891;S-3::195509011985031003;S-3::194906291979031002;S-3::195611221983031001;S-3::195311251979021001;S-3::198301052012121005;S-2::195707081985031003;S-3::196308081990031002;S-3::197004271995011001;S-3::196011111986031004;S-3::196407241988111001;S-3::196904211994032001;S-3::195505161985031003;S-2::197101091997031001;S-3::100140310211100891;S-2::196001121987031003;S-3::0408050280;S-3::198801252015041001;S-2::196807281993031001;S-3::197507042000032001;S-3::196607201995011001;S-3::195512051983032001;S-3::196106081987031003;S-3::196003071993031001;S-3::196405131995121001;S-3::197604092009122001;S-2::197804022008121001;S-2::041003004;S-2::198801122014041001;S-2::198803222012122003;S-2::100120310242807891;S-2";

        $d=explode('::',$str);
        foreach($d as $k=>$v)
        {
            list($nip,$pnd)=explode(';',$v);
            $data['pendidikan']=str_replace('-','',$pnd);
            Dosen::where('nip',$nip)->update($data);
        }
    }

    public function secret()
    {
        if(!SSO::check())
            SSO::authenticate();
        
        $user = SSO::getUser();

        if(isset($user->role))
        {

            if($user->role=='mahasiswa')
            {
                // return $user;
                $dept_id=$program_id=0;
                foreach($user as $k=>$v)
                {
                    if($k=='study_program')
                    {
                        $d=trim(strtok($v,'('));
                        $dept=MasterDepartemen::where('nama_departemen','like',"%$d%")->first();
                        
                        if($dept)
                            $dept_id=$dept->id;
                        
                    }

                    if($k=='educational_program')
                    {
                        $d=trim(strtok($v,'('));
                        if($dept_id!=0)
                        {

                            $prog=ProgamStudi::where('departemen_id',$dept_id)->where('nama_program_studi','like',"%$d%")->first();
                            
                            if($prog)
                                $program_id=$prog->id;
                        }
                        
                    }
                    // echo $program_id;
                    // echo $k.'-'.$v.'<br>';
                }
                // return 1;
                $username=$user->username;
                $npm=$user->npm;
                $mahasiswa=Mahasiswa::where('npm',$npm)->first();
                if($mahasiswa)
                {
                    $users=User::where('kat_user',3)->where('id_user',$mahasiswa->id)->first();
                    // return $users;

                    if($mahasiswa->departemen_id==0)
                    {
                        $mahasiswa->departemen_id=$dept_id;

                        if($mahasiswa->program_studi_id==0)
                            $mahasiswa->program_studi_id=$program_id;

                        $mahasiswa->save();
                    }

                    Auth::login($users);
                    if($mahasiswa->departemen_id==0)
                    {
                        return redirect('profil/#tab_1_2')->with('status','Selamat Datang '.$user->name.'. Silahkan Lengkapi Data Anda Pada Informasi Kampus');
                    }
                    else
                    {
                        if($mahasiswa->program_studi_id==0)
                        {
                            return redirect('profil/#tab_1_2')->with('status','Selamat Datang '.$user->name.'. Silahkan Lengkapi Data Anda Pada Informasi Kampus');
                        }
                        else
                            return redirect('profil')->with('status','Selamat Datang '.$user->name);
                    }
                }
                else
                {
                    // username : ar.royya
                    // name : Ar Royya Noor Gunadi Ahmad
                    // role : mahasiswa
                    // npm : 1706106652
                    // org_code : 08.00.12.01
                    // faculty : ILMU KOMPUTER
                    // study_program : Sistem Informasi (Information System)
                    // educational_program : S1 Paralel (S1 Paralel)
                    $nama=$user->name;
                    $prodi=$user->study_program;
                    $program=$user->educational_program;
                    
                    $mhs=new Mahasiswa;
                    $mhs->npm=$npm;
                    $mhs->nama=$nama;
                    $mhs->email=$username;
                    $mhs->departemen_id='0';
                    $mhs->jenjang_id='0';
                    $mhs->bukti_siak_ng='';
                    $mhs->program_studi_id='0';
                    $mhs->hp='';
                    $mhs->save();

                    $us=new Users;
                    $us->id_user=$mhs->id;
                    $us->email=$username;
                    $us->name=$nama;
                    $us->flag=0;
                    $us->kat_user=3;
                    $us->password=bcrypt($npm);
                    $us->save();

                    $usr = User::where('id',$us->id)->where('kat_user',3)->first();
                    // return $usr;
                    Auth::login($usr);      
                    return redirect('profil')->with('status','Anda Sudah Berhasil Registrasi, Status Akun Anda Akan DI Verifikasi Oleh Sekretariat');    
                }
            }
            elseif($user->role=='staff')
            {
                $cekdosen=Dosen::where('nip',$user->nip)->orWhere('email',$user->username)->first();
                // $cekdosen=Dosen::where('email',$user->username)->first();
                if($cekdosen)
                {
                    $users=User::where('kat_user',2)->where('id_user',$cekdosen->id)->first();
                    Auth::login($users);
                    // return redirect('profil-dosen')->with('status','Selamat Datang '.$user->name);
                    return redirect('beranda');
                }
                else
                {
                    $cekstaf=Staf::where('nip',$user->nip)->orWhere('email',$user->username)->first();
                    // $cekstaf=Staf::where('email',$user->username)->first();
                    if($cekstaf)
                    {
                        $users=User::where('kat_user',1)->where('id_user',$cekstaf->id)->first();
                        Auth::login($users);
                        // return redirect('profil-staf')->with('status','Selamat Datang '.$user->name);
                        return redirect('beranda');
                    }
                    else
                    {
                        return view('welcome',[
                            'user'=>$user,
                        ]);
                    }
                }
            }
            return view('welcome',[
                    'user'=>$user,
                ]);
        }

        return view('welcome',[
            'user'=>$user
        ]);
    }

    public function regis_dosen_staf(Request $request)
    {
        $regis_as = $request->regis_as;
        $nip = $request->nip;
        $nama = $request->nama;
        $departemen_id = $request->departemen_id;
        $email_regis = $request->email_regis;
        $hp = $request->hp;
        $password = $request->password;
        if($regis_as==2)
        {
            $dos=new Dosen;
            $dos->nip=$nip;
            $dos->nama=$nama;
            $dos->departemen_id=$departemen_id;
            $dos->email=$email_regis;
            $dos->hp=$hp;
            $c=$dos->save();

            $us=new Users;
            $us->id_user=$dos->id;
            $us->email=$email_regis;
            $us->name=$nama;
            $us->flag=0;
            $us->kat_user=2;
            $us->password=bcrypt($password);
            $d=$us->save();

            if($c && $d)
                echo 1;
            else
                echo 0;
        }
        elseif($regis_as==1)
        {
            $staf=new Staf;
            $staf->nip=$nip;
            $staf->nama=$nama;
            $staf->departemen_id=$departemen_id;
            $staf->email=$email_regis;
            $staf->hp=$hp;
            $c=$staf->save();

            $us=new Users;
            $us->id_user=$staf->id;
            $us->email=$email_regis;
            $us->name=$nama;
            $us->flag=0;
            $us->kat_user=1;
            $us->password=bcrypt($password);
            $d=$us->save();

            if($c && $d)
                echo 1;
            else
                echo 0;
        }
    }

    public function logout()
    {
        return SSO::logout(url('/'));
    }
}
