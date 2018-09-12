@extends('layouts.master')
@section('title')
    <title>Data Mata Kuliah Khusus :: SIMASKUS</title>
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
                    <span>Data Mata Kuliah Khusus</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Mata Kuliah Khusus
            <small>Daftar</small>
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
            <div class="alert alert-danger" id="pesan-alert">
                <strong>Peringatan !</strong> <span id="alert-msg"></span>
            </div>
            <div id="data"></div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        loaddata();
        $('#pesan-alert').hide();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }

        var ps2 = "{{Session::has('gagal')}}";
        if(ps2!="")
        {
            // alert("{{Session::get('gagal')}}")
            // swal("Gagal", "{{Session::get('gagal')}}", "danger")
            $('#alert-msg').html("{{Session::get('gagal')}}");
            $('#pesan-alert').show();
        }
    });

    function loaddata()
    {
        $('#loader').show();
        $('#data').load('{{url("data-pengajuan-sidang-data/".$jenis)}}',function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function setujui(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Pengajuan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Verifikasi",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                // location.href='{{url("pengajuan-sidang-verifikasi")}}/'+id+'/'+jns;
                $.ajax({
                    url : '{{url("pengajuan-sidang-verifikasi")}}/'+id+'/'+jns,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Sukses!", "Verifikasi Pengajuan Sidang Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Verifiksi Pengajuan Sidang Gagal", "danger");
                });
            } 
        });
    }
    function setujuidokumen(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Dokumen Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Verifikasi",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("dokumen-verifikasi")}}/'+id+'/'+jns,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Sukses!", "Verifikasi Dokumen Sidang Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Verifiksi Dokumen Sidang Gagal", "danger");
                });
            } 
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
                    url : '{{url("pengajuan-hapus")}}/'+id,
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
    function generate(id)
    {
        $('#ajax-sm').modal('show');
        $('#ok-ajax-sm').one('click',function(){
            $('#form-generate-jadwal').submit();
        });
    }
    function tambahpenguji(idpengajuan)
    {
        // $('.modal-body').load('{{url("form-add-penguji")}}',function(){
        //     $('.select2').select2({ width: '100%' });
        // });
        $('#ajax-sm-dosen').modal('show');
        $('#ok-ajax-sm-dosen').one('click',function(){
            var iddos=$('#dosen_id').val();
            $.ajax({
                    url : '{{url("add-penguji")}}/'+idpengajuan,
                    dataType : 'JSON',
                    cache: false,
                    type : 'POST',
                    data : $('#form-add-penguji').serialize(),
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                }).done(function(){
                    $('#ajax-sm-dosen').modal('hide');
                    loaddata();
                    swal("Success!", "Tambah Data Penguji Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Tambah Data Penguji Gagal", "danger");
            });
        });
        // var iddos=$('#dosen_id').val();
        
    }
</script>
@endsection
<div class="modal fade" id="ajax-sm" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('generate-jadwal/'.$dept_id) }}" class="horizontal-form" id="form-generate-jadwal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-success">
                                    <label class="control-label">Tahun Ajaran</label>
                                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Tahun Ajaran" id="tahunajaran_id" name="tahunajaran_id">
                                        <option value="-1">-Pilih Tahun Ajaran-</option>
                                        @foreach ($ta as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok-ajax-sm">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-sm-dosen" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('add-penguji/'.$dept_id) }}" class="horizontal-form" id="form-add-penguji" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-success">
                                    <label class="control-label">Nama Penguji</label>
                                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Penguji" id="dosen_id" name="dosen_id">
                                        <option value="-1">-Pilih Penguji-</option>
                                        @foreach ($dosen as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok-ajax-sm-dosen">OK</button>
            </div>
        </div>
    </div>
</div>