@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Spesial:: SIMA-sp</title>
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
        <h1 class="page-title"> Data Pengajuan <small>Mata Kuliah Spesial</small>
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
            @if ($jns=='bimbingan')
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">
                        <div class="btn-group pull-left">
                                <a href="javascript:generate(-1)" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Pembimbing
                                    <i class="fa fa-users"></i>
                                </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                </div>
            @endif
            @if ($jns=='pengajuan')
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:verifikasisemua()" class="btn btn-primary btn-sm pull-right tooltips" data-style="default" ata-container="body" data-original-title="Verifikasi Semua Pengajuan Bimbingan"><i class="fa fa-check"></i> Verifikasi Semua Pengajuan</a>
                    </div>
                </div>
            @endif
           <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th> Tanggal Pengajuan / <br>Jenis</th>
                            {{-- <th> Jenis</th> --}}
                            <th> Mahasiswa</th>
                            <th> Judul</th>
                            <th> Pembimbing</th>
                            <th> Status </th>
                            <th><div style="width:80px;">Tombol Aksi</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $k => $v)
                            @php
                                if(isset($jdwl[$v->id]))
                                    continue;
                            @endphp
                            <tr>
                                <td>{{++$k}}</td>
                                <td class="text-left">{{ tgl_indo2($v->created_at)}}
                                <br><br>
                                <u>Jenis : </u><br>
                                <b>{{ ($v->jenispengajuan->jenis)}}</b>
                                </td>
                                <td>
                                    <b>{{$v->mahasiswa->nama}}</b><br>
                                    NPM : {{ ($v->mahasiswa->npm)}}<br>
                                    {{$v->mahasiswa->programstudi->nama_program_studi}}<br>
                                    T.A : {{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}
                                </td>
                                <td> 
                                    <u>B. Indonesia:</u><br><b>{{$v->judul_ind}}</b><br><br>
                                    <u>B. Inggris:</u><br><b>{{$v->judul_eng}}</b>
                                
                                </td>
                                <td> 
                                    @if ($jns=='pengajuan')
                                        <a href="javascript:checkall({{$v->id}})" class="pull-right btn-xs btn-primary tooltips" data-style="default" ata-container="body" data-original-title="Setujui Seluruh Pengajuan Pembimbing"><i class="fa fa-check-circle-o"></i> Approve Semua</a>
                                    @endif
                                    <div style="margin-top:10px;">
                                    @php
                                        $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',$v->mahasiswa_id)->where('judul_id',$v->id)->with('dosen')->orderBy('keterangan','desc')->get();
                                    @endphp
                                    <div class="row">
                                         <div class="col-md-7">&nbsp;</div>
                                         <div class="col-md-5">
                                           @if ($v->status_pengajuan==1) 
                                                ACC Sidang
                                            @endif
                                        </div>
                                    </div>
                                    @foreach ($p_bimbingan as $key=>$item)
                                        @if (isset($item->dosen->nama))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                                        <small><u>{{$item->keterangan}}</u></small>
                                                    @else
                                                        <small><u>Pembimbing {{$key+1}}</u></small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if ($item->status==1)
                                                        @if ($item->status_fix==1)
                                                            <i class="fa fa-check font-blue-steel tooltips" data-style="default" ata-container="body" data-original-title="Pembimbing Telah Setuju"></i>
                                                        @else
                                                            <i class="fa fa-check font-blue-steel tooltips" data-style="default" ata-container="body" data-original-title="Telah Di Approve oleh Pembimbing"></i>
                                                        @endif
                                                    @elseif($item->status==0)
                                                        <i class="fa fa-exclamation-circle font-red-thunderbird tooltips" data-style="default" data-container="body" data-original-title="Menunggu Approve Dari Pembimbing"></i>
                                                    @endif
                                                   
                                                    @if ($item->status_fix==0)
                                                        <i class="fa fa-exclamation-circle font-red-thunderbird tooltips" data-style="default" data-container="body" data-original-title="Menunggu DI Generate Pembimbing"></i>
                                                    @endif
                                                    
                                                    <strong>{{$item->dosen->nama}}<br></strong>
                                                </div>
                                                <div class="col-md-3">
                                                    @if($item->status==0)
                                                        <a href="javascript:setujuipengajuan({{$v->id}},{{$v->mahasiswa_id}},{{$item->dosen_id}})" class="btn btn-xs btn-info tooltips" data-style="default" data-container="body" data-original-title="Setujui Bimbingan" id=""><i class="fa fa-check-circle font-white" title=""></i></a>
                                                    @endif
                                                
                                                    @if($item->status==0)
                                                        <a href="javascript:hapuspengajuan({{$v->id}},{{$v->mahasiswa_id}},{{$item->dosen_id}})" class="btn btn-xs btn-danger tooltips" data-style="default" data-container="body" data-original-title="Hapus Pengajuan Bimbingan" id=""><i class="fa fa-trash font-white" title=""></i></a>
                                                    @endif
                                                </div>
                                                <div class="col-md-1">
                                                    @if (isset($acc[$v->id][$item->dosen_id]))
                                                        <a href="" class="btn btn-xs btn-info btn-circle tooltips" data-style="default" data-container="body" data-original-title="Pembimbing Telah ACC Sidang"><i class="fa fa-check"></i></a>    
                                                    @else
                                                        @if ($v->status_pengajuan==1)
                                                            <a href="javascript:accsidang({{$v->id}},{{$item->dosen_id}})" class="btn btn-xs btn-danger btn-circle tooltips" data-style="default" data-container="body" data-original-title="Pembimbing Belum ACC   Sidang"><i class="fa fa-check"></i></a>
                                                        @endif
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </td>
                                <td>
                                    {!! $v->status_pengajuan == 0 ? '<span class="label label-info label-sm">Belum Di Verifikasi</span>' : ($v->status_pengajuan == 1 ? '<span class="label label-success label-sm"><i class="fa fa-check"></i> Di Setujui</span>' : '<span class="label label-danger label-sm"><i class="fa fa-ban"></i> Tidak Disetujui</span>')!!}
                                    @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                        @if ($v->sk_rektor_promotor!=null)
                                            <br>
                                            <br>
                                            SK Rektor Promotor<br>
                                            <a href="{{url('unduh-file/'.$v->sk_rektor_promotor)}}" class="btn btn-xs btn-info tooltips" data-style="default" data-container="body" data-original-title="File SK Rektor" id=""><i class="fa fa-file-o font-white" title=""></i> Lihat File</a>
                                        @endif
                                    @endif
                                </td>

                                @php
                                    $st_pbb=0;
                                    if(isset($piv[$v->mahasiswa_id]))
                                    {

                                        foreach ($piv[$v->mahasiswa_id] as $item)
                                        {
                                            if($item->status==1)
                                            {
                                                $st_pbb=1;
                                                break;
                                            }
                                            else
                                                $st_pbb=0;
                                        }
                                    }
                                @endphp
                                <td>
                                    
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"> Tombol Aksi
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                        @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                            
                                        
                                            @if ($v->status_pengajuan==0)    
                                                {{-- <a href="javascript:verifikasis3({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-info btn-xs tooltips" title="Verifikasi Pengajuan" data-style="default" data-container="body" data-original-title="Verifikasi Pengajuan"><i class="fa fa-check-square-o"></i></a> --}}
                                            
                                                    <li>
                                                        <a href="{{url('data-pengajuan-detail/'.$v->id)}}" class="tooltips" title="Lihat Detail" data-style="default" data-container="body" data-original-title="Lihat Detail"><i class="fa fa-eye"></i>&nbsp;Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:hapus({{$v->id}},'{{$v->jenis_id}}');" class="tooltips" title="Hapus Pengajuan" data-style="default" data-container="body" data-original-title="Hapus Pengajuan"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                                    </li>
                                                
                                                @endif
                                                @if ($jns=='pengajuan')
                                                    <li>
                                                        <a href="javascript:tolak({{$v->id}},'{{$v->jenis_id}}');" class="tooltips" title="Tolak Pengajuan" data-style="default" data-container="body" data-original-title="Tolak Pengajuan"><i class="fa fa-ban"></i>&nbsp;Tolak Pengajuan</a>
                                                    </li>
                                                @endif
                                                
                                        @else
                                            @if ($st_pbb==1)
                                            <li>
                                                <a href="{{url('data-pengajuan-detail/'.$v->id)}}" class="tooltips" title="Lihat Detail" data-style="default" data-container="body" data-original-title="Lihat Detail"><i class="fa fa-eye"></i>&nbsp;Detail</a>
                                            </li>
                                                @if ($v->status_pengajuan==0)  
                                                    <li>  
                                                        <a href="javascript:verifikasi({{$v->id}},'{{$v->jenis_id}}');" class="tooltips" title="Verifikasi Pengajuan" data-style="default" data-container="body" data-original-title="Verifikasi Pengajuan"><i class="fa fa-check-square-o"></i>&nbsp;Verifikasi Pengajuan</a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                        @if ($jns=='pengajuan')
                                            <li><a href="javascript:tolak({{$v->id}},'{{$v->jenis_id}}');" class="tooltips" title="Tolak Pengajuan" data-style="default" data-container="body" data-original-title="Tolak Pengajuan"><i class="fa fa-ban"></i>&nbsp;Tolak Pengajuan</a></li>
                                        @endif
                                        </ul>
                                    </div>
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

        var pse = "{{Session::has('error')}}";
        if(pse!="")
        {
            swal("Gagal", "{{Session::get('error')}}", "error")
        }
        $('#tooltips').tooltip();
    });
    function generate(id)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Men-Generate Data Pembimbing Ini ?",
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
                location.href='{{url("generate-pembimbing")}}/{{$dept_id}}';
            } 
        });
        
    }
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
    function verifikasis3(id,jns)
    {
        $('#id_pengajuan').val(id);
        $('#ajax').modal('show');
    }
    function setujuipengajuan(pengajuan_id,mahasiswa_id,dosen_id)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menyetujui Pengajuan Mahasiswa Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Terima",
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
    function hapuspengajuan(pengajuan_id,mahasiswa_id,dosen_id)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menyetujui Menghapus Pengajuan Bimbingan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                location.href='{{url("hapus-pengajuan-bimbingan")}}/'+pengajuan_id+'/'+mahasiswa_id+'/'+dosen_id;
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

    function checkall(id_pengajuan)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menyetujui Pengajuan Mahasiswa Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Terima",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                location.href='{{url("setujui-pengajuan-bimbingan-semua")}}/'+id_pengajuan;
            } 
        });
    }
    function verifikasisemua()
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Seluruh Data Pengajuan Ini ?",
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
                location.href='{{url("pengajuan-verifikasi-semua")}}';
            } 
        });
    }
    function accsidang(idpengajuan,iddosen)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Persetujuan ACC Sidang Ini?",
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
                location.href='{{url("acc-sidang")}}/'+idpengajuan+'/'+iddosen;
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
<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Unggah SK Rektor</h4>
            </div>
            <form action="{{url('unggah-sk-rektor')}}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group has-success">
                        <label class="control-label">Upload SK Rektor Promotor</label>
                        <input type="file" name="sk_rektor" class="form-control">
                    </div>
                    <input type="hidden" name="id_pengajuan" id="id_pengajuan">
                    <div class="form-group has-success">
                        <label class="control-label">Status Pengajuan</label>
                            <select class="form-control" data-placeholder="Status " name="status" id="status" style="width:100%">
                                <option value="1">Setujui</option>
                                <option value="0">Tolak</option>
                            </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="submit" class="btn green" id="ok">OK</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection