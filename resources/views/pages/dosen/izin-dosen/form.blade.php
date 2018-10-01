<form action="#" class="horizontal-form" id="form-izin" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
    @if ($katuser==1)
    
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group has-success">
                    <label class="control-label">Nama Dosen</label>
                    <div id="prog_studi">
                        <select class="form-control select2" data-placeholder="Pilih Dosen" name="dosen" id="dosen">
                            <option value="0">Pilih</option>
                            @foreach ($dosen as $i => $v)
                            @if ($id!=-1)
                                @if ($det->dosen_id==$v->id)
                                    <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>    
                                @else
                                    <option value="{{$v->id}}">{{$v->nama}}</option>
                                @endif
                            @else
                                <option value="{{$v->id}}">{{$v->nama}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div class="row">
            <div class="col-md-5">
                <div class="form-group has-success">
                    <label class="control-label">Sejak Tanggal</label>
                    <div class="input-group input-medium date date-picker" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->start_date))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="start_date" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->start_date))}}" id="start_date">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-5">
                <div class="form-group has-success">
                    <label class="control-label">Sampai Tanggal</label>
                    <div class="input-group input-medium date date-picker" data-date="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->end_date))}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="end_date" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{$id==-1 ? date('d-m-Y') : date('d-m-Y',strtotime($det->end_date))}}" id="end_date">
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
            <!--/span-->
            <div class="col-md-3">
                <div class="form-group has-success">
                    <label class="control-label">Sejak Pukul</label>
                    @php
                        $waktu=waktu();
                    @endphp
                    <select class="bs-select form-control has-success" data-placeholder="Waktu" name="start_time" id="start_time">
                    @foreach ($waktu as $item)
                        @if ($id!=-1)
                            @if (strpos($det->start_time,str_replace('.',':',$item))!==false)
                                <option value="{{str_replace('.',':',$item)}}" selected="selected">{{$item}}</option>
                            @else
                                <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                            @endif
                        @else
                            <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-3">
                <div class="form-group has-success">
                    <label class="control-label">Sampai Pukul</label>
                    @php
                        $waktu=waktu();
                    @endphp
                    <select class="bs-select form-control has-success" data-placeholder="Waktu" name="end_time" id="end_time">
                    @foreach ($waktu as $item)
                        @if ($id!=-1)
                            @if (strpos($det->end_time,str_replace('.',':',$item))!==false)
                                <option value="{{str_replace('.',':',$item)}}" selected="selected">{{$item}}</option>
                            @else
                                <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
                            @endif
                        @else
                            <option value="{{str_replace('.',':',$item)}}">{{$item}}</option>
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
                    <label class="control-label">Keperluan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control input-circle">{{$id==-1 ? '' : $det->keterangan}}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        
    </div>
</form>
<style>
.select2-container
{
    width:100% !important;
}
</style>
<script>
$('.date-picker').datepicker({
    rtl: App.isRTL(),
    orientation: "left",
    autoclose: true
});
$('.select2').select2();
</script>