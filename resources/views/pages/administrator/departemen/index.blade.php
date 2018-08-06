@extends('layouts.master')
@section('title')
    <title>Data Departemen :: SIMASKUS</title>
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
                    <span>Data Departemen</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Departemen
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
        $('#data').load('{{url("departemen-admin-data")}}',function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function pilihdepartemen(val)
    {
        if(val==0)
            location.href='{{url("dosen-admin/-1")}}';
    }
    function loadform(id)
    {
        $.ajax({
            url : '{{url("departemen-admin")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Departemen",
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
                                var t_url = '{{url("departemen-admin")}}';
                            }
                            else
                                var t_url = '{{url("departemen-admin")}}/'+id;
        
                            var t_method = 'POST';
                            var code=$('#code').val();
                            var nama_departemen=$('#nama_departemen').val();
                            if(code=='')
                            {
                                pesan("Kode Departemen harus dipilih",'error');
                                $('#code').focus();
                                return false;
                            }
                            else if(nama_departemen=='')
                            {
                                pesan("Departemen harus dipilih",'error');
                                $('#nama_departemen').focus();
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
                                        var ps="Data Departemen Berhasil Disimpan";
                                    }
                                    else
                                    {
                                        var ps="Data Departemen Berhasil Di Edit";
                                    }
                                    swal("Berhasil", ps, "success");
                                }).fail(function(dt){ 
                                    var ps='Data Departemen Gagal Disimpan';
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
                    url : '{{url("departemen-admin-hapus")}}/'+id,
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