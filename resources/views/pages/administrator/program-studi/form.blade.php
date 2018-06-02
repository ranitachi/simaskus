<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Kode Program Studi</label>
                    <input type="text" id="code" name="code" class="form-control input-circle" placeholder="Kode Program Studi" value="{{$id==-1 ? '' : $det->code}}">
                </div>
            </div>
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Program Studi</label>
                    <input type="text" id="nama_program_studi" name="nama_program_studi" class="form-control input-circle" placeholder="Nama Program Studi" value="{{$id==-1 ? '' : $det->nama_program_studi}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Departemen</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen_id" id="departemen_id" onchange="pilihdepartemen(this.value)">
                        <option value="-1">-Pilih Departemen-</option>
                        <option value="0">-Input Data Departemen Baru-</option>
                        @foreach ($dept as $i => $v)
                            @if ($id!=-1)
                                @if ($det->departemen_id==$v->id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>    
                                @else
                                    <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
                                @endif
                            @else
                                <option value="{{$v->id}}">{{$v->nama_departemen}}</option>
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
                    <label class="control-label">Nama Pimpinan</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Pimpinan" name="pimpinan_id" id="pimpinan_id" onchange="pilihdepartemen(this.value)">
                        <option value="-1">-Pilih Pimpinan-</option>
                        <option value="0">-Input Data Pimpinan Baru-</option>
                        @foreach ($dosen as $i => $v)
                            @if ($id!=-1)
                                @if ($det->pimpinan_id==$v->id)
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
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->keterangan}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>