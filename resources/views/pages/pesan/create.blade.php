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
                                            <h1 class="pull-left">Kirim Pesan Baru</h1>
                                            
                                        </div>
                                        <div class="inbox-content"> 
                                            <form class="inbox-compose form-horizontal" action="{{ route('pesan.store') }}" id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idform" value="{{ time() }}">
                                                <div class="inbox-compose-btn">
                                                    <button class="btn green"><i class="fa fa-check"></i>Kirim</button>
                                                    <a href="{{ route('pesan.index') }}" class="btn default inbox-discard-btn">Batal</a>
                                                    <button onclick="simpandraft()" class="btn default">Draft</button>
                                                </div>
                                                <div class="inbox-form-group mail-to">
                                                    <label class="control-label">Kepada:</label>
                                                    <div class="controls controls-to">
                                                        {{-- <input type="text" class="form-control" name="to" required> --}}
                                                        <select class="form-control select2" name="to[]" data-placeholder="Pilih Tujuan" multiple>
                                                            <option>&nbsp;</option>
                                                            @foreach ($user as $item)

                                                                @if($item->kat_user==1)
                                                                    <option value="{{ $item->id }}__{{ $item->name }}">STAF :: {{ $item->name }} ( {{ $item->email }} )</option>
                                                                @elseif($item->kat_user==2)
                                                                    <option value="{{ $item->id }}__{{ $item->name }}">DOSEN :: {{ $item->name }} ( {{ $item->email }} )</option>
                                                                @elseif($item->kat_user==3)
                                                                    <option value="{{ $item->id }}__{{ $item->name }}">MAHASISWA :: {{ $item->name }} ( {{ $item->email }} )</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="inbox-form-group">
                                                    <label class="control-label">Judul:</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="subject" required> </div>
                                                </div>
                                                <div class="inbox-form-group">
                                                    <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12" required></textarea>
                                                </div>
                                                <div class="inbox-compose-attachment">
                                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                    <span class="btn green btn-outline fileinput-button">
                                                        <i class="fa fa-plus"></i>
                                                        <span> Add files... </span>
                                                        <input type="file" name="files[]" multiple> </span>
                                                    <!-- The table listing the files available for upload/download -->
                                                    <table role="presentation" class="table table-striped margin-top-10">
                                                        <tbody class="files"> </tbody>
                                                    </table>
                                                </div>
                                                <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                    <tr class="template-upload fade">
                                                        <td class="name" width="30%">
                                                            <span>{%=file.name%}</span>
                                                        </td>
                                                        <td class="size" width="40%">
                                                            <span>{%=o.formatFileSize(file.size)%}</span>
                                                        </td> {% if (file.error) { %}
                                                        <td class="error" width="20%" colspan="2">
                                                            <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else if (o.files.valid && !i) { %}
                                                        <td>
                                                            <p class="size">{%=o.formatFileSize(file.size)%}</p>
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                            </div>
                                                        </td> {% } else { %}
                                                        <td colspan="2"></td> {% } %}
                                                        <td class="cancel" width="10%" align="right">{% if (!i) { %}
                                                            <button class="btn btn-sm red cancel">
                                                                <i class="fa fa-ban"></i>
                                                                <span>Cancel</span>
                                                            </button> {% } %}</td>
                                                    </tr> {% } %} </script>
                                                <!-- The template to display files available for download -->
                                                <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                    <tr class="template-download fade"> {% if (file.error) { %}
                                                        <td class="name" width="30%">
                                                            <span>{%=file.name%}</span>
                                                        </td>
                                                        <td class="size" width="40%">
                                                            <span>{%=o.formatFileSize(file.size)%}</span>
                                                        </td>
                                                        <td class="error" width="30%" colspan="2">
                                                            <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else { %}
                                                        <td class="name" width="30%">
                                                            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                                                        </td>
                                                        <td class="size" width="40%">
                                                            <span>{%=o.formatFileSize(file.size)%}</span>
                                                        </td>
                                                        <td colspan="2"></td> {% } %}
                                                        <td class="delete" width="10%" align="right">
                                                            <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" {% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr> {% } %} </script>
                                                <div class="inbox-compose-btn">
                                                    <button class="btn green"><i class="fa fa-check"></i>Kirim</button>
                                                    <a href="{{ route('pesan.index') }}" class="btn default inbox-discard-btn">Batal</a>
                                                    <button onclick="simpandraft()" class="btn default">Draft</button>
                                                </div>
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

    function simpandraft()
    {
        $('.inbox-compose').attr('action','{{ route("pesan.simpan-draft") }}');
        $('.inbox-compose').submit();
    }
</script>
@endsection