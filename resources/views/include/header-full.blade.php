<div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('img/simaskus-small.png')}}" alt="logo" class="logo-default" /> </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
                    <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
                    <div class="hor-menu   hidden-sm hidden-xs">
                        <ul class="nav navbar-nav">
                            <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                            <li class="classic-menu-dropdown {{Request::path()=='/' ? 'active' : ''}}" aria-haspopup="true">
                                <a href="{{url('/')}}"> Beranda
                                    <span class="{{Request::path()=='/' ? 'selected' : ''}}"> </span>
                                </a>
                            </li>
                            <li class="mega-menu-dropdown {{strpos(Request::url(),'jadwal')!==false ? 'active' : ''}}" aria-haspopup="true">
                                <a href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true"> Jadwal
                                    <i class="fa fa-angle-down"></i>
                                    <span class="{{strpos(Request::url(),'jadwal')!==false ? 'selected' : ''}}"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                @php
                                    $jenis_ta=\App\Model\MasterJenisPengajuan::orderBy('jenis')->get();
                                @endphp
                                    @foreach ($jenis_ta as $key => $item)
                                        <li>
                                            <a href="{{url('jadwal/'.str_slug($item->jenis))}}">
                                                <i class="fa fa-check-square-o"></i> {{$item->jenis}} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="classic-menu-dropdown {{strpos(Request::url(),'rekap')!==false ? 'active' : ''}}" aria-haspopup="true">
                                <a href="javascript:;"> Rekap Data Submit
                                    <span class="{{strpos(Request::url(),'rekap')!==false ? 'selected' : ''}}"> </span>
                                </a>
                            </li>            
                            <li class="mega-menu-dropdown {{strpos(Request::url(),'list-pengajuan')!==false ? 'active' : ''}}" aria-haspopup="true">
                                <a href="javascript:;"> List Pengajuan
                                    <i class="fa fa-angle-down"></i>
                                    <span class="{{strpos(Request::url(),'list-pengajuan')!==false ? 'selected' : ''}}"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-square-o"></i> Panduan Pengajuan </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-square-o"></i> Data Pengajuan </a>
                                    </li>
                                </ul>
                            </li>    
                            <li class="classic-menu-dropdown {{strpos(Request::url(),'login')!==false ? 'active' : ''}}" aria-haspopup="true">
                                <a href="{{url('login')}}"> Login
                                    <span class="{{strpos(Request::url(),'login')!==false ? 'selected' : ''}}"> </span>
                                </a>
                            </li>           
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form" action="extra_search.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>