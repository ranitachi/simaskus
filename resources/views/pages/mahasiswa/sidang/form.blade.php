@extends('layouts.master')
@section('title')
    <title>Tambah Data Pengajuan Sidang :: SIMASKUS</title>
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
                    <span>Form Pengauan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan 
            <small>{{$id==-1 ? 'Tambah Data' :'Edit Data'}}</small>
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
                                @if (count($penguji)!=0)
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($penguji as $kp => $vp)
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
                                    <div class="col-md-12">
                                        <h3>Nama Penguji Belum Diajukan dan Diinput</h3>
                                    </div>
                                @endif
                                {{-- <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Usulan Penguji 1</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Penguji" id="penguji1" name="penguji[]">
                                            <option value="-1">-Pilih Penguji-</option>
                                            @foreach ($dosen as $i => $v)
                                                <option value="{{$v->id}}">{{$v->nama}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
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
                                        <label class="control-label">Upload Dokumen (.doc)</label>
                                        <input type="file" name="dokumen['dokumen_doc']" id="documen_doc" class="form-control"><br>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload Dokumen (.pdf)</label>
                                        <input type="file" name="dokumen['dokumen_pdf']" id="documen_pdf" class="form-control"><br>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload Dokumen (.ppt *optional)</label>
                                        <input type="file" name="dokumen['dokumen_ppt']" id="documen_ppt" class="form-control"><br>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
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
                            </div>
                            
                        <div class="form-actions pull-right">
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
<div id="toolbar">
  <a data-wysihtml5-command="bold">bold</a>
  <a data-wysihtml5-command="italic">italic</a>
  <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">H1</a>
  <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">P</a>
 </div>
@section('footscript')
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function(){
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
        $('#simpan').on('click',function(){
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