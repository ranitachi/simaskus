<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            if(Auth::user()->kat_user==0)
                return view('pages.dashboard.index');
            else if(Auth::user()->kat_user==1)
                return view('pages.dashboard.index-sekretariat');
            else if(Auth::user()->kat_user==3)
            {
                // return view('pages.dashboard.index-mahasiswa');
                return redirect('profil');
            }
            else if(Auth::user()->kat_user==2)
                return view('pages.dashboard.index-dosen');
            // dd(Auth::user());
        }
        else
        {
            return redirect('/')->with('pesan',"Login Gagal");
        }
    }
}
