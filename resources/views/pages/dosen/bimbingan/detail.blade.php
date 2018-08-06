@extends('layouts.master')
@section('title')
    <title>Data Pengajuan Mata Kuliah Khusus :: SIMASKUS</title>
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
                        <a href="#tab_5_1" data-toggle="tab"> Informasi {{$pengajuan->jenispengajuan->jenis}} </a>
                    </li>
                    <li>
                        <a href="#tab_5_2" data-toggle="tab"> Bimbingan </a>
                    </li>
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
                                <div class="col-md-6">
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
                                </div>
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
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Bidang Seminar/Skripsi/Tesis</label>
                                        <input type="text" readonly  id="bidang" name="bidang" class="form-control input-circle" placeholder="Bidang Seminar/Skripsi/Tesis" value="{{$pengajuan->bidang}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Skema Penelitian</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$pengajuan->skema}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
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
                           
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Deskripsi/Rencana</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="deskripsi_rencana">{{$pengajuan->deskripsi_rencana}}</textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
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
                                </div>
                                <!--/span-->
                                
                                <!--/span-->
                            </div>
                           
                        
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Pengambilan Ke</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$pengajuan->pengambilan_ke}}">  
                                    </div>
                                </div>
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing 1</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{isset($pengajuan->dospem_1->nama) ? $pengajuan->dospem_1->nama : ''}}">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing 2</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{isset($pengajuan->dospem_1->nama) ? $pengajuan->dospem_2->nama : ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Pembimbing 3</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{isset($pengajuan->dospem_1->nama) ? $pengajuan->dospem_3->nama : ''}}">
                                    </div>
                                </div>
                        

                        </div>
                        <div class="row">
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
                        </div>
                        </form>
                    
                    </div>
                    <div class="tab-pane" id="tab_5_2">
                        <div class="row">
                            <div class="col-sm-12" id="data-bimbingan"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        
        $('#loader').hide();
        loaddata('{{$mahasiswa_id}}');
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function loaddata(id)
    {
        $('#loader').show();
        $('#data-bimbingan').load('{{url("bimbingan-data-dosen")}}/'+id,function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
        });
    }
    
    function setujui(id)
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
                    loaddata();
                    swal("Sukses!", "Data Data Bimbingan DI Setujui", "success");
                }).fail(function(){
                    swal("Fail!", "Data Bimbingan Ditolak", "danger");
                });
            } 
        });
    }
    function tolak(id)
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
                    loaddata();
                    swal("Di Tolak!", "Data Data Bimbingan DI Setujui", "danger");
                });
            } 
        });
    }
    function hapus(id)
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
                    loaddata();
                    swal("Deleted!", "Data Berhasil Di Hapus", "success");
                }).fail(function(){
                    swal("Fail!", "Hapus Data Gagal", "danger");
                });
            } 
        });
    }
</script>
@endsection