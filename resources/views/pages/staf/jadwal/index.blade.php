@extends('layouts.master')
@section('title')
    <title>Data Mata Kuliah Spesial :: SIMA-sp</title>
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
                    <span>Jadwal Sidang</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Jadwal Sidang
            <small>Daftar</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="row" id="loader">
                <div class="col-md-10 text-center" style="position:fixed;">
                    <center>
                        <img src="{{asset('img/loading-bl-blue.gif')}}">
                    </center>
                </div>
            </div>
            <div class="alert alert-danger" id="pesan-alert">
                <strong>Peringatan !</strong> <span id="alert-msg"></span>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Jadwal Terdekat</a></li>
                <li><a data-toggle="tab" href="#menu1">Sudah Terlaksana</a></li>
            </ul>
            <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div id="data"></div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div id="data_old"></div>
            </div>
            
            
        </div>
    </div>
    @php
        if(isset($kalamik['masa-pelaksanaan-sidang']))
        {
            $start_date=$kalamik['masa-pelaksanaan-sidang']->start_date;
            $end_date=$kalamik['masa-pelaksanaan-sidang']->end_date;
            $thn_ajaran_id=$kalamik['masa-pelaksanaan-sidang']->tahunajaran_id;
        }
        // dd($end_date);
    @endphp
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').show();
        loaddata();
        $('#pesan-alert').hide();
        var start_date='{{$start_date}}';
        var end_date='{{$end_date}}';
        var ps = "{{Session::has('status')}}";
        // alert(end_date);
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }

        var ps2 = "{{Session::has('gagal')}}";
        if(ps2!="")
        {
            // alert("{{Session::get('gagal')}}")
            // swal("Gagal", "{{Session::get('gagal')}}", "danger")
            $('#alert-msg').html("{{Session::get('gagal')}}");
            $('#pesan-alert').show();
        }
        
        if(start_date=='')
        {
            $('#daterangerpicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                minDate: moment()
            });
        }
        else
        {
            $('#daterangerpicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                minDate: new Date('{{$start_date}}'),
                maxDate: new Date('{{$end_date}}')
            });
        }
    });
    function setujumanager(idpengajuan,idmahasiswa)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menyetujui Data Pengajuan Ujian Hasil Riset Ini ?",
            type: "success",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Setuju",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("setujui-acc-manager")}}/'+idpengajuan+'/'+idmahasiswa,
                    success:function(){
                        loaddata();
                        swal("Sukses!", "Hapus Data Penguji Berhasil", "success");
                    }
                });
            }
        });
    }
    function hapusenguji(dosen_id,id)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Menghapus Data Penguji Ini ?",
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
                    url : '{{url("hapus-data-penguji")}}/'+dosen_id+'/'+id,
                    success:function(){
                        loaddata();
                        swal("Sukses!", "Hapus Data Penguji Berhasil", "success");
                    }
                });
            }
        });
    }
    function loaddata()
    {
        $('#loader').show();
        $('#data').load('{{url("data-pengajuan-sidang-data/".$jenis)}}',function(){
            $('#sample_0').dataTable();
            $('#loader').hide();
            $('.tooltips').tooltip();
        });
        $('#data_old').load('{{url("data-pengajuan-sidang-data/".$jenis)}}/old',function(){
            $('#sample_1').dataTable();
            $('#loader').hide();
            $('.tooltips').tooltip();
        });
    }
    function setujui(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Pengajuan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Verifikasi",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                // location.href='{{url("pengajuan-sidang-verifikasi")}}/'+id+'/'+jns;
                $.ajax({
                    url : '{{url("pengajuan-sidang-verifikasi")}}/'+id+'/'+jns,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Sukses!", "Verifikasi Pengajuan Sidang Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Verifiksi Pengajuan Sidang Gagal", "danger");
                });
            } 
        });
    }
    function setujuidokumen(id,jns)
    {
        swal({
            title: "Apakah Anda Yakin ",
            text: "Ingin Memverifikasi Dokumen Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Verifikasi",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{url("dokumen-verifikasi")}}/'+id+'/'+jns,
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Sukses!", "Verifikasi Dokumen Sidang Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Verifiksi Dokumen Sidang Gagal", "danger");
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
    function accsidangmahasiswa()
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin ACC Seluruh Data Pengajuan Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                // location.href='{{url("pengajuan-acc-dosen")}}';
                $.ajax({
                    url : '{{url("pengajuan-acc-dosen")}}',
                    dataType : 'JSON'
                }).done(function(){
                    loaddata();
                    swal("Success!", "Batch ACC Sidang Berhasil Di Lakukan", "success");
                }).fail(function(){
                    swal("Fail!", "Batch ACC Sidang Gagal", "danger");
                });
            } 
        });
    }
    function generate(id)
    {
        $('#ajax-sm').modal('show');
        $('#ok-ajax-sm').on('click',function(){
            var ta=$('#tahunajaran_id').val();
            if(ta=='-1')
            {
                $('#pesan-ta').css('display','inline');
                setTimeout(function(){
                    $('#pesan-ta').css('display','none');
                },3000);
            }
            else
                $('#form-generate-jadwal').submit();
        });
    }
    function tambahpenguji(idpengajuan,mahasiswa_id)
    {
        // $('.modal-body').load('{{url("form-add-penguji")}}',function(){
        //     $('.select2').select2({ width: '100%' });
        // });
        $('#mahasiswa_id_modal').val(mahasiswa_id);
        $('#pengajuan_id_modal').val(idpengajuan);
        $('#ajax-sm-dosen').modal('show');
        $('#ok-ajax-sm-dosen').one('click',function(){
            var iddos=$('#dosen_id').val();
            $.ajax({
                    url : '{{url("add-penguji")}}/'+idpengajuan,
                    dataType : 'JSON',
                    cache: false,
                    type : 'POST',
                    data : $('#form-add-penguji').serialize(),
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                }).done(function(){
                    $('#ajax-sm-dosen').modal('hide');
                    loaddata();
                    swal("Success!", "Tambah Data Penguji Berhasil", "success");
                }).fail(function(){
                    swal("Gagal!", "Tambah Data Penguji Gagal", "danger");
            });
        });
        // var iddos=$('#dosen_id').val();
        
    }
    function aturjadwals3(mahasiswa_id,pengajuan_id)
    {
        $('#daterpicker').datepicker({
            format: 'DD/MM/YYYY'
        });
        $('#mahasiswa_id_s3').val(mahasiswa_id);
        $('#pengajuan_id_s3').val(pengajuan_id);
        $('#ajax-atur-jadwal').modal('show');
    }

    function getkonten(idpengajuan,mahasiswa_id,idjadwal,ruangan_id,tanggal=null)
    {
        
        $('#konten-ubah-jadwal').load('{{url("/")}}/cek-jadwal-sidang/'+idpengajuan+'/'+mahasiswa_id+'/'+idjadwal+'/'+tanggal+'/'+ruangan_id,function(){
            $('#dt-ubahjadwal').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true
            }).on('changeDate', function (ev) {
                // alert(ev.format(0,"yyyy-mm-dd"))
                var ruanan_id=$('#ruangan-ubah-jadwal').val();
                var tgl=ev.format(0,"yyyy-mm-dd");
                getkonten(idpengajuan,mahasiswa_id,idjadwal,ruangan_id,tgl);
            });
        });
    }
    function cekjadwalsidangbyruang(idpengajuan,mahasiswa_id,idjadwal,tgl_sidang,ruangan_id)
    {
        var tgl=($('#dt-ubahjadwal').val()).split('/');
        var tanggal = tgl[2]+'-'+tgl[1]+'-'+tgl[0];
        getkonten(idpengajuan,mahasiswa_id,idjadwal,ruangan_id,tanggal);
    }
    function ubahjadwalsidang(idpengajuan,mahasiswa_id,idjadwal,ruangan_id)
    {
        getkonten(idpengajuan,mahasiswa_id,idjadwal,ruangan_id,null)
        $('#ajax-atur-jadwal-sidang').modal('show');

            var url_update='{{url("/")}}/update-jadwal-sidang/'+idpengajuan+'/'+mahasiswa_id+'/'+idjadwal;
            $('#ok-ajax-sm-ubahjadwal').one('click',function(){
                    $.ajax({
                        url : url_update,
                        data : $('#form-ubah-jadwal').serialize(),
                        type : 'POST',
                        cache: false,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success:function(res){
                            if(res==1)
                            {
                                $('#ajax-atur-jadwal-sidang').modal('hide');
                                loaddata();
                                swal("Success!", "Ubah Data Jadwal Sidang Berhasil", "success");
                            }
                            else
                            {
                                swal("Gagal!", "Ubah Data Jadwal Sidang Gagal", "danger");
                            }
                        }
                    });
                });
        // $('.datepicker').datepicker({
        //     format: 'dd/mm/yyyy'
        // });
        // $.ajax({
        //     url : '{{url("/")}}/cek-jadwal-sidang/'+idpengajuan+'/'+mahasiswa_id+'/'+idjadwal,
        //     success:function(res)
        //     {
        //         var url_update='{{url("/")}}/update-jadwal-sidang/'+idpengajuan+'/'+mahasiswa_id+'/'+idjadwal;
        //         // $('#form-ubah-jadwal').attr('action',url_update);
        //         // alert(res.jadwal.tanggal)
        //         var tgl=res.jadwal.tanggal.split('-');
        //         $('#dt-ubahjadwal').val(tgl[2]+'/'+tgl[1]+'/'+tgl[0])
        //         $('.datepicker').datepicker({
        //             format: 'dd/mm/yyyy'
        //         });
        //         $('#waktu-ubah-jadwal').val(res.jadwal.waktu);
        //         $('#ruangan-ubah-jadwal').val(res.jadwal.ruangan_id);
        //         $('#ajax-atur-jadwal-sidang').modal('show');
        //         $('#ok-ajax-sm-ubahjadwal').one('click',function(){
        //             $.ajax({
        //                 url : url_update,
        //                 data : $('#form-ubah-jadwal').serialize(),
        //                 type : 'POST',
        //                 cache: false,
        //                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        //                 success:function(res){
        //                     if(res==1)
        //                     {
        //                         $('#ajax-atur-jadwal-sidang').modal('hide');
        //                         loaddata();
        //                         swal("Success!", "Ubah Data Jadwal Sidang Berhasil", "success");
        //                     }
        //                     else
        //                     {
        //                         swal("Gagal!", "Ubah Data Jadwal Sidang Gagal", "danger");
        //                     }
        //                 }
        //             });
        //         });
        //     }
        // });
    }

    function selesai(jadwal_id,pengajuan_id)
    {
        swal({
            title: "Apakah Anda Yakin",
            text: "Ingin Memverifikasi Selesai Data Ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                location.href='{{url("pengajuan-selesai")}}/'+jadwal_id+'/'+pengajuan_id
            } 
        });
    }
</script>

<div class="modal fade" id="ajax-sm" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('generate-jadwal/'.$dept_id) }}" class="horizontal-form" id="form-generate-jadwal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-success">
                                    <label class="control-label">Tahun Akademik</label>
                                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Tahun Akademik" id="tahunajaran_id" name="tahunajaran_id" required>
                                        <option value="-1">-Pilih Tahun Akademik-</option>
                                        @foreach ($ta as $k=>$v)
                                            @if (isset($thn_ajaran_id))
                                                @if ($thn_ajaran_id==$v->id)
                                                    <option value="{{$v->id}}" selected="selected">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                                @else
                                                    <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>    
                                                @endif
                                            @else
                                                <option value="{{$v->id}}">{{$v->tahun_ajaran}} : {{$v->jenis}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="font-red" id="pesan-ta" style="display:none"><small>*Tahun Akademik Harus Dipilih</small></span>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Durasi Waktu</label>
                                    <input type="text" name="datetimes" class="form-control" id="daterangerpicker"/>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok-ajax-sm">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-atur-jadwal" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('atur-jadwal/'.$dept_id) }}" class="horizontal-form" id="form-generate-jadwal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" nama="mahasiswa_id_s3" id="mahasiswa_id_s3">
                                <input type="hidden" nama="pengajuan_id_s3" id="pengajuan_id_s3">
                                <div class="form-group has-success">
                                    <label class="control-label">Tanggal</label>
                                    <input type="text" name="datetime" placeholder="dd/mm/yyyy" class="form-control" id="datepicker"/>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                
                                <div class="form-group has-success">
                                    <label class="control-label">Waktu</label>
                                    <select name="waktu" id="waktu" class="form-control">
                                        <option value="0">Pilih</option>
                                        @php
                                            $waktu=waktu();
                                            foreach($waktu as $item)
                                            {
                                                echo '<option value="'.$item.'">'.$item.'</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                @php
                                    $ruangan=\App\Model\MasterRuangan::where('ruang_sidang_promosi',1)->with('departemen')->get();
                                @endphp
                                <div class="form-group has-success">
                                    <label class="control-label">Ruangan</label>
                                    <select name="ruangan" id="ruangan" class="form-control">
                                        <option value="0">Pilih</option>
                                        @php
                                            
                                            foreach($ruangan as $item)
                                            {
                                                echo '<option value="'.$item->id.'">'.$item->departemen->nama_departemen.' -- '.$item->nama_ruangan.'</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="submit" class="btn green" id="ok-ajax-sm">OK</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-atur-jadwal-sidang" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="horizontal-form" id="form-ubah-jadwal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="konten-ubah-jadwal"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok-ajax-sm-ubahjadwal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-sm-dosen" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{url('add-penguji/'.$dept_id) }}" class="horizontal-form" id="form-add-penguji" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-success">
                                    <input type="hidden" name="mahasiswa_id" id="mahasiswa_id_modal">
                                    <input type="hidden" name="pengajuan_id" id="pengajuan_id_modal">
                                    <label class="control-label">Nama Penguji</label>
                                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Penguji" id="dosen_id" name="dosen_id">
                                        <option value="-1">-Pilih Penguji-</option>
                                        @foreach ($dosen as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok-ajax-sm-dosen">OK</button>
            </div>
        </div>
    </div>
</div>
<style>
.showSweetAlert {
  z-index: 1000000;
}
</style>
@endsection