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
                    <label class="control-label">Module</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="module_id" id="module_id">
                        <option value="-1">-Pilih Module-</option>
                        @foreach ($module as $i => $v)
                            @if ($id!=-1)
                                @if ($det->module_id==$v->id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->jenis->jenis}} - {{$v->nama_module}}</option>    
                                @endif
                            @else
                                @if (isset($v->jenis->jenis))
                                    @if ($v->jenis_id==$idmodule)
                                        <option value="{{$v->id}}" selected="selected">{{$v->jenis->jenis}} - {{$v->nama_module}}</option>
                                    @else
                                        <option value="{{$v->id}}">{{$v->jenis->jenis}} - {{$v->nama_module}}</option>
                                    @endif
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
                    <label class="control-label">Code Component</label>
                    <input type="text" id="jenjang" name="code_component" class="form-control input-circle" placeholder="Code Component" value="{{$id==-1 ? '' : $det->code_component}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Component</label>
                    <input type="text" id="jenjang" name="nama_component" class="form-control input-circle" placeholder="Component" value="{{$id==-1 ? '' : $det->nama_component}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Bobot <br>Pembimbing(%)</label>
                    <input type="text" id="bobot" name="bobot" class="form-control input-circle" placeholder="Bobot" value="{{$id==-1 ? '0' : $det->bobot_component}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Bobot <br>Penguji(%)</label>
                    <input type="text" id="bobot" name="bobot_penguji" class="form-control input-circle" placeholder="Bobot" value="{{$id==-1 ? '0' : $det->bobot_penguji}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Bobot Pembimbing Lapangan(%)</label>
                    <input type="text" id="bobot" name="bobot_pembimbing_lapangan" class="form-control input-circle" placeholder="Bobot" value="{{$id==-1 ? '0' : $det->bobot_pembimbing_lapangan}}">
                </div>
            </div>
            <!--/span-->
        </div>
        {{-- <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Kategori</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Departemen" name="category" id="category">
                        <option value="-1">-Pilih Kategori-</option>
                        @foreach ($category as $i => $v)
                            @if ($id!=-1)
                                @if ($det->category_component==$v)
                                    <option value="{{$v}}" selected="selected">{{$v}}</option>    
                                @endif
                            @else
                                <option value="{{$v}}">{{$v}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div> --}}
        
    </div>
</form>