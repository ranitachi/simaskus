@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Publikasi Ilmiah' :'Edit Data Publikasi Ilmiah'}} :: SIMA-sp</title>
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
                    <a href="{{url('skripsi-pengajuan-admin')}}">Publikasi Ilmiah</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Publikasi</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Publikasi 
            
            <small>{{$id==-1 ? 'Tambah Data' :'Edit Data'}}</small>
            
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="" style="padding-bottom:30px;margin-bottom:50px;">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            <a href="{{URL::previous()}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                        <form action="{{url('publikasi-simpan/'.$id)}}" class="horizontal-form" id="form-publikasi" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}
                      
                        <div class="form-body">
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Judul Publikasi</label>
                                        <input type="text" id="judul" name="judul" class="form-control input-circle" placeholder="Judul Publikasi" value="{{$id==-1 ? '' : $det->judul}}">
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label">Lokasi Publikasi</label>
                                        <input type="text" id="lokasi_publikasi" name="lokasi_publikasi" class="form-control input-circle" placeholder="Lokasi Publikasi" value="{{$id==-1 ? '' : $det->lokasi_publikasi}}">
                                    </div>
                                     
                                    <div class="form-group has-success">
                                        <label class="control-label">Deskripsi</label>
                                        <textarea class="wysihtml5 form-control" id="deskripsi" rows="6" name="deskripsi">{{$id!=-1 ? $det->deskripsi : ''}}</textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">URL Publikasi</label>
                                        <input type="text" id="url" name="url" class="form-control input-circle" placeholder="http://domain.com" value="{{$id==-1 ? '' : $det->url}}">
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload File Publikasi</label><small>&nbsp;&nbsp;*Format Dokumen (DOC,DOCX,PDF)</small>
                                        <input type="file" id="file" name="file" class="form-control" accept=".doc,.docx,.pdf"><br>
                                        
                                    </div>
                                </div>
                                <!--/span-->
                            
                                @php
                                    $penulis=array();
                                    if($id!=-1)
                                        $penulis=explode(';',$det->penulis);
                                @endphp
                                <div class="col-md-2">
                                     <div class="form-group has-success">
                                        <label class="control-label">Jumlah Penulis</label>
                                        <select class="form-control select2" data-placeholder="Jumlah Penulis" name="jlh_penulis" id="jlh_penulis">
                                            @for($x=1;$x<=10;$x++)
                                                @if ($id!=-1)
                                                    @if ((count($penulis)-1) ==$x)
                                                        <option value="{{$x}}" selected="selected">{{$x}}</option>
                                                    @else
                                                        <option value="{{$x}}">{{$x}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$x}}">{{$x}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                        @if ($id!=-1)
                                            @php
                                                
                                                foreach($penulis as $k=>$v)
                                                {
                                                    if($v!='')
                                                    {
                                                        echo '<div class="form-group has-success">
                                                            <label class="control-label">Nama Penulis '.($k+1).'</label>
                                                            <input type="text" id="penulis" name="penulis[]" class="form-control input-circle" placeholder="Nama Penulis" value="'.$v.'">
                                                            </div>';
                                                    }
                                                }
                                            @endphp
                                        @else
                                            <div class="form-group has-success">
                                                <label class="control-label">Nama Penulis 1</label><small>&nbsp;&nbsp;*Isi Nama Lengkap Dengan Gelar</small>
                                                <input type="text" id="penulis" name="penulis[]" class="form-control input-circle" placeholder="Nama Penulis" value="{{Auth::user()->name}}">
                                            </div>
                                         @endif
                                         <div id="jlhpenulis"></div>
                                   
                                </div>
                                <!--/span-->
                               
                                <!--/span-->
                            </div>
                        </div>
                        <hr>
 
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="form-actions " style="width:100%;float:right">
                                    
                                    <button type="button" id="simpan" class="btn blue pull-right">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                    <a href="{{URL::previous()}}" class="btn default pull-right">Batal</a>
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
<style>
.select2-selection__choice
{
    margin-bottom:20px !important;
}
</style>
@php
    $nama=Auth::user()->name;
@endphp
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>
    function submit()
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Yang Diinput Sudah Benar ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $('#form-publikasi').submit();
            } 
        });
    }
    $(document).ready(function(){
        // swal("Deleted!", "Data Berhasil Di Hapus", "success");
        // swal("Fail!", "Hapus Data Gagal", "danger");
        var id="{{$id}}";
        $('#simpan').on('click',function(){
            var judul=$('#judul').val();
            var lokasi_publikasi=$('#lokasi_publikasi').val();
            var url=$('#url').val();
            var deskripsi=$('#deskripsi').val();
            var file=$('#file').val();
            if(judul=='')
                pesan("Judul Publikasi Belum Di Isi",'error');
            else if(lokasi_publikasi=='')
                pesan("Lokasi Publikasi Belum Di Isi",'error');
            else if(deskripsi=='')
                pesan("Dekskripsi Publikasi Belum Di Isi",'error');
            else
            {
                if(id==-1)
                {
                    if(document.getElementById("file").files.length == 0)
                        pesan("File Publikasi Tidak Boleh Kosong",'error');
                    else
                        submit()
                }
                else
                    submit()
                
            }
        });



        $('.wysihtml5').wysihtml5({
                "stylesheets": ["{{asset('assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css')}}"]
        });
        $('#jlh_penulis').on('change',function(){
            var jlh=parseInt($(this).val());
            var input='';
            var id='{{$id}}';
            if(jlh>=2)
            {   
                if(id==-1)
                {
                    var j=2;
                }
                else
                    var j='{{count($penulis)}}';
                    for(i=j ; i<=jlh;i++)
                    {
                        input+='<div class="form-group has-success">\
                                            <label class="control-label">Nama Penulis '+i+'</label>\
                                            <input type="text" id="penulis" name="penulis[]" class="form-control input-circle" placeholder="Nama Penulis" value="{{$nama}}">\
                                        </div>';
                    }
                
            }
            $('#jlhpenulis').html(input)
            
        });
    });

</script>
@endsection