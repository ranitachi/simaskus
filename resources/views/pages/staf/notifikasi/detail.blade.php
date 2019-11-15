@extends('layouts.master')
@section('title')
    <title>Detail Notifikasi :: SIMA-sp</title>
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
                    <span> Notifikasi</span>
                </li>
            </ul>
            
        </div>
        <div class="row">
            
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-bell font-dark"></i>
                            <span class="caption-subject bold uppercase">Detail Notifikasi</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    @php
                        $st=trim(strtok($notif->pesan,':'));
                        $pesan = str_replace($st.' :','',$notif->pesan);
                        
                        if(strtolower($st)=='mahasiswa')
                        {
                            $us=\App\Model\Users::where('id',$notif->from)->where('kat_user',3)->first();
                            // return $us;
                            if($us)
                            {
                                if(strpos($notif->pesan,$us->name)===false)
                                {
                                    $us=\App\Model\Users::where('id_user',$notif->from)->where('kat_user',3)->first();
                                }
                            }
                        }
                        elseif(strtolower($st)=='dosen')
                            $us=\App\Model\Users::where('id_user',$notif->from)->where('kat_user',2)->first();
                        else
                            $us=\App\Model\Users::where('id_user',$notif->from)->where('kat_user',1)->first();
                        $nama='';
                        if ($us->kat_user==0)
                        {
                            $nama='Administrator';
                        }
                        elseif($us->kat_user==1)
                        {
                            $nama=$us->staf->nama;
                        }
                        elseif($us->kat_user==2)
                        {
                            if (isset($us->dosen->nama))
                                $nama=$us->dosen->nama;
                        }
                        elseif($us->kat_user==3)
                        {
                            $nama=$us->name;
                        }
                        else
                        {
                            $nama='';
                        }
                    @endphp
                    <div class="portlet-body">
                        <div class="row">

                            <div class="col-md-12">
                                <a href="{{url('notifikasi')}}" class="btn btn-md btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali</a>
                            </div>
                        </div>
                        <form role="form" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Tanggal <i class="fa fa-clock-o"></i></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="form_control_1" readonly placeholder="Enter your name" value="{{tgl_indo_time2($notif->created_at)}}">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Notifikasi Dari <i class="fa fa-user"></i></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="form_control_1" readonly placeholder="Enter your email" style="font-wight:600" value="{{$nama}}
                                        ">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Pesan Notifikasi <i class="fa fa-envelope"></i></label>
                                    <div class="col-md-10">
                                        <div style="padding-top:5px;width:100%;border-bottom:1px dashed #ccc;padding-bottom:5px;">
                                            {!!$notif->pesan!!}
                                        </div>
                                    </div>
                                </div>
                                {{-- @if ($st=='Mahasiswa')
                                    @if ($notif->mahasiswa->user->flag==0)
                                        
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-10">
                                                <a href="{{url('verifikasi-mahasiswa/'.$notif->user->id_user)}}" class="btn blue"><i class="fa fa-check-square-o"></i> Verifikasi Data Mahasiswa</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footscript')
{{-- <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script> --}}
<script>

    $(document).ready(function(){
        
    });
</script>
@endsection