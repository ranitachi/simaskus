@extends('layouts.master')
@section('title')
    <title>Detail Pengauan :: SIMASKUS</title>
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
                    <span>Detail Pengajuan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Data Pengajuan
            <small>Detail</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <a href="{{url('data-pengajuan')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
           <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">

            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        //loaddata();
        $('#sample_4').DataTable();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

</script>
@endsection
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>