@extends('layouts.master')
@section('title')
    <title>Kirim Pesan :: SIMA-sp</title>
    <link href="{{asset('assets')}}/apps/css/inbox.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets')}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets')}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets')}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
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
                                        <a href="javascript:;" data-title="Compose" class="btn red compose-btn btn-block">
                                            <i class="fa fa-edit"></i> Kirim Pesan </a>
                                        <ul class="inbox-nav">
                                            <li>
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
                                            <h1 class="pull-left">Detail Pesan</h1>
                                            
                                        </div>
                                        <div class="inbox-content"> 
                                            <div class="inbox-header inbox-view-header">
                                                <h1 class="pull-left">{{ $get->judul }}
                                                </h1>
                                            </div>
                                            <div class="inbox-view-info">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                Dari : <span class="sbold">{{ $get->dari }}</span>
                                                                <span>&#60;{{ $get->userdari->email }}&#62; </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                Kepada : <span class="sbold">{{ $get->untuk }}</span>
                                                                <span>&#60;{{ $get->useruntuk->email }}&#62; </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                Dikirim : <span class="sbold">{{ tgl_indo_time2($get->created_at) }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-5 inbox-info-btn">
                                                        &nbsp;<a style="margin:0 5px;" href="{{ route('pesan.edit',$get->id) }}" data-messageid="23" class="reply-btn btn btn-success pull-right"><i class="fa fa-reply"></i> Balas </a>&nbsp;
                                                        @if ($get->status_pesan==0)
                                                            &nbsp;<a style="margin:0 5px;" href="{{ route('pesan.kirim',$get->id) }}" data-messageid="23" class="reply-btn btn btn-info pull-right"><i class="fa fa-send"></i> Kirim Pesan</a>&nbsp;
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="inbox-view">
                                                {!! $get->pesan !!}
                                            </div>
                                            <hr>
                                            <div class="inbox-attached">
                                                <div class="margin-bottom-15">
                                                    <span>Lampiran — </span>
                                                </div>
                                                <div class="margin-bottom-25">
                                                    @if (isset($get->lampiran))
                                                        @foreach($get->lampiran as $k=>$v)
                                                            <a href="{{ url('lihat-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-file-o"></i> {{ $v->nama_file }}</a>
                                                            <div>
                                                                <a href="{{ url('lihat-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-eye"></i> View </a>
                                                                <a href="{{ url('unduh-file/'.$v->lokasi_file) }}" target="_blank"><i class="fa fa-download"></i> Download </a>    
                                                            </div>
                                                        @endforeach
                                                    @endif
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
    </div>
@endsection
@section('footscript')
{{-- <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script> --}}
<script src="{{ asset('assets') }}/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2()
        $('#sample_1').dataTable()

        $('.inbox-wysihtml5').wysihtml5({
            "stylesheets": ["{{ asset('assets') }}/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
        });

        $('#fileupload').fileupload({
            url: '{{ route("pesan-lampiran.store") }}',
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '{{ route("pesan-lampiran.store") }}',
                type: 'POST'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                    new Date())
                    .appendTo('#fileupload');
            });
        }
    });
</script>
@endsection