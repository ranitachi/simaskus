@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Grup Kerja Praktek' :'Edit Grup Kerja Praktek'}} :: SIMA-sp</title>
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
                    <a href="{{url('data-kp')}}">Kerja Praktek</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Grup</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Form Grup 
            <small>{{$id==-1 ? 'Kerja Praktek' :'Kerja Praktek'}}</small>
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
                    <form action="{{$id==-1 ? url('data-kp-grup/'.$idkp.'/'.$idmhs.'/-1') : url('data-kp-grup/'.$idkp.'/'.$idmhs.'/'.$id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Grup</label>
                                        <input type="text" id="nama_grup" name="nama_grup" class="form-control input-circle" placeholder="Nama Grup (Wajib Diisi)" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing 1</label>
                                        <div id="prog_studi">
                                            <select class="form-control select2"data-placeholder="Pilih Dosen" name="dospem[]" id="dosen">
                                                <option value="0">Pilih</option>
                                                @foreach ($dosen as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->dospem1==$v->id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>    
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->nama}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$v->id}}">{{$v->nama}}</option>
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Ketua Kelompok</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Ketua Kelompok" id="ketua_kelompok" name="ketua_kelompok">
                                            <option value="-1">Pilih</option>
                                            @foreach ($anggota as $item)
                                                <option value="{{$item->mahasiswa_id}}">{{$item->mahasiswa->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing 2</label>
                                        <div id="prog_studi">
                                            <select class="form-control select2"data-placeholder="Pilih Dosen" name="dospem[]" id="dosen">
                                                <option value="0">Pilih</option>
                                                @foreach ($dosen as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->dospem1==$v->id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>    
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->nama}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$v->id}}">{{$v->nama}}</option>
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Anggota Kelompok</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                                            <option value="-1">Pilih</option>
                                            @foreach ($anggota as $item)
                                                <option value="{{$item->mahasiswa_id}}">{{$item->mahasiswa->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Anggota Kelompok</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Anggota Kelompok" id="anggota_kelompok" name="anggota[]">
                                            <option value="-1">Pilih</option>
                                            @foreach ($anggota as $item)
                                                <option value="{{$item->mahasiswa_id}}">{{$item->mahasiswa->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
@section('footscript')
    <div id="toolbar">
      <a data-wysihtml5-command="bold">bold</a>
      <a data-wysihtml5-command="italic">italic</a>
      <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">H1</a>
      <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">P</a>
     </div>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
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