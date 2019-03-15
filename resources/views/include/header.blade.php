<div class="page-header navbar navbar-fixed-top" style="background:#32c5d2">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.html">
                            <img src="{{asset('img/simaskus-small.png')}}" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler" >
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    @php
                                        $notif=\App\Model\Notifikasi::where('to',Auth::user()->id)->where('flag_active',1)->orderBy('created_at','desc')->get();
                                    @endphp
                                    @if (count($notif)>0)
                                            <span class="badge badge-danger" id="label-notif"> {{count($notif)}} </span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu" style="width:400px !important;max-width:400px !important;">
                                    <li class="external">
                                        <h3>
                                            <span class="bold"></span> Notifikasi</h3>
                                        {{-- <a href="page_user_profile_1.html">view all</a> --}}
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 400px;" data-handle-color="#637283">
                                            @foreach ($notif as $item)
                                                @php
                                                    $waktu=\Carbon\Carbon::parse($item->created_at)->diffForHumans();
                                                    $wkt=text_translate($waktu,'en','id');
                                                    $ps=explode("<a",$item->pesan);
                                                    $pesan=$ps[0];
                                                @endphp 
                                                <li onmouseover="updatenotif({{$item->id}})">
                                                    <a href="{{url('notifikasi/'.$item->id)}}">
                                                        <span class="time" style="max-width:none;background:lightcoral;color:white" id="time-waktu_{{$item->id}}">{{$wkt}}</span>
                                                        <span class="details">
                                                            {!!$pesan!!} </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    @if (Auth::user()->foto!='')
                                        <img alt="" class="img-circle" src="{{asset('storage/'.Auth::user()->foto)}}" />    
                                    @else
                                        <img alt="" class="img-circle" src="{{asset('assets/layouts/layout/img/avatar3_small.jpg')}}" />
                                    @endif
                                    
                                    <span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        @if (Auth::user()->kat_user==3)
                                            <a href="{{url('profil')}}">
                                                <i class="icon-user"></i> My Profile </a>
                                        @elseif(Auth::user()->kat_user==1)
                                            <a href="{{url('profil-staf')}}">
                                                <i class="icon-user"></i> My Profile </a>    
                                        @endif
                                        
                                    </li>
                                    <li class="divider"> </li>
                                    {{-- <li>
                                        <a href="page_user_lock_1.html">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-key"></i> Log Out </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            {{-- <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle" >
                                    <i class="icon-logout"></i>
                                </a>
                                
                            </li> --}}
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
<style>
.page-header.navbar .menu-toggler > span, 
.page-header.navbar .menu-toggler > span:before, 
.page-header.navbar .menu-toggler > span:after
{
    background:#000 !important;
}
</style>
