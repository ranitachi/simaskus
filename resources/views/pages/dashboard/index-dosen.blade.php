@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
@endsection

@section('konten')
    {{-- @include('home') --}}
<div class="page-content">                        
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('beranda')}}">Beranda</a>
                <i class="fa fa-circle"></i>
            </li>
           
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Spesial</h1>
    <div class="row">
        @php
        if(Auth::user()->flag==0)
        {
            echo '<div class="col-md-12"><div class="alert alert-danger">
                    <h1><strong>Informasi!</strong> Akun Anda Belum Diverifikasi Oleh Staf Sekretariat</h1></div></div>';
        }
        $waktupengajuanmk=$waktupengajuansidang=$waktupendajwalan=$waktusidang='Belum Di Atur Jadwal';
        $warnawaktupengajuanmk=$warnawaktupendajwalan=$warnawaktupengajuansidang=$warnawaktusidang='grey';
        $checkwaktupengajuanmk=$checkwaktupendajwalan=$checkwaktupengajuansidang=$checkwaktusidang='';
        $waktupengajuanmk=$waktupengajuansidang=$waktupendajwalan=$waktusidang='Belum Di Atur Jadwal';
        
        if (count($kalender)!=0)
        {
                foreach ($kalender as $key => $value) 
                {
                    if($value['kategori_khusus']=='masa-pengajuan-mata-kuliah-khusus')
                    {
                        $waktupengajuanmk=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/m/Y',strtotime($value['end_date']));
                        $warnawaktupengajuanmk='blue';
                        $checkwaktupengajuanmk='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupengajuanmk='Belum Di Atur Jadwal';
                        $warnawaktupengajuanmk='grey';
                        $checkwaktupengajuanmk='';
                    }
                    
                    if($value['kategori_khusus']=='masa-penjadwalan')
                    {
                        $waktupendajwalan=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/m/Y',strtotime($value['end_date']));
                        $warnawaktupendajwalan='blue';
                        $checkwaktupendajwalan='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupendajwalan='Belum Di Atur Jadwal';
                        $warnawaktupendajwalan='grey';
                        $checkwaktupendajwalan='';
                    }
                    
                    if($value['kategori_khusus']=='masa-pengajuan-sidang-mata-kuliah-khusus')
                    {
                        $waktupengajuansidang=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/m/Y',strtotime($value['end_date']));
                        $warnawaktupengajuansidang='blue';
                        $checkwaktupengajuansidang='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktupengajuansidang='Belum Di Atur Jadwal';
                        $warnawaktupengajuansidang='grey';
                        $checkwaktupengajuansidang='';
                    }
                    
                    if($value['kategori_khusus']=='masa-pelaksanaan-sidang')
                    {
                        $waktusidang=date('d/m/Y',strtotime($value['start_date'])).' s.d. '.date('d/m/Y',strtotime($value['end_date']));
                        $warnawaktusidang='blue';
                        $checkwaktusidang='<i class="fa fa-check"></i>';
                    }
                    else
                    {
                        $waktusidang='Belum Di Atur Jadwal';
                        $warnawaktusidang='grey';
                        $checkwaktusidang='';
                    }
                }
            // }
            // else
            // {
            //     
            // }
        }    
        else
        {
            $waktupengajuanmk=$waktupengajuansidang=$waktupendajwalan=$waktusidang='Belum Di Atur Jadwal';
            $warnawaktupengajuanmk=$warnawaktupendajwalan=$warnawaktupengajuansidang=$warnawaktusidang='grey';
            $checkwaktupengajuanmk=$checkwaktupendajwalan=$checkwaktupengajuansidang=$checkwaktusidang='';
        }

        if(isset($kal_lain['masa-pengajuan-mata-kuliah-khusus']))
        {
            $kl=$kal_lain['masa-pengajuan-mata-kuliah-khusus'];
            $waktupengajuanmk=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));
        }
        if(isset($kal_lain['masa-penjadwalan']))
        {
            $kl=$kal_lain['masa-penjadwalan'];
            $waktupendajwalan=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));;
        }
        if(isset($kal_lain['masa-pengajuan-sidang-mata-kuliah-khusus']))
        {
            $kl=$kal_lain['masa-pengajuan-sidang-mata-kuliah-khusus'];
            $waktupengajuansidang=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));
        }
        if(isset($kal_lain['masa-pelaksanaan-sidang']))
        {
            $kl=$kal_lain['masa-pelaksanaan-sidang'];
            $waktusidang=date('d/m/Y',strtotime($kl->start_date)).' s.d. '.date('d/m/Y',strtotime($kl->end_date));;
        }
        @endphp
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupengajuanmk}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupengajuanmk}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupengajuanmk!!} Pengajuan Bimbingan</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupengajuansidang}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupengajuansidang}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupengajuansidang!!} Pengajuan Sidang</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktupendajwalan}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktupendajwalan}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktupendajwalan!!} Penjadwalan</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 {{$warnawaktusidang}}" href="#">
                <div class="visual">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="details text-center">
                    <div class="desc" style="padding-top:20px;">{{$waktusidang}}</div>
                    <div class="number text-center" style="font-size:23px;padding-top:0px;">{!!$checkwaktusidang!!} Pelaksanaan Sidang</div>
                </div>
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title" style="margin:0 0 10px !important"> Jadwal Menguji </h1>
            {!! $calendar->calendar() !!}
        </div>
    </div>
</div>
@endsection

@section('footscript')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang-all.js"></script>
{!! $calendar->script() !!}

<script>
function lihatdetail(id)
{
    $('.modal-body').html(id);
    $('#ajax').modal('show');
}
</script>

<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Jadwal Sidang Dosen</h4>
            </div>
            <div class="modal-body">
                <img src="{{asset('assets/global/img/loading-spinner-grey.gif')}}" alt="" class="loading">
                <span> &nbsp;&nbsp;Loading... </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" data-dismiss="modal" id="ok">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection