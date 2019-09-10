<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">
            @if (Auth::user()->kat_user==1)
                
            
            {{-- <div class="btn-group pull-left">
                <a href="{{url('data-jadwal-kp-form/-1')}}" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal Sidang KP
                    <i class="fa fa-calendar"></i>
                </a>
            </div> --}}
            @endif
        </div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                @php
                    $state=0;
                @endphp
                @foreach ($pengajuan as $i => $v)
                    @php
                        if (strpos(strtolower($v->jenispengajuan->jenis),'kerja praktek')!==false)
                        {
                            $state=1;
                        }                         
                    @endphp
                @endforeach
                @if ($state==0)
                    
                {{-- <a href="{{url('data-kp/-1/'.Auth::user()->kat_user)}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
                    <i class="fa fa-plus"></i>
                </a> --}}
                @endif
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Tanggal Pengajuan </th>
                    <th> Nama Mahasiswa (NPM) </th>
                    {{-- @if ($pengajuan->count() !=0)
                        @if ($pengajuan[0]->status_pengajuan!=0) --}}
                            <th> Grup KP </th>
                            {{-- <th> Lokasi KP</th> --}}
                            <th> Informasi <br>Kerja Praktek </th>
                            {{-- <th> Status <br>Pelaksanaan KP </th> --}}
                        {{-- @endif
                    @endif --}}
                    <th> Status <br>Pengajuan</th>
                    <th><div style="width:60px;"> #</div></th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                    if(isset($grupkp[$v->mahasiswa_id]))
                    {
                        // $idgrup=$grupkp[$v->mahasiswa_id]->code;
                        $idgrup=key($grupkp[$v->mahasiswa_id]);
                        if(Auth::user()->kat_user==1)
                        {
                            if(isset($jadwal[$idgrup]))
                                continue;
                        }
                        // break;
                    }
                    
                    // if (in_array($v->mahasiswa_id,$d_grup))
                    //     continue;                            
                        
                @endphp
                @if (isset($v->mahasiswa->nama))
                    <tr class="odd gradeX">
                            
                        <td>{{($no)}}</td>
                        <td>{{tgl_indo($v->created_at)}}</td>
                        <td>{{$v->mahasiswa->nama}}<br><span class="font-blue-madison">NPM : {{$v->mahasiswa->npm}}</span></td>
                        
                        @if ($v->status_pengajuan!=0) 
                            
                            <td>
                                @if (isset($grupkp[$v->mahasiswa_id]))
                                    @foreach ($grupkp[$v->mahasiswa_id] as $grup_id=> $grp)
                                        <a class="btn btn-success btn-xs"><i class="fa fa-users"></i> {{$grp->nama_kelompok}}</a>
                                        @php
                                            break;
                                        @endphp
                                    @endforeach
                                @else
                                    <span class="label label-warning label-sm">Belum Memiliki Grup</span>
                                @endif
                            </td>
                            <td>
                                <small>Lokasi KP</small><br>
                                @if (isset($grupkp[$v->mahasiswa_id]))
                                    @foreach ($grupkp[$v->mahasiswa_id] as $grup_id=> $grp)
                                        @if (isset($infokp[$grp->code]))
                                            <a class="btn btn-primary btn-xs"><i class="fa fa-building"></i> {{$infokp[$grp->code]['instansiperusahaan']->isi}}</a>
                                        @endif
                                    @endforeach
                                @endif
                                
                                <br>
                                <br>
                                <small>Status KP</small><br>
                                {!! $v->status_kp == 0 ? '<a class="btn btn-warning btn-xs"><i class="fa fa-exclamation-circle"></i> Belum Di Mulai</a>' : ($v->status_kp == 1 ? '<a class="btn btn-info btn-xs"><i class="fa fa-check"></i> Sedang Berjalan</a>' : ($v->status_kp == 2 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Sudah Selesai</a>' : ($v->status_kp == 10 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Sudah Dijadwalkan</a>' : '<a class="btn btn-danger btn-xs">Tidak Disetujui</a>')))!!}
                                <br>
                                
                                <br>
                                <small>Jadwal KP</small><br>
                                <div class="text-left">
                                    @if (isset($grupkp[$v->mahasiswa_id]))
                                        @foreach ($grupkp[$v->mahasiswa_id] as $grup_id=> $grp)
                                            @if (isset($infokp[$grp->code]))
                                                <b><i class="fa fa-clock-o"></i> {{$infokp[$grp->code]['periode-awal']->isi}}</b><br>s.d.<br>
                                                <b><i class="fa fa-clock-o"></i> {{$infokp[$grp->code]['periode-selesai']->isi}}</b>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        @else
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        @endif
                        <td>
                            @if($v->status_pengajuan == 0)
                                <a class="btn btn-info btn-xs">Belum Di Verifikasi</a>
                        @elseif($v->status_pengajuan == 1)
                            <a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Di Setujui</a>
                        @elseif($v->status_pengajuan == 2)
                            <a class="btn btn-info btn-sm">Telah Selesai</a>
                        @else
                            <a class="btn btn-danger btn-xs">Tidak Disetujui</a>
                        @endif
                            @if ($v->status_pengajuan == 0)
                                <a href="javascript:verifikasi({{$v->id}})" id="sample_editable_1_new" class="btn btn-xs blue" style="margin-left:10px;"> Verifikasi
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
                        </td>

                        <td style="text-center">
        
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"> Tombol Aksi
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="{{url('data-kp-detail/'.$v->id.'/'.Auth::user()->kat_user)}}"><i class="fa fa-eye"></i>&nbsp;Detail KP</a>
                                        </li>
                                        @if ($v->status_kp!=10)
                                            <li>
                                                <a href="{{url('data-kp/'.$v->id.'/'.Auth::user()->kat_user)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->kat_user!=2) 
                                            <li>
                                                <a href="{{url('data-kp/'.$pjuan->id.'/'.Auth::user()->kat_user)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                            </li>
                                        @endif
                                        @if($v->status_kp==0)
                                            <li>
                                                <a href="javascript:hapus({{$v->id}})" class=""><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
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