@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Khusus:: SIMA-sp</title>
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
                            <th> Tombol Aksi </th>
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
                                    @php
                                        $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',$v->mahasiswa_id)->with('dosen')->get();
                                    @endphp
                                    @foreach ($p_bimbingan as $key=>$item)
                                        @if (isset($item->dosen->nama))
                                            <small><u>Pembimbing {{$key+1}}</u></small><br>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    @if ($item->status==1)
                                                        <i class="fa fa-check font-blue-steel"></i>
                                                    @elseif($item->status==0)
                                                        <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                                    @endif
                                                    
                                                    <strong>{{$item->dosen->nama}}<br></strong>
                                                </div>
                                                <div class="col-md-3">
                                                    @if($item->status==0)
                                                        <a href="javascript:setujuipengajuan({{$v->id}},{{$v->mahasiswa_id}},{{$item->dosen_id}})" class="btn btn-xs btn-info tooltips" data-style="default" data-container="body" data-original-title="Setujui Bimbingan" id=""><i class="fa fa-check-circle font-white" title=""></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
                                        <a href="{{url('data-pengajuan-detail/'.$v->id)}}" class="btn btn-success btn-xs tooltips" title="Lihat Detail" data-style="default" data-container="body" data-original-title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                        @if ($v->status_pengajuan==0)    
                                            <a href="javascript:verifikasi({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-info btn-xs tooltips" title="Verifikasi Pengajuan" data-style="default" data-container="body" data-original-title="Verifikasi Pengajuan"><i class="fa fa-check-square-o"></i></a>
                                        @endif
                                    @endif
                                    <a href="javascript:tolak({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-danger btn-xs tooltips" title="Tolak Pengajuan" data-style="default" data-container="body" data-original-title="Tolak Pengajuan"><i class="fa fa-ban"></i></a>
                                    <a href="javascript:hapus({{$v->id}},'{{$v->jenis_id}}');" class="tooltips btn btn-danger btn-xs" title="Hapus Pengajuan" data-style="default" data-container="body" data-original-title="Hapus Pengajuan"><i class="fa fa-trash"></i></a>
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
        $('#tooltips').tooltip();
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
    function setujuipengajuan(pengajuan_id,mahasiswa_id,dosen_id)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menyetujui Pengajuan Mahasiswa Ini ?",
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
                location.href='{{url("setujui-pengajuan-bimbingan")}}/'+pengajuan_id+'/'+mahasiswa_id+'/'+dosen_id;
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
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>
@endsection