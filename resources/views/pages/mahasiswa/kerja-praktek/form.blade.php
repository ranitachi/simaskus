@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Pengajuan Kerja Praktek' :'Edit Data Pengajuan Kerja Praktek'}} :: SIMA-sp</title>
    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
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
                    <a href="{{url('data-kp')}}">Pengajuan</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Pengajuan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan 
            <small>{{$id==-1 ? 'Tambah Kerja Praktek' :'Edit Kerja Praktek'}}</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        @php
            $path='';
        @endphp
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <a href="{{url('data-kp')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('data-kp-proses/-1') : url('data-kp-proses/'.$id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tahun Akademik</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Tahun Akademik" id="tahun_ajaran" name="tahun_ajaran">
                                            <option value="-1">-Pilih Tahun Akademik-</option>
                                            @foreach ($ta as $i => $v)
                                                @if (strpos($v,date('Y')))
                                                    @if ($id!=-1)
                                                        @if ($det->tahunajaran_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Mata Kuliah Spesial</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Jenis" id="jenis_id" name="jenis_id">
                                            {{-- <option value="-1">-Pilih Jenis-</option> --}}
                                            @foreach ($jenispengajuan as $i => $v)
                                                @if (strpos(strtolower($v->jenis),'kerja praktek')!==false) 
                                                    @if ($id!=-1)
                                                        @if ($det->jenis_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->jenis}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            
                            {{-- <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload daftar Bimbingan dari SIAK-NG
                                        </label>
                                        <input type="file" name="bukti_bimbingan" class="form-control"><br>
                                        @if ($id!=-1)
                                            <small><i>(* Biarkan Kosong jika tidak akan diganti)</i></small><br><br>
                                        @endif
                                        <span class="label label-danger">Info</span> <small>Upload bukti daftar bimbingan dalam format jpg, jpeg, png atau PDF. Maksimal ukuran file 10 MB. <br><a href="javascript:contohbuktibimbingan()">Klik disini untuk melihat contoh</a></small>
                                    </div>
                                </div> --}}
                        </div>

                        @if ($id!=-1)    
                            {{-- <div class="row" style="margin-bottom:30px;">
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                            <label class="control-label">Daftar Bimbingan dari SIAK-NG
                                            </label>
                                    </div>        
                                    {{-- {{ storage_path('app/'.$det->file_riwayat_akademis) }} --}}
                                    @php
                                        // $path=asset('../storage/app/'.$det->file_riwayat_akademis);
                                    @endphp
                                    {{-- <div id="example1"></div> --}}
                                
                                {{-- </div>
                            </div> --}}
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-actions pull-right">
                                    <a href="{{URL::previous()}}" class="btn default">Batal</a>
                                    <button type="button" id="simpan" class="btn blue">
                                        <i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footscript')
    
<script src="{{asset('js/pdfobject.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>PDFObject.embed("{{asset($path)}}", "#example1");</script>
<script>

    $(document).ready(function(){
       
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id);
        });

        $('.wysihtml5').wysihtml5({
                "stylesheets": ["{{asset('assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css')}}"]
        });
        // swal("Good job!", "You clicked the button!", "success")
        $('#simpan').on('click',function(){
            $('#form-pengajuan').submit();
            // var npm=$('#npm').val();
            // var nama=$('#nama').val();
            // var departemen=$('#departemen').val();
            // var program_studi=$('#program_studi').val();
            // if(npm=='')
            // {
            //     pesan("NPM Harus Diisi",'error');
            //     $('#npm').focus();
            // }
            // else if(nama=='')
            // {
            //     pesan("Nama Mahasiswa Harus Diisi",'error');
            //     $('#nama').focus();
            // }    
            // else if(departemen=='')
            // {
            //     pesan("Departemen harus dipilih",'error');
            //     $('#departemen').focus();
            // }
            // else if(program_studi=='')
            // {
            //     pesan("Program Studi harus dipilih",'error');
            //     $('#program_studi').focus();
            // }
            // else
            // {
            //     swal({
            //         title: "Apakah Anda Yakin",
            //         text: "Data yang diinput sudah benar, dan ingin di Simpan ?",
            //         type: "warning",
            //         showCancelButton: true,
            //         confirmButtonClass: "btn-info",
            //         confirmButtonText: "Ya, Simpan",
            //         cancelButtonText: "Tidak",
            //         closeOnConfirm: true,
            //         closeOnCancel: true
            //     },
            //     function(isConfirm) {
            //         if (isConfirm) {
            //             //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            //             $('#form-mahasiswa').submit();
            //         } 
            //     });
            // }
        });
    });

    function contohbuktibimbingan()
    {
        var url='{{asset("img/buktiBimbingan.jpg")}}';
        $('.modal-title').text('Contoh Bukti Bimbingan');
        $('.modal-body').html("<img src='"+url+"' style='width:100%'>");
        $('#ajax').modal('show');
    }
</script>
@endsection