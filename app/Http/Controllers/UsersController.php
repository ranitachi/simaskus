<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SSO\SSO;
class UsersController extends Controller
{
    //
    public function performLogout(Request $request) {
        // Auth::logout();
        // if(SSO::check())
            return SSO::logout(url('/logout_akun'));
        // else
            return redirect('/login');
    }

    public function logout() {
        // Auth::logout();
        // if(SSO::check())
            return SSO::logout(url('/logout_akun'));
        // else
            // return redirect('/login');
    }
    public function logout_akun() {
        Auth::logout();
        return redirect('/login');
    }
}
