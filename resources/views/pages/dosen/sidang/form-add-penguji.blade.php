<form action="{{url('add-penguji/'.$dept_id) }}" class="horizontal-form" id="form-add-penguji" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Nama Penguji</label>
                    <select class="select2 form-control has-success col-md-12" data-placeholder="Pilih Penguji" id="dosen_id" name="dosen_id">
                        <option value="-1">-Pilih Penguji-</option>
                        @foreach ($dosen as $k=>$v)
                            <option value="{{$v->id}}">{{$v->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>