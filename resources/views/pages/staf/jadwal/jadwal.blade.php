<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> NPM<br>Mahasiswa </th>
                    <th> Jenis<br>Pengajuan </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Hari/Tanggal/<br>Ruangan Sidang </th>
                    <th> Penguji </th>
                    <th> Dokumen Sidang </th>
                   
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
            @if (count($jadwal) != 0)
                @php
                    $idpengajuan=$v->id;
                @endphp
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{$v->mahasiswa->npm}}<br><b>{{$v->mahasiswa->nama}}</b></td>
                    <td><b>{{$v->jenispengajuan->jenis}}</b><br><br>T.A. <br>{{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}</td>
                    <td>
                        <small><u>Indonesia</u></small><br>
                        <strong>{{$v->judul_ind}}</strong>
                        <br>
                        <small><u>Inggris</u></small><br>
                        <strong>{{$v->judul_eng}}</strong>
                    </td>
                    <td>
                        @if (isset($v->dospem_2->nama))
                            <small><u>Pembimbing 1</u></small><br>
                            @if (isset($piv[$v->mahasiswa_id][$v->dospem1]))
                                @if ($piv[$v->mahasiswa_id][$v->dospem1]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($piv[$v->mahasiswa_id][$v->dospem1]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @endif
                            <strong>{{$v->dospem_1->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_2->nama))
                            <small><u>Pembimbing 2</u></small><br>
                            @if (isset($piv[$v->mahasiswa_id][$v->dospem2]))
                                @if ($piv[$v->mahasiswa_id][$v->dospem2]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($piv[$v->mahasiswa_id][$v->dospem2]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @endif
                           <strong> {{$v->dospem_2->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_3->nama))
                            <small><u>Pembimbing 3</u></small><br>
                            @if (isset($piv[$v->mahasiswa_id][$v->dospem3]))
                                @if ($piv[$v->mahasiswa_id][$v->dospem3]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($piv[$v->mahasiswa_id][$v->dospem3]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @endif
                            <strong>{{$v->dospem_3->nama}}</strong>
                        @endif
                    </td>
                    <td class="text-center">
                        <small><u>Jadwal : </u></small><br>
                        @if (count($jadwal) != 0)
                            @if ($jadwal->tanggal!=null)
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">{{hari($jadwal->hari)}}, <br>{{date('d-m-Y',strtotime($jadwal->tanggal))}}</a>
                            @else
                                <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                            @endif
                        @else
                                <a href="#" class="btn btn-xs btn-info">Belum Ditentukan</a>
                        @endif
                        <br>
                        <br>
                        <small><u>Ruangan : </u></small><br>
                        @if (count($jadwal) != 0)
                            @if ($jadwal->ruangan_id!=0)
                                <a href="#" class="btn btn-xs btn-success" style="font-size:10px;">{{$jadwal->ruangan->code_ruangan}} : {{$jadwal->ruangan->nama_ruangan}}</a>
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            @endif
                        @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                        @endif

                    </td>
                    
                    <td class="text-center">
                    @if(count($jadwal)!=0)
                        @if (isset($uji[$jadwal->id]))
                            @foreach ($uji[$jadwal->id] as $kk => $vv)
                                {{-- @if ($vv->status==0)
                                        <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Penguji Belum Setuju"><i class="fa fa-exclamation-circle"></i> {{$vv->dosen->nama}}</a><br>
                                    @else --}}
                                        <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="Penguji Sudah Setuju" style="font-size:10px;"><i class="fa fa-user"></i> {{$vv->dosen->nama}}</a><br>
                                    {{-- @endif --}}
                            @endforeach
                        @else
                            <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                        @endif
                    @endif
                    </td>
                    
                   <td class="text-left">
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;"><i class="fa fa-download"></i> Daftar Hadir Sidang</a>
                        <br>
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px"><i class="fa fa-download"></i> Undangan Sidang</a>
                        <br>
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Berita Acara Sidang</a>
                        <br>
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Nilai Penguji</a>
                        <br>
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Catatan Penguji</a>
                        <br>
                    </td>
                </tr>
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