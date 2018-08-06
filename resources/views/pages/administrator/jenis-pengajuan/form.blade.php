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
                    <label class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->keterangan}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>