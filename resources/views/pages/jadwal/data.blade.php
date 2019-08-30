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
            @foreach ($pengajuan as $i => $v)
            @if (count($jadwal) != 0)
                @php
                    $no=$i;
                    $idpengajuan=$v->id;
                    if(Auth::user()->kat_user==3)
                    {
                        if($v->mahasiswa_id!=Auth::user()->id_user)
                            continue;
                        else
                            $no=0;
                    }
                    
                @endphp
                <tr class="odd gradeX">
                    <td>{{($no+1)}}</td>
                    <td>{{$v->mahasiswa->npm}}<br><b>{{$v->mahasiswa->nama}}</b></td>
                    <td><b>{{$v->jenispengajuan->jenis}}</b><br><br>T.A. <br>{{$v->tahunajaran->tahun_ajaran}} - {{$v->tahunajaran->jenis}}</td>
                    <td>
                        <small><u>Indonesia</u></small><br>
                        <strong>{{$v->judul_ind}}</strong>
                        <br>
                        <small><u>Inggris</u></small><br>
                        <strong>{{$v->judul_eng}}</strong>
                    </td>
                    @php
                        $pem_bimbingan=\App\Model\PivotBimbingan::where('status',1)->where('status_fix',1)->where('mahasiswa_id',$v->mahasiswa_id)->with('dosen')->get();
                        $p_bimbingan=array();
                        foreach($pem_bimbingan as $k=>$v)
                        {
                            $p_bimbingan[$v->dosen_id]=$v;
                        }
                        $no=1;
                    @endphp
                    <td>
                        @foreach ($p_bimbingan as $key=>$item)
                            @if (isset($item->dosen->nama))
                                <small><u>Pembimbing {{$no}}</u></small><br>
                                <strong>{{$item->dosen->nama}}<br></strong>
                                @php
                                    $no++;
                                @endphp
                            @endif
                        @endforeach
                    </td>
                    
                    <td class="text-left">
                        <small><u>Jadwal : </u></small><br>
                        @if (count($jadwal) != 0)
                            @if ($jadwal[$idpengajuan]->tanggal!=null)
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">{{hari($jadwal[$idpengajuan]->hari)}}, {{date('d-m-Y',strtotime($jadwal[$idpengajuan]->tanggal))}}
                                <br>
                                Pukul : {{$jadwal[$idpengajuan]->waktu}}
                                </a>
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
                            @if ($jadwal[$idpengajuan]->ruangan_id!=0)
                                <a href="#" class="btn btn-xs btn-success" style="font-size:10px;">{{$jadwal[$idpengajuan]->ruangan->code_ruangan}} : {{$jadwal[$idpengajuan]->ruangan->nama_ruangan}}</a>
                            @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                            @endif
                        @else
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;">Belum Ditentukan</a>
                        @endif

                    </td>
                    
                    <td class="text-left">
                    @if(count($jadwal)!=0)
                        @if (isset($uji[$idpengajuan]))
                            @foreach ($uji[$idpengajuan] as $kk => $vv)
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
                        <a href="{{url('berkas-sidang/lembar-penetapan-judul/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" class="btn btn-xs btn-info" style="font-size:10px;"><i class="fa fa-download"></i> Revisi Judul</a>
                        <br>
                        <a href="{{url('berkas-sidang/daftar-perbaikan/'.$jadwal[$idpengajuan]->jadwal_id.'/'.$idpengajuan)}}" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Perbaikan Skripsi</a>
                        <br>
                    </td>
                   
                </tr>
            @endif
            @endforeach                
            </tbody>
        </table>
    </div>
</div>
