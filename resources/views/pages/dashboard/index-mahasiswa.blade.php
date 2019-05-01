@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
    <link href="{{asset('assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
    {{-- <div class="page-content" style="background:#eef1f5">
        <div class="search-page search-content-1">
                            
            <div class="row">
                <div class="col-md-7">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-edit font-dark"></i>
                                <span class="caption-subject font-dark bold uppercase">Berita Terbaru</span>
                            </div>
                            <div class="actions">
                                
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascriptt:;">
                                    <i class="fa fa-newspaper-o"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="search-container ">
                                <ul>
                                    <li class="search-item clearfix">
                                        <a href="javascriptt:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/01.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">Metronic Search Results</a>

                                            </h2>
                                            
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                            
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/1.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">Lorem ipsum dolor</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/02.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">sit amet</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/2.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">consectetur adipiscing</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/03.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">Donec efficitur</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/05.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">mauris quam</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                    <li class="search-item clearfix">
                                        <a href="javascript:;">
                                            <img src="{{asset('assets/pages/img/page_general_search/5.jpg')}}" />
                                        </a>
                                        <div class="search-content">
                                            <span class="mt-comment-date">12 Feb, 08:30AM</span>
                                            <span class="mt-action-dot bg-green"></span>
                                            <span class="mt-comment-date">
                <a href="#">Departemen Teknik Mesin</a>
                                            </span>
                                            <h2 class="search-title">
                <a href="javascript:;">volutpat nunc</a>
                                            </h2>
                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="search-pagination">
                                    <ul class="pagination">
                                        <li class="page-active">
                                            <a href="javascriptt:;"> 1 </a>
                                        </li>
                                        <li>
                                            <a href="javascriptt:;"> 2 </a>
                                        </li>
                                        <li>
                                            <a href="javascriptt:;"> 3 </a>
                                        </li>
                                        <li>
                                            <a href="javascriptt:;"> 4 </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-edit font-dark"></i>
                                <span class="caption-subject font-dark bold uppercase">Jadwal Sidang Terdekat</span>
                            </div>
                            <div class="actions">
                                
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascriptt:;">
                                    <i class="icon-calendar"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="note note-success">
                                <h4 class="block">Success! Some Header Goes Here</h4>
                                <p> Duis mollis, est non commodo luctus, nisi erat mattis consectetur purus sit amet porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                            </div>
                            <div class="note note-info">
                                <h4 class="block">Info! Some Header Goes Here</h4>
                                <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, mattis consectetur purus sit amet eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                            </div>
                            <div class="note note-danger">
                                <h4 class="block">Danger! Some Header Goes Here</h4>
                                <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit mattis consectetur purus sit amet.\ Cras mattis consectetur purus sit amet fermentum. </p>
                            </div>
                            <div class="note note-warning">
                                <h4 class="block">Warning! Some Header Goes Here</h4>
                                <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit mattis consectetur purus sit amet. Cras mattis consectetur purus sit amet fermentum. </p>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div> --}}
    {{-- @include('home') --}}
<div class="page-content">                        
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('beranda')}}">Beranda</a>
                <i class="fa fa-circle"></i>
            </li>
           
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Spesial</h1>
    <div class="row">
        @php
        $warna='grey';
        $check='';
        $waktupengajuanmk=$waktupengajuansidang=$waktupendajwalan=$waktusidang='Belum Di Atur Jadwal';
        if (count($kalender)!=0)
        {
                foreach ($kalender as $key => $value) 
                {
                    if($value['kategori_khusus']=='masa-pengajuan-mata-kuliah-khusus')
                    {
                        $waktupengajuanmk=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/mY',strtotime($value['end_date']));
                        $warna='blue';
                        $check='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupengajuanmk='Belum Di Atur Jadwal';
                        $warnawaktupengajuanmk='grey';
                        $checkwaktupengajuanmk='';
                    }
                    
                    if($value['kategori_khusus']=='masa-penjadwalan')
                    {
                        $waktupendajwalan=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/mY',strtotime($value['end_date']));
                        $warnawaktupendajwalan='blue';
                        $checkwaktupendajwalan='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupendajwalan='Belum Di Atur Jadwal';
                        $warnawaktupendajwalan='grey';
                        $checkwaktupendajwalan='';
                    }
                    
                    if($value['kategori_khusus']=='masa-pengajuan-sidang-mata-kuliah-khusus')
                    {
                        $waktupengajuansidang=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/mY',strtotime($value['end_date']));
                        $warnawaktupengajuansidang='blue';
                        $checkwaktupengajuansidang='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupengajuansidang='Belum Di Atur Jadwal';
                        $warnawaktupengajuansidang='grey';
                        $checkwaktupengajuansidang='';
                    }
                    
                    if($value['kategori_khusus']=='masa-pelaksanaan-sidang')
                    {
                        $waktusidang=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/mY',strtotime($value['end_date']));
                        $warnawaktusidang='blue';
                        $checkwaktusidang='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktusidang='Belum Di Atur Jadwal';
                        $warnawaktusidang='grey';
                        $checkwaktusidang='';
                    }
                }
            // }
            // else
            // {
            //     
            // }
        }    
        else
        {
            $waktupengajuanmk=$waktupengajuansidang=$waktupendajwalan=$waktusidang='Belum Di Atur Jadwal';
            $warnawaktupengajuanmk=$warnawaktupendajwalan=$warnawaktupengajuansidang=$warnawaktusidang='grey';
            $checkwaktupengajuanmk=$checkwaktupendajwalan=$checkwaktupengajuansidang=$checkwaktusidang='';
        }

        if(isset($kal_lain['masa-pengajuan-mata-kuliah-khusus']))
        {
            $kl=$kal_lain['masa-pengajuan-mata-kuliah-khusus'];
            $waktupengajuanmk=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));
        }
        if(isset($kal_lain['masa-penjadwalan']))
        {
            $kl=$kal_lain['masa-penjadwalan'];
            $waktupendajwalan=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));;
        }
        if(isset($kal_lain['masa-pengajuan-sidang-mata-kuliah-khusus']))
        {
            $kl=$kal_lain['masa-pengajuan-sidang-mata-kuliah-khusus'];
            $waktupengajuansidang=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));
        }
        if(isset($kal_lain['masa-pelaksanaan-sidang']))
        {
            $kl=$kal_lain['masa-pelaksanaan-sidang'];
            $waktusidang=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));;
        }
        @endphp
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupengajuanmk}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupengajuanmk}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupengajuanmk!!} Pengajuan Bimbingan</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupengajuansidang}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupengajuansidang}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupengajuansidang!!} Pengajuan Sidang</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupendajwalan}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupendajwalan}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupendajwalan!!} Pendjadwalan</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktusidang}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktusidang}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktusidang!!} Pelaksanaan Sidang</div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    
</script>
@endsection