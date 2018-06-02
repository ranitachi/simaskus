<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/beranda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index($jenis=null)
    {
        if($jenis==null)
            $jns='admin';
        else
            $jns=$jenis;

        return view('auth.login')->with('jenis',$jenis);
    }
    // protected function credentials(Request $request)
    // {
    //     if($request->jenis=='admin')
    //         $kat_user=0;
    //     elseif($request->jenis=='sekretariat')
    //         $kat_user=1;
    //     elseif($request->jenis=='dosen')
    //         $kat_user=2;
    //     elseif($request->jenis=='mahasiswa')
    //         $kat_user=3;

    //     $request->request->add(['kat_user' => $kat_user]);
    //     return array_merge($request->only($this->username(), 'password','kat_user'));
    // }
    // protected function attemptLogin(Request $request,$jenis)
    // {
    //     $request->merge(['kat_user' => '0']);

    //     return $this->guard()->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }
    // protected function credentials(Request $request)
    // {
    //     return $request->only($this->username(), 'password', 'kat_user');
    // }
}
