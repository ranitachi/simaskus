<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        
        <div class="row">
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group has-success">
                    <label class="control-label">Jenis</label>
                    <input type="hidden" id="departemen_id" name="departemen_id" class="form-control input-circle" placeholder="Nama Departemen" value="{{$id==-1 ? $dept_id : $det->departemen_id}}">
                    <select class="bs-select form-control has-success col-md-12" syule="width:100% !important" data-placeholder="Pilih Level" name="level" id="level">
                        @php
                            $level=array('S1','S2','S3');
                        @endphp
                            @foreach ($jenis as $item)
                                @if ($id!=-1)
                                    @if ($item->id==$det->level)
                                        <option value="{{$item->id}}" selected="selected">{{$item->keterangan}} - {{$item->jenis}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->keterangan}} - {{$item->jenis}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}">{{$item->keterangan}} - {{$item->jenis}}</option>
                                @endif
                            @endforeach
                        
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Quota Minimal</label>
                    
                    <input type="text" id="minimal" name="minimal" class="form-control input-circle" placeholder="Minimal" value="{{$id==-1 ? '' : $det->minimal}}">
                </div>
            </div>
            <!--/span-->
        </div>
       
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Quota Maximal</label>
                    
                    <input type="text" id="quota" name="quota" class="form-control input-circle" placeholder="Quota" value="{{$id==-1 ? '' : $det->quota}}">
                </div>
            </div>
            <!--/span-->
        </div>
       
        
    </div>
</form>
<script>
    $('.bs-select').select2({'width':'100%'});
</script>
<style>
    #pimpinan_id_chosen,.select2-selection
    {
        width:100% !important;
    }
</style>