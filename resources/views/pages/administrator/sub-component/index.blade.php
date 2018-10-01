@extends('layouts.master')
@section('title')
    <title>Sub Komponen Penilaian :: SIMASKUS</title>
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
                    <span>Sub Komponen Penilaian</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Sub Komponen
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

                    <div class="col-md-7">&nbsp;</div>
                    <div class="col-md-5">
                        <select class="bs-select form-control has-success" id="jenis" name="jenis" onchange="loaddata(this.value)">
                            <option value="-1">-Pilih Komponen-</option>
                            @foreach ($com_module as $i => $v)
                                <option value="{{$v->c_id}}">{{$v->jenis}} - {{$v->code_component}} - {{$v->nama_component}}</option>
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
        $('#data').load('{{url("subkomponen-data")}}/'+id,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    function loadform(id)
    {
        $.ajax({
            url : '{{url("subkomponen")}}/'+id,
            success: function(html){
                bootbox.confirm({
                    title: "Form Sub Komponen Penilaian",
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
                                var t_url = '{{url("subkomponen")}}';
                            }
                            else
                                var t_url = '{{url("subkomponen")}}/'+id;
        
                            var t_method = 'POST';
                            var code=$('#code').val();
                            var jenjang=$('#jenjang').val();
                            if(jenjang=='')
                            {
                                pesan("Sub Komponen Penilaian harus diisi",'error');
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
                                        var ps="Data Sub Komponen Penilaian Berhasil Disimpan";
                                    }
                                    else
                                    {
                                        var ps="Data Sub Komponen Penilaian Berhasil Di Edit";
                                    }
                                    swal("Berhasil", ps, "success");

                                }).fail(function(dt){ 
                                    var ps='Data Sub Komponen Penilaian Gagal Disimpan';
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
                    url : '{{url("subkomponen-hapus")}}/'+id,
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