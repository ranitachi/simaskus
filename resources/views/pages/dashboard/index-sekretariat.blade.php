@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
@endsection
<link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
@section('konten')
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
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Spesial
    </h1>
    <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                                                            </div>
                                                                            <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1349">0</span>
                                        </div>
                                        <div class="desc"> New Feedbacks </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                                    <div class="desc"> Total Profit </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">0</span>
                                        </div>
                                        <div class="desc"> New Orders </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                    <div class="visual">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number"> +
                                            <span data-counter="counterup" data-value="89"></span>% </div>
                                        <div class="desc"> Brand Popularity </div>
                                    </div>
                                </a>
                            </div>
                        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-hide hide"></i>
                        <span class="caption-subject font-hide bold uppercase">To Do List</span>
                    </div>
                    <div class="actions">
                        <div class="portlet-input input-inline">
                            <div class="input-icon right">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body" id="">
                    <div class="todo-tasklist">
                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                            <a href="{{url('kalender-akademik')}}">
                                <div class="todo-tasklist-item-title"> Input Kalender Akademik </div>
                                <div class="todo-tasklist-item-text"> Silahkan Input Jadwal Kalender Akademik </div>
                                <div class="todo-tasklist-controls pull-left">
                                    <span class="todo-tasklist-badge badge badge-roundless">Urgent</span>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    
</script>
@endsection