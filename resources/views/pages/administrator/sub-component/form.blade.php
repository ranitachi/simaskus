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
                    <label class="control-label">Komponen</label>
                    <select class="bs-select form-control has-success" data-placeholder="Pilih Komponen" name="component_id" id="component_id">
                        <option value="-1">-Pilih Komponen-</option>
                        @foreach ($com_module as $i => $v)
                            @if ($id!=-1)
                                @if ($det->component_id==$v->c_id)
                                    <option value="{{$v->c_id}}" selected="selected">{{$v->jenis}} - {{$v->code_component}} - {{$v->nama_component}}</option>    
                                @endif
                            @else
                                <option value="{{$v->c_id}}">{{$v->jenis}} - {{$v->code_component}} - {{$v->nama_component}}</option>
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
                    <label class="control-label">Nama Sub Komponen</label>
                    <input type="text" id="jenjang" name="nama_sub_component" class="form-control input-circle" placeholder="Sub Komponen" value="{{$id==-1 ? '' : $det->nama_sub_component}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Nilai Min</label>
                    <input type="text" id="nilai_min" name="nilai_min" class="form-control input-circle" placeholder="Nilai Min" value="{{$id==-1 ? '' : $det->nilai_min}}" value="0">
                </div>
            </div>
          
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Nilai Max</label>
                    <input type="text" id="nilai_max" name="nilai_max" class="form-control input-circle" placeholder="Nilai Max" value="{{$id==-1 ? '' : $det->nilai_max}}" value="0">
                </div>
            </div>
          
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Huruf Mutu</label>
                    <input type="text" id="huruf_mutu" name="huruf_mutu" class="form-control input-circle" placeholder="Huruf Mutu" value="{{$id==-1 ? '' : $det->huruf_mutu}}" value="0">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" class="form-control input-circle" placeholder="Keterangan" value="{{$id==-1 ? '' : $det->keterangan}}" value="0">
                </div>
            </div>
          
           
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