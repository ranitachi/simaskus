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
    $mhs=\App\Model\Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
    $jenjang=isset($mhs->programstudi->jenjang) ? $mhs->programstudi->jenjang : 'S1';
@endphp

{{-- @for ($i = 1 ; $i <= $quota_p  ; $i++) --}}
    
@if ($jenjang=='S3')
@php
    $dt['departemen_id']=$quota->departemen_id;
    $dt['level']=$quota->level;
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
        <label class="control-label">Pilihan Pengajuan Co-Promotor (*Optional Maksimal {{$qt['Co-Promotor']}} Orang)</label>
        
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
        
            <select class="form-control select2" data-placeholder="Pilih Dosen" name="dospem[]" id="dosen_pem" multiple>
                @foreach ($dosen as $idx => $v)
                    @if ($jenjang=='S2')
                        @if ($v->pendidikan=='S3')
                            @if (isset($piv[$v->id]))
                                <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} </option>
                            @else
                                <option value="{{$v->id}}">[0] - {{$v->nama}} </option>
                            @endif
                        @endif
                    @else
                        @if (isset($piv[$v->id]))
                            {{-- @if (count($piv[$v->id])==$quota_bim[$jenis->keterangan]->quota) --}}
                                {{-- <option value="{{$v->id}}" disabled>[{{count($piv[$v->id])}}] - {{$v->nama}} </option> --}}
                            {{-- @else --}}
                            {{-- @endif --}}
                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} </option>
                        @else
                            <option value="{{$v->id}}">[0] - {{$v->nama}} </option>
                        @endif
                    @endif
                @endforeach
            </select>
        
    </div>
@endif
    

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
        $('.select2').select2({
            maximumSelectionLength: maks
        });
        $("select").on("select2:select", function (evt) {
                var element = evt.params.data.element;
                // alert($(this).val());
                var id=$(this).val();
                $('#kolom_topik').load('{{url("kolom-topik")}}/'+id);
                var $element = $(element);
                
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");       
        });
        $("select").on("select2:unselect", function (evt) {
            var id=$(this).val();
            $('#kolom_topik').load('{{url("kolom-topik")}}/'+id);
        });
    }
    // 

</script>