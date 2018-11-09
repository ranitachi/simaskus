@extends('layouts.master')
@section('title')
    <title>Data Izin Dosen :: SIMA-sp</title>
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
                    <span>Izin Dosen</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Izin Dosen
            <small>Data</small>
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
        $('#loader').hide();
        loaddata();
        
    });
    function loaddata()
    {
        $('#loader').show();
        $('#data').load('{{url("izin-dosen-data")}}',function(){
            $('#loader').hide();
            $('#sample_4').DataTable();
        });
    }
    function loadform(id)
    {
         $.ajax({
            url : '{{url("izin-dosen")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Izin Dosen",
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
                                var t_url = '{{url("izin-dosen")}}';
                            }
                            else
                                var t_url = '{{url("izin-dosen")}}/'+id;
        
                            var t_method = 'POST';
                            var start_date=$('#start_date').val();
                            var end_date=$('#end_date').val();
                            var start_time=$('#start_time').val();
                            var end_time=$('#end_time').val();
                            var keperluan=$('#keperluan').val();
                            if(start_date=='')
                            {
                                pesan("Tanggal Awal harus dipilih",'error');
                                $('#start_date').focus();
                                return false;
                            }
                            else if(end_date=='')
                            {
                                pesan("Tanggal Selesai harus dipilih",'error');
                                $('#end_date').focus();
                                return false;
                            }
                            else if(start_time=='')
                            {
                                pesan("Waktu Awal harus dipilih",'error');
                                $('#start_time').focus();
                                return false;
                            }
                            else if(end_time=='')
                            {
                                pesan("Waktu Selesai harus dipilih",'error');
                                $('#end_time').focus();
                                return false;
                            }
                            else if(keterangan=='')
                            {
                                pesan("Keterangan harus Dipilih",'error');
                                $('#keterangan').focus();
                                return false;
                            }
                            else
                            {
                                $.ajax({
                                    url : t_url,
                                    type : t_method,
                                    dataType: 'json',
                                    cache: false,
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: $('#form-izin').serialize()
                                }).done(function(dt){
                                    loaddata();
                                    if(id==-1)
                                    {
                                        var ps="Data Izin Berhasil Disimpan";
                                    }
                                    else
                                    {
                                        var ps="Data Izin Berhasil Di Edit";
                                    }
                                    swal("Berhasil", ps, "success");
                                }).fail(function(dt){ 
                                    var ps='Data Izin Gagal Disimpan';
                                    pesan(ps,'error');
                                });
                            }

                        }
                    
                    }
                });   
            }
        })    
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
                    url : '{{url("izin-dosen-hapus")}}/'+id,
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
