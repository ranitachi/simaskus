@extends('layouts.master')
@section('title')
    <title>Data Mata Kuliah Spesial :: SIMA-sp</title>
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
                    <span>Data Mata Kuliah Spesial</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Mata Kuliah Spesial
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
        var dept_id='{{$dept_id}}';

        $('#loader').show();
        $('#data').load('{{url("master-jenispengajuan-data")}}/'+dept_id,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function loadform(id)
    {
        $.ajax({
            url : '{{url("master-jenispengajuan")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Mata Kuliah Spesial",
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
                                var t_url = '{{url("master-jenispengajuan")}}';
                            }
                            else
                                var t_url = '{{url("master-jenispengajuan")}}/'+id;
        
                            var t_method = 'POST';
                            var code=$('#code').val();
                            var nama_departemen=$('#nama_departemen').val();
                            if(code=='')
                            {
                                pesan("Kode Jenis harus diisi",'error');
                                $('#code').focus();
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
                                    if(dt.status==0)
                                    {
                                        var ps=dt.pesan;
                                        pesan(ps,'error');
                                    }
                                    else
                                    {
                                        if(id==-1)
                                        {
                                            var ps="Data Mata Kuliah Spesial Berhasil Disimpan";
                                        }
                                        else
                                        {
                                            var ps="Data Mata Kuliah Spesial Berhasil Di Edit";
                                        }
                                        swal("Berhasil", ps, "success");
                                    }
                                    
                                }).fail(function(dt){ 
                                    var ps='Data Mata Kuliah Spesial Gagal Disimpan';
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
                    url : '{{url("master-jenispengajuan-hapus")}}/'+id,
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