<div class="row" style="padding:0px 20px;">
    <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            @if ($ketua==1)
                @if ($det->status_kp!=10)
                <div class="btn-group pull-right">
                    <a href="javascript:editpembimbing({{$idgrup}})" id="edit-pembimbing" class="btn sbold green"> Edit
                        <i class="fa fa-edit"></i>
                    </a>                
                </div>
                @endif
                <div class="btn-group pull-right">
                    <a href="javascript:simpanpembimbing({{$idgrup}})" id="save-pembimbing" class="btn sbold blue" style="display:none"> Simpan
                        <i class="fa fa-save"></i>
                    </a>                
                </div>
            @endif
        </div>  
</div>
<div id="data-pembimbing">    
    <form role="form" class="form-horizontal">
        <div class="form-body">
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-3 control-label" for="form_control_1">Dosen Pembimbing</label>
                <div class="col-md-9" style="padding-top:6px;">
                   @if (isset($pemb['dosen']))
                        @foreach ($pemb['dosen'] as $item)
                                <i class="fa fa-user"></i>&nbsp;{{$item->dosen->nama}}
                                @if ($ketua==1)
                                    @if ($det->status_kp!=10)
                                     &nbsp;&nbsp;<a href="javascript:hapuspembimbing({{$item->id}},'tab_1_1_4')" class="font-red-thunderbird"><i class="fa fa-trash"></i></a>
                                    @endif
                                @endif   
                                <br>
                        @endforeach
                   @endif
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-3 control-label" for="form_control_1">Pembimbing Lapangan</label>
                <div class="col-md-9" style="padding-top:6px;">
                    @if (isset($pemb['lapangan']))
                        @foreach ($pemb['lapangan'] as $item)
                        <i class="fa fa-user"></i>&nbsp;{{$item->nama}} 
                        @if ($ketua==1)
                            @if ($det->status_kp!=10)
                                &nbsp;&nbsp;<a href="javascript:hapuspembimbing({{$item->id}},'tab_1_1_4')" class="font-red-thunderbird"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif   
                        <br>
                        @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </form>
</div>
<div id="form-pembimbing" style="display:none">    
    <form role="form" class="form-horizontal" action="{{url('pembimbing-proses/'.$idgrup.'/-1')}}" method="post" id="pembimbing-simpan">
        <div class="form-body">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="kat_user" value="{{$kat_user}}">
            <input type="hidden" name="url" value="tab_1_1_4">
            <input type="hidden" name="dept_id" value="{{$dept_id}}">
           @if (isset($pemb['dosen']))  
                @if(count($pemb['dosen'])!=0)
                @foreach ($pemb['dosen'] as $idx=>$item)
                    <div class="form-group form-md-line-input has-success" id="title_1">
                    
                        <label class="col-md-3 control-label" for="form_control_1">Pembimbing </label>
                        <div class="col-md-5">
                            <select class="bs-select form-control has-success"  data-size="10" data-placeholder="Pilih Pembimbing" id="anggota_1" name="pembimbing[]">
                                <option value="-1">- Pilih -</option>
                                @foreach ($dosen as $dsn)
                                    @if ($dsn->id==$idx)
                                        <option value="{{$dsn->id}}" selected="selected">{{$dsn->nama}}</option>
                                    @else
                                        <option value="{{$dsn->id}}">{{$dsn->nama}}</option>
                                    @endif
                                        
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    
                @endforeach
                @endif
            @endif
            @for ($i = 0; $i < (3 - (isset($pemb['dosen']) ? count($pemb['dosen']) : 0)); $i++)
                <div class="form-group form-md-line-input has-success" id="title_1">
                    
                    <label class="col-md-3 control-label" for="form_control_1">Pembimbing </label>
                    <div class="col-md-5">
                        <select class="bs-select form-control has-success"  data-size="10" data-placeholder="Pilih Pembimbing" id="anggota_1" name="pembimbing[]">
                            <option value="-1">- Pilih -</option>
                            @foreach ($dosen as $dsn)
                                    <option value="{{$dsn->id}}">{{$dsn->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
            @endfor
            
            
            <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
            @if (isset($pemb['lapangan'])) 
                @if(count($pemb['lapangan'])!=0)
                    @foreach ($pemb['lapangan'] as $idx=>$item)
                    <div class="form-group form-md-line-input has-success" id="title_1">
                        <label class="col-md-3 control-label" for="form_control_1">Pembimbing Lapangan</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="pembimbing_lapangan[]" id="form_control_1" placeholder="Pembimbing Lapangan" value="{{$item->nama}}">
                        </div>
                    </div>
                    @endforeach
                @endif
            @endif
            @for ($i = 0; $i < (3 - (isset($pemb['lapangan']) ? count($pemb['lapangan']) : 0)); $i++)
                <div class="form-group form-md-line-input has-success" id="title_1">
                    <label class="col-md-3 control-label" for="form_control_1">Pembimbing Lapangan</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="pembimbing_lapangan[]" id="form_control_1" placeholder="Pembimbing Lapangan" value="">
                    </div>
                </div>
            @endfor
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
            </div>
            <div class="form-actions">
               <div class="row">
                   <div class="col-md-12">
                       <a href="javascript:simpanpembimbing({{$idgrup}})" class="btn blue pull-right" id="tambah-field" style="margin-right:20px;">Simpan&nbsp;<i class="fa fa-save"></i> </a>
                   </div>
               </div>
           </div>
        </div>
    </form>
</div>

<script>
   
    function editpembimbing(idgrup)
    {
        $('#edit-pembimbing').css('display','none');
        $('#save-pembimbing').css('display','inline');
        $('#data-pembimbing').hide();
        $('#form-pembimbing').css('display','inline');
    }
</script>
<style>
.form-padding
{
    padding-top:0px !important;
}
</style>