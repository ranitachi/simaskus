<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\User;
use App\Models\Pesan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesanController extends Controller
{
    public function index()
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;
        
        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        return view('pages.pesan.index')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash);
    }

    public function create()
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;

        $user = User::where('flag',1)->where('kat_user','!=','0')->orderBy('name')->get();

        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        return view('pages.pesan.create')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash)
            ->with('user',$user);
    }
    public function edit($id)
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;

        $user = User::where('flag',1)->where('kat_user','!=','0')->orderBy('name')->get();

        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        $get=Pesan::where('id',$id)->with('lampiran')->with('userdari')->with('useruntuk')->first();
        return view('pages.pesan.edit')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash)
            ->with('get',$get)
            ->with('user',$user);
    }

    public function show($id)
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;

        $user = User::where('flag',1)->where('kat_user','!=','0')->orderBy('name')->get();

        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        $get=Pesan::where('id',$id)->with('lampiran')->with('userdari')->with('useruntuk')->first();
        $get->status_baca=1;
        $get->save();

        return view('pages.pesan.detail')
            ->with('get',$get)
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash)
            ->with('user',$user);
    }
    public function kirim($id)
    {
        $get=Pesan::where('id',$id)->with('lampiran')->with('userdari')->with('useruntuk')->first();
        $get->status_pesan=1;
        $get->save();
        return redirect()->route('pesan.index')->with('success','Pesan Anda Telah Di Berhasil Dikirim');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $idform = $request->idform;
        $judul = $request->subject;
        $pesan = $request->message;

        foreach($request->to as $k=>$v)
        {
            list($iduser,$namauser)=explode('__',$v);
            $simpan =  new Pesan;
            $simpan->idform = $idform;
            $simpan->id_user_dari = Auth::user()->id;
            $simpan->id_user_untuk = $iduser;
            $simpan->status_baca = 0;
            $simpan->status_pesan = 1;
            $simpan->dari = Auth::user()->name;
            $simpan->untuk = $namauser;
            $simpan->judul = $judul;
            $simpan->pesan = $pesan;
            $simpan->save();
        }

        return redirect()->route('pesan.index')->with('success','Pesan Anda Telah Terkirim');
    }

    public function store_draft(Request $request)
    {
        // return $request->all();
        $idform = $request->idform;
        $judul = $request->subject;
        $pesan = $request->message;

        foreach($request->to as $k=>$v)
        {
            list($iduser,$namauser)=explode('__',$v);
            $simpan =  new Pesan;
            $simpan->idform = $idform;
            $simpan->id_user_dari = Auth::user()->id;
            $simpan->id_user_untuk = $iduser;
            $simpan->status_baca = 0;
            $simpan->status_pesan = 0;
            $simpan->dari = Auth::user()->name;
            $simpan->untuk = $namauser;
            $simpan->judul = $judul;
            $simpan->pesan = $pesan;
            $simpan->save();
        }

        return redirect()->route('pesan.index')->with('success','Pesan Anda Telah Disimpan sebagai Draft');
    }

    public function terkirim()
    {
        
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;
        
        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        // return $terkirim;
        return view('pages.pesan.terkirim')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash);
    }
    public function draft()
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;
        
        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        return view('pages.pesan.draft')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash);
    }
    public function trash()
    {
        $datauser = $this->datauser(); 
        $dept_id = $datauser['data']->departemen_id;
        
        $pesan=Pesan::where('id_user_untuk',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $terkirim = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','1')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $draft = Pesan::where('id_user_dari',Auth::user()->id)->where('status_pesan','0')->with('lampiran')->with('userdari')->with('useruntuk')->orderBy('created_at','desc')->get();
        $trash = DB::table('pesans')->whereNotNull('deleted_at')->orderBy('created_at','desc')->get();

        return view('pages.pesan.trash')
            ->with('pesan',$pesan)
            ->with('terkirim',$terkirim)
            ->with('draft',$draft)
            ->with('trash',$trash);
    }
}
