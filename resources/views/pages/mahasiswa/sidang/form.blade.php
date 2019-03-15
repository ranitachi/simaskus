@extends('layouts.master')
@section('title')
    <title>Tambah Data Pengajuan Sidang :: SIMA-sp</title>
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
                    <a href="{{url('skripsi-pengajuan-admin')}}">Pengajuan</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Pengjauan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Daftar Sidang 
            <small>Form</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <a href="{{url('daftar-sidang')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('daftar-sidang') : url('daftar-sidang/'.$id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                @if (isset($penguji[$id]))
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($penguji[$id] as $kp => $vp)
                                        <div class="col-md-4">
                                            <div class="form-group has-success">
                                                <label class="control-label">Nama Usulan Penguji {{$no}}</label>
                                                <select class="bs-select form-control has-success" data-placeholder="Pilih Penguji" id="penguji1" name="penguji[]">
                                                    {{-- <option value="-1">-Pilih Penguji-</option> --}}
                                                    @foreach ($dosen as $i => $v)
                                                        @if ($v->id==$vp->penguji_id)
                                                            <option value="{{$v->id}}" selected="selcted">{{$v->nama}}</option>     
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                @else
                                    <div class="col-md-12" style="margin-bottom:20px;">
                                        <h3>Unggah Berkas Untuk Daftar Sidang <b>{{$det->jenispengajuan->jenis}}</b></h3>
                                    </div>
                                @endif
                                @if (isset($mhs->programstudi->nama_program_studi))
                                    @if (strpos($mhs->programstudi->nama_program_studi,'inter')!==false)
                                    
                                        <div class="col-md-4">
                                            <div class="form-group has-success">
                                                <label class="control-label">Nilai IELTS</label>
                                                <input type="text" name="nilai_ielts" id="nilai_ielts" class="form-control"><br>
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-success">
                                                <label class="control-label">Upload Nilai IELTS</label>
                                                <input type="file" name="file_ielts" id="file_ielts" class="form-control"><br>
                                            </div> 
                                        </div>
                                    @endif
                                @endif
                                {{--<div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Usulan Penguji 2</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Penguji" id="penguji2" name="penguji[]">
                                            <option value="-1">-Pilih Penguji-</option>
                                            @foreach ($dosen as $i => $v)
                                                <option value="{{$v->id}}">{{$v->nama}}</option>      
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Usulan Penguji 3</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Penguji" id="penguji3" name="penguji[]">
                                            <option value="-1">-Pilih Penguji-</option>
                                            @foreach ($dosen as $i => $v)
                                                <option value="{{$v->id}}">{{$v->nama}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group has-success">
                                        @if (isset($mhs->programstudi->jenjang))
                                            @if ($mhs->programstudi->jenjang=='S3')
                                                <label class="control-label">Upload Buku Ujian (.doc)</label>
                                            @else
                                                <label class="control-label">Upload Dokumen (.doc)</label>
                                            @endif
                                        @else
                                            <label class="control-label">Upload Dokumen (.doc)</label>
                                        @endif
                                        <input type="file" name="dokumen['dokumen_doc']" accept=".doc,.docx" id="documen_doc" class="form-control"><br>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group has-success">
                                         @if (isset($mhs->programstudi->jenjang))
                                            @if ($mhs->programstudi->jenjang=='S3')
                                                <label class="control-label">Upload Buku Ujian (.pdf)</label>
                                            @else
                                                <label class="control-label">Upload Dokumen (.pdf)</label>
                                            @endif
                                        @else
                                            <label class="control-label">Upload Dokumen (.pdf)</label>
                                        @endif
                                        <input type="file" name="dokumen['dokumen_pdf']" id="documen_pdf" accept=".pdf" class="form-control"><br>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload Dokumen (.ppt *optional)</label>
                                        <input type="file" name="dokumen['dokumen_ppt']" id="documen_ppt" accept=".ppt,.pptx" class="form-control"><br>
                                    </div>
                                </div>

                            </div>
                            @if ($det->jenispengajuan->keterangan=='S3')
                                @if (str_slug($det->jenispengajuan->jenis)=='sidang-promosi')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <legend>Publikasi</legend>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                                <div class="form-group">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-3">
                                                            Judul Publikasi
                                                        </div>
                                                        <div class="col-md-2">
                                                            Nama Publisher
                                                        </div>
                                                        <div class="col-md-2">
                                                            Penulis
                                                        </div>
                                                        <div class="col-md-2">
                                                            URL
                                                        </div>
                                                        <div class="col-md-2">
                                                            File Bukti Publikasi
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group" id="dynamic_form">
                                                    
                                                    <div class="row">
                                                        
                                                        <div class="col-md-3">
                                                            <input type="text" name="judul" id="p_name" placeholder="Judul Publikasi" class="form-control">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Nama Publisher">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" name="penulis" id="penulis" placeholder="Penulis">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" name="url" id="url" placeholder="URL">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="file" class="form-control" name="file" id="file" placeholder="File">
                                                        </div>
                                                        <div class="button-group">
                                                            <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus-circle"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-close"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                @endif
                            @endif
                            {{-- <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload daftar Bimbingan dari SIAK-NG (*optional)</label>
                                        <input type="file" name="dokumen['bukti_bimbingan']" id="bimbingan_siak" class="form-control"><br>
                                        <span class="label label-danger">Info</span> <small>Upload bukti daftar bimbingan dalam format jpg, jpeg, png atau PDF. Maksimal ukuran file 10 MB. <br><a href="javascript:contohbuktibimbingan()">Klik disini untuk melihat contoh</a></small>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload Asistensi Bimbingan (*optional)</label>
                                        <input type="file" name="dokumen['bimbingan_asistensi']" id="bimbingan_asistensi" class="form-control"><br>
                                    </div>
                                </div>
                                
                                <!--/span-->
                            </div> --}}
                        </div>
                        <div class="form-actions">
                            <a href="{{URL::previous()}}" class="btn default">Batal</a>
                            <button type="button" id="simpan" class="btn blue">
                                <i class="fa fa-save"></i> Simpan</button>
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

<script src="{{asset('js/dynamic-form.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
		        limit:10,
		        formPrefix : "dynamic_form",
		        normalizeFullForm : false
		    });

        	//dynamic_form.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

		    $("#dynamic_form #minus5").on('click', function(){
		    	var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
		    	if (initDynamicId === 2) {
		    		$(this).closest('#dynamic_form').next().find('#minus5').hide();
		    	}
		    	$(this).closest('#dynamic_form').remove();
		    });
             

        $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id);
        });

        $('.wysihtml5').wysihtml5({
                "stylesheets": ["{{asset('assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css')}}"]
        });
        // swal("Good job!", "You clicked the button!", "success")
        $('#simpan').on('click',function(event){
            //$('#form-pengajuan').submit();
            var penguji1=$('#penguji1').val();
            var penguji2=$('#penguji2').val();
            
            if( document.getElementById("documen_doc").files.length == 0 ){
                pesan("Dokumen DOC Belum Di Upload",'error');
            }
            else if( document.getElementById("documen_pdf").files.length == 0 ){
                pesan("Dokumen PDF Belum Di Upload",'error');
            }
           
            else
            {
                var values = {};
				$.each($('form').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				//console.log(values)
        		event.preventDefault();
                $('#form-pengajuan').submit();
            }
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