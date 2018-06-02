@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Pengajuan Skripsi' :'Edit Data Pengajuan Skripsi'}} :: SIMASKUS</title>
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
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('skripsi-pengajuan-admin') : url('skripsi-pengajuan-admin/'.$id) }}" class="horizontal-form" id="form-mahasiswa" method="POST">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Judul Pengajuan</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Judul" name="judul" id="judul">
                                            <option value="-1">-Pilih Judul-</option>
                                            @foreach ($judul as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->judul_id==$v->id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->judul}}</option>    
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->judul}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$v->id}}">{{$v->judul}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing</label>
                                        <div id="prog_studi">
                                            <select class="form-control select2-multiple" multiple data-placeholder="Pilih Dosen Pembimbing" name="dosen[]" id="dosen">
                                                @foreach ($dosen as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->dosen_id==$v->id)
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
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Jenis Pengajuan</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Jenis" id="jenis_id" name="jenis_id">
                                            <option value="-1">-Pilih Jenis-</option>
                                            @foreach ($jenispengajuan as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->jenis_id==$v->id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->judul}}</option>    
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Judul Tugas Akhir</label>
                                        <input type="text" id="judul_ta" name="judul_ta" class="form-control input-circle" placeholder="Judul Tugas Akhir" value="{{$id==-1 ? '' : $det->judul}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                           
                        
                        </div>
                        <div class="form-actions right">
                            <a href="{{URL::previous()}}" class="btn default">Batal</a>
                            <button type="button" id="simpan" class="btn blue">
                                <i class="fa fa-check"></i> Simpan</button>
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
<script>
    $(document).ready(function(){
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id);
        });
        // swal("Good job!", "You clicked the button!", "success")
        $('#simpan').on('click',function(){
            var npm=$('#npm').val();
            var nama=$('#nama').val();
            var departemen=$('#departemen').val();
            var program_studi=$('#program_studi').val();
            if(npm=='')
            {
                pesan("NPM Harus Diisi",'error');
                $('#npm').focus();
            }
            else if(nama=='')
            {
                pesan("Nama Mahasiswa Harus Diisi",'error');
                $('#nama').focus();
            }    
            else if(departemen=='')
            {
                pesan("Departemen harus dipilih",'error');
                $('#departemen').focus();
            }
            else if(program_studi=='')
            {
                pesan("Program Studi harus dipilih",'error');
                $('#program_studi').focus();
            }
            else
            {
                swal({
                    title: "Apakah Anda Yakin",
                    text: "Data yang diinput sudah benar, dan ingin di Simpan ?",
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
                        //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        $('#form-mahasiswa').submit();
                    } 
                });
            }
        });
    });
</script>
@endsection