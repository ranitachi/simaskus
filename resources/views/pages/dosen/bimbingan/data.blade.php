
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Jenis Bimbingan </th>
                    <th> Data Mahasiswa </th>
                    <th> Judul </th>
                    @if ($jenis=='pengajuan')
                        <th> Kesediaan Pembimbing </th>
                    @else
                        <th class="text-center"> Dokumen Sidang </th>
                        <th class="text-center"> Status Sidang </th>
                        <th class="text-center"> Bimbingan </th>
                    @endif
                    <th> Tombol Aksi </th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($data as $k =>$v)
                @if ($jenis=='pengajuan')
                    @if (isset($piv[$v->mahasiswa_id]) && $v->status_pengajuan==0)
                            @if ($piv[$v->mahasiswa_id]->status==0)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td> {{$v->jenispengajuan->jenis}}</td>
                                    <td>
                                        <i>NPM</i> : <br>
                                        <b>{{$v->mahasiswa->npm}}</b>
                                        <br>
                                        <br>
                                        <i>Nama</i> : <br>
                                        <b>{{$v->mahasiswa->nama}}</b>
                                        <br>
                                        <br>
                                        <i>Program Studi</i> : <br>
                                        <b>{{$v->mahasiswa->programstudi->nama_program_studi}}</b>
                                    </td>
                                    <td> {{$v->judul_ind}} </td>
                                    <td class="text-center"> {!!isset($piv[$v->mahasiswa_id]) ? ($piv[$v->mahasiswa_id]->status==0 ? '<span class="label label-sm label-info"><i class="fa fa-exclamation-triangle"></i> Belum Bersedia</span>' : ($piv[$v->mahasiswa_id]->status==1 ? '<span class="label label-sm label-success"><i class="fa fa-check"></i>  Bersedia</span>' : '<span class="label label-sm label-danger"><i class="fa fa-ban"></i> Tidak Bersedia</span>')) : ''!!} </td>
                                   
                                    <td>
                                        @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                             <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id)}}" class="btn btn-xs btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                        <a href="javascript:setujui({{$piv[$v->mahasiswa_id]->id}})" class="btn btn-xs btn-primary tooltips" data-container="body" data-placement="top" data-original-title="Klik Untuk Memverifikasi" title="Klik Untuk Memverifikasi">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="javascript:tolak({{$piv[$v->mahasiswa_id]->id}})" class="btn btn-xs btn-danger tooltips" data-container="body" data-placement="top" data-original-title="Klik Untuk Menolak" title="Klik Untuk Menolak"><i class="fa fa-ban"></i></a>
                                        
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$no}}</td>
                                    <td> {{$v->jenispengajuan->jenis}}</td>
                                    <td>
                                        <i>NPM</i> : <br>
                                        <b>{{$v->mahasiswa->npm}}</b>
                                        <br>
                                        <br>
                                        <i>Nama</i> : <br>
                                        <b>{{$v->mahasiswa->nama}}</b>
                                        <br>
                                        <br>
                                        <i>Program Studi</i> : <br>
                                        <b>{{$v->mahasiswa->programstudi->nama_program_studi}}</b>
                                    </td>
                                   
                                    <td> {{$v->judul_ind}} </td>
                                    <td class="text-center"> {!!isset($piv[$v->mahasiswa_id]) ? ($piv[$v->mahasiswa_id]->status==0 ? '<span class="label label-sm label-info"><i class="fa fa-exclamation-triangle"></i> Belum Bersedia</span>' : ($piv[$v->mahasiswa_id]->status==1 ? '<span class="label label-sm label-success"><i class="fa fa-check"></i>  Bersedia</span>' : '<span class="label label-sm label-danger"><i class="fa fa-ban"></i> Tidak Bersedia</span>')) : ''!!} </td>
                                    <td>
                                        <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id)}}" class="btn btn-xs btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                       
                                    </td>
                                </tr>
                            @endif 
                        @endif                        
                    @else
                        @if ($v->status_pengajuan>=1)
                            @if ($piv[$v->mahasiswa_id]->status==1)
                                @if (isset($v->mahasiswa->npm))
                                
                            
                                <tr>
                                    <td>{{$no}}</td>
                                    <td> {{isset($v->jenispengajuan->jenis) ? $v->jenispengajuan->jenis : 'n/a'}}</td>
                                    <td>
                                        <i>NPM</i> : <br>
                                        <b>{{$v->mahasiswa->npm}}</b>
                                        <br>
                                        <br>
                                        <i>Nama</i> : <br>
                                        <b>{{$v->mahasiswa->nama}}</b>
                                        <br>
                                        <br>
                                        <i>Program Studi</i> : <br>
                                        <b>{{$v->mahasiswa->programstudi->nama_program_studi}}</b>
                                    </td>
                                   
                                    <td> {{$v->judul_ind}} </td>
                                    <td>
                                        <div style="width:110px;">
                                        @php
                                            $dokumen=\App\Model\PivotDocumentSidang::where('departemen_id',$v->mahasiswa->departemen_id)->get();
                                            $dok=array();
                                            foreach($dokumen as $kd => $vd)
                                            {
                                                $dok[$vd->pengajuan_id][$vd->jenis_dokumen]=$vd;
                                            }
                                            $verif_dok=array();
                                            // dd($dokumen);
                                        @endphp
                                        @if (isset($dok[$v->id]))
                                            
                                        
                                            @foreach ($dok[$v->id] as $kd => $vd)
                                                <small><u>{{$kd}}</u></small><br>
                                                @if ($vd->status==0)
                                                    <a href="#" class="btn btn-xs btn-danger btn-rounded" data-toggle="tooltip" title="Belum Di Verifikasi" style="font-size:10px;margin-right:0px;"><i class="fa fa-exclamation-circle"></i></a>    


                                                    <a href="javascript:setujuidokumen({{$vd->id}},1)" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i></a> 
                                                    @php
                                                        $verif_dok[]=0;
                                                    @endphp
                                                @else
                                                    <a href="#" class="btn btn-xs btn-info btn-rounded" data-toggle="tooltip" title="Sudah Di Setujui" style="font-size:10px;margin-right:0px;"><i class="fa fa-check"></i></a>
                                                    @php
                                                        $verif_dok[]=1;
                                                    @endphp
                                                @endif
                                                
                                                <a href="{{url('unduh-file/'.$vd->file)}}" target="_blank" class="btn btn-xs btn-success" data-toggle="tooltip" title="Lihat Dokumen" style="font-size:10px;"><i class="fa fa-search"></i> Lihat</a>
                                            @endforeach
                                        @endif
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        @if (isset($acc_sid[Auth::user()->id_user][$v->mahasiswa_id][$v->id]))
                                            <a href="#" class="btn btn-xs btn-primary">
                                                <i class="fa fa-check"></i> Telah Di Setujui
                                            </a>
                                            <br>
                                            @if (isset($penguji[$v->mahasiswa_id]))
                                                <br>Usulan Penguji :
                                                @foreach ($penguji[$v->mahasiswa_id]  as $idx=>$vl)
                                                    <br><i class="fa fa-user"></i> <b>{{$vl->dosen->nama}}</b>
                                                @endforeach
                                                
                                            @endif
                                            <br>
                                            <br>
                                            {{-- @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                                <a href="javascript:usulpenguji('{{$v->id}}','{{$v->mahasiswa_id}}')" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Usulkan Nama Penguji</a>
                                            @else --}}
                                                <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id.'#tab_5_4')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Usulkan Nama Penguji</a>
                                            {{-- @endif --}}
                                                
                                        @else
                                            @php
                                                $jadwal=\App\Model\PivotJadwal::where('judul_id',$v->id)->where('mahasiswa_id',$v->mahasiswa_id)->first();    
                                            @endphp
                                            @if($jadwal)
                                                <div style="width:140px;">
                                                    <a href="#" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-exclamation-triangle"></i> Acc Sidang
                                                    </a>
                                                    <a href="javascript:setujusidang('{{$v->id}}','{{$v->mahasiswa_id}}')" class="btn btn-xs btn-primary">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id.'#tab_5_2')}}" class="btn btn-xs btn-primary" title="Lihat Data Bimbingan">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id)}}" class="btn btn-xs btn-success" title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                       
                                    </td>
                                </tr>
                                @endif
                            @endif  
                        @endif  
                        @php
                            $no++;
                        @endphp
                    @endif
                @endforeach     
            </tbody>
        </table>

<style>
    .table td,
    .table th
    {
        font-size: 11px !important;
    }
</style>