<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> NPM<br>Mahasiswa </th>
                    <th> Mata Kuliah Spesial </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Hari/Tanggal/<br>Ruangan Sidang </th>
                    <th> Penguji </th>
                    <th> Dokumen Sidang </th>
                   
                </tr>
            </thead>
            
            <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($pengajuan as $i => $v)
            @if (count($jadwal) != 0)
                @if (isset($v->jenispengajuan->keterangan))
                    
                    @php
                        $back=$pesan='';
                        $idpengajuan=$v->id;
                        if($v->jenispengajuan->keterangan=='S3')
                        {
                            if(str_slug($v->jenispengajuan->jenis)=='sidang-promosi')
                            {
                                if($v->acc_manager_akademik==0)
                                {
                                    //$back='background:pink';
                                    $pesan="<i style='color: red'>Jadwal Ini Belum Di ACC <br>Manager Akademik</i>";
                                }
                            }
                        }
                    @endphp
                    <tr class="odd gradeX" data-toggle="tooltip" title="Penguji Sudah Setuju">
                        <td>{{($no)}}</td>
                        <td style="{{$back}}">
                        
                            <b>
                            {{$v->mahasiswa->nama}}</b><br>
                            {{$v->mahasiswa->npm}}<br>
                            {{$v->mahasiswa->programstudi->nama_program_studi}}
                            <br>
                            <br>
                            <br>
                            
                        </td>
                        <td style="{{$back}}">
                            
                            @if ($v->jenispengajuan->keterangan=='S2')
                                <b>Thesis</b>
                            @else
                                <b>{{$v->jenispengajuan->jenis}}</b>
                            @endif
                            
                            <br><br>T.A. <br>{{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}</td>
                        <td>
                        
                            <small><u>Indonesia</u></small><br>
                            <strong>{{$v->judul_ind}}</strong>
                            <br>
                            <small><u>Inggris</u></small><br>
                            <strong>{{$v->judul_eng}}</strong>
                        </td>
                        <td>
                            
                            @php
                                $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',$v->mahasiswa_id)->where('judul_id',$idpengajuan)->with('dosen')->orderBy('keterangan','desc')->get();
                            @endphp
                            @foreach ($p_bimbingan as $key=>$item)
                                @if (isset($item->dosen->nama))
                                    @if ($v->jenispengajuan->keterangan=='S3')
                                        @if (str_slug($v->jenispengajuan->jenis)=='ujian-hasil-riset')
                                            <small><u><b>{{ucwords($item->keterangan)}}</b></u></small><br>     
                                        @endif
                                    @else 
                                        <small><u>Pembimbing {{$key+1}}</u></small><br>
                                    @endif
                                    <strong>{{$item->dosen->nama}}<br></strong>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-left">
                            <small><u>Jadwal : </u></small><br>
                            @if (count($jadwal) != 0)
                                @if (isset($jadwal[$idpengajuan]->tanggal))
                                    
                                
                                    @if ($jadwal[$idpengajuan]->tanggal!=null)
                                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;text-align:left">{{hari($jadwal[$idpengajuan]->hari)}}, 
                                            {{date('d-m-Y',strtotime($jadwal[$idpengajuan]->tanggal))}}
                                            <br>Pukul : {{$jadwal[$idpengajuan]->waktu}}
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                                    @endif
                                @endif
                            @else
                                    <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                            @endif
                            <br>
                            <br>
                            <small><u>Ruangan : </u></small><br>
                            @if (count($jadwal) != 0)
                                @if (isset($jadwal[$idpengajuan]->ruangan_id))
                                    @if ($jadwal[$idpengajuan]->ruangan_id!=0)
                                        <a href="#" class="btn btn-xs btn-success" style="font-size:10px;">{{$jadwal[$idpengajuan]->ruangan->code_ruangan}} : {{$jadwal[$idpengajuan]->ruangan->nama_ruangan}}</a>
                                    @else
                                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                                    @endif
                                @endif
                            @else
                                    <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            @endif

                        </td>
                        
                        <td class="text-left">
                        @if(count($jadwal)!=0)
                            @if (isset($jadwal[$idpengajuan]->id))
                                
                                @if (isset($uji[$idpengajuan][$v->mahasiswa_id]))
                                    @foreach ($uji[$idpengajuan][$v->mahasiswa_id] as $kk => $vvv)
                                        {{-- @if ($vv->status==0)
                                                <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Penguji Belum Setuju"><i class="fa fa-exclamation-circle"></i> {{$vv->dosen->nama}}</a><br>
                                            @else --}}
                                                <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="Penguji Sudah Setuju" style="font-size:10px;"><i class="fa fa-user"></i> {{$vvv->dosen->nama}}</a><br>
                                            {{-- @endif --}}
                                    @endforeach
                                @endif
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            @endif
                        @endif
                        <br>
                        <br>
                        @if ($pesan!='')
                            
                        
                            {!!$pesan!!}
                            <br>
                            <a href="javascript:setujumanager({{$idpengajuan}},{{$v->mahasiswa_id}})" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i> SETUJUI</a> 
                        @endif
                        </td>
                        
                    <td class="text-left">
                        @if(count($jadwal)!=0)
                                @if (isset($jadwal[$idpengajuan]->jadwal_id))

                                    <a href="{{url('form-penilaian/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-danger" style="font-size:10px;"><i class="fa fa-list"></i> Form Penilaian</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/daftar-hadir-sidang/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px"><i class="fa fa-download"></i> Daftar Hadir Sidang</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/undangan-sidang/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px"><i class="fa fa-download"></i> Undangan Sidang</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/berita-acara-sidang/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Berita Acara Sidang</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/form-nilai-penguji/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Nilai Penguji</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/form-nilai-pembimbing/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Nilai Pembimbing</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/form-catatan-penguji/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Catatan Penguji</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/lembar-penetapan-judul/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Lembar Penetapan Judul</a>
                                    <br>
                                    <a href="{{url('berkas-sidang/daftar-perbaikan/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" target="_blank" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Daftar Perbaikan</a>
                                    <br>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endif
                @endif
            @endforeach                
            </tbody>
        </table>
    </div>
</div>
<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>