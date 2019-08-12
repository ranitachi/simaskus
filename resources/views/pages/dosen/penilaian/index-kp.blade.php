@extends('layouts.master')
@section('title')
    <title>Data Jadwal :: SIMA-sp</title>
    <link href="{{asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/pages/css/portfolio.min.css')}}" rel="stylesheet" type="text/css" />
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
                    <span>Jadwal</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Jadwal
            <small>Sidang</small>
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
            <div id="data">
                 <div class="portlet light portlet-fit portlet-datatable bordered">

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> NPM<br>Mahasiswa </th>
                                    <th> Mata Kuliah Spesial </th>
                                    <th> Pembimbing </th>
                                    <th> Hari/Tanggal/<br>Ruangan Sidang </th>
                                    <th> Penguji </th>
                                    <th> Dokumen Sidang </th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                            @php
                            $no=1;
                            
                            @endphp
                            @foreach ($pengajuan as $i => $v)
                                @php
                                    $penguji='';
                                    $d_penguji=array();
                                    $back=$pesan='';
                                    $idpengajuan=$v->id;
                                    if($v->jenispengajuan->keterangan=='S3')
                                    {
                                        if(str_slug($v->jenispengajuan->jenis)=='sidang-promosi')
                                        {
                                            if($v->acc_manager_akademik==0)
                                            {
                                                //$back='background:pink';
                                                $pesan="<i style='color: red'>Jadwal Ini Belum Di ACC <br>Manager Akademik</i>";
                                            }
                                        }
                                    }
                                @endphp
                                @if (count($jadwal) != 0)
                                    @if (isset($v->jenispengajuan->keterangan))
                                        @if (isset($v->mahasiswa->nama))
                                        <!-- Cek Status Penguji -->
                                        @if(count($jadwal)!=0)
                                            @if (isset($jadwal[$idpengajuan]->id))            
                                                @if (isset($uji[$idpengajuan][$v->mahasiswa_id]))
                                                    @foreach ($uji[$idpengajuan][$v->mahasiswa_id] as $kk => $vvv)
                                                        @php
                                                            $penguji.='<a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="'.$vvv->dosen->nama.'" style="font-size:10px;"><i class="fa fa-user"></i> '.$vvv->dosen->nama.'</a><br>';
                                                            $d_penguji[]=$vvv->dosen->id;
                                                        @endphp
                                                        
                                                    @endforeach
                                                @endif    
                                            @else
                                                @php
                                                    $penguji='<a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>';
                                                    $d_penguji;
                                                @endphp
                                            @endif
                                        @endif

                                        @php
                                            if(!in_array(Auth::user()->id_user,$d_penguji))
                                                continue;
                                        @endphp
                                        <!-- ENd Cek Status Penguji -->
                                            
                                            <tr class="odd gradeX" data-toggle="tooltip" title="Penguji Sudah Setuju">
                                                <td>{{($no)}}</td>
                                                <td style="{{$back}}">
                                                
                                                    <b>
                                                    {{$v->mahasiswa->nama}}</b><br>
                                                    {{$v->mahasiswa->npm}}<br>
                                                    {{$v->mahasiswa->programstudi->nama_program_studi}}
                                                    <br>
                                                    <br>
                                                    <br>
                                                    
                                                </td>
                                                <td style="{{$back}}">
                                                    
                                                    @if ($v->jenispengajuan->keterangan=='S2')
                                                        <b>Thesis</b>
                                                    @else
                                                        <b>{{$v->jenispengajuan->jenis}}</b>
                                                    @endif
                                                    
                                                    <br><br>T.A. <br>{{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}

                                                    <br><br>

                                                    <small><u>Judul Indonesia</u></small><br>
                                                    <strong>{{$v->judul_ind}}</strong>
                                                    <br>
                                                    <small><u>Judul Inggris</u></small><br>
                                                    <strong>{{$v->judul_eng}}</strong>
                                                </td>
                                                <td>
                                                    
                                                    @php
                                                        $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',$v->mahasiswa_id)->where('judul_id',$idpengajuan)->with('dosen')->orderBy('keterangan','desc')->get();
                                                    @endphp
                                                    @foreach ($p_bimbingan as $key=>$item)
                                                        @if (isset($item->dosen->nama))
                                                            @if ($v->jenispengajuan->keterangan=='S3')
                                                                @if (str_slug($v->jenispengajuan->jenis)=='ujian-hasil-riset')
                                                                    <small><u><b>{{ucwords($item->keterangan)}}</b></u></small><br>     
                                                                @endif
                                                            @else 
                                                                <small><u>Pembimbing {{$key+1}}</u></small><br>
                                                            @endif
                                                            <strong>{{$item->dosen->nama}}<br></strong>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-left">
                                                    <small><u>Jadwal : </u></small><br>
                                                    @if (count($jadwal) != 0)
                                                        @if (isset($jadwal[$idpengajuan]->tanggal))
                                                            
                                                        
                                                            @if ($jadwal[$idpengajuan]->tanggal!=null)
                                                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;text-align:left">{{hari($jadwal[$idpengajuan]->hari)}}, 
                                                                    {{date('d-m-Y',strtotime($jadwal[$idpengajuan]->tanggal))}}
                                                                    <br>Pukul : {{$jadwal[$idpengajuan]->waktu}}
                                                                </a>
                                                            @else
                                                                <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                            <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                                                    @endif
                                                    <br>
                                                    <br>
                                                    <small><u>Ruangan : </u></small><br>
                                                    @if (count($jadwal) != 0)
                                                        @if (isset($jadwal[$idpengajuan]->ruangan_id))
                                                            @if ($jadwal[$idpengajuan]->ruangan_id!=0)
                                                                <a href="#" class="btn btn-xs btn-success" style="font-size:10px;">{{$jadwal[$idpengajuan]->ruangan->code_ruangan}} : {{$jadwal[$idpengajuan]->ruangan->nama_ruangan}}</a>
                                                            @else
                                                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                            <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                                                    @endif

                                                </td>
                                                
                                                <td class="text-left">
                                                {!!$penguji!!}
                                                <br>
                                                <br>
                                                @if ($pesan!='')
                                                    
                                                
                                                    {!!$pesan!!}
                                                    <br>
                                                    <a href="javascript:setujumanager({{$idpengajuan}},{{$v->mahasiswa_id}})" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i> SETUJUI</a> 
                                                @endif
                                                </td>
                                                
                                            <td class="text-left">
                                                @if(count($jadwal)!=0)
                                                        @if (isset($jadwal[$idpengajuan]->jadwal_id))

                                                            @if (isset($n[$jadwal[$idpengajuan]->jadwal_id]['penguji'][Auth::user()->id_user]))
                                                                <a href="javascript:formnilai({{$jadwal[$idpengajuan]->jadwal_id}},{{$idpengajuan}},'penguji-{{Auth::user()->id_user}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn blue uppercase btn blue uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Form Penilaian Penguji</a>    
                                                            @else
                                                                <a href="javascript:formnilai({{$jadwal[$idpengajuan]->jadwal_id}},{{$idpengajuan}},'penguji-{{Auth::user()->id_user}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Form Penilaian Penguji</a>    
                                                            @endif
                                                            @if (isset($perb[$jadwal[$idpengajuan]->jadwal_id][Auth::user()->id_user]))
                                                                <a href="javascript:daftarperbaikan({{$jadwal[$idpengajuan]->jadwal_id}},{{$idpengajuan}},'penguji-{{Auth::user()->id_user}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-check"></i> Daftar Perbaikan</a>
                                                            @else
                                                                <a href="javascript:daftarperbaikan({{$jadwal[$idpengajuan]->jadwal_id}},{{$idpengajuan}},'penguji-{{Auth::user()->id_user}}')" class="cbp-singlePage cbp-l-caption-buttonLeft btn default uppercase btn default uppercase btn-xs" rel="nofollow" style="padding:0px 5px !important;border-bottom:1px solid #aaa;"><i class="fa fa-file-o"></i> Daftar Perbaikan</a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @endif
                                    @endif
                                @endif
                            @endforeach                
                            </tbody>
                        </table>
                    </div>
                </div>
                <style>
                    .table td,
                    .table th
                    {
                        font-size: 11px !important;
                    }
                </style>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script src="{{asset('assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/portfolio-1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#loader').hide();
        $('#sample_4').dataTable();
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });
    function formnilai(id,pengajuan_id)
    {
        $('.modal-title').text('Form Nilai');
        $('.modal-body').load('{{url("form-nilai-dosen")}}/'+id+'/'+pengajuan_id);
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#simpan-nilai').submit();
        });
    }
    function daftarperbaikan(id,pengajuan_id)
    {
        $('.modal-title').text('Form Daftar Perbaikan');
        $('.modal-body').load('{{url("daftar-perbaikan")}}/'+id+'/'+pengajuan_id,function(){
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
        });
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#daftar-perbaikan').submit();
        });
    }
    function penetapanjudul(id,pengajuan_id)
    {
        $('.modal-title').text('Form Penetapan Judul');
        $('.modal-body').load('{{url("penetapan-judul")}}/'+id+'/'+pengajuan_id);
        $('#ajax').modal('show');

        $('#ok').on('click',function(){
            $('#penetapan-judul').submit();
        });
    }
</script>
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>
<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img src="{{asset('assets/global/img/loading-spinner-grey.gif')}}" alt="" class="loading">
                <span> &nbsp;&nbsp;Loading... </span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green" id="ok">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection
