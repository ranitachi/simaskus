@extends('layouts.master')
@section('title')
    <title>Pimpinan Departemen :: SIMA-sp</title>
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
                    <span>Pimpinan Departemen</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Data
            <small>Pimpinan Departemen</small>
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
        $('#data').load('{{url("pimpinan-departemen-data")}}',function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function loadform(id)
    {
        $.ajax({
            url : '{{url("pimpinan-departemen")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Pimpinan",
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
                                var t_url = '{{url("pimpinan-departemen")}}';
                            }
                            else
                                var t_url = '{{url("pimpinan-departemen")}}/'+id;
        
                            var t_method = 'POST';
                            var dosen_id=$('#dosen_id').val();
                            var nama_departemen=$('#nama_departemen').val();
                            if(dosen_id=='')
                            {
                                pesan("Nama Dosen harus Di pilih",'error');
                                $('#dosen_id').focus();
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
                                    data: $('#form-departemen').serialize()
                                }).done(function(dt){
                                    loaddata();
                                    if(id==-1)
                                    {
                                        var ps="Pimpinan Departemen Berhasil Disimpan";
                                    }
                                    else
                                    {
                                        var ps="Pimpinan Departemen Berhasil Di Edit";
                                    }
                                    swal("Berhasil", ps, "success");
                                }).fail(function(dt){ 
                                    var ps='Pimpinan Departemen Gagal Disimpan';
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
                    url : '{{url("pimpinan-departemen-hapus")}}/'+id,
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
    function dosenbaru(val)
    {
        if(val==0)
        {
            location.href="{{url('dosen-admin/-1')}}";
        }
    }
</script>
@endsection