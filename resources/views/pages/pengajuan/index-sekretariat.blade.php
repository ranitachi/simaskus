@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Khusus:: SIMASKUS</title>
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
                    <span>Data Pengajuan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Data Pengajuan <small>Mata Kuliah Khusus</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            {{-- <div class="row" id="loader">
                <div class="col-md-10 text-center" style="position:fixed;">
                    <center>
                        <img src="{{asset('img/loading-bl-blue.gif')}}">
                    </center>
                </div>
            </div> --}}
           <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th> Tanggal Pengajuan</th>
                            <th> Mahasiswa</th>
                            <th> Judul</th>
                            <th> Pembimbing</th>
                            <th> Status </th>
                            <th> # </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $k => $v)
                            <tr>
                                <td>{{++$k}}</td>
                                <td class="text-center">{{ tgl_indo2($v->created_at)}}</td>
                                <td>NPM : {{ ($v->mahasiswa->npm)}}<br><b>{{$v->mahasiswa->nama}}</b></td>
                                <td> {{$v->topik_diajukan}}</td>
                                <td> 
                                    @if (isset($v->dospem_2->nama))
                                        <small><u>Pembimbing 1</u></small><br>
                                        @if (isset($piv[$v->mahasiswa_id][$v->dospem1]))
                                            @if ($piv[$v->mahasiswa_id][$v->dospem1]->status==1)
                                                <i class="fa fa-check font-blue-steel"></i>
                                            @elseif($piv[$v->mahasiswa_id][$v->dospem1]->status==0)
                                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                            @endif
                                        @endif
                                        <strong>{{$v->dospem_1->nama}}<br></strong>
                                    @endif
                                    @if (isset($v->dospem_2->nama))
                                        <small><u>Pembimbing 2</u></small><br>
                                        @if (isset($piv[$v->mahasiswa_id][$v->dospem2]))
                                            @if ($piv[$v->mahasiswa_id][$v->dospem2]->status==1)
                                                <i class="fa fa-check font-blue-steel"></i>
                                            @elseif($piv[$v->mahasiswa_id][$v->dospem2]->status==0)
                                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                            @endif
                                        @endif
                                    <strong> {{$v->dospem_2->nama}}<br></strong>
                                    @endif
                                    @if (isset($v->dospem_3->nama))
                                        <small><u>Pembimbing 3</u></small><br>
                                        @if (isset($piv[$v->mahasiswa_id][$v->dospem3]))
                                            @if ($piv[$v->mahasiswa_id][$v->dospem3]->status==1)
                                                <i class="fa fa-check font-blue-steel"></i>
                                            @elseif($piv[$v->mahasiswa_id][$v->dospem3]->status==0)
                                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                            @endif
                                        @endif
                                        <strong>{{$v->dospem_3->nama}}</strong>
                                    @endif
                                </td>
                                <td>{!! $v->status_pengajuan == 0 ? '<span class="label label-info label-sm">Belum Di Verifikasi</span>' : ($v->status_pengajuan == 1 ? '<span class="label label-success label-sm"><i class="fa fa-check"></i> Di Setujui</span>' : '<span class="label label-danger label-sm"><i class="fa fa-ban"></i> Tidak Disetujui</span>')!!}</td>

                                @php
                                    $st_pbb=0;
                                    if(isset($piv[$v->mahasiswa_id]))
                                    {

                                        foreach ($piv[$v->mahasiswa_id] as $item)
                                        {
                                            if($item->status==1)
                                            {
                                                $st_pbb=1;
                                            }
                                            else
                                            $st_pbb=0;
                                        }
                                    }
                                @endphp
                                <td>
                                    @if ($st_pbb==1)
                                        <a href="{{url('data-pengajuan-detail/'.$v->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                        <a href="javascript:verifikasi({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-info btn-xs"><i class="fa fa-check-square-o"></i></a>
                                    @endif
                                    <a href="javascript:tolak({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></a>
                                    <a href="javascript:hapus({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        //loaddata();
        $('#sample_4').DataTable();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function verifikasi(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Data Ini ?",
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
                location.href='{{url("pengajuan-verifikasi")}}/'+id+'/'+jns;
            } 
        });
    }
    function tolak(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menolak Pengajuan Data Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                location.href='{{url("pengajuan-tolak")}}/'+id+'/'+jns;
            } 
        });
    }
    function hapus(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menolak Menghapus Data Ini ?",
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
                location.href='{{url("pengajuan-hapus")}}/'+id+'/'+jns;
            } 
        });
    }
</script>
@endsection
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>