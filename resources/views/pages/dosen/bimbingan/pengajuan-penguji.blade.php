<form action="{{$id==-1 ? url('pengajuan-penguji') : url('pengajuan-penguji/'.$id.'/'.$mahasiswa_id) }}" class="horizontal-form" id="form-pengajuan" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    @php
        $mhs=\App\Model\Mahasiswa::where('id',$mahasiswa_id)->with('programstudi')->first();
        $jlhpenguji=5;
        $pengajuan=\App\Model\Pengajuan::find($id);
        if(strpos($mhs->programstudi->nama_program_studi,'S1')!==false)
        {
            // dd($pengajuan->jenis_id);
            if(isset($q_penguji[$pengajuan->jenis_id]))
                $jlhpenguji=$q_penguji[$pengajuan->jenis_id]->quota;
        }
        elseif(strpos($mhs->programstudi->nama_program_studi,'S2')!==false)
        {
            if(isset($q_penguji['S2']))
                $jlhpenguji=$q_penguji['S2']->quota;
        }
        elseif(strpos($mhs->programstudi->nama_program_studi,'S3')!==false)
        {
            if(isset($q_penguji['S3']))
                $jlhpenguji=$q_penguji['S3']->quota;
        }
    @endphp
    <div class="form-body">
        <div class="row">
            {{-- @for ($i = 1; $i <= $jlhpenguji; $i++) --}}
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Nama Usulan Penguji</label>
                        <select class="form-control select2 has-success" multiple data-placeholder="Pilih Penguji" id="penguji1" name="penguji[]">
                            <option value="-1">-Pilih Penguji-</option>
                            @foreach ($dosen as $ii => $v)
                                {{-- @if (isset($piv_uji[$mahasiswa_id][$i]))
                                    @if ($piv_uji[$mahasiswa_id][$i]->penguji_id == $v->id)
                                        <option value="{{$v->id}}" selected="selected">{{$v->nama}}</option>   
                                    @else
                                        <option value="{{$v->id}}">{{$v->nama}}</option>       
                                    @endif
                                @else --}}
                                    <option value="{{$v->id}}">{{$v->nama}}</option>   
                                {{-- @endif --}}
                            @endforeach
                        </select>
                    </div> 
                </div>
            {{-- @endfor --}}
          
        </div>
        
    <div class="form-actions pull-right">
        <button type="submit" id="simpan" class="btn blue">
            <i class="fa fa-save"></i> Simpan</button>
    </div>
</form>
