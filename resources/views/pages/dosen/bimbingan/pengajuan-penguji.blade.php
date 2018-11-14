<form action="{{$id==-1 ? url('pengajuan-penguji') : url('pengajuan-penguji/'.$id.'/'.$mahasiswa_id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    @php
        $pembimbing=\App\Model\PivotBimbingan::where('mahasiswa_id',$mahasiswa_id)->where('judul_id',$id)->get();
        $pemb=array();
        foreach($pembimbing as $k => $v)
        {
            $pemb[]=$v->dosen_id;
        }
        // dd($pemb);
        $penguji=\App\Model\PivotPenguji::where('mahasiswa_id',$mahasiswa_id)->where('pengajuan_id',$id)->get();
        $peng=array();
        foreach($penguji as $k => $v)
        {
            $peng[]=$v->penguji_id;
        }
    @endphp
    <div class="form-body">
        <div class="row">
            {{-- @for ($i = 1; $i <= $jlhpenguji; $i++) --}}
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Nama Usulan Penguji</label>
                        <select class="form-control has-success" multiple data-placeholder="Pilih Penguji" id="penguji1" name="penguji[]">
                            <option value="-1">-Pilih Penguji-</option>
                            @foreach ($dosen as $ii => $v)
                                {{-- @if (isset($piv_uji[$mahasiswa_id][$i]))
                                    @if ($piv_uji[$mahasiswa_id][$i]->penguji_id == $v->id)
                                        <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>   
                                    @else
                                        <option value="{{$v->id}}">{{$v->nama}}</option>       
                                    @endif
                                @else --}}
                                    @if (!in_array($v->id,$pemb))
                                        <option value="{{$v->id}}">{{$v->nama}}</option>   
                                    @endif

                                    @if (in_array($v->id,$peng))
                                        <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>   
                                    @else
                                        <option value="{{$v->id}}">{{$v->nama}}</option>   
                                    @endif
                                {{-- @endif --}}
                            @endforeach
                        </select>
                    </div> 
                </div>
            {{-- @endfor --}}
          
        </div>
        
    <div class="form-actions pull-right">
        @if (count($peng)!=0)
            <a type="button" id="" href="{{url('daftar-bimbingan')}}" class="btn btn-warning">
                <i class="fa fa-fast-forward"></i> Skip
            </a>    
        @endif
        <button type="submit" id="simpan" class="btn blue">
            <i class="fa fa-save"></i> Simpan</button>
    </div>
</form>
<style>
.select2-container
{
    width:100% !important;
}
</style>