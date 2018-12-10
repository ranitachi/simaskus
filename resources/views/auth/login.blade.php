<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login :: SIMA-sp</title>
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
        <link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('assets/pages/css/login-4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login" id="radial-center">
        <div class="logo">
            <a href="{{url('/')}}">
                <img src="{{asset('img/sima-sp.png')}}" alt="" style="height:80px;"/> </a>
        </div>
        <div class="content" style="background:white !important;">
            <form class="form-horizontal" id="login-form" method="POST" action="{{ route('login') }}" >
                 {{ csrf_field() }}
                <h3 class="form-title" style="color:darkblue">Halaman Login</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Silahkan Masukan Username dan Password </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus style="color:darkblue">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif    
                     </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required style="color:darkblue">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <input type="submit" class="btn btn-primary" value="Login">
                        {{-- @if (isset($jenis))
                            @if ($jenis=='mahasiswa') --}}
                            <button type="button" id="register-btn" class="btn btn-success">
                                Register
                            </button>
                            {{-- @endif
                        @endif --}}
                        {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a> --}}
                    </div>
                </div>
                <div class="login-options">
                    &nbsp;
                </div>
                
            </form>
            <form class="register-form" id="register-form" action="{{url('registrasi-mhs')}}" method="POST" style="margin-top:-80px;" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h3>&nbsp;</h3>
                <p> Enter your personal details below: </p>
                <div class="form-group" style="margin-bottom:5px;">
                                    <label class="control-label visible-ie8 visible-ie9">NPM</label>
                                    <div class="input-icon">
                                        <i class="fa fa-code"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="NPM" name="npm" id="npm" /> </div>
                                </div>
                                <div class="form-group" style="margin-bottom:5px;">
                                    <label class="control-label visible-ie8 visible-ie9">Nama Lengkap</label>
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Nama Lengkap" name="nama" id="nama" /> </div>
                                </div>
                                <div class="form-group" style="margin-bottom:5px;">
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">Departemen</label>
                                   
                                        <select class="bs-select form-control has-success" name="departemen_id" id="departemen_id" onchange="prodi(this.value)">
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
                                    <label class="control-label visible-ie8 visible-ie9">Program Studi</label>
                                        <div id="div_dept">
                                            <select class="bs-select form-control has-success" name="program_studi" id="jenjang">
                                                <option value="0">- Pilih Jejang -</option>
                                            </select>
                                        </div>
                                </div>
                                
                                <div class="form-group" style="margin-bottom:5px;">
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                                    <div class="input-icon">
                                        <i class="fa fa-at"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email_regis" id="email_regis" autocomplete="off"> </div>
                                </div>
                                <div class="form-group" style="margin-bottom:5px;">
                                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                    <label class="control-label visible-ie8 visible-ie9">Telp/HP</label>
                                    <div class="input-icon">
                                        <i class="fa fa-phone"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Telp/HP" name="hp" id="hp"/> </div>
                                </div>
                                <div class="form-group" style="margin-bottom:5px;">
                                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" /> </div>
                                </div>
                                <div class="form-group" style="margin-bottom:5px;">
                                    <label class="control-label" style="color:black;font-style:italic;font-size:10px;">Upload Bukti SIAK-NG</label>
                                    <div class="input-icon">
                                        <i class="fa fa-file-o"></i>
                                        <input class="form-control placeholder-no-fix" type="file" placeholder="Upload Bukti SIAK-NG" name="file_upload" /> </div>
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
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
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
        <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {{-- <script src="{{asset('assets/pages/scripts/login-4.js')}}" type="text/javascript"></script> --}}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('.register-form').hide();
                $('#register-btn').click(function(){
                    $('.register-form').show();
                    $('#login-form').hide();
                });
                
                $('#register-back-btn').click(function(){
                    $('.register-form').hide();
                    $('#login-form').show();
                });

                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

                $('#npm').on('blur',function(){
                    var npm=$(this).val();
                    $.ajax({
                        url : '{{url("mahasiswa-by-npm")}}/'+npm,
                        dataType : 'json',
                        success : function(a)
                        {
                            // var count = Object.keys(a).length;
                            if(a!=null)
                            {
                                //alert(a.nama);
                                //$().
                                $('#nama').val(a.nama);
                                $('#email').val(a.email);
                                $('#hp').val(a.hp);
                                swal("Sudah Terdaftar", "Akun Anda Sudah Terdaftar Sebleumnya, Silahkan Lakukan Login", "success")
                            }
                        }    
                    });
                });
                $('#register-submit-btn').on('click',function(){
                    var email=$('#email_regis').val();
                    $.ajax({
                        url : '{{url("mahasiswa-by-email")}}/'+email,
                        dataType : 'json',
                        success : function(a)
                        {
                            // var count = Object.keys(a).length;
                            if(a==null)
                            {
                                //alert(a.nama);
                                //$().
                                $('#register-form').submit();
                            }
                            else
                            {
                                
                                $('#nama').val(a.nama);
                                $('#email').val(a.email);
                                $('#hp').val(a.hp);
                                swal("Sudah Terdaftar", "Email Sudah Terdaftar Sebleumnya, Silahkan Gunakan Email Lain", "success")
                            }
                        }    
                    });
                });
            })

            function prodi(id_dept)
            {
                $('#div_dept').load('{{url("program-studi")}}/'+id_dept,function(){
                    $('#program_studi').select2();
                });
            }
        </script>
    </body>

</html>
<style>
    #radial-center {
  /* fallback */
  background-color: #00a3f1;
  /* background-image: url(images/radial_bg.png); */
  background-position: center center;
  background-repeat: no-repeat;

  /* Safari 4-5, Chrome 1-9 */
  /* Can't specify a percentage size? Laaaaaame. */
  background: -webkit-gradient(radial, center center, 0, center center, 460, from(#ffffff), to(#00a3f1));

  /* Safari 5.1+, Chrome 10+ */
  background: -webkit-radial-gradient(circle, #ffffff, #00a3f1);

  /* Firefox 3.6+ */
  background: -moz-radial-gradient(circle, #ffffff, #00a3f1);

  /* IE 10 */
  background: -ms-radial-gradient(circle, #ffffff, #00a3f1);

  /* Opera couldn't do radial gradients, then at some point they started supporting the -webkit- syntax, how it kinda does but it's kinda broken (doesn't do sizing) */
}
</style>