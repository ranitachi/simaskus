@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Kerja Praktek :: SIMA-sp</title>
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
                    <span>Data Pengajuan Kerja Praktek</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan Kerja Praktek
            <small>Data Pengajuan</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#home">Belum Diverifikasi</a></li>
                <li><a data-toggle="tab" href="#menu1">Telah Di Verifikasi</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="row" id="loader_belum">
                        <div class="col-md-10 text-center" style="position:fixed;">
                            <center>
                                <img src="{{asset('img/loading-bl-blue.gif')}}">
                            </center>
                        </div>
                    </div>
                    <div id="data_belum"></div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="row" id="loader_sudah">
                        <div class="col-md-10 text-center" style="position:fixed;">
                            <center>
                                <img src="{{asset('img/loading-bl-blue.gif')}}">
                            </center>
                        </div>
                    </div>
                    <div id="data_sudah"></div>
                </div>
            </div>
            
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        loaddata();

        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function loaddata()
    {
        $('#loader').show();
        $('#data_belum').load('{{url("data-kp-data")}}/0',function(){
            $('#sample_0').dataTable();
            $('#loader_belum').hide();
        });
        $('#data_sudah').load('{{url("data-kp-data")}}/1',function(){
            $('#sample_1').dataTable();
            $('#loader_sudah').hide();
        });
    }
    function hapus(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menghapus Data Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("data-kp-hapus")}}/'+id,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }
    function verifikasi(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Memverifikasi Data Kerja Praktek Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Setuju",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("data-kp-verifikasi")}}/'+id+'/1',
                    dataType : 'JSON'
                }).done(function(){
                    //loaddata();
                    swal("Success!", "Data Berhasil Di Verifikasi", "success");
                    loaddata();
                // location.href='{{url("data-kp-detail")}}/'+id+'/{{Auth::user()->kat_user}}';
                }).fail(function(){
                    swal("Fail!", "Verifikasi Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection