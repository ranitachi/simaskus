<div class="portlet light portlet-fit portlet-datatable bordered">
    
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    {{-- <th> Jenis<br>Mata Kuliah Spesial </th> --}}
                    <th> Judul </th>
                    {{-- <th> Pembimbing </th> --}}
                    <th> Hari/Tanggal<br>Ruang Sidang </th>
                    <th> Penguji </th>
                    <th> Dokumen </th>
                    <th> ACC Sidang Pembimbing</th>
                    <th> Status Sidang </th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                @endphp
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    {{-- <td></td> --}}
                    <td>
                        <small><u>Jenis Mata Kuliah Spesial</u></small><br>
                        <b>{{$v->jenispengajuan->jenis}}</b><br><br>
                        <small><u>Indonesia</u></small><br>
                        <strong>{{$v->judul_ind}}</strong>
                        <br>
                        <small><u>Inggris</u></small><br>
                        <strong>{{$v->judul_eng}}</strong>
                    </td>
                    @php
                        $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',Auth::user()->id_user)->where('judul_id',$v->id)->with('dosen')->get();
                    @endphp
                    {{-- <td>
                        @foreach ($p_bimbingan as $key=>$item)
                            @if (isset($item->dosen->nama))
                                <small><u>Pembimbing {{$key+1}}</u></small><br>
                                   @if ($item->status==1)
                                        <i class="fa fa-check font-blue-steel"></i>
                                    @elseif($item->status==0)
                                        <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                    @endif
                                
                                <strong>{{$item->dosen->nama}}<br></strong>
                            @endif
                        @endforeach
                    </td> --}}
                    <td class="text-left">
                        <small><u>Jadwal</u></small><br>
                        @if ($jadwal)
                            @if ($jadwal->count() != 0)
                                                            
                                @if ($jadwal[0]->tanggal!=null)
                                    {{hari($jadwal[0]->hari)}}, <br>{{date('d-m-Y',strtotime($jadwal[0]->tanggal))}}
                                @else
                                    <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum Ditentukan</a>
                                @endif
                            
                             @else
                                    <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum Ditentukan</a>
                            @endif
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px">Belum Ditentukan</a>
                        @endif
                        <br>
                        <br>
                        <small><u>Ruangan</u></small><br>
                        @if ($jadwal)
                            @if ($jadwal->count() != 0)
                                @if (isset($jadwal[0]->ruangan->nama_ruangan))
                                    <a href="#" class="btn btn-xs btn-success">{{$jadwal[0]->ruangan->code_ruangan}}</a>
                                    <a href="#" class="btn btn-xs btn-success">{{$jadwal[0]->ruangan->nama_ruangan}}</a>   
                                @else
                                    <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a> 
                                @endif
                            @else
                                <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>
                            @endif
                        @else
                            <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>
                            
                        @endif
                        
                    </td>

                    <td class="text-left">
                        @if ($jadwal)
                            @if ($jadwal->count()!=0)                            
                                @if (isset($uji[$v->id][$v->mahasiswa_id]))
                                    @foreach ($uji[$v->id][$v->mahasiswa_id] as $kk => $vv)
                                        {{-- @if ($vv->status==0)
                                            <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Penguji Belum Setuju" style="font-size:10px"><i class="fa fa-exclamation-circle"></i> {{$vv->dosen->nama}}</a><br>
                                        @else --}}
                                            <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="Penguji Sudah Setuju" style="font-size:10px"><i class="fa fa-user"></i> {{$vv->dosen->nama}}</a><br>
                                        {{-- @endif --}}
                                    @endforeach
                                @else
                                    <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Belum Ditentukan</a>
                                @endif
                                
                                <center>
                                    <a href="javascript:tambahpenguji({{$idpengajuan}},{{$v->mahasiswa_id}})" style="font-size:10px;"><i class="fa fa-plus-circle"></i> Tambah Penguji</a>
                                </center>
                            @endif
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
                    
                    <td>
                        @php
                            // dd($acc_sid);
                        @endphp
                        @foreach ($p_bimbingan as $key=>$item)
                            @if (isset($acc_sid[$v->id][Auth::user()->id_user][$item->dosen_id]))
                                @if ($acc_sid[$v->id][Auth::user()->id_user][$item->dosen_id]->status==1)
                                    <i class="fa fa-check font-blue-steel"></i>
                                @elseif($acc_sid[$v->id][Auth::user()->id_user][$item->dosen_id]->status==0)
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>    
                                @else
                                    <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                @endif
                                <strong>{{$item->dosen->nama}}<br></strong>
                            @else
                                <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                <strong>{{$item->dosen->nama}}<br></strong>
                            @endif
                            {{-- <strong>{{$item->dosen->nama}}<br></strong> --}}
                        @endforeach
                        
                        @php
                            $st_sid=0;
                            if(isset($acc_sid[$v->id][Auth::user()->id_user]))
                            {
                                foreach($acc_sid[$v->id][Auth::user()->id_user] as $k => $vv)
                                {
                                    if($v->status==1)
                                        $st_sid=1;
                                    else
                                        $st_sid=0;
                                }
                            }

                            $jlhbimbingan=\App\Model\Bimbingan::where('mahasiswa_id',Auth::user()->id_user)->where('flag',1)->get();

                            $jadwal2=\App\Model\PivotJadwal::where('judul_id',$idpengajuan)->where('mahasiswa_id',Auth::user()->id_user)->first();

                        @endphp

                        @if (is_null($jadwal2))
                            @php
                                $jum_minimal=\App\Model\QuotaJumlahBimbingan::where('level',$v->jenis_id)
                                    ->where('departemen_id',$v->mahasiswa->departemen_id)
                                    ->first();

                                if($jum_minimal)
                                    $jlh_min=$jum_minimal->minimal;
                                else
                                    $jlh_min=5;
                            @endphp 
                            @if ($jlhbimbingan->count() >= $jlh_min)
                                {{-- @if ($st_sid==1) --}}
                                
                                <div style="width:110px;">
                                    <a href="{{url('daftar-sidang/'.$idpengajuan)}}" class="btn btn-xs btn-primary"><i class="fa fa-plus-circle"></i> Daftar Sidang</a>
                                </div>
                                    
                            @else
                                <div style="width:110px;">
                                    <button data-toggle="tooltip" title="Daftar Sidang Belum Dapat Dilakukan" disable="disable" class="btn btn-xs btn-danger" onclick="belumbisadaftar()"><i class="fa fa-plus-circle"></i> Daftar Sidang</button>
                                </div>
                                    
                                {{-- @endif --}}
                            @endif
                        
                        @endif
                    </td>
                    <td class="text-center">
                        @php
                            
                        @endphp
                        @if ($jadwal)  
                            @if ($jadwal->count()!=0)  
                                @php
                                    // $acc_sidang=\App\Model\PivotSetujuSidang::where('mahasiswa_id',Auth::user()->id_user)->where('pengajuan_id',$v->id)->get();
                                    // // dd($acc_sidang);
                                    // $st_acc_sidang=0;
                                    // foreach($acc_sidang as $idx_ac=>$val_ac)
                                    // {
                                    //     if($val_ac->status==1)
                                    //         $st_acc_sidang=1;
                                    //     else
                                    //     {
                                    //         $st_acc_sidang=0;
                                    //         break;
                                    //     }
                                    // }
                                    // echo $acc_sidang->count();
                                    // echo $st_acc_sidang;
                                    // $st_acc_sidang=0;
                                    if(isset($acc_sid[$v->id][Auth::user()->id_user]))
                                    {
                                        // dd($acc_sid);
                                        foreach($acc_sid[$v->id][Auth::user()->id_user] as $k => $vv)
                                        {
                                            // echo $vv->status;
                                            if($vv->status==1)
                                                $st_acc_sidang=1;
                                            else
                                            {
                                                $st_acc_sidang=0;
                                                break;
                                            }
                                        }
                                    }
                                    // echo $st_acc_sidang;
                                @endphp 
                                @if ($st_acc_sidang==1)
                                    @if ($v->status_pengajuan==0)
                                        <a href="#" class="btn btn-xs btn-success" style="font-size:10px">Belum <br>Di Setujui</a>
                                    @elseif($v->status_pengajuan==1)
                                        <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Di Setujui, <br>Akan Di Jadwalkan</a> 
                                    @elseif($v->status_pengajuan==2)
                                        <a href="#" class="btn btn-xs btn-primary" style="font-size:10px">Sudah Dijadwalkan</a> 
                                    @endif

                                @else
                                    <a href="#" class="btn btn-xs btn-danger" style="font-size:10px">Menunggu ACC<br>Dosen Pembimbing</a> 
                                @endif
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