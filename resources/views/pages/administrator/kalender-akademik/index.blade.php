@extends('layouts.master')
@section('title')
    <title>Data Kalender Akademik :: SIMA-sp</title>
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
                    <span>Data Kalender Akademik</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Kalender Akademik
            <small>Daftar</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            {{-- <div class="row" id="loader">
                <div class="col-md-10 text-center" style="position:fixed;">
                    <center>
                        <img src="{{asset('img/loading-bl-blue.gif')}}">
                    </center>
                </div>
            </div> --}}
                <div class="row">

                    <div class="col-md-7">&nbsp;</div>
                    <div class="col-md-3">
                        <select class="bs-select form-control has-success" id="tahun_ajaran" name="tahun_ajaran" onchange="loaddata(this.value)">
                            <option value="-1">-Pilih Tahun Akademik-</option>
                            @foreach ($ta as $k => $v)
                                @if (strpos($v,date('Y'))!==false)
                                    @if (Session::get('idta') == $v->id)
                                        <option value="{{$v->id}}" selected="selected">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                    @else
                                        <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-2">
                        <div class="btn-group pull-right">
                            <a href="javascript:tambahdata()" id="sample_editable_1_new" class="btn sbold green"> Tambah Kalender
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            
            <div id="data">
                <div class="row">
                    <div class="col-md-12">
                        Pilih Tahun Akademik Terlebih Dahulu
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        //loaddata();

        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }

        var ta="{{Session::has('idta')}}";
        if(ta!="")
        {
            // alert(ta)
            var idta="{{Session::get('idta')}}";
            loaddata(idta)
        }
    });

    function tambahdata()
    {
        var ta=$('#tahun_ajaran').val();
        if(ta==-1)
        {
            pesan("Silahkan Pilih Tahun Akademik Terlebih Dahulu",'error');
        }
        else
        {
            location.href='{{url("kalender-akademik")}}/'+ta+'/-1';
        }
    }

    function loaddata(idta)
    {
        $('#loader').show();
        $('#data').load('{{url("kalender-akademik-data")}}/'+idta,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    
    function hapus(idta,id)
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
                    url : '{{url("kalender-akademik-hapus")}}/'+id,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata(idta);
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection