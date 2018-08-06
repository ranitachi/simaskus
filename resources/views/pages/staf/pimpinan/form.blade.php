<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
       
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Jabatan</label>
                    {{-- <input type="text" id="jabatan" name="jabatan" class="form-control input-circle" placeholder="Jabatan" value="{{$id==-1 ? '' : $det->jabatan}}"> --}}
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Jabatan" name="jabatan" id="jabatan">
                        <option value="0">-Pilih-</option>
                        <option value="Ketua Departemen" {{$id!=-1 ? ($det->jabatan=="Ketua Departemen" ? "selected='selected'" : '') : ''}}>Ketua Departemen</option>
                        <option value="Sekretaris Departemen" {{$id!=-1 ? ($det->jabatan=="Sekretaris Departemen" ? "selected='selected'" : '') : ''}}>Sekretaris Departemen</option>
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Departemen</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen_id" id="departemen_id" onchange="dosenbaru(this.value)">

                        @foreach ($dept as $i => $v)
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
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Dosen</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="dosen_id" id="dosen_id" onchange="dosenbaru(this.value)">
                        <option value="-1">-Pilih Dosen-</option>
                        <option value="0">-Input Data Dosen Baru-</option>
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
    $('.bs-select').select2({'width':'100%'});
</script>