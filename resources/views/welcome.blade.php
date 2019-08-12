<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Portal SIMA-sp</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('assets/pages/css/coming-soon.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="">
        <div class="container">
            <div style="background:#fff;width:80%;margin:50px auto;" class="logo">
                
                <div class="row">
                    <div class="col-md-12 coming-soon-content" style="padding-left:40px;">

                            {{-- @foreach ($user as $key=>$item)
                                <h3>{{$key}} : {{$item}}</h3>
                            @endforeach
                            <br><br> --}}
                            <div class="row">
                                <div class="col-md-3">Nama</div>
                                <div class="col-md-8">: <b>{{$user->name}}</b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Username/Email</div>
                                <div class="col-md-8">: <b>{{$user->username}}</b></div>
                            </div>
                            @if ($user->role=='staff')
                                <div class="row">
                                    <div class="col-md-3">NIP</div>
                                    <div class="col-md-8">: <b>{{isset($user->nip) ? $user->nip : ''}}</b></div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3">Role</div>
                                <div class="col-md-8">: <b>{{$user->role}}</b></div>
                            </div>
                            
                            @if ($user->role=='tamu')
                                <div class="row">
                                    <div class="col-md-12 text-center"><h3>Mohon Maaf, Untuk Role <b>TAMU</b> belum dapat mengakses Sistem ini, Silahkan Dapat Menghubungi Admin Departemen Masing-Masing</h3></div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12" style="padding-top:40px;">
                                        <h4 class="text-center">Akun Anda Belum Terdaftar Pada Sistem Ini, Mohon Registrasi Terlebih Dahulu, agar dapat di verifikasi Oleh Staf Sekretariat. Terima Kasih.</h4>
                                    </div>
                                    <div class="col-md-2" style="padding-top:20px;">&nbsp;</div>
                                    <div class="col-md-7" style="padding-top:20px;">
                                        
                                        
                                        
                                        <form class="register-form" id="register-form" action="{{url('registrasi-staf')}}" method="POST" style="margin-top:-50px;padding-top:0px;" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <h3>&nbsp;</h3>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Register Sebagai</label>
                                                
                                                        <select class="bs-select form-control has-success" name="regis_as" id="regis_as" style="width:200px;">
                                                            <option value="2">Dosen</option>
                                                            <option value="1">Staf Sekretariat</option>
                                                        </select>
                                                
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">NIP</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-code"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" placeholder="NIP" name="nip" id="nip" value="{{isset($user->nip) ? $user->nip : ''}}"/> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Nama Lengkap</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-user"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Nama Lengkap" name="nama" id="nama_lengkap" value="{{$user->name}}"/> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Departemen</label>
                                                
                                                        <select class="bs-select form-control has-success" name="departemen_id" id="departemen_id" >
                                                            <option value="0">- Pilih Departemen -</option>
                                                            @php
                                                                $dept=\App\Model\MasterDepartemen::all();
                                                            @endphp
                                                            @foreach ($dept as $item)
                                                                <option value="{{$item->id}}">{{$item->nama_departemen}}</option>
                                                            @endforeach
                                                        </select>
                                                
                                                </div>
                                                
                                                
                                               
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Email/Username SSO</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-at"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email_regis" id="email_regis" autocomplete="off" value="{{$user->username}}"> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Telp/HP</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-phone"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Telp/HP" name="hp" id="hp"/> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Jenis Kelamin</label>
                                                
                                                        <select class="bs-select form-control has-success" name="gender" id="gender" style="width:200px;">
                                                            <option value="1">Pria</option>
                                                            <option value="0">Wanita</option>
                                                        </select>
                                                
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Password</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-key"></i>
                                                        <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" id="password_regis"/> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Confirm Password</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-key"></i>
                                                        <input class="form-control placeholder-no-fix" type="password" placeholder="Confirm Password" name="c_password" id="c_password_regis"/> </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Upload Foto (*optional)</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-file-o"></i>
                                                        <input class="form-control placeholder-no-fix" required type="file" placeholder="Upload Foto" name="file_upload" id="file_upload" accept=".jpg,.png"/> </div>
                                                </div>
                                                {{-- <div class="form-group" style="margin-bottom:5px;">
                                                    <label class="control-label visible-ie8 visible-ie9">Re-Password</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-key"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Re-Password" name="re-password" /> </div>
                                                </div>
                                                
                                                --}}
                                                <div class="form-actions">
                                                    <button id="register-back-btn" type="button" class="btn red btn-outline"> Back </button>
                                                    <button type="button" id="register-submit-btn" class="btn green pull-right"> Register </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            

                            <h3 class="text-center"><a href="{{url('logout_sso')}}">LOGOUT</a></h3>
                            {{-- <h3>Nama : {{$user->name}}</h3>
                            <h3>NIM/NPM : {{$user->npm}}</h3>
                            <h3>Fakultas : {{$user->faculty}}</h3> --}}
                            {{-- <div class="row">
                                <div class="col-md-3 " style="cursor:pointer">
                                    <center class="link-login" style="padding:10px 0 10px 0;">
                                        <a href="{{url('login/admin')}}">
                                            <img src="{{asset('img/logo.png')}}" style="height:150px;margin:0 auto;">
                                            <div style="margin:15px 0 0 0;">Administrator</div>
                                        </a>
                                    </center>
                                </div>
                                <div class="col-md-3 " style="cursor:pointer">
                                    <center class="link-login" style="padding:10px 0 10px 0;">
                                        <a href="{{url('login/mahasiswa')}}">
                                            <img src="{{asset('img/mhs.png')}}" style="height:150px;margin:0 auto;">
                                            <div style="margin:15px 0 0 0;">Mahasiswa</div>
                                        </a>
                                    </center>
                                </div>
                                <div class="col-md-3" style="cursor:pointer">
                                    <center class="link-login" style="padding:10px 0 10px 0;">
                                        <a href="{{url('login/dosen')}}">
                                            <img src="{{asset('img/dosen.png')}}" style="height:150px;margin:0 auto;">
                                            <div style="margin:15px 0 0 0;">Dosen</div>
                                        </a>
                                    </center>
                                </div>
                                <div class="col-md-3" style="cursor:pointer">
                                    <center class="link-login" style="padding:10px 0 10px 0;">
                                        <a href="{{url('login/sekretariat')}}">
                                            <img src="{{asset('img/staff.png')}}" style="height:150px;margin:0 auto;">
                                            <div style="margin:15px 0 0 0;">Sekretariat</div>
                                        </a>
                                    </center>
                                </div>
                            </div> --}}
                            
                        {{-- </center> --}}
                    </div>
                </div>
                <!--/end row-->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <hr style="width:80%;margin:0 auto;border:1px solid #aaa">
                        <div class="coming-soon-footer" style="text-align:center !important;color:#000">Copyright &copy; Fakultas Teknik Universitas Indonesia {{date('Y')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/countdown/jquery.countdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/coming-soon.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
                $('#register-submit-btn').on('click',function(){
                       
                       

                        var regis_as = $('#regis_as').val();
                        var nip = $('#nip').val();
                        var nama_lengkap = $('#nama_lengkap').val();
                        var departemen_id = $('#departemen_id').val();
                        var email_regis = $('#email_regis').val();
                        var hp = $('#hp').val();
                        var password_regis = $('#password_regis').val();
                        var c_password_regis = $('#c_password_regis').val();
                        var file_upload=$('#file_upload').val();

                        if(regis_as=='')
                            swal("Peringatan", "Registrasi Sebagai - Belum Di Dipilih", "error")
                        else if(nip=='')
                            swal("Peringatan", "NIP Belum Di Isi", "error")
                        else if(nama_lengkap==0)
                            swal("Peringatan", "Nama Lengkap Belum Diisi", "error")
                        else if(departemen_id==0)
                            swal("Peringatan", "Departemen Belum Dipilih", "error")
                        else if(email_regis==0)
                            swal("Peringatan", "Email/Username SSO Belum Diisi", "error")
                        else if(password_regis=="")
                            swal("Peringatan", "Silahkan Isi Password", "error")
                        else if(c_password_regis=="")
                            swal("Peringatan", "Silahkan Isi Konfirmasi Password", "error")
                        else if(password_regis!=c_password_regis)
                            swal("Peringatan", "Password Tidak Sama", "error")
                        else
                        {
                            $.ajax({
                                url : '{{url("regis-dosen-staf")}}',
                                type : 'POST',
                                data : $('#register-form').serialize(),
                                success : function(a)
                                {
                                    // var count = Object.keys(a).length;
                                    if(a==1)
                                    {
                                        swal("Registrasi Berhasil", "Proses Registrasi Berhasil, Data Anda Akan Segera Diverifikasi Oleh Staf Sekretariat ", "success")
                                    }
                                    else
                                    {
                                        swal("Registrasi Gagal", "Mohon Maaf, Proses Registrasi Gagal, Silahkan Dapat Menghubungi Staf Sekretariat", "error")
                                        // $('#nama').val(a.nama);
                                        // $('#email').val(a.email);
                                        // $('#hp').val(a.hp);
                                        // swal("Sudah Terdaftar", "Email Sudah Terdaftar Sebleumnya, Silahkan Gunakan Email Lain", "error")
                                        // $('#register-submit-btn').prop('disabled',true);
                                    }
                                }    
                            });
                        }
                    });
            
            })
        </script>
        <style>
            .logo
            {
                border-radius: 20px !important;
            }
            .link-login:hover
            {
                background:lightblue;
                font-style: bold;
                font-weight: 600;
                text-decoration:none;
                border-radius: 10px;
            }
            .link-login:hover a{
                text-decoration:none;
            }
        </style>
    </body>

</html>