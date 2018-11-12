@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Khusus :: SIMA-sp</title>
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
                    <span>Detail Pengajuan Mata Kuliah Khusus</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Pengajuan Mata Kuliah Khusus
            <small>Detail</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="tabbable-custom ">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab_5_1" data-toggle="tab"> Informasi {{strpos($pengajuan->jenispengajuan->jenis,'Skripsi')!==false ? 'Skripsi' : ''}} </a>
                    </li>
                    <li>
                        <a href="#tab_5_2" data-toggle="tab"> Bimbingan </a>
                    </li>
                    <li>
                        <a href="#tab_5_3" data-toggle="tab"> ACC Sidang </a>
                    </li>
                    @if (!is_null($acc))
                    <li>
                        <a href="#tab_5_4" data-toggle="tab"> Pengajuan Penguji </a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_5_1">
                        
                        <form role="form" class="horizontal-form" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Jenis Pengajuan</label>
                                        <input type="text" readonly  id="ipk_terakhir" name="ipk_terakhir" class="form-control input-circle" placeholder="IPK Terakhir"  style="" value="{{$pengajuan->jenispengajuan->jenis}}">
                                    </div>
                                </div>
                                <!--/span-->
                                {{-- <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">IPK Terakhir</label>
                                        <input type="text" readonly  id="ipk_terakhir" name="ipk_terakhir" class="form-control input-circle" placeholder="IPK Terakhir"  style="" value="{{$pengajuan->ipk_terakhir}}">
                                    </div>
                                </div>
                                
                                <!--/span-->
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Jumlah SKS Lulus</label>
                                        <input type="text" readonly  id="jumlah_sks_lulus" name="jumlah_sks_lulus" class="form-control input-circle" placeholder="Jumlah SKS Lulus"  style="width:50%;" value="{{$pengajuan->jumlah_sks_lulus}}">
                                    </div>
                                </div> --}}
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Topik Yang Diajukan</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$pengajuan->topik_diajukan}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Bidang Seminar/Skripsi/Tesis</label>
                                        <input type="text" readonly  id="bidang" name="bidang" class="form-control input-circle" placeholder="Bidang Seminar/Skripsi/Tesis" value="{{$pengajuan->bidang}}">
                                    </div>
                                </div> --}}
                                <!--/span-->
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Skema Penelitian</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$pengajuan->skema}}">
                                    </div>
                                </div>
                                <!--/span-->
                            {{-- </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Judul (Bahasa Indonesia)</label>
                                        <input type="text" readonly  id="judul_ind" name="judul_ind" class="form-control input-circle" placeholder="Judul (Bahasa Indonesia)" value="{{$pengajuan->judul_ind}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Judul (Bahasa Inggris)</label>
                                        <input type="text" readonly  id="judul_eng" name="judul_eng" class="form-control input-circle" placeholder="Judul (Bahasa Inggris)" value="{{$pengajuan->judul_eng}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                           
                            <div class="row"> --}}
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Deskripsi/Rencana</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="deskripsi_rencana">{{$pengajuan->deskripsi_rencana}}</textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                {{-- <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Abstrak (Indonesia)</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="abstrak_ind">{{$pengajuan->abstrak_ind}}</textarea>
                                        <small>* Bisa Menyusul</small>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Abstrak (Inggris)</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="abstrak_eng">{{$pengajuan->abstrak_eng}}</textarea>
                                        <small>* Bisa Menyusul</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     &nbsp;
                                </div> --}}
                                <!--/span-->
                                
                                <!--/span-->
                            </div>
                           
                        
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Pengajuan Ke</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$pengajuan->pengambilan_ke}}">  
                                    </div>
                                </div>
                            <div class="col-md-6"> 
                                @php
                                    $pembinging=\App\Model\PivotBimbingan::where('mahasiswa_id',$pengajuan->mahasiswa_id)->with('dosen')->get();
                                @endphp
                                    @foreach ($pembinging as $key=>$item)
                                        <div class="form-group has-success">
                                            <label class="control-label">Dosen Pembimbing {{$key+1}}</label>
                                            @if ($item->status==0)
                                                <i class="fa fa-ban" style="color:red"></i> <i><small>Menunggu Persetujuan Dosen</small></i>
                                            @else
                                                <i class="fa fa-check" style="color:green"></i>
                                            @endif
                                            <input type="text" readonly  id="pembimbing_{{$key+1}}" name="pembimbing_{{$key+1}}" class="form-control input-circle" placeholder="Dosen Pembimbing" value="{{isset($item->dosen->nama) ? $item->dosen->nama : ''}}">
                                        </div>
                                   @endforeach
                            </div>

                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Ketua Kelompok Ilmu</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" value="{{isset($pengajuan->dosenketua->nama) ? $pengajuan->dosenketua->nama : ''}}">
                                    </div>
                                </div>
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing Sebelumnya (Buat yang mengulang)</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle"  value="{{isset($pengajuan->pembimbing_sebelum->nama) ? $pengajuan->pembimbing_sebelum->nama : ''}}">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Alasan Mengulang</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="alasan_mengulang">{{$pengajuan->alasan_mengulang}}</textarea>
                                    </div>
                                </div>
                            <div class="col-md-6"> 
                                    
                            </div>
                        </div> --}}
                        @if ($pengajuan->pengambilan_ke>1)
                            <div class="row">
                                
                                <div class="col-md-6"> 
                                        <div class="form-group has-success">
                                            <label class="control-label">Dosen Pembimbing Sebelumnya (Buat yang mengulang)</label>
                                            <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle"  value="{{isset($pengajuan->pembimbing_sebelum->nama) ? $pengajuan->pembimbing_sebelum->nama : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group has-success">
                                            <label class="control-label">Alasan Mengulang</label>
                                            <textarea readonly  class="wysihtml5 form-control" rows="4" name="alasan_mengulang">{{$pengajuan->alasan_mengulang}}</textarea>
                                        </div>
                                    </div>
                            </div>
                        @endif
                        </form>
                    
                    </div>
                    <div class="tab-pane" id="tab_5_2">
                        <div class="row">
                            <div class="col-sm-12" id="data-bimbingan"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_5_3">
                        <div class="row">
                            @include('pages.dosen.bimbingan.acc-sidang')
                        </div>
                    </div>
                    @if (!is_null($acc))
                    
                    <div class="tab-pane" id="tab_5_4">
                        <div class="row">
                            <div class="col-sm-12" style="min-height:300px;">
                                @include('pages.dosen.bimbingan.pengajuan-penguji')
                                
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('.select2').select2();
        
        $('#loader').hide();
        loaddatabimbingan('{{$mahasiswa_id}}');
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }

        var ps2= "{{Session::has('fail')}}";
        if(ps2!="")
        {
            swal("Gagal", "{{Session::get('fail')}}", "danger")
        }
    });

    function loaddatabimbingan(id)
    {
        $('#loader').show();
        $('#data-bimbingan').load('{{url("bimbingan-data-dosen")}}/'+id,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    
    function setujui(id,mahasiswa_id)
    {
       
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menyetujui Data Bimbingan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Setujui",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("data-bimbingan-status")}}/'+id+'/1',
                    dataType : 'JSON'
                }).done(function(){
                    loaddatabimbingan(mahasiswa_id);
                    swal("Sukses!", "Data Data Bimbingan DI Setujui", "success");
                }).fail(function(){
                    swal("Fail!", "Data Bimbingan Ditolak", "danger");
                });
            } 
        });
    }
    function tolak(id,mahasiswa_id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menolak Data Bimbingan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("data-bimbingan-status")}}/'+id+'/2',
                    dataType : 'JSON'
                }).done(function(){
                    loaddatabimbingan(mahasiswa_id);
                    swal("Di Tolak!", "Data Data Bimbingan DI Setujui", "danger");
                });
            } 
        });
    }
    function hapus(id,mahasiswa_id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Menghapus Data Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("pengajuan-hapus")}}/'+id,
                    dataType : 'JSON'
                }).done(function(){
                    loaddatabimbingan(mahasiswa_id);
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }

</script>
@endsection