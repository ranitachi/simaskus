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
                                <td>
                                    <b>{{$v->mahasiswa->nama}}</b><br>
                                    NPM : {{ ($v->mahasiswa->npm)}}<br>
                                    {{$v->mahasiswa->programstudi->nama_program_studi}}
                                </td>
                                <td> {{$v->topik_diajukan}}</td>
                                <td> 
                                    @php
                                        $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',$v->mahasiswa_id)->with('dosen')->orderBy('keterangan','desc')->get();
                                    @endphp
                                    @foreach ($p_bimbingan as $key=>$item)
                                        @if (isset($item->dosen->nama))
                                            @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                                <small><u>{{$item->keterangan}}</u></small><br>
                                            @else
                                                <small><u>Pembimbing {{$key+1}}</u></small><br>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if ($item->status==1)
                                                        <i class="fa fa-check font-blue-steel"></i>
                                                    @elseif($item->status==0)
                                                        <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                                    @endif
                                                    
                                                    <strong>{{$item->dosen->nama}}<br></strong>
                                                </div>
                                                <div class="col-md-4">
                                                    @if($item->status==0)
                                                        <a href="javascript:setujuipengajuan({{$v->id}},{{$v->mahasiswa_id}},{{$item->dosen_id}})" class="btn btn-xs btn-info tooltips" data-style="default" data-container="body" data-original-title="Setujui Bimbingan" id=""><i class="fa fa-check-circle font-white" title=""></i></a>
                                                    @endif
                                                
                                                    @if($item->status==0)
                                                        <a href="javascript:hapuspengajuan({{$v->id}},{{$v->mahasiswa_id}},{{$item->dosen_id}})" class="btn btn-xs btn-danger tooltips" data-style="default" data-container="body" data-original-title="Hapus Pengajuan Bimbingan" id=""><i class="fa fa-trash font-white" title=""></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
                                    @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                        @if ($v->status_pengajuan==0)    
                                            <a href="javascript:verifikasis3({{$v->id}},'{{$v->jenis_id}}');" class="btn btn-info btn-xs tooltips" title="Verifikasi Pengajuan" data-style="default" data-container="body" data-original-title="Verifikasi Pengajuan"><i class="fa fa-check-square-o"></i></a>
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
                        <label class="control-label">Upload daftar Bimbingan dari SIAK-NG</label>
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