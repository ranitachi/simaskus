<form action="{{url("pimpinan-fakultas-simpan/".$id)}}" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
   
    <div class="form-body">
       
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Jabatan</label>
                    {{-- <input type="text" id="jabatan" name="jabatan" class="form-control input-circle" placeholder="Jabatan" value="{{$id==-1 ? '' : $det->jabatan}}"> --}}
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Jabatan" name="jabatan" id="jabatan">
                        <option value="0">-Pilih-</option>
                        <option value="Dekan" {{$id!=-1 ? ($det->jabatan=="Dekan" ? "selected='selected'" : '') : ''}}>Dekan</option>
                        <option value="Wakil Dekan Bidang Pendidikan, Penelitian & Kemahasiswaan" {{$id!=-1 ? ($det->jabatan=="Wakil Dekan Bidang Pendidikan, Penelitian & Kemahasiswaan" ? "selected='selected'" : '') : ''}}>Wakil Dekan Bidang Pendidikan, Penelitian & Kemahasiswaan</option>
                        <option value="Wakil Dekan Bidang Sumber Daya, Ventura, & Administrasi Umum" {{$id!=-1 ? ($det->jabatan=="Wakil Dekan Bidang Sumber Daya, Ventura, & Administrasi Umum" ? "selected='selected'" : '') : ''}}>Wakil Dekan Bidang Sumber Daya, Ventura, & Administrasi Umum</option>
                        <option value="Manajer Pendidikan & Kepala PAF" {{$id!=-1 ? ($det->jabatan=="Manajer Pendidikan & Kepala PAF" ? "selected='selected'" : '') : ''}}>Manajer Pendidikan & Kepala PAF</option>
                        <option value="Manajer Riset & Pengabdian Masyarakat" {{$id!=-1 ? ($det->jabatan=="Manajer Riset & Pengabdian Masyarakat" ? "selected='selected'" : '') : ''}}>Manajer Riset & Pengabdian Masyarakat</option>
                        <option value="Manajer Kemahasiswaan & Alumni" {{$id!=-1 ? ($det->jabatan=="Manajer Kemahasiswaan & Alumni" ? "selected='selected'" : '') : ''}}>Manajer Kemahasiswaan & Alumni</option>
                        <option value="Manajer Umum & Fasilitas" {{$id!=-1 ? ($det->jabatan=="Manajer Umum & Fasilitas" ? "selected='selected'" : '') : ''}}>Manajer Umum & Fasilitas</option>
                        <option value="Manajer Kerjasama & Ventura" {{$id!=-1 ? ($det->jabatan=="Manajer Kerjasama & Ventura" ? "selected='selected'" : '') : ''}}>Manajer Kerjasama & Ventura</option>
                        <option value="Manajer SDM & Administrasi Umum" {{$id!=-1 ? ($det->jabatan=="Manajer SDM & Administrasi Umum" ? "selected='selected'" : '') : ''}}>Manajer SDM & Administrasi Umum</option>
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Pimpinan</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="dosen_id" id="dosen_id" onchange="dosenbaru(this.value)">
                        <option value="-1">-Pilih-</option>
                        <option value="0">-Input Data Baru-</option>
                        @foreach ($dosen as $i => $v)
                            @if ($id!=-1)
                                @if ($det->dosen_id==$v->id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>    
                                @else
                                    <option value="{{$v->id}}">{{$v->nama}}</option>
                                @endif
                            @else
                                <option value="{{$v->id}}">{{$v->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>
<script>
    $('.bs-select').parents('.bootbox').removeAttr('tabindex');
    $('.bs-select').select2({'width':'100%'});
</script>