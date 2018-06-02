<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Portal SIMASKUS</title>
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
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="">
        <div class="container">
            <div style="background:#fff;width:80%;margin:50px auto;" class="logo">
                <div class="row">
                    <div class="col-md-12 coming-soon-header text-center" style="margin-top:40px !important;">
                        
                            <img src="{{asset('img/simaskus.png')}}" alt="logo" style="height:100px;padding:5px;"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 coming-soon-content">
                        
                            <div class="row">
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
                            </div>
                            
                        </center>
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
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/countdown/jquery.countdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
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