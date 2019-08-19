@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
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
                    <span>Data Profil Mahasiswa</span>
                </li>
            </ul>
            
        </div>
<div class="row">
        <div class="col-md-12">
            @if (Auth::user()->flag==0)
                <div class="alert alert-info text-center" style="font-size:20px !important;">
                    <strong>Info!</strong> Akun Anda Belum DI Verifikasi Oleh Sekretariat.
                </div>
            @endif
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic" >
                    @if (Auth::user()->foto!='')
                        {{-- <img src="{{url('showgambar/'.Auth::user()->foto)}}" class="img-responsive" alt="" style="border-radius:20% !important;"> --}}
                        <img src="{{asset('storage/'.Auth::user()->foto)}}" class="img-responsive" alt="" style="border-radius:5% !important;">
                    @else
                        <img src="{{asset('img/mhs.png')}}" class="img-responsive" alt=""> 
                    @endif
                </div> 
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{$profil->nama}} </div>
                    <div class="profile-usertitle-job"> NPM : {{$profil->npm}} </div>
                    <div class="profile-usertitle-job"> 
                        @if (isset($profil->programstudi->nama_program_studi)) 
                            {{$profil->programstudi->nama_program_studi}} 
                        @endif    
                    </div>
                    <div class="profile-usertitle-job"><span class="label label-primary">{!!$profil->gender==1 ? '<i class="fa fa-mars"></i> Pria' : ($profil->gender==0 ? '<i class="fa fa-venus"></i> Wanita' : 'n/a') !!} </span></div>
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
                                    <span class="caption-subject font-blue-madison bold uppercase">Profil Mahasiswa</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Biodata Diri</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Info Kampus</a>
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
                                        <form role="form" action="{{url('simpan-profil-mhs')}}" method="POST" enctype="multipart/form-data">
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
                                                        <option value="0" {{$profil->gender==0 ? 'selected="selected"' : ''}}>Wanita</option>
                                                    </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" placeholder="Email" class="form-control" name="email" value="{{$profil->email}}"/> </div>
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
                                                <input type="file" placeholder="Foto" class="form-control" name="foto" accept=".png,.jpg,.jpeg"/> 
                                            </div>
                                                <div class="margiv-top-10">
                                                <button type="submit" class="btn green pull-right"> Simpan </button>
                                            </div>
                                        </form>
                                </div>
                             
                            
                <!-- END PERSONAL INFO TAB -->
                <!-- CHANGE AVATAR TAB -->
                <div class="tab-pane" id="tab_1_2">
                    <form role="form" action="{{url('simpan-college-mhs')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Nama Departemen</label>
                            <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen" id="departemen">
                                <option value="-1">-Pilih Departemen-</option>
                                @foreach ($dept as $i => $v)
                                    @if ($profil->departemen_id==$v->id)
                                        <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Program Studi</label>
                            <div id="prog_studi">
                                <select class="bs-select form-control has-success" data-placeholder="Pilih Program Studi" name="program_studi" id="program_studi">
                                    <option value="-1">-Pilih Program Studi-</option>
                                    @if ($profil->program_studi_id!=0)
                                        @if (isset($profil->programstudi->nama_program_studi)) 
                                            <option value="{{$profil->program_studi_id}}" selected="selected">{{$profil->programstudi->nama_program_studi}}</option>    
                        
                                        @endif
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lokasi Kuliah</label>
                            <div id="prog_studi">
                                <select class="bs-select form-control has-success" data-placeholder="Pilih Lokasi Kuliah" name="lokasi_kuliah" id="lokasi_kuliah">
                                    <option value="0">-Pilih Lokasi Kuliah-</option>
                                    @if ($profil->lokasi_kuliah!='')
                                        <option value="depok" {{$profil->lokasi_kuliah=='depok' ? 'selected="selected"' : ''}}>Kampus Depok</option>
                                        <option value="salemba" {{$profil->lokasi_kuliah=='salemba' ? 'selected="selected"' : ''}}>Kampus Salemba</option>
                                    @else
                                        <option value="depok">Kampus Depok</option>
                                        <option value="salemba">Kampus Salemba</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tahun Masuk</label>
                            <select class="bs-select form-control has-success" data-placeholder="Pilih Tahun Masuk" id="tahun_masuk" name="tahun_masuk" style="width:100px !important;">
                                <option value="-1">-Pilih Tahun Masuk-</option>
                                @for ($i=(date('Y')-10) ; $i<=date('Y') ; $i++)
                                        @if ($i==$profil->tahun_masuk)
                                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                                        @else
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endif                                                    
                                    
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Bukti SIAK-NG</label><br>
                            @if ($profil->bukti_siak_ng!='')
                                <a class="btn btn-xs btn-success" target="_blank" href="{{asset('storage/'.$profil->bukti_siak_ng)}}"><i class="fa fa-file-o"></i>&nbsp;Lihat Bukti SIAK-NG</a>
                                <div class="form-group">
                                    <label class="control-label">Upload Ulang Bukti SIAK-NG</label>
                                    <input type="file" placeholder="Bukti SIAK-NG" class="form-control" name="siak_ng" accept=".png,.jpg,.jpeg,.pdf"/> 
                                </div>
                                {{-- <a class="btn btn-xs btn-success" target="_blank" href="{{url('showgambar/'.$profil->bukti_siak_ng)}}"><i class="fa fa-file-o"></i>&nbsp;Lihat Bukti SIAK-NG</a> --}}
                            @else
                                <a class="btn btn-xs btn-danger" href="#">Belum Upload Bukti SIAK-NG</a>
                                <div class="form-group">
                                    <label class="control-label">Upload Bukti SIAK-NG</label>
                                    <input type="file" placeholder="Bukti SIAK-NG" class="form-control" name="siak_ng" accept=".png,.jpg,.jpeg,.pdf"/> 
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label class="control-label">Jenjang</label>
                            <select class="bs-select form-control has-success" data-placeholder="Pilih Jenjang" id="jenjang_id" name="jenjang_id">
                                <option value="-1">-Pilih Jenjang-</option>
                                @foreach ($jenjang as $i => $v)
                                    @if ($profil->jenjang_id==$v->id)
                                        <option value="{{$v->id}}" selected="selected">{{$v->jenjang}}</option>    
                                    @else
                                        <option value="{{$v->id}}">{{$v->jenjang}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div> --}}
                        
                        <div class="margiv-top-10">
                            <button type="submit" class="btn green pull-right"> Simpan </button>
                        </div>
                    </form>
                </div>
                <!-- END CHANGE AVATAR TAB -->
                <!-- CHANGE PASSWORD TAB -->
                <div class="tab-pane" id="tab_1_3">
                    <form method="POST" action="{{ route('simpan.password') }}" id="simpan-password">
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
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id);
        });

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