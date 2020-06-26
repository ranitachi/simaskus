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
                           
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Nama Pengusul </th>
                                    <th> Departemen /<br>Program Studi </th>
                                    <th> Judul Publikasi </th>
                                    <th> Penulis </th>
                                    <th> URL /<br>Lokasi Publikasi</th>
                                    <th> Status </th>
                                    <th> <div style="width:60px;">#</div> </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                    $no=1;
                                    $ds=\App\Model\Dosen::find(Auth::user()->id_user);
                                    $pimpinan=\App\Model\MasterPimpinan::where('dosen_id',Auth::user()->id_user)->where('status',1)->where('departemen_id',$ds->departemen_id)->first();
                                    $pimpinanfakultas=\App\Model\MasterPimpinan::where('dosen_id',Auth::user()->id_user)->where('status',1)->where('jabatan','like','%Manajer Pendidikan & Kepala PAF%')->first();
                                @endphp
                                @foreach ($publikasi as $item)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            <small>Nama :</small> <br>
                                            <b>{{$item->mahasiswa->nama}}</b>
                                            <br>
                                            <small>NPM :</small> <br>
                                            <b>{{$item->mahasiswa->npm}}</b>
                                        </td>
                                        <td>
                                            <small>Departemen :</small> <br>
                                            <b>{{$item->mahasiswa->departemen->nama_departemen}}</b>
                                            <br>
                                            <small>Program Studi :</small> <br>
                                            <b>{{$item->mahasiswa->programstudi->nama_program_studi}}</b>
                                        </td>
                                        <td>{{$item->judul}}</td>
                                        <td><ul><li>{!!str_replace(';','<li>',substr($item->penulis,0,-1))!!}</ul></td>
                                        <td><b><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></b><br><br>
                                            <small>Lokasi Publikasi</small><br>
                                            {{$item->lokasi_publikasi}}</td>
                                        <td class="text-center">
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
                                                    @if ($pimpinan)
                                                        @if ($item->acc_dep==0)
                                                        <li>
                                                                <a href="javascript:verifikasi({{$item->id}},1,'dep')" title="Verifikasi Publikasi"><i class="fa fa-check"></i> Verifikasi Publikasi</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="javascript:verifikasi({{$item->id}},0,'dep')" title="Verifikasi Publikasi"><i class="fa fa-ban"></i> Hapus Verifikasi</a>
                                                            </li>
                                                        @endif
                                                        
                                                    @endif
                                                    @if ($pimpinanfakultas)
                                                        @if ($item->acc_mandik==0)
                                                        <li>
                                                                <a href="javascript:verifikasi({{$item->id}},1,'mandik')" title="Verifikasi Publikasi"><i class="fa fa-check"></i> Verifikasi Publikasi</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="javascript:verifikasi({{$item->id}},0,'mandik')" title="Verifikasi Publikasi"><i class="fa fa-ban"></i> Hapus Verifikasi</a>
                                                            </li>
                                                        @endif
                                                        
                                                    @endif
                                                    
                                                    
                                                    {{-- <li>
                                                        <a href="{{url('publikasi/'.$item->id)}}" title=""><i class="fa fa-edit"></i> Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:hapus({{$item->id}})" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
                                                    </li> --}}
                                                    
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
        small
        {
            color:blue;
            font-style: italic
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
    function verifikasi(id,status,pimpinan)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Memverifikasi Publikasi Ilmiah Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Verifikasi",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                location.href='{{url("dosen-publikasi-ilmiah-verifikasi")}}/'+id+'/'+status+'/'+pimpinan;
            } 
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
                location.href='{{url("dosen-publikasi-ilmiah-hapus")}}/'+id;
            } 
        });
    }

    function detail(id)
    {
        $('#detail').load('{{url("/")}}/dosen-publikasi-ilmiah-detail/'+id);
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