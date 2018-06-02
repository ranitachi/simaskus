<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login :: SIMASKUS</title>
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
        <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('assets/pages/css/login-5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 login-container bs-reset">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('/')}}">
                                <img class="login-logo login-6" src="{{asset('img/simaskus.png')}}" style="margin:0 auto;height:50px;"/>
                            </a>
                        </div>
                    </div>
                    <div class="login-content">
                        
                        <form class="form-horizontal" id="login-form" method="POST" action="{{ route('login') }}">
                                <h1>User Login</h1>
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Username</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                        {{-- @if (isset($jenis))
                                            @if ($jenis=='mahasiswa')
                                            <button type="button" id="register-btn" class="btn btn-success">
                                                Register
                                            </button>
                                            @endif
                                        @endif --}}

                                        {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a> --}}
                                    </div>
                                </div>
                            </form>
                            <form class="register-form" action="{{url('registrasi-mhs')}}" method="POST" style="margin-top:-30px;">
                                {{ csrf_field() }}
                                <h3>Registrasi</h3>
                                <p> Silahkan Isi Data Di Bawah Ini : </p>
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
                                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                                    <div class="input-icon">
                                        <i class="fa fa-at"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" id="email"/> </div>
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
                                {{-- <div class="form-group" style="margin-bottom:5px;">
                                    <label class="control-label visible-ie8 visible-ie9">Re-Password</label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="Re-Password" name="re-password" /> </div>
                                </div>
                                
                                --}}
                                <div class="form-actions">
                                    <button id="register-back-btn" type="button" class="btn grey-salsa btn-outline"> Back </button>
                                    <button type="submit" id="register-submit-btn" class="btn green pull-right"> Register </button>
                                </div>
                            </form>
                        </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-4 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-8 bs-reset">
                                <div class="login-copyright text-right">
                                <p>Copyright &copy; Fakultas Teknik Universitas Indonesia {{date('Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bs-reset">
                    <div class="login-bg"> </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script> 
<script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/login-5.js')}}" type="text/javascript"></script>
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
                            var count = Object.keys(a).length;
                            if(count!=0)
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
            })
        </script>
    </body>

</html>