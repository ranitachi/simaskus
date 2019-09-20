@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Kerja Praktek :: SIMA-sp</title>
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
                    <span>Data Pengajuan Kerja Praktek</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan Kerja Praktek
            <small>Data Pengajuan</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            
            <div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">
            @if (Auth::user()->kat_user==1)
                
            
            <div class="btn-group pull-left">
                <a href="{{url('data-jadwal-kp-form/-1')}}" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal Sidang KP
                    <i class="fa fa-calendar"></i>
                </a>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                @php
                    $state=0;
                @endphp
                @foreach ($pengajuan as $i => $v)
                    @php
                        if (strpos(strtolower($v->jenispengajuan->jenis),'kerja praktek')!==false)
                        {
                            $state=1;
                        }                         
                    @endphp
                @endforeach
                @if ($state==0)
                    
                {{-- <a href="{{url('data-kp/-1/'.Auth::user()->kat_user)}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
                    <i class="fa fa-plus"></i>
                </a> --}}
                @endif
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Grup KP </th>
                    <th> Nama Mahasiswa (NPM) </th>
                    <th> Pembimbing </th>
                    <th> Status KP</th>
                    <th><div style="width:60px;"> #</div> </th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
            @foreach ($d_grup as $i => $v)
                <tr class="odd gradeX">
                    <td>{{$no}}</td>
                    <td>{{$v[0]->nama_kelompok}}</td>
                    <td>
                        <ul>
                        @foreach ($v as $item)
                            @if (isset($item->mahasiswa->nama))
                                <li>{{ucwords($item->kategori)}}<br>Nama : <b>{{$item->mahasiswa->nama}}</b><br><span class="font-blue-madison">NPM : <b>{{$item->mahasiswa->npm}}</b></span></li>
                            @endif
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                        @if (isset($pembimbing_kp[$i]))
                            @foreach ($pembimbing_kp[$i] as $item)
                                @if (isset($item->dosen->nama))
                                    <li>{{ucwords($item->kategori)}}<br><b>{{$item->dosen->nama}}</b></li>
                                @endif
                            @endforeach
                        @endif
                        </ul>
                    </td>
                    @php
                        if(isset($pengajuan[$v[0]->mahasiswa_id]))
                            $pjuan=$pengajuan[$v[0]->mahasiswa_id];
                        else
                            $pjuan=false;
                    @endphp
                    <td>
                        <small>Lokasi KP</small><br>
                            @if (isset($grupkp[$v[0]->mahasiswa_id]))
                                @foreach ($grupkp[$v[0]->mahasiswa_id] as $grup_id=> $grp)
                                    @if (isset($infokp[$grp->code]))
                                        <a class="btn btn-primary btn-xs"><i class="fa fa-building"></i> {{$infokp[$grp->code]['instansiperusahaan']->isi}}</a>
                                    @else
                                        <a class="btn btn-warning btn-xs"><i class="fa fa-exclamation-circle"></i> Data Lokasi KP Masih Kosong</a>
                                    @endif
                                @endforeach
                            @endif
                            
                        <br>
                        <br>
                        <small>Status KP</small><br>
                            @if ($pjuan!=false)
                                {!! $pjuan->status_kp == 0 ? '<a class="btn btn-warning btn-xs"><i class="fa fa-exclamation-circle"></i> Belum Di Mulai</a>' : ($pjuan->status_kp == 1 ? '<a class="btn btn-info btn-xs"><i class="fa fa-check"></i> Sedang Berjalan</a>' : ($pjuan->status_kp == 2 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Sudah Selesai</a>' : ($pjuan->status_kp == 10 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Sudah Dijadwalkan</a>' : '<a class="btn btn-danger btn-xs">Tidak Disetujui</a>')))!!}
                            @endif
                    </td>
                    <td>
                        
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"> Tombol Aksi
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    @if ($pjuan!=false)
                                        <li>
                                            <a href="{{url('data-kp-detail/'.$pjuan->id.'/'.Auth::user()->kat_user)}}"><i class="fa fa-eye"></i>&nbsp;Detail KP</a>
                                        </li>
                                        @if (Auth::user()->kat_user!=2) 
                                            <li>
                                                <a href="{{url('data-kp/'.$pjuan->id.'/'.Auth::user()->kat_user)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                            </li>
                                        @endif
                                        @if($pjuan->status_kp==0)
                                            <li>
                                                <a href="javascript:hapus({{$pjuan->id}})"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                            </li>
                                        @endif
                                    @endif
                                            
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
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        // $('#loader').show();
        // loaddata();
        $('#sample_4').dataTable({
                columnDefs: [
                    { width: 60, targets: 5 }
                ],
            });
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function loaddata()
    {
        // $('#loader').show();
        // $('#data').load('{{url("data-kp-data")}}',function(){
        //     $('#sample_4').dataTable();
        //     $('#loader').hide();
        // });
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
                    url : '{{url("data-kp-hapus")}}/'+id,
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
    function verifikasi(id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Memverifikasi Data Kerja Praktek Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Setuju",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("data-kp-verifikasi")}}/'+id+'/1',
                    dataType : 'JSON'
                }).done(function(){
                    //loaddata();
                    swal("Success!", "Data Berhasil Di Verifikasi", "success");
                    loaddata();
                // location.href='{{url("data-kp-detail")}}/'+id+'/{{Auth::user()->kat_user}}';
                }).fail(function(){
                    swal("Fail!", "Verifikasi Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection