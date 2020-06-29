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
                                            <li class="active">
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
                                            <li>
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
                                            <h1 class="pull-left">Pesan Masuk</h1>
                                            
                                        </div>
                                        <div class="inbox-content"> 
                                            <div class="inbox-view-info">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        &nbsp;
                                                    </div>
                                                    <div class="col-md-5 inbox-info-btn">
                                                        <a style="margin:0 5px;" href="javascript:hapus()" data-messageid="23" class="reply-btn btn btn-danger pull-right"><i class="fa fa-trash"></i> Hapus </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <form id="hapus-pesan" action="{{ route('pesan.destroy') }}" method="POST">
                                                {{ csrf_field() }}
                                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Dari</th>
                                                            <th class="text-center">Judul</th>
                                                            <th class="text-center">Lampiran</th>
                                                            <th class="text-center">Tanggal</th>
                                                            <th class="text-center">Aksi <input type="checkbox" id="pilih"></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    @php
                                                        $no=1;
                                                    @endphp
                                                    @foreach ($pesan as $item)
                                                        <tr>
                                                            @if ($item->status_baca==0)
                                                                <td onclick="location.href='pesan/{{ $item->id }}'"  onclick="location.href='pesan/{{ $item->id }}'"style="font-weight: bold">{{ $no++ }}</td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'"  onclick="location.href='pesan/{{ $item->id }}'"style="font-weight: bold">{{ $item->dari }}</td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'"  onclick="location.href='pesan/{{ $item->id }}'"style="font-weight: bold">{{ $item->judul }}</td>
                                                                <td style="font-weight: bold">
                                                                    @if (isset($item->lampiran))
                                                                        @foreach($item->lampiran as $k=>$v)
                                                                            <a href="{{ url('lihat-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-file-o"></i> {{ $v->nama_file }}</a>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'"  onclick="location.href='pesan/{{ $item->id }}'"style="font-weight: bold">{{ tgl_indo_time2($item->created_at) }}</td>
                                                                <td class="text-center" style="font-weight: bold"><input type="checkbox" class="pilih-pesan" name="hapuspesan[{{ $item->id }}]" id="pilih-pesan"></td>
                                                            @else    
                                                                <td>{{ $no++ }}</td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'">{{ $item->dari }}</td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'">{{ $item->judul }}</td>
                                                                <td>
                                                                    @if (isset($item->lampiran))
                                                                        @foreach($item->lampiran as $k=>$v)
                                                                            <a href="{{ url('lihat-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-file-o"></i> {{ $v->nama_file }}</a>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td onclick="location.href='pesan/{{ $item->id }}'">{{ tgl_indo_time2($item->created_at) }}</td>
                                                                <td class="text-center"><input type="checkbox" class="pilih-pesan" name="hapuspesan[{{ $item->id }}]" id="pilih-pesan"></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </form>
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

        $("#pilih").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
    function hapus()
    {
        $('#hapus-pesan').submit();
    }
</script>
@endsection