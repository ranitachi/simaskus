@extends('layouts.master')
@section('title')
    <title>Data Jadwal :: SIMA-sp</title>
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
                 <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th> Tanggal Sidang/Seminar<br>Waktu</th>
                            <th> Jenis</th>
                            <th> Pembimbing</th>
                            <th> NPM</th>
                            <th> Nama Mahasiswa </th>
                            <th> Ruangan </th>
                            <th> Form Penilaian </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @php
                        $no=1;
                        // echo '<pre>';
                        // dd($pengajuan);
                        // echo '</pre>';
                    @endphp
                    @foreach ($jadwal as $d=>$v)
                        @if (isset($pengajuan[$v->judul_id]))
                            @if (isset($bimb[Auth::user()->id_user][$pengajuan[$v->judul_id]->mahasiswa_id]))
                                @if ($v->ruangan_id!=0)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td class="text-left">
                                            <i class="fa fa-calendar"></i> {{date('d/m/Y', strtotime($v->tanggal))}}<br>
                                            <i class="fa fa-clock-o"></i> {{$v->waktu}}
                                        </td>
                                        <td>{{str_replace('Pembimbing','Sidang', $pengajuan[$v->judul_id]->jenispengajuan->jenis )}}</td>
                                        <td>
                                            @php
                                                foreach($piv[$pengajuan[$v->judul_id]->mahasiswa_id] as $kd=>$vd)
                                                {
                                                    echo '<i class="fa fa-user"></i> <b>'.$vd->dosen->nama.'</b><br>';
                                                }
                                            @endphp
                                        </td>
                                        <td>{{$pengajuan[$v->judul_id]->mahasiswa->npm}}</td>
                                        <td>{{$pengajuan[$v->judul_id]->mahasiswa->nama}}</td>
                                        <td> 
                                        @if (isset($ruangan[$v->ruangan_id]))
                                            Code : {{$ruangan[$v->ruangan_id]->code_ruangan}}<br>
                                            Nama : {{$ruangan[$v->ruangan_id]->nama_ruangan}}<br>
                                            Gedung : {{$ruangan[$v->ruangan_id]->lokasi}}
                                        @endif    
                                        </td>
                                        <td>
                                            @if (isset($n[$v->id]))
                                                <a href="javascript:formnilai({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn blue uppercase btn blue uppercase btn-xs" rel="nofollow" style="padding:0px !important;border-bottom:1px solid #aaa;">
                                                    <i class="fa fa-check"></i> Form Nilai</a>
                                            @else
                                                <a href="javascript:formnilai({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px !important;border-bottom:1px solid #aaa;">
                                                    <i class="fa fa-file-o"></i> Form Nilai</a>

                                            @endif
                                            <br>
                                            @if (isset($perbaikan[$v->id]))
                                                <a href="javascript:daftarperbaikan({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Daftar Perbaikan</a>
                                            @else
                                                <a href="javascript:daftarperbaikan({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Daftar Perbaikan</a>
                                            @endif
                                            <br> 
                                            @if (isset($penetapan[$pengajuan[$v->judul_id]->id]))
                                                <a href="javascript:penetapanjudul({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;"><i class="fa fa-check"></i> Penetapan Judul</a>
                                            @else
                                                <a href="javascript:penetapanjudul({{$v->id}},{{$v->judul_id}})" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;"><i class="fa fa-file-o"></i> Penetapan Judul</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endif
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                 </table>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script src="{{asset('assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/portfolio-1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#loader').hide();
        $('#sample_4').dataTable();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });
    function formnilai(id,pengajuan_id)
    {
        $('.modal-title').text('Form Nilai');
        $('.modal-body').load('{{url("form-nilai-dosen")}}/'+id+'/'+pengajuan_id);
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#simpan-nilai').submit();
        });
    }
    function daftarperbaikan(id,pengajuan_id)
    {
        $('.modal-title').text('Form Daftar Perbaikan');
        $('.modal-body').load('{{url("daftar-perbaikan")}}/'+id+'/'+pengajuan_id,function(){
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
        });
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#daftar-perbaikan').submit();
        });
    }
    function penetapanjudul(id,pengajuan_id)
    {
        $('.modal-title').text('Form Penetapan Judul');
        $('.modal-body').load('{{url("penetapan-judul")}}/'+id+'/'+pengajuan_id);
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#penetapan-judul').submit();
        });
    }
</script>
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>
<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img src="{{asset('assets/global/img/loading-spinner-grey.gif')}}" alt="" class="loading">
                <span> &nbsp;&nbsp;Loading... </span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection
