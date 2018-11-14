@php
    if(isset($quota->maksimal))
    {
        $quota_p=$quota->maksimal;
    }
    else {
        $quota_p=5;
    }

    if($quota_p==0)
        $quota_p=5;
    // dd($quota);
    // echo $quota_p;
@endphp

{{-- @for ($i = 1 ; $i <= $quota_p  ; $i++) --}}
    

    <div class="form-group has-success">
        <label class="control-label">Pilihan Pengajuan Pembimbing ( * maksimal {{$quota_p}} Dosen)</label>
        
            <select class="form-control select2" data-placeholder="Pilih Dosen" name="dospem[]" id="dosen_pem" multiple>
                @foreach ($dosen as $idx => $v)
                    @if (isset($piv[$v->id]))
                        @if (count($piv[$v->id])==$quota_bim[$jenis->keterangan]->quota)
                            {{-- <option value="{{$v->id}}" disabled>[{{count($piv[$v->id])}}] - {{$v->nama}} </option> --}}
                        @else
                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} </option>
                        @endif
                        
                    @else
                        <option value="{{$v->id}}">[0] - {{$v->nama}} </option>
                    @endif
                @endforeach
            </select>
        
    </div>

{{-- @endfor --}}

<style>
.select2-container
{
    width:100%
}
</style>
<script>
    var maks=parseInt('{{$quota_p}}');
    $('.select2').select2({
        maximumSelectionLength: maks
    });
    $("select").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);
            
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
    });
</script>