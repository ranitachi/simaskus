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
                    <th> Dokumen </th>
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
                        @if ($jadwal->count() != 0)
                        @if ($jadwal[0]->tanggal!=null)
                        {{hari($jadwal[0]->hari)}}, <br>{{date('d-m-Y',strtotime($jadwal[0]->tanggal))}}
                        @else
                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum Ditentukan</a>
                        @endif
                        @endif
                        <br>
                        <br>
                        <small><u>Ruangan</u></small><br>
                        {!!$jadwal->count()!=0 ? ($jadwal[0]->ruangan_id!=0 ? '<a href="#" class="btn btn-xs btn-success">'.$jadwal[0]->ruangan->code_ruangan.' : '.$jadwal[0]->ruangan->nama_ruangan.'</a>' : '<a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>') : ''!!}
                    </td>

                    <td class="text-left">
                        @if ($jadwal->count()!=0)                            
                            @if (isset($uji[$v->mahasiswa_id]))
                                @foreach ($uji[$v->mahasiswa_id] as $kk => $vv)
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
                    
                    <td >
                        @foreach ($dok as $kd => $vd)
                            <div style="width:100px;">
                                <small><u>{{$kd}}</u></small><br>
                                @if ($vd->status==0)
                                    <a href="#" class="btn btn-xs btn-danger btn-rounded" data-toggle="tooltip" title="Belum Di Verifikasi" style="font-size:10px;margin-right:0px;"><i class="fa fa-exclamation-circle"></i></a>    
                                @else
                                    <a href="#" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Sudah Di Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i></a> 
                                @endif

                                <a href="{{url('unduh-file/'.$vd->file)}}" target="_blank" class="btn btn-xs btn-success" data-toggle="tooltip" title="Lihat Dokumen" style="font-size:10px;margin-right:0px;"><i class="fa fa-search"></i> Lihat</a>

                                @if ($vd->status==0)
                                    <a href="#" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Upload Kembali" style="font-size:10px;margin-right:0px;"><i class="fa fa-upload"></i></a>   
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @if ($jadwal->count()!=0)   
                            @if ($v->status_pengajuan==0)
                                <a href="#" class="btn btn-xs btn-success" style="font-size:10px">Belum <br>Di Setujui</a>
                            @elseif($v->status_pengajuan==1)
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Di Setujui, <br>Akan Di Jadwalkan</a> 
                            @elseif($v->status_pengajuan==2)
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Dijadwalkan</a> 
                            @endif
                        @endif
                    </td>
                    <td>
                        
                        @if (isset($v->dospem_2->nama))
                            @if (isset($acc_sid[$v->mahasiswa_id][$v->dospem1]))
                                @if ($acc_sid[$v->mahasiswa_id][$v->dospem1]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$v->mahasiswa_id][$v->dospem1]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                            <strong>{{$v->dospem_1->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_2->nama))
                            @if (isset($acc_sid[$v->mahasiswa_id][$v->dospem2]))
                                @if ($acc_sid[$v->mahasiswa_id][$v->dospem2]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$v->mahasiswa_id][$v->dospem2]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                           <strong> {{$v->dospem_2->nama}}<br></strong>
                        @endif
                        @if (isset($v->dospem_3->nama))
                            @if (isset($acc_sid[$v->mahasiswa_id][$v->dospem3]))
                                @if ($acc_sid[$v->mahasiswa_id][$v->dospem3]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$v->mahasiswa_id][$v->dospem3]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                            @endif
                            <strong>{{$v->dospem_3->nama}}</strong>
                        @endif
                        @php
                            $st_sid=0;
                            if(isset($acc_sid[Auth::user()->id_user]))
                            {

                                foreach($acc_sid[Auth::user()->id_user] as $k => $v)
                                {
                                    if($v->status==1)
                                    $st_sid=1;
                                    else
                                    $st_sid=0;
                                }
                            }
                        @endphp

                        @if ($jadwal->count()==0)
                            @if ($st_sid==1)
                            <div style="width:110px;">
                                <a href="{{url('daftar-sidang/'.$idpengajuan)}}" class="btn btn-xs btn-primary"><i class="fa fa-plus-circle"></i> Daftar Sidang</a>
                            </div>
                                
                            @else
                            <div style="width:110px;">
                                <button data-toggle="tooltip" title="Daftar Sidang Belum Dapat Dilakukan" disable="disable" class="btn btn-xs btn-danger"><i class="fa fa-plus-circle"></i> Daftar Sidang</button>
                            </div>
                                
                            @endif
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