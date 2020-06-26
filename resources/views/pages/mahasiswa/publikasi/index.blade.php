@extends('layouts.master')
@section('title')
    <title>Data Publikasi Ilmiah :: SIMA-sp</title>
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
                    <span>Data Publikasi Ilmiah</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Publikasi Ilmiah
            <small>Data</small>
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
                                    <a href="{{url('publikasi/-1')}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
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
                                    <th> Judul Publikasi </th>
                                    <th> Penulis </th>
                                    <th> URL </th>
                                    <th> Lokasi Publikasi </th>
                                    <th> Status </th>
                                    <th> <div style="width:60px;">#</div> </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($publikasi as $item)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$item->judul}}</td>
                                        <td><ul><li>{!!str_replace(';','<li>',substr($item->penulis,0,-1))!!}</ul></td>
                                        <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
                                        <td>{{$item->lokasi_publikasi}}</td>
                                        <td>
                                            @if ($item->status==1)
                                                <a href="#" class="btn btn-xs btn-info"><i class="fa fa-check"></i> Di Setujui</a>
                                            @else
                                                @if ($item->acc_dep==1)
                                                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Sudah Di ACC Pimpinan Departemen</a><br>
                                                    <a href="#" class="btn btn-xs btn-info"><i class="fa fa-exclamation-circle"></i> Menunggu Di ACC Manajer Akademik</a>
                                                @else
                                                    <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-exclamation-circle"></i> Pengajuan</a>
                                                @endif
                                            @endif    
                                        </td>
                                        <td>
                                             <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"> Tombol Aksi
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="javascript:detail({{$item->id}})" title="Lihat Detail"><i class="fa fa-eye"></i> Detail Publikasi</a>
                                                    </li>
                                                    @if($item->acc_dep==0)
                                                    <li>
                                                        <a href="{{url('publikasi/'.$item->id)}}" title=""><i class="fa fa-edit"></i> Edit</a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="javascript:hapus({{$item->id}})" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
                                                    </li>
                                                    
                                                </ul>
                                             </div>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <style>
        .table td,
        .table th
        {
            font-size: 11px !important;
        }
    </style>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#sample_4').dataTable();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

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
                location.href='{{url("publikasi-hapus")}}/'+id;
            } 
        });
    }

    function detail(id)
    {
        $('#detail').load('{{url("/")}}/publikasi-detail/'+id);
        $('#ajax-sm').modal('show');
    }
</script>
<div class="modal fade" id="ajax-sm" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Publikasi</h4>
            </div>
            <div class="modal-body">
                <div id="detail"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn green" id="ok-ajax-sm">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection