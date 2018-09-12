<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
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
                return view('pages.dashboard.index-mahasiswa');
                // return redirect('profil');
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
        // $EMAIL            = $username;
        // $PASSWORD         = $password;
        // $cookie_file_path = "/home/user/Users/Documents/cookies.txt";
        // // $LOGINURL         = "https://cart2.barnesandnoble.com/mobileacct/op.asp?stage=signIn"; 
        // $LOGINURL         = "https://academic.ui.ac.id/main/Authentication/"; 
        // $agent            = "Nokia-Communicator-WWW-Browser/2.0 (Geos 3.0 Nokia-9000i)";


        // // begin script
        // $ch = curl_init(); 

        // // extra headers
        // $headers[] = "Accept: */*";
        // $headers[] = "Connection: Keep-Alive";

        // // basic curl options for all requests
        // curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
        // curl_setopt($ch, CURLOPT_HEADER,  0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);         
        // curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path); 
        // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 

        // // set first URL
        // curl_setopt($ch, CURLOPT_URL, $LOGINURL);

        // // execute session to get cookies and required form inputs
        // $content = curl_exec($ch); 

        // // grab the hidden inputs from the form required to login
        // $fields = getFormFields($content);
        // $fields['emailAddress'] = $EMAIL;
        // $fields['acctPassword'] = $PASSWORD;

        // // get x value that is used in the login url
        // $x = '';
        // // if (preg_match('/op\.asp\?x=(\d+)/i', $content, $match)) {
        // //     $x = $match[1];
        // // }

        // //$LOGINURL   = "https://cart2.barnesandnoble.com/mobileacct/op.asp?stage=signIn";
        // // $LOGINURL   = "https://cart2.barnesandnoble.com/mobileacct/op.asp?x=$x";
        //  $LOGINURL         = "https://academic.ui.ac.id/main/Authentication/"; 

        // // set postfields using what we extracted from the form
        // $POSTFIELDS = http_build_query($fields); 

        // // change URL to login URL
        // curl_setopt($ch, CURLOPT_URL, $LOGINURL); 

        // // set post options
        // curl_setopt($ch, CURLOPT_POST, 1); 
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS); 

        // // perform login
        // $result = curl_exec($ch);
        // Storage::put('file.txt', $result);
    }
    
}
