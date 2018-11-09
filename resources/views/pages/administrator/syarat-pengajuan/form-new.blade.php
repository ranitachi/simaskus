@extends('layouts.master')
@section('title')
    <title>Data Syarat Pengajuan :: SIMA-sp</title>
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
                    <span>Data Syarat Pengajuan</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Syarat Pengajuan
            <small>Tambah</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            
            <form action="{{$id==-1 ? url('master-syaratpengajuan') : url('master-syaratpengajuan/'.$id) }}" class="horizontal-form" id="form-syarat" method="POST">
                {{ csrf_field() }}
                @if ($id!=-1)
                    {{ method_field('PATCH') }}
                @endif
                <div class="form-body">
                    
                    
                        <!--/span-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label class="control-label">Departemen</label>
                                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen_id" id="departemen_id">
                                        <option value="-1">-Pilih Departemen-</option>
                                        @foreach ($departemen as $i => $v)
                                            @if ($id!=-1)
                                                @if ($det->departemen_id==$v->id)
                                                    <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                                @else
                                                    <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                @endif
                                            @else
                                                <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label">Persyaratan</label>
                                <textarea name="syarat" id="syarat" class="form-control input-circle">{{$id==-1 ? '' : $det->syarat}}</textarea>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="form-actions right">
                            <a href="{{URL::previous()}}" class="btn default">Batal</a>
                            <button type="button" id="simpan" class="btn blue">
                                <i class="fa fa-check"></i> Simpan
                            </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
@endsection

@section('footscript')
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('syarat',{height:300});

        $('#simpan').on('click',function(){
            var departemen_id=$('#departemen_id').val();
            var syarat=CKEDITOR.instances['syarat'].getData();
            if(departemen_id==-1)
            {
                var ps="Departemen Belum Dipilih";
                swal("Error", ps, "error");
            }
            else if(syarat=='')
            {
                var ps="Data Persyaratan Belum Diisi";
                swal("Error", ps, "error");
            }
            else
            {
                $('#form-syarat').submit();
            }
        });
    });

 
   
</script>
@endsection