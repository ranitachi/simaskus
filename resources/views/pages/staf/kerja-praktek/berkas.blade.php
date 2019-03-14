<div id="data-kelompok">    
    <form role="form" class="form-horizontal">
        <div class="form-body">
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Surat Keterangan / Penghantar KP</label>
                <div class="col-md-4">
                    <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Surat Keterangan / Penghantar KP').'/'.$id)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Surat Permohonan Izin KP/Surat Balasan Untuk Perusahaan</label>
                <div class="col-md-4">
                    <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Surat Permohonan Izin KP/Surat Balasan Untuk Perusahaan Indonesia').'/'.$id)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                    <img src="{{asset('img/bendera_indonesia.png')}}" style="height:20px;">
                    &nbsp;&nbsp; <br>
                    <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Surat Permohonan Izin KP/Surat Balasan Untuk Perusahaan Inggris').'/'.$id)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                    <img src="{{asset('img/bendera_inggris.png')}}" style="height:20px;">
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Form Asistensi Bimbingan Dosen</label>
                <div class="col-md-4">
                     <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Form Asistensi Bimbingan Dosen').'/'.$id)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Form Asistensi Bimbingan Lapangan (Log Book)</label>
                <div class="col-md-4">
                     <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Form Asistensi Bimbingan Lapangan (Log Book)').'/'.$id)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Upload Surat Balasan Dari Perusahaan</label>
                <div class="col-md-4">
                    @if ($det->balasan_surat!='')
                        
                        <a target="_blank" href="{{asset('../storage/app/'.$det->balasan_surat)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-file-pdf-o"></i> Lihat File</a> 
                        &nbsp;&nbsp;

                        @if ($det->status_kp==1)
                            <a target="" href="#"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-check-circle"></i> KP Sudah Mulai Berjalan</a>
                        @elseif ($det->status_kp==2)
                            <a target="" href="#"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-check-circle"></i> KP Sudah Selesai</a>
                        @else
                            <a target="" href="javascript:mulaikp({{$idgrup}})"  class="btn btn-sm btn-success btn-circle"><i class="fa fa-check"></i> Mulai KP</a> &nbsp;&nbsp;
                        @endif
                    @else
                        <a target="" href="javascript:uploadbalasan({{$idgrup}})"  class="btn btn-sm btn-success btn-circle"><i class="fa fa-upload"></i> Upload</a>
                    @endif
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-6 control-label" for="form_control_1">Upload Surat Pernyataan Selesai KP Dari Perusahaan</label>
                <div class="col-md-4">
                    @if ($det->surat_pernyataan_selesai!='')
                        
                        <a target="_blank" href="{{asset('../storage/app/'.$det->surat_pernyataan_selesai)}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-file-pdf-o"></i> Lihat File</a> 
                        &nbsp;&nbsp;

                        @if ($det->status_kp==2)
                            <a target="" href="#"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-check-circle"></i> KP Sudah Selesai</a>
                        @else
                            <a target="" href="javascript:selesaikp({{$idgrup}})"  class="btn btn-sm btn-success btn-circle"><i class="fa fa-check"></i> Verifikasi Selesai KP</a> &nbsp;&nbsp;
                        @endif
                    @else
                        <a target="" href="#"  class="btn btn-sm btn-success btn-circle"><i class="fa fa-upload"></i> Upload</a>
                    @endif
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modal_upload_balasan" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('upload-balasan-kp')}}" method="POST" enctype="multipart/form-data" class="horizontal-form" id="form-balasan">
                    {{ csrf_field() }}
                    <input type="hidden" name="idgrup" value="{{$idgrup}}">
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="kat_user" value="{{$kat_user}}">
                    <input type="hidden" name="url" value="tab_1_1_3">
                    <input type="hidden" name="dept_id" value="{{$dept_id}}">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="form-group has-success">
                                <label class="control-label">Pilih File</label>
                                <input type="file" id="file" name="file" class="form-control input-circle" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="simpan-balasan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_upload_selesai" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('upload-selesai-kp')}}" method="POST" enctype="multipart/form-data" class="horizontal-form" id="form-selesai">
                    {{ csrf_field() }}
                    <input type="hidden" name="idgrup" value="{{$idgrup}}">
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="kat_user" value="{{$kat_user}}">
                    <input type="hidden" name="url" value="tab_1_1_3">
                    <input type="hidden" name="dept_id" value="{{$dept_id}}">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="form-group has-success">
                                <label class="control-label">Pilih File</label>
                                <input type="file" id="file" name="file" class="form-control input-circle" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="simpan-balasan">Simpan</button>
            </div>
        </div>
    </div>
</div>
