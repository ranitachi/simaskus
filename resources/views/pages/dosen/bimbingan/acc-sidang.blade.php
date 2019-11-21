@if (isset($acc->status))
    @if ($acc->status==1)
        
    <div class="row">
        <div class="col-sm-7">
            &nbsp;
        </div>
        <div class="col-md-5">
            <div class="pull-right text-center">
                <div class="alert alert-info" style="font-size:20px;">
                        <i class="fa fa-check"></i>&nbsp;<strong>Telah Di ACC Mengajukan Sidang</strong>
                    </div>
                </div>
            </div>
    </div>

    @endif
@endif
<h2 class="text-center">
    FORMULIR EVALUASI BIMBINGAN <br>TUGAS SKRIPSI     
</h2>       
    <form action="{{url('simpan-form-evaluasi-skripsi')}}" class="horizontal-form" id="simpan-acc" method="POST" style="padding:20px;">
                {{ csrf_field() }}
            <input type="hidden" name="pengajuan_id" value="{{$id}}">
            <input type="hidden" name="mahasiswa_id" value="{{$mahasiswa_id}}">
            <input type="hidden" name="dept_id" value="{{$pengajuan->departemen_id}}">
            <input type="hidden" name="dosen_id" value="{{Auth::user()->id_user}}">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">Nama Mahasiswa</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">NPM</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Tahun Akademik</div>
                        <div class="col-md-10">: <b>{{$pengajuan->tahunajaran->tahun_ajaran}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Topik Tugas Skripsi</div>
                        <div class="col-md-10">: <b>{{$pengajuan->topik_diajukan}}</b></div>
                    </div>
                    <br>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                        <thead>
                            <tr>
                                <th class="text-center"> &nbsp;</th>
                                <th class="text-center" colspan="4"> Kemajuan Penyelesaian<br>Tugas Skripsi</th>
                                <th class="text-center">&nbsp;</th>
                            </tr>
                            <tr>
                                <th class="text-center"> Uraian</th>
                                <th class="text-center"> 25%</th>
                                <th class="text-center"> 50%</th>
                                <th class="text-center"> 75%</th>
                                <th class="text-center"> 100%</th>
                                <th class="text-center"> Keteragan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian as $k => $v)
                            @php
                                if(isset($ev[$v->c_id]))
                                {
                                    $nilai=$ev[$v->c_id]->nilai;
                                    $ket=$ev[$v->c_id]->keterangan;
                                }
                                else
                                    $nilai=$ket='';
                                    
                            @endphp
                                <tr>
                                    <td class="text-left" style="text-align:left !important;padding-left:20px;">{{$v->nama_component}}</td>
                                    <td class="text-center" style="width:10%"> 
                                        <input type="radio" name="nilai[{{$v->c_id}}]" {{$nilai!='' ? ($nilai=='25%' ? 'checked="checked"' : '') : ''}} value="25%">
                                    </td>
                                    <td class="text-center" style="width:10%"> 
                                        <input type="radio" name="nilai[{{$v->c_id}}]" {{$nilai!='' ? ($nilai=='50%' ? 'checked="checked"' : '') : ''}} value="50%">
                                    </td>
                                    <td class="text-center" style="width:10%"> 
                                        <input type="radio" name="nilai[{{$v->c_id}}]" {{$nilai!='' ? ($nilai=='75%' ? 'checked="checked"' : '') : ''}} value="75%">
                                    </td>
                                    <td class="text-center" style="width:10%"> 
                                        <input type="radio" name="nilai[{{$v->c_id}}]" {{$nilai!='' ? ($nilai=='100%' ? 'checked="checked"' : '') : ''}} value="100%">
                                    </td>
                                   
                                    <td class="text-center"style="width:20%"> <input type="text" id="judul" name="keterangan[{{$v->c_id}}]" class="form-control input-circle" placeholder="" value="{{$nilai!='' ? $ket : ''}}"></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-left" colspan="6">
                                    Catatan Permasalahan yang Di Hadapi : <br>
                                    <textarea name="catatan" class="form-control" rows="10">{{$eval->count() != 0 ? $eval[0]->catatan : ''}}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <div class="form-actions right">
                            @if ($pengajuan->status_pengajuan!=0)
                                @php
                                    $jadwal=\App\Model\PivotJadwal::where('judul_id',$pengajuan->id)->first(); 
                                    // echo $jadwal->id.';;s';                               
                                @endphp
                                {{-- @if(!$jadwal) --}}
                                    <button type="submit" id="simpan-evaluasi" class="btn blue">
                                        <i class="fa fa-check"></i> Simpan</button>
                                {{-- @endif --}}
                            @endif
                        </div>
                    </center>
                </div>
            </form>