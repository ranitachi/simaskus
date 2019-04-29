@extends('layouts.master')
@section('title')
    <title>Form Penilaian :: SIMA-sp</title>
    <link href="{{asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/pages/css/portfolio.min.css')}}" rel="stylesheet" type="text/css" />
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
                    <span>Penilaian</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Form
            <small>Penilaian</small>
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
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="row" style="padding:5px 20px;">
                        <div class="col-md-6">
                            &nbsp;
                        </div>
                        <div class="col-md-6">
                            <a href="{{url('data-jadwal/2')}}" id="" class="btn btn-sm sbold btn-success pull-right"><i class="fa fa-angle-double-left"></i> Kembali</a>
                        </div>
                    </div>
                    <h3 style="text-align:center">
                        PENILAIAN
                    </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#" class="horizontal-form" style="padding:20px;">
                                <div class="portlet-body">
                                    <div class="row" style="">
                                        <div class="col-md-2">Nama Mahasiswa</div>
                                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-md-2">NPM</div>
                                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-md-2">Jadwal Sidang</div>
                                        <div class="col-md-10">: 
                                            <b><i class="fa fa-calendar"></i> {{date('d/m/Y',strtotime($jadwal[0]->tanggal))}}</b>
                                            &nbsp;
                                            &nbsp;
                                            <span style="color:blue"><i class="fa fa-clock-o"></i> {{$jadwal[0]->waktu}}</span>
                                        </div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-md-2">Ruangan</div>
                                        <div class="col-md-10">: <b>{{$jadwal[0]->ruangan->nama_ruangan}}</b></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12" style="padding:20px 30px;">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Nama Dosen </th>
                                        <th> Kategori </th>
                                        <th> Form </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($dos as $key=>$it)
                                        @foreach ($it as $ky=>$item)

                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$item['nama']}}</td>
                                                <td>{{$item['kategori']}}</td>
                                                <td>
                                                @if ($item['kategori']=='pembimbing')
                                                    @if (isset($n['pembimbing'][$item['iddosen']]))
                                                        <a href="javascript:formnilai({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn blue uppercase btn blue uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Form Penilaian</a>    
                                                    @else
                                                        <a href="javascript:formnilai({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Form Penilaian</a>    
                                                    @endif
                                                    
                                                    <br>
                                                    @if (isset($perb[$idjadwal][$item['iddosen']]))
                                                        <a href="javascript:daftarperbaikan({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Daftar Perbaikan</a>
                                                    @else
                                                        <a href="javascript:daftarperbaikan({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Daftar Perbaikan</a>
                                                    @endif
                                                    <br>
                                                    @if (isset($penp[$idpengajuan]))
                                                        <a href="javascript:penetapanjudul({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;"><i class="fa fa-check"></i> Penetapan Judul</a>
                                                    @else
                                                        <a href="javascript:penetapanjudul({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;"><i class="fa fa-file-o"></i> Penetapan Judul</a>
                                                    @endif
                                                @else
                                                    @if (isset($n['penguji'][$item['iddosen']]))
                                                        <a href="javascript:formnilai({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn blue uppercase btn blue uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Form Penilaian</a>    
                                                    @else
                                                        <a href="javascript:formnilai({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Form Penilaian</a>    
                                                    @endif
                                                    <br>
                                                    @if (isset($perb[$idjadwal][$item['iddosen']]))
                                                        <a href="javascript:daftarperbaikan({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Daftar Perbaikan</a>
                                                    @else
                                                        <a href="javascript:daftarperbaikan({{$idjadwal}},{{$idpengajuan}},'{{$item['kategori'].'-'.$item['iddosen']}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Daftar Perbaikan</a>
                                                    @endif
                                                    <br>
                                                @endif    
                                                </td>
                                            </tr>    
                                        @php
                                            $no++;
                                        @endphp
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
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
    function formnilai(id,pengajuan_id,dosen_id)
    {
        $('.modal-title').text('Form Nilai');
        $('.modal-body').load('{{url("form-nilai-dosen-staf")}}/'+id+'/'+pengajuan_id+'/'+dosen_id);
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#simpan-nilai').submit();
        });
    }
    function daftarperbaikan(id,pengajuan_id,dosen_id)
    {
        $('.modal-title').text('Form Daftar Perbaikan');
        $('.modal-body').load('{{url("daftar-perbaikan-staf")}}/'+id+'/'+pengajuan_id+'/'+dosen_id,function(){
            var startDate = new Date();
            startDate.setDate(startDate.getDate(new Date()));
            
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            $('.date-picker').datepicker('setStartDate', startDate);
        });
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#daftar-perbaikan').submit();
        });
    }
    function penetapanjudul(id,pengajuan_id,dosen_id)
    {
        $('.modal-title').text('Form Penetapan Judul');
        $('.modal-body').load('{{url("penetapan-judul-staf")}}/'+id+'/'+pengajuan_id+'/'+dosen_id);
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
