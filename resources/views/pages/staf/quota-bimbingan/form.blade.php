<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
        
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Level</label>
                    <input type="hidden" id="departemen_id" name="departemen_id" class="form-control input-circle" placeholder="Nama Departemen" value="{{$id==-1 ? $dept_id : $det->departemen_id}}">
                        @php
                            $level=array('S1','S2','S3','Total');
                            $total=14;
                            if(isset($quo['Total']))
                            {
                                $tot=$quo['Total']->quota;
                                $t=0;
                                foreach($quo as $qv=>$vv)
                                {
                                    if($qv!='Total')
                                    {
                                        $t+=$vv->quota;
                                    }
                                }
                                $total=$tot-$t;
                            }
                        @endphp
                    <select class="bs-select form-control has-success col-md-12" syule="width:100% !important" data-placeholder="Pilih Level" name="level" id="level">
                        @if (isset($quo['Total']))    
                            @foreach ($level as $item)
                                @if ($id!=-1)
                                    @if ($item==$det->level)
                                        <option value="{{$item}}" selected="selected">{{$item}}</option>
                                    @else
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                @else
                                    @php
                                        if($item!='Total')
                                            echo '<option value="'.$item.'">'.$item.'</option>';
                                    @endphp
                                @endif
                            @endforeach
                        @else
                            <option value="Total">Total</option>
                        @endif
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <!--/span-->
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label">Quota</label>
                    
                    <input type="number" min="0" max="{{$total}}" id="quota" name="quota" class="form-control input-circle" placeholder="Quota" value="{{$id==-1 ? $total : $det->quota}}">
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