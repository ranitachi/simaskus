@extends('layouts.master')
@section('title')
    <title>Tambah Kalender Akademik :: SIMA-sp</title>
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
                    <a href="{{url('mahasiswa-admin')}}">Kalender Akademik</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Kalender Akademik
            <small>Tambah Data</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-body">
                    <form action="{{url('kalender-akademik/'.$idta.'/'.$id) }}" class="horizontal-form" id="form-kalender" method="POST">
                        {{ csrf_field() }}
                      
                        <input type="hidden" name="idta" value="{{$idta}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tanggal Mulai</label>
                                        <div class="input-group input-medium date start-date" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->start_date))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="start_date" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->start_date))}}">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tanggal Selesai</label>
                                        <div class="input-group input-medium date end-date" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->end_date))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="end_date" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->end_date))}}">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tahun Akademik</label>
                                        <input type="text" readonly class="form-control input-circle" placeholder="Tahun Akademik" value="{{ $tahunajaran->tahun_ajaran}} - {{$tahunajaran->jenis}}">
                                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" class="form-control input-circle" placeholder="Tahun Akademik" value="{{ $tahunajaran->tahun_ajaran}}">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Status Sidang</label>
                                        <select class="bs-select form-control has-success" name="status_sidang">
                                            <option value="0" {{$id!=-1 ? ($det->status_sidang==0 ? 'selected="selected"' : '') : ''}}>Tidak</option>
                                            <option value="1" {{$id!=-1 ? ($det->status_sidang==1 ? 'selected="selected"' : '') : ''}}>Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label">Kategori Khusus</label>
                                        <select class="bs-select form-control has-success" name="kategori_khusus">
                                            @foreach ($d_kal as $item)
                                                @if (in_array(str_slug($item),$kalm))
                                                        
                                                @else
                                                    <option value="{{str_slug($item)}}" {{$id!='-1' ? ($det->kategori_khusus==str_slug($item) ? 'selected="selected"' : '') : ''}}>{{$item}}</option>        
                                                @endif
                                            @endforeach                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                        <label class="control-label">Kegiatan</label>
                                        <input type="text" id="kegiatan" name="kegiatan" class="form-control input-circle" placeholder="Kegiatan" value="{{$id==-1 ? '' : $det->kegiatan}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            
                            <div class="row">
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                        <label class="control-label">Keterangan</label>
                                        <textarea name="deskripsi" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->keterangan}}</textarea>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#simpan').on('click',function(){
            var kegiatan=$('#kegiatan').val();
            if(kegiatan=='')
                pesan("Kegiatan Akademik Harus Diisi",'error');
            else
                $('#form-kalender').submit();
        });
        $('.start-date').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        }).on('changeDate', function(selected){
                startDate = new Date(selected.date.valueOf());
                startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                $('.end-date').datepicker('setStartDate', startDate);
        });

        $('.end-date').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });
    });
</script>
@endsection