<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">
            <div class="btn-group pull-left">
                <a href="javascript:generate(-1)" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal
                    <i class="fa fa-calendar"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <a href="javascript:accsidangmahasiswa()" id="sample_editable_1_new" class="btn btn-sm sbold btn-success pull-right"> Batch Acc Sidang Mahasiswa
                    <i class="fa fa-check"></i>
                </a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> NPM<br>Mahasiswa </th>
                    <th> Mata Kuliah Spesial </th>
                    <th> Judul </th>
                    {{-- <th> Pembimbing </th> --}}
                    @if ($jenis==2)
                        <th> Hari/Tanggal/<br>Ruangan Sidang </th>
                    @endif
                    <th>Dokumen</th>
                    <th> Penguji </th>
                    <th> Status Acc Sidang <br>Pembimbing</th>
                    <th> Atur Jadwal</th>
                   
                </tr>
            </thead>
            
            <tbody>
            @php
                $no=0;
            @endphp
            @foreach ($pengajuan as $i => $v)
            {{-- @if (count($jadwal) != 0) --}}
            
                @php
                    $idpengajuan=$v->id;
                    $no++;
                    if(!isset($piv_jad[$idpengajuan]))
                        continue;
                @endphp
                {{-- @if(isset($jadwal[$v->id])) --}}
                <tr class="odd gradeX">
                    <td>{{($no)}}</td>
                    <td>
                        <b>
                        {{$v->mahasiswa->nama}}</b><br>
                        {{$v->mahasiswa->npm}}<br>
                        {{$v->mahasiswa->programstudi->nama_program_studi}}
                    </td>
                    <td><b>{{$v->jenispengajuan->jenis}}</b><br><br>T.A. <br>{{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}</td>
                    <td>
                        <small><u>Indonesia</u></small><br>
                        <strong>{{$v->judul_ind}}</strong>
                        <br>
                        <small><u>Inggris</u></small><br>
                        <strong>{{$v->judul_eng}}</strong>
                    </td>
                        @php
                            $p_bimbingan=\App\Model\PivotBimbingan::where('judul_id',$v->id)->where('mahasiswa_id',$v->mahasiswa_id)->with('dosen')->get();
                        @endphp
                    {{-- <td>
                        @foreach ($p_bimbingan as $key=>$item)
                            
                            @if (isset($item->dosen->nama))
                                <small><u>Pembimbing {{$key+1}}</u></small><br>
                                   @if ($item->status==1)
                                        <i class="fa fa-check-circle font-blue-steel"></i>
                                    @elseif($item->status==0)
                                        <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                    @endif
                                
                                <strong>{{$item->dosen->nama}}<br></strong>
                            @endif
                        @endforeach
                    </td> --}}
                    @if ($jenis==2)
                        <td class="text-center">
                            <small><u>Jadwal : </u></small><br>
                            @if (count($jadwal) != 0)
                                @if (isset($jadwal->tanggal))
                                    
                                
                                    @if ($jadwal->tanggal!=null)
                                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">{{hari($jadwal->hari)}}, <br>{{date('d-m-Y',strtotime($jadwal->tanggal))}}</a>
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
                                @if (isset($jadwal->ruangan_id))
                                    
                                
                                    @if ($jadwal->ruangan_id!=0)
                                        <a href="#" class="btn btn-xs btn-success" style="font-size:10px;">{{$jadwal->ruangan->code_ruangan}} : {{$jadwal->ruangan->nama_ruangan}}</a>
                                    @else
                                        <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                                    @endif
                                @endif
                            @else
                                    <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            @endif
                            

                        </td>
                        
                    @endif
                    <td>
                        <div style="width:110px;">
                        @php
                            $verif_dok=array();
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
                        @php
                            $wh=['pengajuan_id'=>$v->id,'mahasiswa_id'=>$v->mahasiswa_id];
                            $publk=\App\Model\Publikasi::where($wh)->get();
                            if($v->mahasiswa->programstudi->jenjang=='S3')
                            {
                                if(str_slug($v->jenispengajuan->jenis)=='sidang-promosi')
                                {
                                    echo '<br><br><b>Publikasi</b><br>';
                                    foreach($publk as $kpb => $vpb)
                                    {
                                        echo '<b>
                                            <a href="'.url('unduh-file').'/'.$vpb->file.'" target="_blank"><i class="fa fa-download"></i></a>&nbsp;
                                            <i class="fa fa-file-o"></i>
                                            &nbsp; '.$vpb->judul.'</b><br>';
                                    }
                                }
                            }
                        @endphp
                        </div>
                    </td>
                    <td class="text-left">
                    {{-- @if(count($jadwal)!=0) --}}
                        {{-- @if (isset($jadwal->id)) --}}
                        
                            @if (isset($uji[$v->id][$v->mahasiswa_id]))
                                @foreach ($uji[$v->id][$v->mahasiswa_id] as $kk => $vv)
                                    {{-- @if ($vv->status==0)
                                            <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Penguji Belum Setuju"><i class="fa fa-exclamation-circle"></i> {{$vv->dosen->nama}}</a><br>
                                        @else --}}
                                                <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" title="Penguji Sudah Setuju" style="font-size:10px;">
                                                    <i class="fa fa-trash tooltips" data-container="body" data-placement="top" data-original-title="Hapus Data Penguji" onclick="hapusenguji({{$vv->penguji_id}},{{$vv->id}})" style="color:black"></i> | 
                                                    <i class="fa fa-user"></i> {{$vv->dosen->nama}}</a><br>
                                        @php
                                            $adapenguji=1;
                                        @endphp
                                        {{-- @endif --}}
                                @endforeach
                            {{-- @endif --}}
                            <center>
                                <a href="javascript:tambahpenguji({{$v->id}},{{$v->mahasiswa_id}})" style="font-size:10px;"><i class="fa fa-plus-circle"></i> Tambah Penguji</a>
                            </center>
                        @else
                            <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            <center>
                                <a href="javascript:tambahpenguji({{$v->id}},{{$v->mahasiswa_id}})" style="font-size:10px;"><i class="fa fa-plus-circle"></i> Tambah Penguji</a>
                            </center>
                            @php
                                $adapenguji=0;
                            @endphp
                        @endif
                    {{-- @endif --}}
                    </td>
                    <td class="text-left">
                        @if ($v->status_pengajuan==0)
                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i> Belum Disetujui
                            <br>
                            <br>
                            <a href="javascript:setujui({{$idpengajuan}},'{{$jenis}}')" class="btn btn-xs btn-primary" style="font-size:10px;"><i class="fa fa-check"></i> Setujui</a>   
                        @else
                            @php
                                $acc_sidang=\App\Model\PivotSetujuSidang::where('mahasiswa_id',$v->mahasiswa_id)->where('pengajuan_id',$v->id)->get();
                                $acc_s=array();
                                foreach($acc_sidang as $k=>$v)
                                {
                                    $acc_s[]=$v->dosen_id;
                                }
                            @endphp
                            @foreach ($p_bimbingan as $key=>$item)
                                @if (isset($item->dosen->nama))
                                    @if ($v->mahasiswa->programstudi->jenjang=='S3')
                                        <small><u>{{ucwords($item->keterangan)}}</u></small><br>
                                    @else
                                        <small><u>Pembimbing {{$key+1}}</u></small><br>
                                    @endif
                                        @if (in_array($item->dosen_id,$acc_s))
                                            <i class="fa fa-check-circle font-blue-steel"></i>
                                        @else
                                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                        @endif
                                    
                                    <strong>{{$item->dosen->nama}}<br></strong>
                                @endif
                            @endforeach
                            {{-- <a href="#" class="btn btn-xs btn-primary" style="font-size:10px;">Sudah Di Setujui</a>     --}}
                        @endif

                        @if (in_array(0,$verif_dok))
                            <a href="#" class="btn btn-xs btn-danger" style="font-size:10px;">Berkas Sidang Belum Di verifikasi</a>    
                        @endif
                    </td>
                    <td>
                        @if ($v->mahasiswa->programstudi->jenjang=='S3')
                            @if ($adapenguji==1)
                                <a class="btn btn-info btn-xs" href="javascript:aturjadwals3('{{$v->mahasiswa_id}}','{{$v->id}}')"><i class="fa fa-calendar"></i> Atur Jadwal</a>
                            @endif
                        @endif
                    </td>
                   
                </tr>
                
                {{-- @endif --}}
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