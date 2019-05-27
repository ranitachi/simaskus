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
                    <a class="btn btn-info btn-md pull-right" href="{{url('data-pengajuan')}}">Data Pengajuan</a>
                @endif
            </div>
        </div>
        <div class="">
            <div class="tabbable-custom ">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab_5_1" data-toggle="tab"> Informasi {{$pengajuan->jenispengajuan->jenis}} </a>
                    </li>
                    @if (Auth::user()->kat_user==3)
                    <li>
                        <a href="#tab_5_2" data-toggle="tab"> Bimbingan </a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_5_1">
                        @if (Auth::user()->level==1)
                            @if ($pengajuan->status_pengajuan==0)
                                <div class="alert alert-danger text-center" style="font-size:20px !important;">
                                    <strong>Info!</strong> Pengajuan Ini Belum DI Verifikasi, &nbsp;<button class="btn btn-xs btn-info" onclick="verifikasi({{$pengajuan->id}})"><i class="fa fa-check"></i> Klik Untuk Memverifikasi</button>.
                                </div>
                            @endif
                        @endif
                        <form role="form" class="horizontal-form" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Mata Kuliah Spesial</label>
                                        <input type="text" readonly  id="ipk_terakhir" name="ipk_terakhir" class="form-control input-circle" placeholder="IPK Terakhir"  style="" value="{{$pengajuan->jenispengajuan->jenis}}">
                                    </div>
                                </div>
                                <!--/span-->
                                {{-- <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">IPK Terakhir</label>
                                        <input type="text" readonly  id="ipk_terakhir" name="ipk_terakhir" class="form-control input-circle" placeholder="IPK Terakhir"  style="" value="{{$pengajuan->ipk_terakhir}}">
                                    </div>
                                </div> --}}
                                
                                <!--/span-->
                            {{-- </div>
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
                                        <textarea readonly  class="form-control" rows="4" name="deskripsi_rencana">{!!$pengajuan->deskripsi_rencana!!}</textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                {{-- <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Abstrak (Indonesia)</label>
                                        <textarea readonly  class="wysihtml5 form-control" rows="4" name="abstrak_ind">{{$pengajuan->abstrak_ind}}</textarea>
                                        <small>* Bisa Menyusul</small>
                                    </div>
                                </div> --}}
                                <!--/span-->
                            {{-- </div>
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
                                
                                <!--/span-->--}}
                            </div> 
                           
                        
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Pengajuan Ke</label>
                                        <input type="text" readonly  id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Pengajuan Ke" value="{{$pengajuan->pengambilan_ke}}">  
                                    </div>
                            </div>
                            <div class="col-md-6"> 
                                @php
                                    $pembinging=\App\Model\PivotBimbingan::where('mahasiswa_id',$pengajuan->mahasiswa_id)
                                                ->where('judul_id',$pengajuan->id)
                                                ->with('dosen')->orderBy('keterangan','desc')->get();

                                    // dd($pengajuan->id);
                                @endphp
                                    @foreach ($pembinging as $key=>$item)
                                        <div class="form-group has-success">
                                            <label class="control-label">{{ucwords($item->keterangan)}}</label>
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
                            <div class="col-sm-8" id="data-bimbingan">

                            </div>
                            <div class="col-sm-4" id="form-bimbingan">

                            </div>
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
        loaddata(-1);
        loadform(-1);
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });

    function loaddata()
    {
        $('#loader').show();
        $('#data-bimbingan').load('{{url("bimbingan-data")}}/{{$pengajuan->mahasiswa_id}}/{{$id}}',function(){
            $('#sample_4').dataTable();
            $('#loader').hide();
            $('.tooltips').tooltip();
        });
    }
    
    function loadform(id)
    {
        // var pengajuan_id='{{$pengajuan->id}}';
        
        $('#form-bimbingan').load('{{url("bimbingan")}}/'+id+'/{{$id}}',function(){
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });

            $('button#simpan').one('click',function(){
                swal({
                    title: "Apakah Anda Yakin",
                    text: "Ingin Menyimpan Data Bimbingan Ini ?",
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
                        if(id==-1)
                        {
                            var t_url = '{{url("bimbingan")}}';
                        }
                        else
                            var t_url = '{{url("bimbingan")}}/'+id;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url : t_url,
                            type : "POST",
                            dataType: 'json',
                            cache: false,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data: $('#simpan-bimbingan').serialize()
                        }).done(function(){
                            loaddata();
                            loadform(id)
                            swal("Berhasil", "Data Berhasil Di Simpan", "success");
                        }).fail(function(){
                            swal("Fail!", "Simpan Data Gagal", "danger");
                        });
                    } 
                });
            });

            $('#baru').one('click',function(){
                loadform(-1);
            });
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
    function verifikasi(id)
    {
        $.ajax({
            url : '{{url("verifikasi-pengajuan")}}/'+id,
            success:function(a){
                if(a==1)
                {
                    swal("Berhasil", "Data Pengajuan Sudah Di Verifikasi", "success");
                    // loaddata();
                    setTimeout(function(){
                        location.href="{{url('/')}}/pengajuan-detail/"+id;
                    },2000);
                    
                }
                else
                    swal("Gagal", "Data Pengajun Gagal Di Verifikasi", "danger");
            }
        });
    }
    
</script>
@endsection