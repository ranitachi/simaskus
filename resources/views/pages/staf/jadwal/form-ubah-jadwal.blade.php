<div class="form-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group has-success">
                <label class="control-label">Tanggal</label>
                @if ($tgl!=0)
                    <input type="text" name="datetime" placeholder="dd/mm/yyyy" class="form-control datepicker" id="dt-ubahjadwal" value="{{date('d/m/Y',strtotime($tgl))}}"/>
                @else
                    <input type="text" name="datetime" placeholder="dd/mm/yyyy" class="form-control datepicker" id="dt-ubahjadwal" value="{{date('d/m/Y',strtotime($det->tanggal))}}"/>
                @endif
            </div>
            
        </div>
        <div class="col-md-4">
            
            <div class="form-group has-success">
                <label class="control-label">Waktu</label>
                <select name="waktu" id="waktu-ubah-jadwal" class="form-control">
                    <option value="0">Pilih</option>
                    @php
                        $waktu=waktu();
                        foreach($waktu as $item)
                        {
                            if($item==$det->waktu)
                                echo '<option selected="selected" value="'.$item.'">'.$item.'</option>';
                            else{
                                if(in_array($item,$wkt))
                                    echo '<option disabled value="'.$item.'">'.$item.'</option>';
                                else
                                    echo '<option value="'.$item.'">'.$item.'</option>';
                            }
                        }
                    @endphp
                </select>
            </div>
            
        </div>
        <div class="col-md-12">
            @php
                $ruangan=\App\Model\MasterRuangan::with('departemen')->get();
            @endphp
            <div class="form-group has-success">
                <label class="control-label">Ruangan</label>
                <select name="ruangan" id="ruangan-ubah-jadwal" class="form-control" onchange="cekjadwalsidangbyruang({{$idpengajuan}},{{$mahasiswa_id}},{{$idjadwal}},{{$tgl}},this.value)">
                    <option value="0">Pilih</option>
                    @php
                        foreach($ruangan as $item)
                        {
                            if($ruangan_id==$item->id)
                                echo '<option selected value="'.$item->id.'">'.$item->departemen->nama_departemen.' -- '.$item->nama_ruangan.'</option>';
                            else
                                echo '<option value="'.$item->id.'">'.$item->departemen->nama_departemen.' -- '.$item->nama_ruangan.'</option>';
                        }
                    @endphp
                </select>
            </div>
            
        </div>
    </div>
</div>