@extends('layouts.master')
@section('title')
    <title>Kirim Pesan :: SIMA-sp</title>
    <link href="{{asset('assets')}}/apps/css/inbox.min.css" rel="stylesheet" type="text/css">
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
                    <span>Kirim Pesan</span>
                </li>
            </ul>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-envelope font-dark"></i>
                            <span class="caption-subject bold uppercase">Kirim Pesan</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="inbox">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="inbox-sidebar">
                                        <a href="{{ route('pesan.create') }}" data-title="Compose" class="btn red compose-btn btn-block">
                                            <i class="fa fa-edit"></i> Kirim Pesan </a>
                                        <ul class="inbox-nav">
                                            <li >
                                                <a href="{{ route('pesan.index') }}" data-type="inbox" data-title="Inbox"> Pesan Masuk
                                                    <span class="badge badge-success">{{ $pesan->count() }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('pesan.terkirim') }}" data-type="sent" data-title="Sent"> Pesan Terkirim 
                                                <span class="badge badge-info">{{ $terkirim->count() }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('pesan.draft') }}" data-type="draft" data-title="Draft"> Draft
                                                    <span class="badge badge-danger">{{ $draft->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li class="active">
                                                <a href="{{ route('pesan.trash') }}" class="sbold" data-title="Trash"> Terhapus
                                                    <span class="badge badge-info">{{ $trash->count() }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="inbox-body">
                                        <div class="inbox-header">
                                            <h1 class="pull-left">Pesan Hapus</h1>
                                            
                                        </div>
                                        <div class="inbox-content"> 
                                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Dari</th>
                                                        <th class="text-center">Untuk</th>
                                                        <th class="text-center">Judul</th>
                                                        <th class="text-center">Lampiran</th>
                                                        <th class="text-center">Tanggal</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($trash as $item)
                                                    <tr onclick="location.href='pesan/{{ $item->id }}'">
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->dari }}</td>
                                                        <td>{{ $item->untuk }}</td>
                                                        <td>{{ $item->judul }}</td>
                                                        <td>
                                                            @if (isset($item->lampiran))
                                                                @foreach($item->lampiran as $k=>$v)
                                                                    <a href="{{ url('lihat-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-file-o"></i> {{ $v->nama_file }}</a>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{ tgl_indo_time2($item->created_at) }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
    </div>
@endsection
@section('footscript')
{{-- <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script> --}}
<script>

    $(document).ready(function(){
        $('#sample_1').dataTable()
        var ps = "{{Session::has('success')}}";
        // alert(end_date);
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('success')}}", "success")
        }
    });
</script>
@endsection