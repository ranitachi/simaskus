<form action="#" class="horizontal-form" id="simpan-bimbingan" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Tanggal Bimbingan</label>
                    <div class="input-group input-medium date date-picker" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->tanggal_bimbingan))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="tanggal_bimbingan" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->tanggal_bimbingan))}}">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Bimbingan Ke</label>
                    <input type="text" id="bimbingan_ke" name="bimbingan_ke" class="form-control input-circle" placeholder="" value="{{$id==-1 ? ($count+1) : $det->bimbingan_ke}}">
                </div>
            </div>
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    <label class="control-label">Judul Bimbingan</label>
                    <input type="text" id="judul" name="judul" class="form-control input-circle" placeholder="" value="{{$id==-1 ? '' : $det->judul}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="form-group has-success">
                    @if ($mhs->programstudi->jenjang=='S3')
                        <label class="control-label">Promotor & Co-Promotor</label>
                    @else
                        <label class="control-label">Dosen Pembimbing</label>
                    @endif
                    <select class="bs-select form-control has-success" data-placeholder="" name="dospem_id" id="dospem_id">
                        <option value="-1">-Pilih Dosen-</option>
                        @foreach ($dospem as $i => $v)
                            @if ($id!=-1)
                                @if ($det->dosen_id==$v->dosen_id)
                                    <option value="{{$v->dosen_id}}" selected="selected">{{$v->dosen->nama}}</option>    
                                @else
                                    <option value="{{$v->dosen_id}}">{{$v->dosen->nama}}</option>
                                @endif
                            @else
                                <option value="{{$v->dosen_id}}">{{$v->dosen->nama}}</option>
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
                    <label class="control-label">Deskripsi Bimbingan</label>
                    <textarea class="wysihtml5 form-control" rows="6" name="deskripsi_bimbingan">{{$id!=-1 ? $det->deskripsi_bimbingan : ''}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="form-actions right">
            <a href="{{URL::previous()}}" class="btn default">Batal</a>
            <button type="button" id="simpan" class="btn blue">
                <i class="fa fa-check"></i> Simpan</button>
        </div>
    </div>
</form>