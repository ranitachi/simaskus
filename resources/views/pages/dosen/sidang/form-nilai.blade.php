@extends('layouts.master')
@section('title')
    <title>Ujian Sidang Mata Kuliah Spesial :: SIMA-sp</title>
@endsection

@section('konten')
        <div class="page-content">
       
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('beranda')}}">Beranda</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Ujian Sidang Mata Kuliah Spesial</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Mata Kuliah Spesial
            <small>Form Nilai</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <form action="#" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                {{ csrf_field() }}
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">Nama Mahasiswa</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">NPM</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Judul Indonesia</div>
                        <div class="col-md-10">: <b>{{$pengajuan->judul_ind}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Judul Inggris</div>
                        <div class="col-md-10">: <b>{{$pengajuan->judul_eng}}</b></div>
                    </div>
                    <br>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                        <thead>
                            <tr>
                                <th class="text-center"> Jenis Penilaian</th>
                                <th class="text-center"> #</th>
                                <th class="text-center"> %</th>
                                <th class="text-center"> #</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian as $k => $v)
                                <tr>
                                    <th class="text-left" style="text-align:left !important;padding-left:20px;">{{$v->nama_component}}</th>
                                    <th class="text-center" style="width:20%"> <input type="text" id="judul" name="nilai_angka" class="form-control input-circle" placeholder="" value=""></th>
                                    <th class="text-center" style="width:100px;">x {{$v->bobot_penguji}} %</th>
                                    <th class="text-center"style="width:20%"> <input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                                </tr>
                            @endforeach
                            <tr>
                                <th style="text-align:right;">T O T A L</th>
                                <th style="text-align:right;"><input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                                <th style="text-align:right;">%</th>
                                <th style="text-align:right;"><input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <div class="form-actions right">
                            <a href="{{URL::previous()}}" class="btn default">Kembali</a>
                            <button type="button" id="simpan" class="btn blue">
                                <i class="fa fa-check"></i> Simpan</button>
                        </div>
                    </center>
                </div>
            </form>
            </div>
            <table class="table table-striped" style="width:30%">
                <tr>
                    <th>Batasan Nilai</th>
                    <th>Huruf</th>
                    <th>Angka</th>
                </tr>
            @php
                $batasan=array('A'=>'85-100','A-'=>'80-84','B+'=>'75-79','B'=>'70-74','B-'=>'65-69','C+'=>'60-64','C'=>'55-59','C-'=>'50-54','D'=>'40-49','E'=>'00-39');
            @endphp
                @foreach ($batasan as $idx => $val)
                    <tr>
                        <td></td>
                        <td class="">{{$idx}}</td>
                        <td class="">{{$val}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
    });
</script>