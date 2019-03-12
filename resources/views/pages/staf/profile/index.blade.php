@extends('layouts.master')
@section('title')
    <title>Profil Staf :: SIMA-sp</title>
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
                    <span>Data Profil Staf</span>
                </li>
            </ul>
            
        </div>
    <div class="row">
        <div class="col-md-12">
            
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic" >
                    @if (Auth::user()->foto!='')
                        <img src="{{url('showgambar/'.Auth::user()->foto)}}" class="img-responsive" alt="" style="border-radius:20% !important;">
                    @else
                        <img src="{{asset('img/mhs.png')}}" class="img-responsive" alt=""> 
                    @endif
                </div> 
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{$profil->nama}} </div>
                    <div class="profile-usertitle-job"> NIP : {{$profil->nip}} </div>
                    <div class="profile-usertitle-job"> {{$profil->departemen->nama_departemen}} </div>
                    <div class="profile-usertitle-job"><span class="label label-primary">{!!$profil->gender==1 ? '<i class="fa fa-mars"></i> Pria' : '<i class="fa fa-venus"></i> Wanita'!!} </span></div>
                </div>


<!-- END MENU -->
                </div>
              
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profil Staf</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Biodata Diri</a>
                                    </li>
                                   
                                    <li>
                                         <a href="#tab_1_3" data-toggle="tab">Ganti Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="{{url('simpan-profil-staf')}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label">Nama Lengkap</label>
                                                <input type="text" placeholder="Nama Lengkap" class="form-control" name="nama" value="{{$profil->nama}}"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Tempat Lahir</label>
                                                <input type="text" placeholder="Tempat Lahir" class="form-control" name="tempat_lahir" value="{{$profil->tempat_lahir}}"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Lahir</label>
                                                <div class="input-group input-medium date date-picker" data-date="{{date('d-m-Y',strtotime($profil->tanggal_lahir))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" name="tanggal_lahir" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{date('d-m-Y',strtotime($profil->tanggal_lahir))}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label">Jenis Kelamin</label>
                                                    <select class="bs-select col-md-4 form-control has-success" name="gender">
                                                        <option value="1" {{$profil->gender==1 ? 'selected="selected"' : ''}}>Pria</option>
                                                        <option value="2" {{$profil->gender==2 ? 'selected="selected"' : ''}}>Wanita</option>
                                                    </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" placeholder="Email" class="form-control" name="email" value="{{$profil->email}}"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Nama Departemen</label>
                                                <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen" id="departemen">
                                                    <option value="-1">-Pilih Departemen-</option>
                                                    @foreach ($dept as $i => $v)
                                                        @if ($profil->departemen_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Telp/HP</label>
                                                <input type="text" placeholder="Telp/Hp" class="form-control" name="hp" value="{{$profil->hp}}"/> </div>
                                    
                                            <div class="form-group">
                                                <label class="control-label">Alamat</label>
                                                <input type="text" placeholder="Alamat" class="form-control" name="alamat" value="{{$profil->alamat}}"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Kota</label>
                                                <input type="text" placeholder="Kota" class="form-control" name="kota" value="{{$profil->kota}}"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Foto</label>
                                                <input type="file" placeholder="Foto" class="form-control" name="foto"/> 
                                            </div>
                                                <div class="margiv-top-10">
                                                <button type="submit" class="btn green"> Simpan </button>
                                            </div>
                                        </form>
                                </div>
                             
                            
               
                <div class="tab-pane" id="tab_1_3">
                    <form method="POST" action="{{ route('simpan.passwordstaf') }}" id="simpan-password">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <input type="password" id="newpassword" name="newpassword" class="form-control" /> </div>
                        <div class="form-group">
                            <label class="control-label">Re-type New Password</label>
                            <input type="password" class="form-control" id="repassword" name="repassword"/> </div>
                        <div class="margin-top-10">
                            <a href="javascript:changepass()" class="btn green"> Ganti Password </a>
                            <a href="javascript:;" class="btn default"> Cancel </a>
                        </div>
                    </form>
                </div>
                <!-- END CHANGE PASSWORD TAB -->
                <!-- PRIVACY SETTINGS TAB -->

                </div>
                <!-- END PRIVACY SETTINGS TAB -->
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>

                </div>

@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        
        var ps = "{{Session::has('status')}}";
        if(ps!="")
        {
            swal("Berhasil", "{{Session::get('status')}}", "success")
        }
    });
    function changepass()
    {
        //var pass=$('#password').val();
        var newpass=$('#newpassword').val();
        var repass=$('#repassword').val();
        if(newpass=='')
            pesan("Password Tidak Boleh Kosong",'error');    
        else if(nrepass=='')
            pesan("Re-Type Password Tidak Boleh Kosong",'error');    
        else
        {

            if(newpass!=repass)
            {
                pesan("Password yang anda Input Tidak Sama",'error');    
            }
            else{
                $('#simpan-password').submit();
            }
        }
        
    }

</script>
@endsection