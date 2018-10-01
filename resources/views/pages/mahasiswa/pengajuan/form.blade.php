@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Pengajuan Skripsi' :'Edit Data Pengajuan Skripsi'}} :: SIMASKUS</title>
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
                            <a href="{{url('pengajuan')}}" id="sample_editable_1_new" class="btn sbold green"> Kembali
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('pengajuan') : url('pengajuan/'.$id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tahun Ajaran</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Tahun Ajaran" id="tahun_ajaran" name="tahun_ajaran">
                                            <option value="-1">-Pilih Tahun Ajaran-</option>
                                            @foreach ($ta as $i => $v)
                                                @if ($id!=-1)
                                                    @if ($det->tahunajaran_id==$v->id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>    
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Jenis Pengajuan</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Jenis" id="jenis_id" name="jenis_id" onchange="jenis(this.value)">
                                            <option value="-1">-Pilih Jenis-</option>
                                            @foreach ($jenispengajuan as $i => $v)
                                                @if (strpos(strtolower($v->jenis),'skripsi')!==false)
                                                    @if ($id!=-1)
                                                        @if ($det->jenis_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->judul}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->jenis}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6" style="display: none">
                                     <div class="form-group has-success">
                                        <label class="control-label">IPK Terakhir</label>
                                        <input type="text" id="ipk_terakhir" name="ipk_terakhir" class="form-control input-circle" placeholder="IPK Terakhir" value="{{$id==-1 ? '0' : $det->ipk_terakhir}}" style="width:50%;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Topik Yang Diajukan</label>
                                        <input type="text" id="topik_diajukan" name="topik_diajukan" class="form-control input-circle" placeholder="Topik Yang Diajukan" value="{{$id==-1 ? '-' : $det->topik_diajukan}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6" style="display: none">
                                     <div class="form-group has-success">
                                        <label class="control-label">Jumlah SKS Lulus</label>
                                        <input type="text" id="jumlah_sks_lulus" name="jumlah_sks_lulus" class="form-control input-circle" placeholder="Jumlah SKS Lulus" value="{{$id==-1 ? '0' : $det->jumlah_sks_lulus}}" style="width:50%;">
                                    </div>
                                </div>
                                <!--/span-->
                                
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Bidang Skripsi</label>
                                        <input type="text" id="bidang" name="bidang" class="form-control input-circle" placeholder="Bidang Skripsi" value="{{$id==-1 ? '-' : $det->bidang}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Skema Penelitian</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Skema" id="skema" name="skema">
                                            <option value="-1">-Pilih Skema-</option>
                                            <option value="Sendiri" {{$id!=-1 ? ($det->skema=="Sendiri" ? 'selected="selected"' : '-') : '-'}}>Sendiri</option>
                                            <option value="Penelitian Dosen" {{$id!=-1 ? ($det->skema=="Penelitian Dosen" ? 'selected="selected"' : '-') : '-'}}>Penelitian Dosen</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row" style="display:none;">
                                <div class="col-md-6">
                                     <div class="form-group has-success">
                                        <label class="control-label">Judul Bahasa Indonesia (<i>* Dapat Menyusul</i>)</label>
                                        <input type="text" id="judul_ind" name="judul_ind" class="form-control input-circle" placeholder="Judul (Bahasa Indonesia)" value="{{$id==-1 ? '-' : $det->judul_ind}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Judul Bahasa Inggris (<i>* Dapat Menyusul</i>)</label>
                                        <input type="text" id="judul_eng" name="judul_eng" class="form-control input-circle" placeholder="Judul (Bahasa Inggris)" value="{{$id==-1 ? '-' : $det->judul_eng}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="form-group has-success">
                                        <label class="control-label">Deskripsi/Rencana</label>
                                        <textarea class="wysihtml5 form-control" rows="6" name="deskripsi_rencana">{{$id!=-1 ? $det->deskripsi_rencana : '-'}}</textarea>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row" style="display:none">
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                        <label class="control-label">Abstrak (Indonesia)</label>
                                        <textarea class="wysihtml5 form-control" rows="6" name="abstrak_ind">{{$id!=-1 ? $det->abstrak_ind : '-'}}</textarea>
                                        <small>* Bisa Menyusul</small>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                        <label class="control-label">Abstrak (Inggris)</label>
                                        <textarea class="wysihtml5 form-control" rows="6" name="abstrak_eng">{{$id!=-1 ? $det->abstrak_eng : '-'}}</textarea>
                                        <small>* Bisa Menyusul</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     &nbsp;
                                </div>
                                <!--/span-->
                                
                                <!--/span-->
                            </div>
                           
                        
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Pengajuan Ke</label>
                                            <select class="form-control" data-placeholder="Pengajuan Ke" name="pengambilan_ke" id="pengambilan_ke" style="width:20%" onchange="cekmengulang(this.value)">
                                            @for ($x=1;$x<=5;$x++)
                                                @if ($id!=-1)
                                                    @if ($det->pengambilan_ke==$x)
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
                                    <div class="form-group has-success">
                                        <label class="control-label">Dosen Ketua Kelompok Ilmu</label>
                                        <div id="prog_studi">
                                            <select class="form-control select2"data-placeholder="Pilih " name="dosen_ketua" id="dosen_ketua">
                                                <option value="0">Pilih Dosen</option>
                                                @foreach ($dosen as $i => $v)
                                                @if ($v->status_ketua_kelompok==1)
                                                    
                                                    @if ($id!=-1)
                                                        @if ($det->dosen_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>    
                                                        @else
                                                        <option value="{{$v->id}}">{{$v->nama}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->nama}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     <div class="form-group has-success" id="dosen-mengulang" style="display:none">
                                        <label class="control-label">Dosen Pembimbing Sebelumnya (Buat yang mengulang)</label>
                                        <div id="prog_studi">
                                            <select class="form-control select2" data-placeholder="Pilih Dosen" name="pembimbing_sebelumnya" id="pembimbing_sebelumnya">
                                                <option value="0">Pilih Dosen</option>
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
                            <div class="col-md-6"> 
                                <div id="jlh-pembimbing"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12" id="alasan-mengulang" style="display:none"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Alasan Mengulang (* Jika Mengulang)</label>
                                        <textarea class="wysihtml5 form-control" rows="6" name="alasan_mengulang">{{$id!=-1 ? $det->alasan_mengulang : ''}}</textarea>
                                    </div>
                                </div>
                            <div class="col-md-6"> 
                                    <div class="form-group has-success">
                                        <label class="control-label">Upload daftar Bimbingan dari SIAK-NG</label>
                                        <input type="file" name="bukti_bimbingan" class="form-control"><br>
                                        <span class="label label-danger">Info</span> <small>Upload bukti daftar bimbingan dalam format jpg, jpeg, png atau PDF. Maksimal ukuran file 10 MB. <br><a href="javascript:contohbuktibimbingan()">Klik disini untuk melihat contoh</a></small>
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
    function cekmengulang(val)
    {
        if(val>1)
        {
            $('#dosen-mengulang').css({'display':'inline'});
            $('#alasan-mengulang').css({'display':'inline'});
        }
        else{
            $('#dosen-mengulang').css({'display':'none'});
            $('#alasan-mengulang').css({'display':'none'});
        }
    }
    function jenis(val)
    {
        $('#jlh-pembimbing').load('{{url("jlh_pembimbing")}}/'+val,function(){
            $('.select2').select2();
        });
    }

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