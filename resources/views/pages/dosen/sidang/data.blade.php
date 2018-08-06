<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Jenis<br>Pengajuan </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Hari/Tanggal<br>Ruang Sidang </th>
                    <th> Penguji </th>
                    <th> Status Sidang </th>
                    <th> ACC Sidang </th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                @endphp
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{$v->jenispengajuan->jenis}}</td>
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
                    <td class="text-left">
                        <small><u>Jadwal</u></small><br>
                        @if (count($jadwal[$idpengajuan]) != 0)
                            @if ($jadwal[$idpengajuan]->tanggal!=null)
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">{{hari($jadwal[$idpengajuan]->hari)}}, <br>{{date('d-m-Y',strtotime($jadwal[$idpengajuan]->tanggal))}}</a>
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum Ditentukan</a>
                            @endif
                        @endif
                        <br>
                        <br>
                        <small><u>Ruangan</u></small><br>
                        @if (count($jadwal) != 0)
                            @if ($jadwal[$idpengajuan]->tanggal!=null)
                                @if ($jadwal[$idpengajuan]->ruangan_id!=0)
                                    <a href="#" class="btn btn-xs btn-success">{{$jadwal[$idpengajuan]->ruangan->code_ruangan}} : {{$jadwal[$idpengajuan]->ruangan->nama_ruangan}}</a>    
                                @endif
                            @else
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>'
                            @endif
                        @else
                            <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>'
                        @endif
                    </td>
                    <td class="text-center">
                        @if (count($jadwal)!=0)                           
                            @if (isset($uji[$idpengajuan]))
                                @foreach ($uji[$idpengajuan] as $kk => $vv)
                                    {{-- @if ($vv->status==0)
                                        <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Penguji Belum Setuju" style="font-size:10px"><i class="fa fa-exclamation-circle"></i> {{$vv->dosen->nama}}</a><br>
                                    @else --}}
                                        <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="Penguji Sudah Setuju" style="font-size:10px"><i class="fa fa-user"></i> {{$vv->dosen->nama}}</a><br>
                                    {{-- @endif --}}
                                @endforeach
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum <br>Ditentukan</a>
                            @endif
                        
                            <center>
                                <a href="javascript:tambahpenguji({{$idpengajuan}})" style="font-size:10px;"><i class="fa fa-plus-circle"></i> Tambah Penguji</a>
                            </center>
                        @endif
                    </td>
                    <td>
                        @if (count($jadwal)!=0)   
                            @if ($v->status_pengajuan==0)
                                <a href="#" class="btn btn-xs btn-success" style="font-size:10px">Belum Di Setujui</a>
                            @elseif($v->status_pengajuan==1)
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Di Setujui, <br>Akan Segera Di Jadwalkan<br></a>    
                            @elseif($v->status_pengajuan==2)
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Di Jadwalkan</a>    
                            @endif
                        @endif
                    </td>
                    <td>
                        {{-- @if ($v->allow_sidang!=0)
                            <div style="width:110px;">
                                <a href="{{url('daftar-sidang/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-plus-circle"></i> Daftar Sidang</a>
                            </div>
                        @else --}}

                        {{-- @endif --}}
                        @if (isset($v->dospem_2->nama))
                            @if (isset($acc_sid[$idpengajuan][$v->dospem1]))
                                @if ($acc_sid[$idpengajuan][$v->dospem1]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$idpengajuan][$v->dospem1]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                            <strong>{{$v->dospem_1->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_2->nama))
                            @if (isset($acc_sid[$idpengajuan][$v->dospem2]))
                                @if ($acc_sid[$idpengajuan][$v->dospem2]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$idpengajuan][$v->dospem2]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                           <strong> {{$v->dospem_2->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_3->nama))
                            @if (isset($acc_sid[$idpengajuan][$v->dospem3]))
                                @if ($acc_sid[$idpengajuan][$v->dospem3]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$idpengajuan][$v->dospem3]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                            <strong>{{$v->dospem_3->nama}}</strong>
                        @endif
                    </td>
                </tr>

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