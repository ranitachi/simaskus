@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Dosen' :'Edit Data Dosen'}} :: SIMA-sp</title>
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
                    <a href="{{url('dosen-admin')}}">Dosen</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Dosen
            <small>{{$id==-1 ? 'Tambah Data' :'Edit Data'}}</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('dosen-admin') : url('dosen-admin/'.$id) }}" class="horizontal-form" id="form-Dosen" method="POST">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <input type="hidden" name="{{URL::previous()}}" name="url_prev">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">NIP</label>
                                        <input type="text" id="nip" name="nip" class="form-control input-circle" placeholder="NIP" value="{{$id==-1 ? '' : $det->nip}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">NIDN</label>
                                        <input type="text" id="nidn" name="nidn" class="form-control input-circle" placeholder="NIDN" value="{{$id==-1 ? '' : $det->nidn}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" class="form-control input-circle" placeholder="Nama Lengkap" value="{{$id==-1 ? '' : $det->nama}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Inisial</label>
                                        <input type="text" id="inisial" name="inisial" class="form-control input-circle" placeholder="Inisial" value="{{$id==-1 ? '' : $det->inisial}}">
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control input-circle" placeholder="Tempat Lahir" value="{{$id==-1 ? '' : $det->tempat_lahir}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tanggal Lahir</label>
                                        {{--<input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control input-circle" placeholder="dd/mm/yyyy" value="{{$id==-1 ? '' : $det->tanggal_lahir}}"> --}}
                                    <div class="input-group input-medium date date-picker" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->tanggal_lahir))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="tanggal_lahir" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->tanggal_lahir))}}">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Jenis Kelamin</label>
                                        <select class="bs-select form-control has-success" name="gender">
                                            <option value="1" {{$id!=-1 ? ($det->gender==1 ? 'selected="selected"' : '') : ''}}>Pria</option>
                                            <option value="2" {{$id!=-1 ? ($det->gender==2 ? 'selected="selected"' : '') : ''}}>Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label">Departemen</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen" id="departemen">
                                            <option value="-1">-Pilih Departemen-</option>
                                            @foreach ($departemen as $i => $v)
                                                @if ($id!=-1)
                                                    @if (Auth::user()->kat_user!=0)
                                                        @php
                                                            if (Auth::user()->staf_user->departemen_id==$v->id)
                                                            {
                                                                echo '<option value="'.$v->id.'" selected="selected">'.$v->nama_departemen.'</option>';
                                                                continue;
                                                            }
                                                        @endphp
                                                    @else
                                                        @if ($det->departemen_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                        @endif
                                                    @endif
                                                @else
                                                     @if (Auth::user()->kat_user!=0)
                                                        @php
                                                            if (Auth::user()->staf_user->departemen_id==$v->id)
                                                            {
                                                                echo '<option value="'.$v->id.'" selected="selected">'.$v->nama_departemen.'</option>';
                                                                continue;
                                                            }
                                                        @endphp
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="row">
                                    <!--/span-->
                                            <div class="col-md-4">
                                                
                                                <div class="form-group has-success">
                                                    <label class="control-label">Status Dosen</label>
                                                    <select class="bs-select form-control has-success" data-placeholder="Pilih Status" name="status_dosen" id="status_dosen">
                                                        <option value="-1">-Pilih Status-</option>
                                                        <option value="Dosen UI" {{$id!=-1 ? ($det->status_dosen=="Dosen UI" ? 'selected="selected"' : '') : ''}}>Dosen UI</option>
                                                        <option value="Dosen Non UI" {{$id!=-1 ? ($det->status_dosen=="Dosen Non UI" ? 'selected="selected"' : '') : ''}}>Dosen Non UI</option>
                                                        <option value="Lainnya" {{$id!=-1 ? ($det->status_dosen=="Lainnya" ? 'selected="selected"' : '') : ''}}>Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!--/span-->
                                            <div class="col-md-4">
                                                
                                                <div class="form-group has-success">
                                                    <label class="control-label">Pendidikan</label>
                                                    <select class="bs-select form-control has-success" data-placeholder="Pilih" name="pendidikan" id="pendidikan">
                                                        <option value="-1">-Pilih-</option>
                                                        <option value="S1" {{$id!=-1 ? ($det->pendidikan=="S1" ? 'selected="selected"' : '') : ''}}>S1</option>
                                                        <option value="S2" {{$id!=-1 ? ($det->pendidikan=="S2" ? 'selected="selected"' : '') : ''}}>S2</option>
                                                        <option value="S3" {{$id!=-1 ? ($det->pendidikan=="S3" ? 'selected="selected"' : '') : ''}}>S3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jabatan</label>
                                                    <select class="bs-select form-control has-success" data-placeholder="Pilih" name="jabatan" id="jabatan">
                                                        <option value="-1">-Pilih-</option>
                                                        <option value="Pengajar" {{$id!=-1 ? ($det->jabatan=="Pengajar" ? 'selected="selected"' : '') : ''}}>Pengajar</option>
                                                        <option value="Lektor" {{$id!=-1 ? ($det->jabatan=="Lektor" ? 'selected="selected"' : '') : ''}}>Lektor</option>
                                                        <option value="Lektor Kepala" {{$id!=-1 ? ($det->jabatan=="Lektor Kepala" ? 'selected="selected"' : '') : ''}}>Lektor Kepala</option>
                                                        <option value="Guru Besar" {{$id!=-1 ? ($det->jabatan=="Guru Besar" ? 'selected="selected"' : '') : ''}}>Guru Besar</option>
                                                        <option value="Asisten Ahli" {{$id!=-1 ? ($det->jabatan=="Asisten Ahli" ? 'selected="selected"' : '') : ''}}>Asisten Ahli</option>
                                                    </select>
                                                </div>
                                            
                                                <input type="hidden"  name="penugasan" class="form-control input-circle" value="{{$id==-1 ? '' : $det->penugasan}}"> </div>
                                            
                                        </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control input-circle" placeholder="Email" value="{{$id==-1 ? '' : $det->email}}">
                                    </div>
                                    @if ($id==-1)                                        
                                        <div class="form-group has-success" id="div-pass" style="display: none">
                                            <label class="control-label">Password</label>
                                            <input type="text" id="password" name="password" class="form-control input-circle" placeholder="Password"><small>*Kosongkan Jika Tidak Diganti</small>
                                        </div>
                                    @else
                                        {{-- @if ($det->status_dosen=='Dosen UI') --}}
                                            <div class="form-group has-success" id="div-pass">
                                                <label class="control-label">Password</label>
                                                <input type="text" id="password" name="password" class="form-control input-circle" placeholder="Password"><small>*Kosongkan Jika Tidak Diganti</small>
                                            </div>
                                        {{-- @endif --}}
                                    @endif
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                            <div class="row">
                                <input type="hidden" name='status_ketua_kelompok'>
                                {{-- <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label">Status Ketua Kelompok</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Status" name="status_ketua_kelompok" id="status_ketua_kelompok">
                                            <option value="-1">-Pilih Status-</option>
                                            <option value="1" {{$id!=-1 ? ($det->status_ketua_kelompok==1 ? 'selected="selected"' : '') : ''}}>Ya</option>
                                            <option value="0" {{$id!=-1 ? ($det->status_ketua_kelompok==0 ? 'selected="selected"' : '') : ''}}>Tidak</option>
                                        </select>
                                    </div>
                                </div> --}}
                                
                                <!--/span-->
                                <div class="col-md-6">
                                    
                                </div>
                                <!--/span-->
                            </div>
                            
                            <!--/row-->
                            <h3 class="form-section">Alamat</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label>Jalan</label>
                                        <input type="text" name="alamat" id="alamat"  class="form-control input-circle" value="{{$id==-1 ? '' : $det->alamat}}"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label>Kota</label>
                                        <input type="text"  name="kota" id="kota" class="form-control input-circle" value="{{$id==-1 ? '' : $det->kota}}"> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Telp/HP</label>
                                         <input type="text" id="hp" name="hp" class="form-control input-circle" placeholder="Telp/HP" value="{{$id==-1 ? '' : $det->hp}}">
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                        <div class="form-actions right">
                            <a href="{{URL::previous()}}" class="btn default">Batal</a>
                            <button type="button" id="simpan" class="btn blue">
                                <i class="fa fa-check"></i> Simpan</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        
        // swal("Good job!", "You clicked the button!", "success")
        $('#status_dosen').on('change',function(){
            var jns=$(this).val();
            if(jns=='Dosen UI')
            {
                // alert(jns);
                $('#div-pass').css('display','block');
            }
            else
                $('#div-pass').css('display','none');
        });
        $('#simpan').on('click',function(){
            var nip=$('#nip').val();
            var nama=$('#nama').val();
            var email=$('#email').val();
            var departemen=$('#departemen').val();
            
            if(nip=='')
            {
                pesan("NIP Harus Diisi",'error');
                $('#nip').focus();
            }
            else if(nama=='')
            {
                pesan("Nama Dosen Harus Diisi",'error');
                $('#nama').focus();
            }    
            else if(email=='')
            {
                pesan("Email Dosen Wajib Diisi",'error');
                $('#nama').focus();
            }    
            else if(departemen=='')
            {
                pesan("Departemen harus dipilih",'error');
                $('#departemen').focus();
            }
           
            else
            {
                swal({
                    title: "Apakah Anda Yakin",
                    text: "Data yang diinput sudah benar, dan ingin di Simpan ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-info",
                    confirmButtonText: "Ya, Simpan",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        $('#form-Dosen').submit();
                    } 
                });
            }
        });
    });
</script>
@endsection