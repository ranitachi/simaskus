@php
    // $copromotor=0;
    $quota_co=2;
    // dd($quota);
    if(isset($quota->maksimal))
    {
        $quota_p=$quota->maksimal;
    }
    else 
    {
        $quota_p=5;
    }

    if($quota_p==0)
    {
        $quota_p=5;
    }
    // dd($jenis);
    // echo $quota_p;
    if(Auth::user()->kat_user==3)
        $mhs=\App\Model\Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
    else
        $mhs=\App\Model\Mahasiswa::where('id',$pengajuan[$idpengajuan]->mahasiswa_id)->with('programstudi')->first();

    $jenjang=isset($mhs->programstudi->jenjang) ? $mhs->programstudi->jenjang : 'S1';
@endphp

{{-- @for ($i = 1 ; $i <= $quota_p  ; $i++) --}}
    
@if ($jenjang=='S3')
    @php
        // $dt['departemen_id']=$quota->departemen_id;
        $dt['departemen_id']=(isset($mhs->departemen_id) ? $mhs->departemen_id : 0);
        $dt['level']=isset($quota->level) ? $quota->level : (isset($pengajuan[$idpengajuan]) ? $pengajuan[$idpengajuan]->jenis_id : 0);
        $qq=\App\Model\QuotaPembimbing::where($dt)->get();
        $qt=array();
        foreach($qq as $k=>$v)
        {
            $qt[$v->keterangan]=$v->maksimal;
        }
        $jab_promotor=jab_promotor();
        $jab_copromotor=jab_copromotor();
        // dd($dosen);
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="form-group has-success">
            <label class="control-label">Pilihan Pengajuan Promotor</label>
            
                <select class="form-control select2" data-placeholder="Pilih Promotor" placeholder="Pilih Promotor" name="promotor" id="dosen_promotor">
                    <option value="0"></option>
                    @foreach ($dosen as $idx => $v)
                        @php
                            $jabatan=str_slug($v->jabatan);
                            
                        @endphp
                        @if (count($promotor)!=0)
                            @if (in_array($v->id,$promotor))
                                
                                    @if (in_array($jabatan,$jab_promotor))
                                        @if ($jabatan=='lektor-kepala')
                                            @if ($v->pendidikan=='S3')
                                                @if (isset($piv[$v->id]))
                                                    <option selected="selected" value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                                @else
                                                    <option selected="selected" value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                                @endif
                                            @endif
                                        @else
                                            @if (isset($piv[$v->id]))
                                                <option selected="selected" value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @else
                                                <option selected="selected" value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @endif
                                        @endif
                                    @endif
                                
                            @else
                                @if (in_array($jabatan,$jab_promotor))
                                    @if ($jabatan=='lektor-kepala')
                                        @if ($v->pendidikan=='S3')
                                            @if (isset($piv[$v->id]))
                                                <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @else
                                                <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @endif
                                        @endif
                                    @else
                                        @if (isset($piv[$v->id]))
                                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @else
                                            <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @endif
                                    @endif
                                @endif
                            @endif                                                                               
                        @else
                            @if (in_array($jabatan,$jab_promotor))
                                @if ($jabatan=='lektor-kepala')
                                    @if ($v->pendidikan=='S3')
                                        @if (isset($piv[$v->id]))
                                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @else
                                            <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @endif
                                    @endif
                                @else
                                    @if (isset($piv[$v->id]))
                                        <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                    @else
                                        <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group has-success">
            <label class="control-label">Pilihan Pengajuan Co-Promotor (*Optional Maksimal {{isset($qt['Co-Promotor']) ? $qt['Co-Promotor'] : 5}} Orang)</label>
                
                <select class="form-control select2" data-placeholder="Pilih Co Promotor" name="copromotor[]" id="dosen_co" multiple>
                    @foreach ($dosen as $idx => $v)
                        @php
                            $jabatan=str_slug($v->jabatan);
                        @endphp
                        @if (count($copromotor)!=0)
                            @if (in_array($v->id,$copromotor))
                                @if (in_array($jabatan,$jab_copromotor))
                                    @if ($jabatan=='lektor')
                                        @if ($v->pendidikan=='S3')
                                            @if (isset($piv[$v->id]))
                                                <option selected="selected" value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @else
                                                <option selected="selected" value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @endif
                                        @endif
                                    @else
                                        @if (isset($piv[$v->id]))
                                            <option selected="selected" value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @else
                                            <option selected="selected" value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @endif
                                    @endif
                                @endif
                            @else
                                @if (in_array($jabatan,$jab_copromotor))
                                    @if ($jabatan=='lektor')
                                        @if ($v->pendidikan=='S3')
                                            @if (isset($piv[$v->id]))
                                                <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @else
                                                <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                            @endif
                                        @endif
                                    @else
                                        @if (isset($piv[$v->id]))
                                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @else
                                            <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @endif
                                    @endif
                                @endif
                            @endif                                                                               
                        @else    
                            @if (in_array($jabatan,$jab_copromotor))
                                @if ($jabatan=='lektor')
                                    @if ($v->pendidikan=='S3')
                                        @if (isset($piv[$v->id]))
                                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @else
                                            <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                        @endif
                                    @endif
                                @else
                                    @if (isset($piv[$v->id]))
                                        <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                    @else
                                        <option value="{{$v->id}}">[0] - {{$v->nama}} - [{{strtoupper($jabatan)}}]</option>
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

    </div>
@else

    <div class="form-group has-success">
        <label class="control-label">Pilihan Pengajuan Pembimbing ( * maksimal {{$quota_p}} Dosen)</label>
        <div class="row">
            <div class="col-md-5" style="" id="datadosen">
                @for ($i = 1; $i <=($quota_p); $i++)
                    @php
                        if($i%2!=0)
                        {
                            $border='background:#eee;';
                        }
                        else
                        {
                            $border='border:1px solid #eee;';
                        }
                    @endphp 
                    <div class="row" style="margin:2px 0px;padding:10px 0;{{$border}};height:116px">
                        <div class="col-md-10" style="">
                                <input type="text" readonly name="dospemnama[{{$i}}]" id='dosen_pem_{{$i}}' placeholder="Cari Data Dosen .." class="form-control dosen_pem" />
                                <input type="hidden" readonly name="dospem[{{$i}}]" id='dosen_pem_id_{{$i}}' class="form-control dosen_pem_id" />
                        </div>
                        
                        <div class="col-md-2">
                            <button type="button" class="btn btn-md btn-primary" onclick="choosedosen({{$i}})"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-md-7" style="">
                @for ($i = 1; $i <=($quota_p); $i++)
                    @php
                        if($i%2!=0)
                        {
                            $border='background:#eee;';
                        }
                        else
                        {
                            $border='border:1px solid #eee;';
                        }
                    @endphp 
                    <div class="row" style="margin:2px 0px;padding:10px 0;{{$border}};height:116px">
                        <div class="col-md-12">
                            <input type="text" id="kolom_topik" name="kolom_topik[{{$i}}]" class="form-control" placeholder="Topik">
                        </div>
                        <div class="col-md-12" style="padding-top:10px;">
                            <textarea class="form-control" name="deskripsi_topik[{{$i}}]" id="deskripsi-topik" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endif
<input type="hidden" id="idpembimbing">

{{-- @endfor --}}

<style>
.select2-container
{
    width:100%
}]
</style>
@php
    if(isset($qt['Co-Promotor']))
        $qco=$qt['Co-Promotor'];
    else
        $qco=2;
@endphp
<script>
    var jenjang = '{{$jenjang}}';
    if(jenjang=='S3')
    {
        var maks=parseInt("{{$qco}}");
        $('#dosen_promotor').select2({
        });
        $('#dosen_co').select2({
            maximumSelectionLength: maks
        });

    }
    else
    {
        // $('#dosen_pem_1').select2({
            $('.select2').select2({
            maximumSelectionLength: maks
        });
        
        $("#dosen_pem_1").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var id=$(this).val();
            
            // alert($(this).val());

            // disabl
            // $('#'+id).prop('disabled', !$('#'+id).prop('disabled'));
            // $('select').select2();

        });
        
    }
    // 
function choosedosen(i)
{
    var idpm=$('#idpembimbing').val();
    // $('.modal-body').load('{{url("get-pembimbing")}}/'+idpm+'/'+i);
    var kat_dosen='{{$kat_dosen}}';
    var idpengajuan='{{$idpengajuan}}';
    $('.modal-title').html('Pilih Dosen Pembimbing '+i);
    if(kat_dosen!='' && kat_dosen!=1)
    {
        $('.modal-body').load('{{url("get-pembimbing")}}/{{$idjenis}}/'+i+'/'+idpm+'/'+kat_dosen,function(){
            $('.select2').select2();
        });
    }
    else if(idpengajuan!='')
    {
        if(idpm=='')
        {
            $('.modal-body').load('{{url("get-pembimbing")}}/{{$idjenis}}/'+i+'/-1/'+kat_dosen+'/'+idpengajuan,function(){
                $('.select2').select2();
            });
        }
        else
        {
            $('.modal-body').load('{{url("get-pembimbing")}}/{{$idjenis}}/'+i+'/'+idpm+'/'+kat_dosen+'/'+idpengajuan,function(){
                $('.select2').select2();
            });
        }
    }
    else if(idpm!='')
    {
        $('.modal-body').load('{{url("get-pembimbing")}}/{{$idjenis}}/'+i+'/'+idpm ,function(){
            $('.select2').select2();
        });   
    }
    else
    {
        $('.modal-body').load('{{url("get-pembimbing")}}/{{$idjenis}}/'+i,function(){
            $('.select2').select2();
        });   
    }
    $('#ajax').modal('show');
    $('button#ok').one('click',function(){
        // var id=$('#dosen_pem_'+i).val();
        // var vid=$('#dosen_pemb_'+i+' :selected').text();
        // // alert(vid+'-'+i)
        // vid=vid.replace(/Pilih/g,'');
        // $('#dosen_pem_'+i).val(vid);
        $('#ajax').modal('hide');
    });

    
}
function pilihdos(val,ix)
{
    // alert(val,ix);
    var x=val.split('__');
    nama=x[1];
    // alert(val+'--'+nama)
    $('#dosen_pem_'+ix).val(nama);
    $('#dosen_pem_id_'+ix).val(x[0]);
    $('#ajax').modal('hide');
    pilihdosen(x[0],ix);
}
function pilihdosen(iddosen,i)
{
    var idpm='';
    $('input.dosen_pem_id').each(function(){
        var dt=$(this).attr('id');
        var idd=$(this).val();
        if(idd=='')
            idpm+=0+'_';
        else
            idpm+=idd+'_';
    });
    // alert(idpm);
    $('#idpembimbing').val(idpm);
    
}
</script>
<style>
.select2-container{
    width:100% !important;
}
</style>