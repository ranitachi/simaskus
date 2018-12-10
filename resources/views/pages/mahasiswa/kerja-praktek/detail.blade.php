@extends('layouts.master')
@section('title')
    <title>{{$det->status_pengajuan==0 ? 'Verifikasi Kerja Praktek' :'Detail Kerja Praktek'}} :: SIMA-sp</title>
    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="{{url('data-kp')}}">Pengajuan</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Pengajuan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan 
            <small>{{$det->status_pengajuan==0 ? 'Verifikasi Kerja Praktek' :'Detail Kerja Praktek'}}</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true"> Detail </a>
                </li>
                <li>
                    <a href="#tab_1_1_5" data-toggle="tab"> Anggota Kelompok </a>
                </li>
                <li class="">
                    <a href="#tab_1_1_2" data-toggle="tab" aria-expanded="false"> Informasi </a>
                </li>
                <li>
                    <a href="#tab_1_1_3" data-toggle="tab"> Berkas </a>
                </li>
                <li>
                    <a href="#tab_1_1_4" data-toggle="tab"> Penetapan Pembimbing </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1_1">
                    @php
                    $path='';
                    @endphp
                
                    <div class="portlet light portlet-fit portlet-datatable ">
                        <div class="row" style="padding:5px 20px;">

                            <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <a href="{{url('data-kp')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                    
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="alert alert-info" id="pesan-alert">
                                    <strong>Info!</strong> <span id="alert-msg"></span>
                                </div>
                                <!-- BEGIN FORM-->
                                <form action="{{$id==-1 ? url('data-kp-proses/-1') : url('data-kp-proses/'.$id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @if ($id!=-1)
                                        {{ method_field('PATCH') }}
                                    @endif
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Tahun Ajaran</label>
                                                    <select class="bs-select form-control has-success" disabled data-placeholder="Pilih Tahun Ajaran" id="tahun_ajaran" name="tahun_ajaran">
                                                        <option value="-1">-Pilih Tahun Ajaran-</option>
                                                        @foreach ($ta as $i => $v)
                                                            @if ($id!=-1)
                                                                @if ($det->tahunajaran_id==$v->id)
                                                                    <option value="{{$v->id}}" selected="selected">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>    
                                                                @else
                                                                    <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                                @endif
                                                            @else
                                                                <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jenis Pengajuan</label>
                                                    <select disabled class="bs-select form-control has-success" data-placeholder="Pilih Jenis" id="jenis_id" name="jenis_id">
                                                        <option value="-1">-Pilih Jenis-</option>
                                                        @foreach ($jenispengajuan as $i => $v)
                                                            @if (strpos(strtolower($v->jenis),'kerja praktek')!==false) 
                                                                @if ($id!=-1)
                                                                    @if ($det->jenis_id==$v->id)
                                                                        <option value="{{$v->id}}" selected="selected">{{$v->jenis}}</option>    
                                                                    @else
                                                                        <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                                    @endif
                                                                @else
                                                                    <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @if ($det->status_pengajuan==1)
                                            <div class="col-md-4">&nbsp;</div>
                                            <div class="col-md-4">
                                                    <div class="pull-right text-center">
                                                        <h4>Status Pengajuan</h4>
                                                        <div class="alert alert-info" style="font-size:20px;">
                                                            <i class="fa fa-check"></i><strong>Di Terima</strong>
                                                        </div>
                                                    </div>
                                            </div>
                                        @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            
                                        
                                        <div class="col-md-6"> 
                                                
                                        </div>
                                    </div>

                                    @if ($id!=-1)    
                                        <div class="row" style="margin-bottom:30px;">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                        <label class="control-label">Daftar Bimbingan dari SIAK-NG
                                                        </label>
                                                </div>        
                                                {{-- {{ storage_path('app/'.$det->file_riwayat_akademis) }} --}}
                                                @php
                                                    $path=asset('../storage/app/'.$det->file_riwayat_akademis);
                                                @endphp
                                                <div id="example1"></div>
                                            
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-actions pull-right">
                                        <a href="{{url('data-kp')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                    
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1_1_5">
                    @include('pages.mahasiswa.kerja-praktek.anggota')
                </div>
                <div class="tab-pane" id="tab_1_1_2">
                    @include('pages.mahasiswa.kerja-praktek.informasi')
                </div>
                <div class="tab-pane" id="tab_1_1_3">
                    @include('pages.mahasiswa.kerja-praktek.berkas')
                </div>
                <div class="tab-pane" id="tab_1_1_4">
                    @include('pages.mahasiswa.kerja-praktek.pembimbing')
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
@section('footscript')
    
<script src="{{asset('js/pdfobject.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>PDFObject.embed("{{asset($path)}}", "#example1");</script>
<script>

    $(document).ready(function(){
        $('#pesan-alert').hide();
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id);
        });

        $('.wysihtml5').wysihtml5({
                "stylesheets": ["{{asset('assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css')}}"]
        });

        $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
    });

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
                    //swal("Success!", "Data Berhasil Di Verifikasi", "success");
                    location.href='{{url("data-kp-detail")}}/'+id+'/{{Auth::user()->kat_user}}';
                }).fail(function(){
                    swal("Fail!", "Verifikasi Data Gagal", "danger");
                });
            } 
        });
    }
    function hapusverifikasi(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menghapus Verifikasi Data Kerja Praktek Ini ?",
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
                    url : '{{url("data-kp-verifikasi")}}/'+id+'/0',
                    dataType : 'JSON'
                }).done(function(){
                    //loaddata();
                    //swal("Success!", "Data Berhasil Di Verifikasi", "success");
                    location.href='{{url("data-kp-detail")}}/'+id+'/{{Auth::user()->kat_user}}';
                }).fail(function(){
                    swal("Fail!", "Verifikasi Data Gagal", "danger");
                });
            } 
        });
    }

    function addfields()
    {
        // alert('dd');
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $("#title_wrap"); //Fields wrapper
        
        var x = 1; //initlal text box count
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="form-group form-md-line-input has-success" id="">\
                    <label class="col-md-4 control-label" for="form_control_1">Judul Informasi</label>\
                    <div class="col-md-7">\
                        <input type="text" class="form-control" id="form_control_1" name="title_tambahan[]" placeholder="Judul">\
                    </div><div class="col-md-1">&nbsp;</div>\
                    <label class="col-md-4 control-label" for="form_control_1">Isi Informasi</label>\
                    <div class="col-md-7">\
                        <textarea class="form-control" id="form_control_1" name="isi_tambahan[]" placeholder="Isi"></textarea>\
                    </div><div class="col-md-1">&nbsp;</div>\
                    <a href="#" class="remove_field"><i class="fa fa-remove font-red"></i></a>\
                </div><hr class="col-md-12">'); 
            }
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    }

    function simpaninfo(idgrup)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Yang Di Input Sudah Sesuai ?",
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
                $('#informasi-simpan').submit();
            } 
        });
    }
    function simpanpembimbing(idgrup)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Pembimbing Yang Di Input Sudah Sesuai ?",
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
                $('#pembimbing-simpan').submit();
            } 
        });
    }
    function simpankelompok(idgrup)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Anggota Kelmopok Yang Di Input Sudah Sesuai ?",
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
                $('#kelompok-simpan').submit();
            } 
        });
    }
    function hapusanggota(id,url)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menghapus Data Anggota Ini ?",
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
                    url : '{{url("data-kp-hapus-anggota")}}/'+id,
                    dataType : 'JSON'
                });

                location.href='{{url("data-kp-detail")}}/{{$id}}/{{$kat_user}}';
            } 
        });
    }
    function hapuspembimbing(id,url)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menghapus Data Anggota Ini ?",
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
                // $.ajax({
                //     url : '{{url("data-kp-hapus-anggota")}}/'+id,
                //     dataType : 'JSON'
                // });

                location.href='{{url("data-kp-hapus-pembimbing")}}/{{$id}}/{{$kat_user}}/'+id;
            } 
        });
    }
    function uploadbalasan(idgrup)
    {
        $('#modal_upload_balasan').modal('show');
        $('#simpan-balasan').one('click',function(){
            $('#form-balasan').submit();
        });
    }
    function uploadselesai(idgrup)
    {
        $('#modal_upload_selesai').modal('show');
        $('#simpan-selesai').one('click',function(){
            $('#form-selesai').submit();
        });
    }
    
</script>
@endsection