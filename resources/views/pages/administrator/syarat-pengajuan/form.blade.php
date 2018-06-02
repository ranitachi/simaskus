<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Kode Syarat</label>
                    <input type="text" id="code" name="code" class="form-control input-circle" placeholder="Kode Jenis" value="{{$id==-1 ? '' : $det->code}}">
                </div>
            </div>
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Syarat</label>
                    <input type="text" id="syarat" name="syarat" class="form-control input-circle" placeholder="Jenis" value="{{$id==-1 ? '' : $det->syarat}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Jenis Pengajuan</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Jenis Pengajuan" name="pengajuan_id" id="pengajuan_id" onchange="pilihdepartemen(this.value)">
                        <option value="-1">-Pilih Jenis Pengajuan-</option>
                        <option value="0">-Input Data Jenis Pengajuan Baru-</option>
                        @foreach ($jenis as $i => $v)
                            @if ($id!=-1)
                                @if ($det->pengajuan_id==$v->id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->jenis}}</option>    
                                @else
                                    <option value="{{$v->id}}">{{$v->jenis}}</option>
                                @endif
                            @else
                                <option value="{{$v->id}}">{{$v->jenis}}</option>
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