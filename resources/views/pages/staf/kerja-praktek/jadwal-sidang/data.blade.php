<div class="portlet light portlet-fit portlet-datatable bordered">
    @if (Auth::user()->kat_user==1)
    <div class="row" style="padding:5px 20px;">
        <div class="col-md-6">
            <div class="btn-group pull-left">
                <a href="{{url('data-jadwal-kp-form/-1')}}" id="sample_editable_1_new" class="btn btn-sm sbold blue"> Generate Jadwal Sidang KP
                    <i class="fa fa-calendar"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="{{url('publish-kp/-1')}}" id="sample_editable_1_new" class="btn btn-sm sbold green"> Publish Semua Jadwal
                    <i class="fa fa-check"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
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
                    {{-- <th> Penguji </th> --}}
                    <th> Status Sidang </th>
                    @if (Auth::user()->kat_user==1)
                        <th class="text-center">Aksi</th>
                    @endif
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
                            if($v[0]->publish_date!='')
                                $st_sidang=1;
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
                    <td style="width:200px;">
                        @if (Auth::user()->kat_user==1)
                            <div class="row">
                                <div class="col-sm-4">Hari</div>
                                <div class="col-sm-8">: {{$v[0]->hari}}</div>
                                <div class="col-sm-4">Tanggal</div>
                                <div class="col-sm-8">: {{tgl_indo2($v[0]->tanggal)}}</div>
                                <div class="col-sm-4">Waktu</div>
                                <div class="col-sm-8">: {{($v[0]->waktu)}}</div>
                                <div class="col-sm-4">Ruangan</div>
                                <div class="col-sm-8">: {{$v[0]->ruangan->nama_ruangan}}</div>
                            </div>
                        @else    
                            @if ($st_sidang != 0)
                                <div class="row">
                                    <div class="col-sm-4">Hari</div>
                                    <div class="col-sm-8">: {{$v[0]->hari}}</div>
                                    <div class="col-sm-4">Tanggal</div>
                                    <div class="col-sm-8">: {{tgl_indo2($v[0]->tanggal)}}</div>
                                    <div class="col-sm-4">Waktu</div>
                                    <div class="col-sm-8">: {{($v[0]->waktu)}}</div>
                                    <div class="col-sm-4">Ruangan</div>
                                    <div class="col-sm-8">: {{$v[0]->ruangan->nama_ruangan}}</div>
                                </div>
                            @else
                                <a href="#" class="btn btn-danger btn-xs">Menunggu Jadwal Di Publish</a>
                            @endif
                        @endif
                    </td>
                    {{-- <td>
                        @if (isset($penguji[$v[0]->id_grup]))
                            @foreach ($penguji[$v[0]->id_grup] as $vp)
                                <i class="fa fa-user"></i>&nbsp;{{$vp->dosen->nama}}<br>
                            @endforeach
                        @endif
                    </td>--}}
                    <td>
                        <div style="width:145px;">
                            @if ($st_sidang == 0)
                                @if (Auth::user()->kat_user==1)
                                    <a href="javascript:publish({{$v[0]->id}})" class="btn btn-success btn-xs tooltips" data-style="default" data-container="body" data-original-title="Publish Jadwal" title="Publish Jadwal"><i class="fa fa-check"></i></a>
                                @endif
                                <a href="#" class="btn btn-info btn-xs">Belum Di Publish</a>
                            @else
                                <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Sudah Di Publish</a>
                            @endif
                        </div>
                    </td>
                    @if (Auth::user()->kat_user==1)
                        <td class="text-center">
                            <a class="btn btn-info btn-xs" href="{{url('data-jadwal-kp-form/'.$v[0]->id.'__'.$v[0]->id_grup)}}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-xs" href="javascript:hapus({{$v[0]->id}})"><i class="fa fa-trash"></i></a>
                        </td>
                    @endif
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