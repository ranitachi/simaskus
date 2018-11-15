
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Jenis Bimbingan </th>
                    <th> NPM </th>
                    <th> Mahasiswa </th>
                    <th> Program Studi </th>
                    <th> Judul </th>
                    @if ($jenis=='pengajuan')
                        <th> Kesediaan Pembimbing </th>
                    @else
                        <th class="text-center"> Status Sidang </th>
                        <th class="text-center"> Bimbingan </th>
                    @endif
                    <th> Tombol Aksi </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($data as $k =>$v)
                @if ($jenis=='pengajuan')
                    @if (isset($piv[$v->mahasiswa_id]) && $v->status_pengajuan==0)
                            @if ($piv[$v->mahasiswa_id]->status==0)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td> {{$v->jenispengajuan->jenis}}</td>
                                    <td> {{$v->mahasiswa->npm}}</td>
                                    <td> {{$v->mahasiswa->nama}}</td>
                                    <td> {{$v->mahasiswa->programstudi->nama_program_studi}} </td>
                                    <td> {{$v->judul_ind}} </td>
                                    <td class="text-center"> {!!isset($piv[$v->mahasiswa_id]) ? ($piv[$v->mahasiswa_id]->status==0 ? '<span class="label label-sm label-info"><i class="fa fa-exclamation-triangle"></i> Belum Bersedia</span>' : ($piv[$v->mahasiswa_id]->status==1 ? '<span class="label label-sm label-success"><i class="fa fa-check"></i>  Bersedia</span>' : '<span class="label label-sm label-danger"><i class="fa fa-ban"></i> Tidak Bersedia</span>')) : ''!!} </td>
                                   
                                    <td>
                                    
                                        <a href="javascript:setujui({{$piv[$v->mahasiswa_id]->id}})" class="btn btn-xs btn-primary tooltips" data-container="body" data-placement="top" data-original-title="Klik Untuk Memverifikasi" title="Klik Untuk Memverifikasi">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="javascript:tolak({{$piv[$v->mahasiswa_id]->id}})" class="btn btn-xs btn-danger tooltips" data-container="body" data-placement="top" data-original-title="Klik Untuk Menolak" title="Klik Untuk Menolak"><i class="fa fa-ban"></i></a>
                                        
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td> {{$v->jenispengajuan->jenis}}</td>
                                    <td> {{$v->mahasiswa->npm}}</td>
                                    <td> {{$v->mahasiswa->nama}}</td>
                                    <td> {{$v->mahasiswa->programstudi->nama_program_studi}} </td>
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
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td> {{$v->jenispengajuan->jenis}}</td>
                                    <td> {{$v->mahasiswa->npm}}</td>
                                    <td> {{$v->mahasiswa->nama}}</td>
                                    <td> {{$v->mahasiswa->programstudi->nama_program_studi}} </td>
                                    <td> {{$v->judul_ind}} </td>
                                    <td class="text-center">
                                        @if (isset($acc_sid[Auth::user()->id_user][$v->mahasiswa_id]))
                                            <a href="#" class="btn btn-xs btn-primary">
                                                <i class="fa fa-check"></i> Telah Di Setujui
                                            </a>
                                            <br>
                                            @if (isset($penguji[$v->mahasiswa_id]))
                                                <br>Usulan Penguji :
                                                <ul style="text-align:left">
                                                @foreach ($penguji[$v->mahasiswa_id]  as $idx=>$vl)
                                                    <li><i class="fa fa-user"></i> {{$vl->dosen->nama}}</li>   
                                                @endforeach
                                                </ul>
                                            @else
                                                <br>
                                                <a href="{{url('bimbingan-detail/'.$v->id.'/'.$v->mahasiswa->id.'#tab_5_4')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Usulkan Nama Penguji</a>
                                            @endif
                                        @else
                                            @php
                                                $jadwal=\App\Model\PivotJadwal::where('judul_id',$v->id)->where('mahasiswa_id',$v->mahasiswa_id)->first();    
                                            @endphp
                                            @if($jadwal)
                                                <a href="#" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-exclamation-triangle"></i> Acc Sidang
                                                </a>
                                                <a href="javascript:setujusidang('{{$v->id}}','{{$v->mahasiswa_id}}')" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-check"></i>
                                                </a>
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