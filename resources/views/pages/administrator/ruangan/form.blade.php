<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Kode Ruangan</label>
                    <input type="text" id="code_ruangan" name="code_ruangan" class="form-control input-circle" placeholder="Kode Ruangan" value="{{$id==-1 ? '' : $det->code_ruangan}}">
                </div>
            </div>
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Ruangan</label>
                    <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control input-circle" placeholder="Nama Ruangan" value="{{$id==-1 ? '' : $det->nama_ruangan}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control input-circle" placeholder="Lokasi" value="{{$id==-1 ? '' : $det->lokasi}}">
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
                    <label class="control-label">Keterangan</label>
                    <textarea name="deskripsi" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->deskripsi}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>