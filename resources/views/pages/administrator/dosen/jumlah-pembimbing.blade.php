@for ($i = 1 ; $i <= $quota->quota ; $i++)
    

    <div class="form-group has-success">
        <label class="control-label">Dosen Pembimbing {{$i}}</label>
        
            <select class="form-control select2" data-placeholder="Pilih Dosen" name="dospem[]" id="dosen">
                <option value="0">Pilih</option>
                @foreach ($dosen as $idx => $v)
                    @if (isset($piv[$v->id]))
                        @if (count($piv[$v->id])==$quota_bim[$jenis->keterangan])
                            <option value="{{$v->id}}" disabled>[{{count($piv[$v->id])}}] - {{$v->nama}} </option>
                        @else
                            <option value="{{$v->id}}">[{{count($piv[$v->id])}}] - {{$v->nama}} </option>
                        @endif
                        
                    @else
                        <option value="{{$v->id}}">[0] - {{$v->nama}} </option>
                    @endif
                @endforeach
            </select>
        
    </div>

@endfor

<style>
.select2-container
{
    width:100%
}
</style>