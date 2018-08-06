<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">
            <div class="btn-group pull-left">
                <a href="javascript:generate(-1)" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal
                    <i class="fa fa-calendar"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">&nbsp;</div>
    </div>
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
                    <th>Dokumen</th>
                    <th> Penguji </th>
                    <th> Status Sidang </th>
                   
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
                    <td>
                        @foreach ($dok[$idpengajuan] as $kd => $vd)
                            <small><u>{{$kd}}</u></small><br>
                            @if ($vd->status==0)
                                <a href="#" class="btn btn-xs btn-danger btn-rounded" data-toggle="tooltip" title="Belum Di Verifikasi" style="font-size:10px;margin-right:0px;"><i class="fa fa-exclamation-circle"></i></a>    


                                <a href="javascript:setujuidokumen({{$vd->id}},1)" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i></a> 
                            @else
                                <a href="#" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Sudah Di Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i></a>

                            @endif
                            
                            <a href="{{url('unduh-file/'.$vd->file)}}" target="_blank" class="btn btn-xs btn-success" data-toggle="tooltip" title="Lihat Dokumen" style="font-size:10px;"><i class="fa fa-search"></i> Lihat</a>
                        @endforeach
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
                    <td class="text-center">
                        @if ($v->status_pengajuan==0)
                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i> Belum Disetujui
                            <br>
                            <br>
                            <a href="javascript:setujui({{$idpengajuan}},'{{$jenis}}')" class="btn btn-xs btn-primary" style="font-size:10px;"><i class="fa fa-check"></i> Setujui</a>
                            
                        @else
                            <a href="#" class="btn btn-xs btn-primary" style="font-size:10px;">Sudah Di Setujui</a>    
                        @endif
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