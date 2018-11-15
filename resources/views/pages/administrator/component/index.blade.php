@extends('layouts.master')
@section('title')
    <title>Komponen Penilaian :: SIMA-sp</title>
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
                    <span>Komponen Penilaian</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Komponen
            <small>Penilaian</small>
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
             <div class="row">

                    <div class="col-md-9">&nbsp;</div>
                    <div class="col-md-3">
                        <select class="bs-select form-control has-success" id="jenis" name="jenis" onchange="loaddata(this.value)">
                            <option value="-1">-Semua Jenis-</option>
                            @foreach ($jenis as $k => $v)
                                    <option value="{{$v->id}}">{{$v->jenis}}</option>
                            @endforeach
                        </select>

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
        loaddata(-1);

        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function loaddata(id)
    {
        

        $('#loader').show();
        $('#data').load('{{url("komponen-penilaian-data")}}/'+id,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function loadform(id)
    {
        $.ajax({
            url : '{{url("komponen-penilaian")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Module Penilaian",
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
                                var t_url = '{{url("komponen-penilaian")}}';
                            }
                            else
                                var t_url = '{{url("komponen-penilaian")}}/'+id;
        
                            var t_method = 'POST';
                            var code=$('#code').val();
                            var jenjang=$('#jenjang').val();
                            if(jenjang=='')
                            {
                                pesan("Komponen Penilaian harus diisi",'error');
                                $('#jenjang').focus();
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
                                    data: $('#form-module').serialize()
                                }).done(function(dt){
                                    var idjenis=$('#jenis').val();
                                    loaddata(idjenis);
                                    if(id==-1)
                                    {
                                        var ps="Data Komponen Penilaian Berhasil Disimpan";
                                    }
                                    else
                                    {
                                        var ps="Data Komponen Penilaian Berhasil Di Edit";
                                    }
                                    swal("Berhasil", ps, "success");

                                }).fail(function(dt){ 
                                    var ps='Data Komponen Penilaian Gagal Disimpan';
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
                    url : '{{url("komponen-penilaian-hapus")}}/'+id,
                    dataType : 'JSON'
                }).done(function(){
                    var id=$('#jenis').val();
                    loaddata(id);
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection