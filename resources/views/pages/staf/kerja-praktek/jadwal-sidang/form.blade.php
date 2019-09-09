@extends('layouts.master')
@section('title')
    <title>Jadwal Sidang Kerja Praktek :: SIMA-sp</title>
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
                    <span>Generate Jadwal Sidang Kerja Praktek</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Generate Jadwal Sidang
            <small>Kerja Praktek</small>
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
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="row" style="padding:5px 20px;">

                    <div class="col-md-12">
                        <div class="btn-group pull-right">
                            {{-- <a href="{{url('data-jadwal-kp')}}" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Kembali Ke Jadwal Sidang --}}
                            <a href="{{ URL::previous() }}" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Kembali Ke Jadwal Sidang
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">&nbsp;</div> --}}
                </div>
                <div class="portlet-body">
                    <form action="{{url('jadwal-sidang-kp-simpan/all/'.$id)}}" method="POST" id="simpan-generate">
                        {{ csrf_field() }}
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Grup</td>
                                    <td>Nama Mahasiswa </th>  
                                    <th> Informasi KP </th>
                                    <th> Tanggal, Waktu</th>
                                    <th> Ruangan Sidang </th>
                                    <th> Penguji </th>
                                    <th> Aksi</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                    @foreach ($klp as $i => $v)
                                        @if (isset($pengajuan[$v[0]->mahasiswa_id]))
                                            <tr class="odd gradeX">
                                                <td>{{($no)}}</td>   
                                                <td>
                                                    <small>Grup</small><br>
                                                    <b>{{$i}}</b>
                                                    <br><br>
                                                    <small>Pembimbing</small><br>
                                                    @php
                                                        $pem_kp=array();
                                                    @endphp
                                                    @if (isset($pemb[$i]))    
                                                        @foreach ($pemb[$i] as $iddos=>$item)
                                                            @if (isset($item->dosen->nama))
                                                                <i class="fa fa-user"></i> <b>{{$item->dosen->nama}}</b><br>
                                                                @php
                                                                    $pem_kp[]=$iddos;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>Ketua</small><br>
                                                    <b>{{$i}}</b><br>
                                                    <small>Anggota</small><br>
                                                    <b>{{$i}}</b>
                                                </td>
                                                <td>
                                                <small>Lokasi KP</small><br>
                                                        @if (isset($infokp[$i]))
                                                            <a class="btn btn-primary btn-xs"><i class="fa fa-building"></i> {{$infokp[$i]['instansiperusahaan']->isi}}</a>
                                                        @endif
                                                        
                                                        <br><br>
                                                        @if (isset($infokp[$i]['nama-pekerjaan']))
                                                            <small>Nama Pekerjaan</small><br>
                                                            <a class="btn btn-primary btn-xs"><i class="fa fa-list"></i> {{$infokp[$i]['nama-pekerjaan']->isi}}</a>
                                                        @endif
                                                        
                                                        <br><br>
                                                        <small>Jadwal KP</small><br>
                                                        <div class="text-left">
                                                            @if (isset($infokp[$i]))
                                                                    <b><i class="fa fa-clock-o"></i> {{$infokp[$i]['periode-awal']->isi}}</b><br>s.d.<br>
                                                                    <b><i class="fa fa-clock-o"></i> {{$infokp[$i]['periode-selesai']->isi}}</b>
                                                            @endif
                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        @if ($id!=-1)
                                                        @php
                                                            $tgl=date('d-m-Y',strtotime($jadwalkp->tanggal));
                                                        @endphp
                                                        <div class="input-group input-small date tanggal" data-date="{{$tgl}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                            <input type="text" name="tanggal_sidang[{{$i}}]" id="tanggal_sidang_{{$i}}" class="form-control tanggal" placeholder="dd-mm-yyyy" value="{{$tgl}}">
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        @else
                                                        <div class="input-group input-small date tanggal" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                            <input type="text" name="tanggal_sidang[{{$i}}]" id="tanggal_sidang_{{$i}}" class="form-control tanggal" placeholder="dd-mm-yyyy">
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        @if ($id!=-1)
                                                            <select class="bs-select col-md-4 form-control has-success waktu" name="waktu[{{$i}}]" id="waktu_{{$i}}">
                                                                @foreach ($waktu as $item)
                                                                    @if (strpos(str_replace(':','.',$jadwalkp->waktu),$item)!==false)
                                                                        <option selected="selected" value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                                                                    @else
                                                                        <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <select class="bs-select col-md-4 form-control has-success waktu" name="waktu[{{$i}}]" id="waktu_{{$i}}">
                                                                <option value="0">-waktu-</option>
                                                                @foreach ($waktu as $item)
                                                                    <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        @if ($id!=-1)
                                                            <select class="select2 col-md-4 form-control has-success ruangan" name="ruangan_id[{{$i}}]" id="ruangan_id_{{$i}}">
                                                                @foreach ($ruangan as $item)
                                                                    @if ($item->id==$jadwalkp->ruangan_id)
                                                                        <option value="{{$item->id}}" selected="selected">{{$item->nama_ruangan}}</option>
                                                                    @else
                                                                        <option value="{{$item->id}}">{{$item->nama_ruangan}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <select class="select2 col-md-4 form-control has-success ruangan" name="ruangan_id[{{$i}}]" id="ruangan_id_{{$i}}">
                                                                <option value="0">-Pilih Ruangan-</option>
                                                                @foreach ($ruangan as $item)
                                                                    <option value="{{$item->id}}">{{$item->nama_ruangan}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    
                                                        
                                                    </div>
                                                    
                                                        <input type="hidden" name="idkp[{{$i}}]" id="idkp_{{$i}}" value="{{$pengajuan[$v[0]->mahasiswa_id]->id}}">
                                                    
                                                </td>
                                                <td>
                                                    <select class="select2 col-md-4 form-control has-success ruangan" multiple name="penguji[{{$i}}][]" id="penguji_{{$i}}">
                                                        <option value="0">-Pilih Dosen-</option>
                                                        @foreach ($dosen as $itemd)
                                                            @if ($id!=-1)
                                                                @if (isset($uji[$jadwalkp->id][$itemd->id]))
                                                                    <option selected="selected" value="{{$itemd->id}}">{{$itemd->nama}}</option>     
                                                                @else
                                                                    <option value="{{$itemd->id}}">{{$itemd->nama}}</option>    
                                                                @endif
                                                            @else
                                                                @if (in_array($itemd->id,$pem_kp))
                                                                    <option value="{{$itemd->id}}" selected="selected">{{$itemd->nama}}</option>    
                                                                @else
                                                                    <option value="{{$itemd->id}}">{{$itemd->nama}}</option>    
                                                                @endif
                                                            @endif
                                                            
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success btn-check" type="button" id="check_{{$i}}"><i class="fa fa-check"></i></button>
                                                    @if ($id!=-1)
                                                        <button class="btn btn-sm btn-primary" type="button" onclick="simpansatu({{$i}})"><i class="fa fa-save"></i>&nbsp; Ubah Jadwal</button>
                                                    @else
                                                        <button class="btn btn-sm btn-primary" type="button" onclick="simpansatu({{$i}})"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @endif
                                    @endforeach                
                            </tbody>
                        </table>
                        @if ($id==-1)   
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-sm btn-primary pull-right" type="button" id="simpansemua"><i class="fa fa-save"></i>&nbsp; Simpan Semua</button>
                                </div>
                            </div>
                        @endif
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
        $('button.btn-check').each(function(){
            $(this).hide();
        });
        loaddata();

        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }

        var startDate = new Date();
        startDate.setDate(startDate.getDate(new Date()));
        $('.tanggal').datepicker({
            autoclose: true,
            format:'dd-mm-yyyy'
        });
        $('.tanggal').datepicker('setStartDate', startDate);

        $('#simpansemua').on('click',function(){
            swal({
                title: "Apakah Anda Yakin",
                text: "Ingin Melakukan Generate Jadwal ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-info",
                confirmButtonText: "Ya, Generate",
                cancelButtonText: "Tidak",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    //
                    var x=1,y=1,z=1;
                    $('input.tanggal').each(function(){
                        var tgl=$(this).val();
                        if(tgl=='')
                            x=0;
                    });
                    if(x==0)
                        pesan('Tanggal Masih Ada Yang Kosong','error');
                    
                    $('select.ruangan').each(function(){
                        var rg=$(this).val();
                        if(rg=='0')
                            y=0;
                    });
                    if(y==0)
                        pesan('Ruangan Masih Ada Yang Belum Dipilih','error');
                    
                    $('select.waktu').each(function(){
                        var wkt=$(this).val();
                        if(wkt=='0')
                            z=0;
                    });
                    if(z==0)
                        pesan('Waktu Masih Ada Yang Belum Dipilih','error');

                    if(x==1 && y==1 && z==1)
                        $('#simpan-generate').submit();
                } 
            });
        });
    });

    function loaddata()
    {
        // $('#loader').show();
        // $('#sample_4').dataTable();
        // $('#loader').hide();
    }
    function simpansatu(grupid)
    {
        var tanggal_sidang = $('#tanggal_sidang_'+grupid).val();
        var ruangan_id = $("#ruangan_id_"+grupid+" option:selected").val();
        var waktu = $("#waktu_"+grupid).val();
        var idkp = $("#idkp_"+grupid).val();
        var penguji = $("#penguji_"+grupid).val();
        // alert(ruangan_id)
        if(tanggal_sidang=='')
        {
            pesan('Tanggal Harus Dipilih','error');
        }
        else if(ruangan_id=='0')
        {
            pesan('Ruangan Harus Dipilih','error');
        }
        else if(waktu=='0')
        {
            pesan('Waktu Harus Dipilih','error');
        }
        else
        {
            $.ajax({
                url : '{{url("/")}}/jadwal-sidang-kp-simpan/one/{{$id}}/'+idkp,
                type : 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data : {idgrup:grupid, ruangan:ruangan_id, tanggal:tanggal_sidang,waktu:waktu,penguji:penguji },
                dataType : 'JSON',
                success:function(res){
                    if(res.status==1)
                        $("#check_"+grupid).show();
                    else
                        $("#check_"+grupid).hide();
                }
            });
        }
    }
</script>
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>
@endsection