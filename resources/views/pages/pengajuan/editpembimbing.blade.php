@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Spesial :: SIMA-sp</title>
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
                    <span>Detail Pengajuan Mata Kuliah Spesial</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan Mata Kuliah Spesial
            <small>Detail</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                @if (Auth::user()->kat_user==1)
                    <a class="btn btn-info btn-md pull-right" href="{{url('data-bimbingan')}}"><i class="fa fa-chevron-left"></i> Data Bimbingan</a>
                @endif
            </div>
        </div>
        <div class="portlet-body">

            <div class="tabbable-custom ">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab_5_1" data-toggle="tab"> Edit Data Pembimbing</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <form action="{{url('edit-pembimbing-simpan/'.$idpengajuan) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                        <div class="tab-pane active" id="tab_5_1">
                            {{ csrf_field() }}
                            <div class="row" style="padding:20px;">
                                <div class="col-md-12" style="border-bottom:1px solid #ccc;">
                                    <h4>Pembimbing Saat Ini</h4>
                                    <ul>
                                        @foreach ($pembimbing as $item)
                                            <li><b>{{$item->dosen->nama}}</b></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h4>Pembimbing Baru</h4>
                                    <div class="form-group has-success">
                                        <label class="control-label">Status Dosen Pembimbing</label>
                                        <select class="form-control" data-placeholder="Status Dosen Pembimbing" name="pengambilan_ke" id="pengambilan_ke" style="width:100%" onchange="cekstatusdosen({{$jenis_id}},this.value)">
                                                <option value="0">-Pilih-</option>
                                                <option value="1">Dosen Departemen</option>
                                                <option value="2">Seluruh Dosen Fakultas</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12"> 
                                        <div id="jlh-pembimbing"></div>
                                    </div>
                                    <div class="col-md-7"> 
                                        <div id="kolom_topik"></div>
                                    </div>  
                            </div>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').hide();

        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
        $('#simpan').on('click',function(){
           swal({
                    title: "Apakah Anda Yakin",
                    text: "Data Pembimbing yang Diinput Sudah Benar ?",
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
                        $('#form-pengajuan').submit();
                    } 
                });
            
        });
    });
    function cekstatusdosen(jenis,val)
    {
        if(val==1)
        {
            $('#jlh-pembimbing').load('{{url("jlh_pembimbing")}}/'+jenis+'/1/{{$idpengajuan}}');
        }
        else{
            $('#jlh-pembimbing').load('{{url("jlh_pembimbing")}}/'+jenis+'/'+val+'/{{$idpengajuan}}');
        }

    }
</script>
@endsection
