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
            
            <div id="data">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="row" style="padding:5px 20px;">

                        <div class="col-md-6">&nbsp;</div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <a href="javascript:loadform(-1)" id="sample_editable_1_new" class="btn btn-xs sbold green"> Tambah Data
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> NIP </th>
                                    <th> Nama Pimpinan </th>
                                    <th> Jabatan </th>
                                    <th> # </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($pimpinan as $i => $v)
                                @if(isset($v->dosen->nama))
                                    <tr class="odd gradeX">
                                        <td>{{(++$i)}}</td>
                                        <td>{{isset($v->dosen->nip) ? $v->dosen->nip : '-'}}</td>
                                        <td>{{isset($v->dosen->nama) ? $v->dosen->nama : '-'}}</td>
                                        <td>{{isset($v->jabatan) ? $v->jabatan : '-'}}</td>
                                        <td>
                                            <div style="width:80px;">
                                                <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach                
                            </tbody>
                        </table>
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
    });

    
    function loadform(id)
    {
        $.ajax({
            url : '{{url("pimpinan-fakultas-form")}}/'+id,
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
                            var dosen_id=$('#dosen_id').val();
                            var jabatan=$('#jabatan').val();
                            if(dosen_id=='')
                            {
                                pesan("Nama Dosen harus Di pilih",'error');
                                $('#dosen_id').focus();
                                // return false;
                            }
                            
                            else if(jabatan=='')
                            {
                                pesan("Jabatan harus Di pilih",'error');
                                $('#jabatan').focus();
                                // return false;
                            }
                            else
                            {
                               $('#form-departemen').submit();
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