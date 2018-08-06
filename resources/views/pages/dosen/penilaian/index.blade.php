@extends('layouts.master')
@section('title')
    <title>Data Sidang :: SIMASKUS</title>
@endsection
<link href="{{asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/portfolio.min.css')}}" rel="stylesheet" type="text/css" />
@section('konten')
        <div class="page-content">
       
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('beranda')}}">Beranda</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Jadwal</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Jadwal
            <small>Sidang</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="row" id="loader">
                <div class="col-md-10 text-center" style="position:fixed;">
                    <center>
                        <img src="{{asset('img/loading-bl-blue.gif')}}">
                    </center>
                </div>
            </div>
            <div id="data">
                 <div class="portfolio-content portfolio-1">
                            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> Semua Jadwal
                                    <div class="cbp-filter-counter"></div>
                                </div>
                                @foreach ($jenis as $v)
                                    <div data-filter=".{{str_slug($v)}}" class="cbp-filter-item btn dark btn-outline uppercase"> {{$v}}
                                        <div class="cbp-filter-counter"></div>
                                    </div>
                                @endforeach
                                {{-- <div data-filter=".identity" class="cbp-filter-item btn dark btn-outline uppercase"> Identity
                                    <div class="cbp-filter-counter"></div>
                                </div>
                                <div data-filter=".web-design" class="cbp-filter-item btn dark btn-outline uppercase"> Web Design
                                    <div class="cbp-filter-counter"></div>
                                </div>
                                <div data-filter=".graphic" class="cbp-filter-item btn dark btn-outline uppercase"> Graphic
                                    <div class="cbp-filter-counter"></div>
                                </div>
                                <div data-filter=".logos" class="cbp-filter-item btn dark btn-outline uppercase"> Logo
                                    <div class="cbp-filter-counter"></div>
                                </div> --}}
                            </div>
                            <div id="js-grid-juicy-projects" class="cbp">
                                @foreach ($jenis as $idx=>$v)
                                    @foreach ($pengajuan[$idx] as $item)
                                        @php
                                            $idjadwal=$jadwal[$item->id]->jadwal_id;
                                        @endphp
                                        <div class="cbp-item {{str_slug($v)}}" style="border:1px solid #666;padding:5px;">
                                            <div class="cbp-caption">
                                                <div class="cbp-caption-defaultWrap">
                                                    <div class="row" style="background:#fff">
                                                        <div class="col-md-12">
                                                            <img src="{{asset('img/buttonschedule.png')}}" alt="">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cbp-caption-activeWrap">
                                                    <div class="cbp-l-caption-alignCenter">
                                                        <div class="cbp-l-caption-body">
                                                            <a href="{{url('form-nilai-dosen/'.$idjadwal.'/'.$item->id)}}" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px !important;">Form Nilai</a>
                                                            <a href="{{url('daftar-perbaikan/'.$idjadwal.'/'.$item->id)}}" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;">Daftar Perbaikan</a>
                                                            <a href="{{url('penetapan-judul/'.$idjadwal.'/'.$item->id)}}" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;">Penetapan Judul</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">{{$item->mahasiswa->nama}}</div>
                                            <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">NPM : {{$item->mahasiswa->npm}}</div>
                                        </div>
                                    @endforeach
                                @endforeach
                                
                                
                            </div>
                            <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                                <a href="{{asset('assets/global/plugins/cubeportfolio/ajax/loadMore.html')}}" class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                                    <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                                    <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                                    <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                                </a>
                            </div>
                        </div>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script src="{{asset('assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/portfolio-1.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#loader').hide();
    });

    
</script>
@endsection
