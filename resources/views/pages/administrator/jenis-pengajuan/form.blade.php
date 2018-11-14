<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Kode Jenis</label>
                    <input type="text" id="code" name="code" class="form-control input-circle" placeholder="Kode Jenis" value="{{$id==-1 ? '' : $det->code}}">
                </div>
            </div>
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Jenis</label>
                    <input type="text" id="jenis" name="jenis" class="form-control input-circle" placeholder="Jenis" value="{{$id==-1 ? '' : $det->jenis}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Level</label>
                    <input type="hidden" name="departemen_id" value="{{$dept_id}}">
                    {{-- <textarea name="keterangan" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->keterangan}}</textarea> --}}
                    <select class="bs-select form-control has-success col-md-12" syule="width:100% !important" data-placeholder="Pilih Level" name="keterangan" id="level">
                        @php
                            $level=array('S1','S2','S3');
                        @endphp
                            @foreach ($level as $item)
                                @if ($id!=-1)
                                    @if ($item==$det->keterangan)
                                        <option value="{{$item}}" selected="selected">{{$item}}</option>
                                    @else
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                @else
                                    <option value="{{$item}}">{{$item}}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>