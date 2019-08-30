@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
    <link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
@endsection

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
    
    <div class="row" style="margin-top:40px;">
        <h1 class="text-center" style="padding-bottom:30px;">Silahkan Pilih Bagian Terlebih Dahulu</h1>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            &nbsp;
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="{{url('penilaian-penguji-kp')}}">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number" style="padding-top:10px;">
                        <div class="desc">Sidang Kerja Praktek</div>
                        <span data-counter="counterup" data-value="{{$jadwalkp->count()}}">{{$jadwalkp->count()}}</span>
                    </div>
                    <div class="desc"> Jadwal </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="{{url('penilaian-penguji')}}">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number" style="padding-top:10px;">
                        <div class="desc">Sidang S1, S2, S3</div>
                        <span data-counter="counterup" data-value="{{$jadwal->count()}}">{{$jadwal->count()}}</span>
                    </div>
                    <div class="desc"> Jadwal </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            &nbsp;
    </div>
   
</div>
@endsection

@section('footscript')
<script>
    
</script>
<style>
.table th,.table td
{
    font-size:11px !important;
}
.table th
{
    text-align:center !important;
    background: #eee !important;
    vertical-align:middle !important;
}
</style>
@endsection