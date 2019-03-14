@extends('layouts.master')
@section('title')
    <title>{{$id==-1 ? 'Tambah Data Mahasiswa' :'Edit Data Mahasiswa'}} :: SIMA-sp</title>
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
                    <a href="{{url('mahasiswa-admin')}}">Mahasiswa</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Mahasiswa
            <small>{{$id==-1 ? 'Tambah Data' :'Edit Data'}}</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{$id==-1 ? url('mahasiswa-admin') : url('mahasiswa-admin/'.$id) }}" class="horizontal-form" id="form-mahasiswa" method="POST">
                        {{ csrf_field() }}
                        @if ($id!=-1)
                            {{ method_field('PATCH') }}
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">NPM</label>
                                        <input type="text" id="npm" name="npm" class="form-control input-circle" placeholder="NPM" value="{{$id==-1 ? '' : $det->npm}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" class="form-control input-circle" placeholder="Nama Lengkap" value="{{$id==-1 ? '' : $det->nama}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">       
                                <!--/span-->
                                <!--/span-->
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
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control input-circle" placeholder="Email" value="{{$id==-1 ? '' : $det->email}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Departemen</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen" id="departemen">
                                            {{-- <option value="-1">-Pilih Departemen-</option> --}}
                                            @foreach ($departemen as $i => $v)
                                                @if (Auth::user()->kat_user==0)
                                                    @if ($id!=-1)
                                                        @if ($det->departemen_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                                    @endif
                                                @else
                                                    @if ($id!=-1)
                                                        @if ($det->departemen_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                                        @endif
                                                    @else
                                                        @if ($dept_id==$v->id)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>
                                                        @endif
                                                    @endif
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Program Studi</label>
                                        <div id="prog_studi">
                                            <select class="bs-select form-control has-success" data-placeholder="Pilih Program Studi" name="program_studi" id="program_studi">
                                                {{-- <option value="-1">-Pilih Program Studi-</option> --}}
                                                    @if ($id!=-1)
                                                        @foreach ($prodi[$det->departemen_id] as $kd => $vd)        
                                                            @if ($det->program_studi_id==$vd->id))
                                                                <option value="{{$det->program_studi_id}}" selected="selected">{{$det->programstudi->nama_program_studi}}</option> 
                                                            
                                                            @endif
                                                        @endforeach
                                                    @elseif($dept_id!=-1)
                                                        @foreach ($prodi[$dept_id] as $kd => $vd)  
                                                            <option value="{{$vd->id}}">{{$vd->nama_program_studi}}</option> 
                                                        @endforeach
                                                    @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Tahun Masuk</label>
                                        <select class="bs-select form-control has-success" data-placeholder="Pilih Tahun Masuk" id="tahun_masuk" name="tahun_masuk">
                                            <option value="-1">-Pilih Tahun Masuk-</option>
                                            @for ($i=(date('Y')-10) ; $i<=date('Y') ; $i++)
                                                @if ($id!=-1)
                                                    @if ($i==$det->tahun_masuk)
                                                        <option value="{{$i}}" selected="selected">{{$i}}</option>
                                                    @else
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endif                                                    
                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">Status Mahasiswa</label>
                                        <select class="bs-select form-control has-success" name="status_mahasiswa">
                                            <option value="0" {{$id!=-1 ? ($det->status_mahasiswa==1 ? 'selected="selected"' : '') : ''}}>Tidak Aktif</option>
                                            <option value="1" {{$id!=-1 ? ($det->status_mahasiswa==1 ? 'selected="selected"' : '') : ''}}>Aktif</option>
                                            <option value="2" {{$id!=-1 ? ($det->status_mahasiswa==2 ? 'selected="selected"' : '') : ''}}>Lulus</option>
                                        </select>
                                    </div>
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
        $('#departemen').change(function(){
            var id=$(this).val();
            $('#prog_studi').load('{{url("program-studi")}}/'+id,function(){
                $('#program_studi').select2();
            });
        });
        // swal("Good job!", "You clicked the button!", "success")
        $('#simpan').on('click',function(){
            var npm=$('#npm').val();
            var nama=$('#nama').val();
            var departemen=$('#departemen').val();
            var program_studi=$('#program_studi').val();
            if(npm=='')
            {
                pesan("NPM Harus Diisi",'error');
                $('#npm').focus();
            }
            else if(nama=='')
            {
                pesan("Nama Mahasiswa Harus Diisi",'error');
                $('#nama').focus();
            }    
            else if(departemen=='-1')
            {
                pesan("Departemen harus dipilih",'error');
                $('#departemen').focus();
            }
            else if(program_studi=='-1')
            {
                pesan("Program Studi harus dipilih",'error');
                $('#program_studi').focus();
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
                        $('#form-mahasiswa').submit();
                    } 
                });
            }
        });
    });
</script>
@endsection