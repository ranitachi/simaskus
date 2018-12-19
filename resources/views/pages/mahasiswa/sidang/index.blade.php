@extends('layouts.master')
@section('title')
    <title>Data Mata Kuliah Khusus :: SIMA-sp</title>
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
            <div id="data"></div>
            
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
        $('#data').load('{{url("daftar-sidang-data")}}',function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
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
    function tambahpenguji(idpengajuan,idmahasiswa)
    {
        // $('.modal-body').load('{{url("form-add-penguji")}}',function(){
        //     $('.select2').select2({ width: '100%' });
        // });
        $('#mahasiswa_id').val(idmahasiswa);
        $('#ajax-sm').modal('show');
        $('#ok-ajax-sm').one('click',function(){
            var iddos=$('#dosen_id').val();
            $.ajax({
                    url : '{{url("add-penguji")}}/'+idpengajuan,
                    dataType : 'JSON',
                    cache: false,
                    type : 'POST',
                    data : $('#form-add-penguji').serialize(),
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                }).done(function(){
                    $('#ajax-sm').modal('hide');
                    loaddata();
                    swal("Success!", "Tambah Data Penguji Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Tambah Data Penguji Gagal", "danger");
            });
        });
        // var iddos=$('#dosen_id').val();
        
    }
    function belumbisadaftar()
    {
        swal({
            title: "Peringatan",
            text: "Anda Belum Menyelesaikan Minimal Bimbingan atau \nBimbingan Anda Belum DI Setujui Pembimbing",
            type: "warning",
            showCancelButton: false,
            confirmButtonClass: "btn-info",
            confirmButtonText: "OK",
            closeOnConfirm: true
        },
        function(isConfirm) {
            
        });
    }
</script>

<div class="modal fade" id="ajax-sm" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="#" class="horizontal-form" id="form-add-penguji" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">
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
                <button type="button" class="btn green" id="ok-ajax-sm">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection