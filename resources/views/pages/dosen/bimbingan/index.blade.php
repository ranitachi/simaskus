@extends('layouts.master')
@section('title')
    <title> Data Pengajuan Bimbingan :: SIMA-sp</title>
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
                    <span>Pengajuan Bimbingan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Data
            <small>Pengajuan Bimbingan</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    
                    <div class="portlet-body">
                        {{-- <div class="row" style="margin-bottom:10px;">
                            <div class="col-md-7"></div>
                            <div class="col-md-2">
                                Jenis Bimbingan : 
                            </div>
                            <div class="col-md-3">
                                <select class="bs-select"></select>
                            </div>
                        </div> --}}
                        <div id="data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
        loaddata();
        
    });
    function loaddata()
    {
        $('#data').load('{{url("pengajuan-data-dosen/".$jenis)}}',function(){
            $('#sample_4').DataTable();
        });
    }
    function setujui(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menyetujui Pengajuan Bimbingan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Setujui",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("pengajuan-bimbingan-status")}}/'+id+'/1',
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Sukses!", "Data Pengajuan Bimbingan Di Setujui", "success");
                }).fail(function(){
                    swal("Fail!", "Pengajuan Bimbingan Ditolak", "danger");
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
    function setujusidang(id_pengajuan,id_mahasiswa)
    {
         location.href='{{url("bimbingan-detail")}}/'+id_pengajuan+'/'+id_mahasiswa+'#tab_5_3';
        // swal({
        //     title: "Apakah Anda Yakin",
        //     text: "Ingin Menyetujui Pengajuan Sidang Mahasiswa Ini ?",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonClass: "btn-info",
        //     confirmButtonText: "Ya, Setujui",
        //     cancelButtonText: "Tidak",
        //     closeOnConfirm: true,
        //     closeOnCancel: true
        // },
        // function(isConfirm) {
        //     if (isConfirm) {
        //         $.ajax({
        //             url : '{{url("pengajuan-sidang-status")}}/'+id_pengajuan+'/'+id_mahasiswa,
        //             dataType : 'JSON'
        //         }).done(function(){
        //             loaddata();
        //             swal("Sukses!", "Data Pengajuan Sidang Di Setujui", "success");
        //         }).fail(function(){
        //             swal("Fail!", "Pengajuan Sidang Ditolak", "danger");
        //         });
        //     } 
        // });
    }
    function tolak(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menolaj Pengajuan Bimbingan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("pengajuan-bimbingan-status")}}/'+id+'/2',
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Di Tolak!", "Data Pengajuan Bimbingan DI Setujui", "danger");
                });
            } 
        });
    }

    function usulpenguji(idpengajuan,mahasiswa_id)
    {
        // $('.modal-body').load('{{url("form-add-penguji")}}',function(){
        //     $('.select2').select2({ width: '100%' });
        // });
        $('#mahasiswa_id_modal').val(mahasiswa_id);
        $('#pengajuan_id_modal').val(idpengajuan);
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
                                    <input type="hidden" name="mahasiswa_id" id="mahasiswa_id_modal">
                                    <input type="hidden" name="pengajuan_id" id="pengajuan_id_modal">
                                    <label class="control-label">Nama Penguji</label>
                                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Penguji" id="dosen_id" name="dosen_id">
                                        <option value="-1">-Pilih Penguji-</option>
                                        @if (isset($dosen))    
                                            @foreach ($dosen as $k=>$v)
                                                <option value="{{$v->id}}">{{$v->nama}}</option>
                                            @endforeach
                                        @endif

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
@endsection