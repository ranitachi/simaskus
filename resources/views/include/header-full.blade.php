<div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('img/simaskus-small.png')}}" alt="logo" class="logo-default" /> </a>
                    </div>

                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                            {{-- <li class="classic-menu-dropdown {{Request::path()=='/' ? 'active' : ''}}" aria-haspopup="true">
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
                            </li>     --}}
                            {{-- <li class="classic-menu-dropdown {{strpos(Request::url(),'login')!==false ? 'active' : ''}}" aria-haspopup="true">
                                <a href="{{url('login')}}"> Login
                                    <span class="{{strpos(Request::url(),'login')!==false ? 'selected' : ''}}"> </span>
                                </a>
                            </li>  --}}
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="{{url('login')}}" class="dropdown-toggle">
                                    <i class="icon-login"></i>
                                </a>
                            </li>          
                        </ul>
                    </div>
                    
                </div>
                <!-- END HEADER INNER -->
            </div>