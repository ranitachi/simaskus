<form action="#" class="horizontal-form" id="form-module" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <input type="hidden" name="id_dept" value="{{$dept_id}}">
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
                                @endif
                            @else
                                @if ($v->id==$dept_id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->nama_departemen}}</option>
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
                    <label class="control-label">Jenis Penilaian</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Jenis" name="jenis_id" id="jenis_id">
                        <option value="-1">-Pilih Jenis-</option>
                        @foreach ($jenis as $i => $v)
                            @if ($id!=-1)
                                @if ($det->jenis_id==$v->id)
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
                    <label class="control-label">Nama Module</label>
                    <input type="text" id="jenjang" name="nama_module" class="form-control input-circle" placeholder="Module" value="{{$id==-1 ? '' : $det->nama_module}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Bobot (%)</label>
                    <input type="text" id="bobot" name="bobot" class="form-control input-circle" placeholder="Bobot" value="{{$id==-1 ? '' : $det->bobot_module}}">
                </div>
            </div>
            <!--/span-->
        </div>
        
        
        
    </div>
</form>