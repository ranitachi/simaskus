@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
@endsection

@section('konten')
    {{-- @include('home') --}}
<div class="page-content">                        
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('beranda')}}">Beranda</a>
                <i class="fa fa-circle"></i>
                <a href="#">Rekapitulasi Jumlah Bimbingan</a>
            </li>
           
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Spesial</h1>
    <div class="row">
         <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tools pull-right"> 
                                <select class="bs-select has-success" data-placeholder="Bulan" id="bulan" name="bulan" onchange="getdata()">
                                    @for($x=1;$x<=12;$x++)
                                        @if ($bulan==$x)
                                            <option value="{{$x}}" selected="selected">{{getBulan($x)}}</option>
                                        @else
                                            <option value="{{$x}}">{{getBulan($x)}}</option>
                                        @endif
                                    @endfor
                                </select>
                                <select class="bs-select has-success" data-placeholder="Tahun" id="tahun" name="tahun" onchange="getdata()">
                                    @for($x=date('Y');$x>=(date('Y')-5);$x--)
                                        @if ($tahun==$x)
                                            <option value="{{$x}}" selected="selected">{{($x)}}</option>
                                        @else
                                            <option value="{{$x}}">{{($x)}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <h3>List Data Bimbingan</h3>
                            <hr>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Tahun Akademik </th>
                                        <th> Jenis Bimbingan </th>
                                        <th> Nama Mahasiswa </th>
                                        <th> Tombol Aksi </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <h3>Jumlah Data Bimbingan</h3>
                            <hr>
                            <div style="background: #eee;">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="details text-center">
                                        <div class="desc" style="padding-top:20px;">Jumlah Bimbingan</div>
                                        <div class="number text-center" style="font-size:23px;padding-top:0px;">S3 : 10x</div>
                                    </div>
                                </a>
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="details text-center">
                                        <div class="desc" style="padding-top:20px;">Jumlah Bimbingan</div>
                                        <div class="number text-center" style="font-size:23px;padding-top:0px;">S2 : 10x</div>
                                    </div>
                                </a>
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="details text-center">
                                        <div class="desc" style="padding-top:20px;">Jumlah Bimbingan</div>
                                        <div class="number text-center" style="font-size:23px;padding-top:0px;">S1 : 10x</div>
                                    </div>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#sample_4').DataTable();
    });

    function getdata()
    {
        var thn=$('#tahun').val();
        var bln=$('#bulan').val();
        location.href='{{url("/")}}/rekap-pembimbing/'+bln+'/'+thn;
    }
</script>
@endsection