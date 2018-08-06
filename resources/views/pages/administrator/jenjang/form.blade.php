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
                    <label class="control-label">Nama Departemen</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="departemen" id="departemen">
                        <option value="-1">-Pilih Departemen-</option>
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
                    <label class="control-label">Nama Jenjang</label>
                    <input type="text" id="jenjang" name="jenjang" class="form-control input-circle" placeholder="Jenjang" value="{{$id==-1 ? '' : $det->jenjang}}">
                </div>
            </div>
            <!--/span-->
        </div>
        
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Keterangan</label>
                    <textarea name="desc" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->desc}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>