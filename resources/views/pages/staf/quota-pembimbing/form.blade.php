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
                    <label class="control-label">Level</label>
                    <input type="hidden" id="departemen_id" name="departemen_id" class="form-control input-circle" placeholder="Nama Departemen" value="{{$id==-1 ? $dept_id : $det->departemen_id}}">
                    <select class="bs-select form-control has-success col-md-12" syule="width:100% !important" data-placeholder="Pilih Level" name="level" id="level" onchange="cekjenjang(this)">
                        @php
                            $level=array('S1','S2','S3');
                        @endphp
                            @foreach ($jenis as $item)
                                @if (in_array($item->keterangan,$level))
                                
                                    @if ($id!=-1)
                                        @if ($item->id==$det->level)
                                            <option value="{{$item->id}}" selected="selected">{{$item->keterangan}}-{{$item->jenis}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->keterangan}}-{{$item->jenis}}</option>
                                        @endif
                                    @else
                                        <option value="{{$item->id}}">{{$item->keterangan}}-{{$item->jenis}}</option>
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
            <div class="col-md-6">
                <div class="form-group has-success">
                    <label class="control-label">Maksimal Jumlah Pembimbing</label>
                    
                    <input type="text" id="quota" name="quota" class="form-control input-circle" placeholder="Quota" value="{{$id==-1 ? '' : $det->quota}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group has-success">
                    <label class="control-label">Maksimal Jumlah Yang Diajukan</label>
                    
                    <input type="text" id="maksimal" name="maksimal" class="form-control input-circle" placeholder="Maksimal" value="{{$id==-1 ? '' : $det->maksimal}}">
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row" id="quota-s3" style="display: none">
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group has-success">
                    <label class="control-label">Kategori</label>
                    
                    <select class="bs-select form-control has-success col-md-12" syule="width:100% !important" data-placeholder="Pilih" name="keterangan" id="keterangan">
                        <option value="">Pilih</option>
                        <option value="Promotor" {{$id!=-1 ? ($det->keterangan=='Promotor' ? 'selected="selected"' : '') : ''}}>Promotor</option>
                        <option value="Co-Promotor" {{$id!=-1 ? ($det->keterangan=='Co-Promotor' ? 'selected="selected"' : '') : ''}}>Co-Promotor</option>
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
       
        
    </div>
</form>
<script>
    $('.bs-select').select2({'width':'100%'});
    function cekjenjang(sel)
    {
        //alert(sel.options[sel.selectedIndex].text);
        var tx=sel.options[sel.selectedIndex].text;
        var t=tx.split('-');
        if(t[0]=='S3')
        {
            $('#quota-s3').css({'display':'block'});
        }
        else
        {
            $('#quota-s3').css({'display':'none'});
        }
    }

</script>
<style>
    #pimpinan_id_chosen,.select2-selection
    {
        width:100% !important;
    }
</style>