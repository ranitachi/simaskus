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
        $('#data').load('{{url("data-kp-data")}}',function(){
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

    function addanggota(code,id)
    {
        $.ajax({
            url : '{{url("data-kp-anggota")}}/'+code+'/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Tambah Anggota",
                    message: html,
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Batal'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Simpan'
                        }
                    },
                    callback: function (result) 
                    {
                        if(result)
                        {
                            if(id==-1)
                            {
                                var t_url = '{{url("data-kp-anggota-proses")}}/'+code+'/-1';
                            }
                            else
                                var t_url = '{{url("data-kp-anggota-proses")}}/'+code+'/'+id;
        
                            var t_method = 'POST';
                            
                            $.ajax({
                                    url : t_url,
                                    type : t_method,
                                    dataType: 'json',
                                    cache: false,
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: $('#form-departemen').serialize()
                                }).done(function(dt){
                                    loaddata();
                                    if(id==-1)
                                    {
                                        var ps="Tambah Anggota Kelompok` Berhasil";
                                    }
                                    else
                                    {
                                        var ps="Edit Anggota Kelompok` Berhasil";
                                    }
                                    swal("Berhasil", ps, "success");
                                }).fail(function(dt){ 
                                    var ps='Simpan Anggota Kelompok Gagal';
                                    pesan(ps,'error');
                                });
                            }

                        
                    }
                });   
            }
        })    
    }
    function hapusanggota(id)
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
                }).done(function(){
                    loaddata();
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection