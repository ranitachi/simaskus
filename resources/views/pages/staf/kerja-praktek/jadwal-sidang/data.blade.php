<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">
            {{-- <div class="btn-group pull-left">
                <a href="javascript:generate(-1)" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal
                    <i class="fa fa-calendar"></i>
                </a>
            </div> --}}
        </div>
        <div class="col-md-6">&nbsp;</div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Nama Grup </th>
                    <th> Nama Mahasiswa </th>
                    
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Hari/Tanggal/<br>Ruangan Sidang </th>
                    <th> Penguji </th>
                    <th> Status Sidang </th>
                   
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
            @foreach ($jadwal as $i => $v)
           
                <tr class="odd gradeX">
                    <td>{{($no)}}</td>
                    <td class="text-center"><b>{{$klp[$v[0]->id_grup][0]->nama_kelompok}}</b></td>
                    <td>
                    @php
                        $st_sidang=0;
                    @endphp
                    @foreach ($klp[$v[0]->id_grup] as $item)
                        <i class="fa fa-user"></i>&nbsp;{{$item->mahasiswa->npm}} - {{$item->mahasiswa->nama}}<br>

                        @php
                            if (isset($pengajuan[$item->mahasiswa_id]))
                            {
                                $st_=$pengajuan[$item->mahasiswa_id];
                                if($st_->status_kp==2)
                                {
                                    if(!is_null($st_->publish_date))
                                    {
                                        $st_sidang=1;
                                    }
                                }
                            }
                        @endphp
                    @endforeach
                    </td>
                    <td>
                        {{isset($infokp[$v[0]->id_grup]['judul-kerja-praktek']) ? $infokp[$v[0]->id_grup]['judul-kerja-praktek']->isi : ''}}
                    </td>
                    <td>
                        @if (isset($pemb[$v[0]->id_grup]))
                            @foreach ($pemb[$v[0]->id_grup] as $vp)
                                <i class="fa fa-user"></i>&nbsp;{{$vp->dosen->nama}}<br>
                            @endforeach
                        @endif
                    </td>
                    <td style="width:180px;">
                        <div class="row">
                            <div class="col-sm-3">Hari</div>
                            <div class="col-sm-9">: {{$v[0]->hari}}</div>
                            <div class="col-sm-3">Tanggal</div>
                            <div class="col-sm-9">: {{tgl_indo2($v[0]->tanggal)}}</div>
                            <div class="col-sm-3">Ruangan</div>
                            <div class="col-sm-9">: {{$v[0]->ruangan->nama_ruangan}}</div>
                        </div>
                    </td>
                    <td>
                        @if (isset($penguji[$v[0]->id_grup]))
                            @foreach ($penguji[$v[0]->id_grup] as $vp)
                                <i class="fa fa-user"></i>&nbsp;{{$vp->dosen->nama}}<br>
                            @endforeach
                        @endif
                    </td>
                    <td>{!! $st_sidang == 0 ? '<span class="label label-info label-sm">Belum Di Publish</span>' : '<span class="label label-success label-sm">Sudah Di Publish</span>'!!}</td>
                   
                </tr>
                @php
                    $no++;
                @endphp
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