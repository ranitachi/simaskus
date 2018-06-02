<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UsersController extends Controller
{
    //
    public function performLogout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
