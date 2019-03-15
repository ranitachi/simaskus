<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
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
                    
                <a href="{{url('data-kp/-1/'.Auth::user()->kat_user)}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
                    <i class="fa fa-plus"></i>
                </a>
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
                    @if ($pengajuan->count() !=0)
                        @if ($pengajuan[0]->status_pengajuan!=0)
                            <th> Grup <br>Kerja Praktek </th>
                            <th> Informasi<br>Kerja Praktek</th>
                            
                        @endif
                    @endif
                    <th> Status <br>Pengajuan</th>
                    <th> # </th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                    if (count($grupkp)!=0)
                    {
                        // $idgrup=$grupkp[$v->mahasiswa_id]->code;
                        // $idgrup=key($grupkp[0]);
                        if(isset($jadwal[$grupkp[0]->code]))
                            continue;
                        // break;
                    }
                @endphp
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{tgl_indo($v->created_at)}}</td>
                    @if ($v->status_pengajuan!=0)
                        
                        <td class="text-left">
                            @if (count($grupkp)!=0)
                                @foreach ($grupkp as $item)
                                    @if($item->kategori=='ketua')
                                        Ketua : 
                                    @else
                                        Anggota : 
                                    @endif
                                    <br>
                                    <a href="#" data-toggle="tooltip" title="{{$item->mahasiswa->nama}}" style="font-size:11px;padding-left:20px;"><i class="fa fa-user"></i> {{$item->mahasiswa->nama}}</a> 
                                    &nbsp;&nbsp;
                                    @if($item->kategori!='ketua')
                                        <a href="javascript:hapusanggota({{$item->id}})" class="font-red-thunderbird"><i class="fa fa-trash"></i></a>
                                        <br>
                                    @endif
                                @endforeach

                                @if($v->status_kp!=2)
                                    @if ($ketua==1)
                                        <br>
                                        <div class="text-center">
                                            <a href="javascript:addanggota({{$grupkp[0]->code}},'-1')" class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Anggota</a>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <a href="{{url('data-kp-grup/'.$v->id.'/'.$v->mahasiswa_id.'/-1')}}" class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Grup</a>
                            @endif
                        </td>
                        <td class="text-left">
                            <small>Status KP</small><br>
                            {!! $v->status_kp == 0 ? '<a class="btn btn-warning btn-xs"><i class="fa fa-exclamation-circle"></i> Belum Di Mulai</a>' : ($v->status_kp == 1 ? '<a class="btn btn-info btn-xs"><i class="fa fa-check"></i> Sedang Berjalan</a>' : ($v->status_kp == 2 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Sudah Selesai</a>' : '<a class="btn btn-danger btn-xs">Tidak Disetujui</a>'))!!}

                            <br>
                            <br>
                            <small>Info KP</small><br>
                            <a href="{{url('data-kp-detail/'.$v->id.'/'.Auth::user()->kat_user)}}#tab_1_1_2" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail Info KP</a>
                        </td>
                    @endif
                    <td>{!! $v->status_pengajuan == 0 ? '<a class="btn btn-info btn-xs">Belum Di Verifikasi</a>' : ($v->status_pengajuan == 1 ? '<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Di Setujui</a>' : '<span class="label label-danger label-sm">Tidak Disetujui</span>')!!}</td>

                    <td style="text-center">
                            @if ($v->status_pengajuan == 1)
                                <a href="{{url('data-kp-detail/'.$v->id.'/'.Auth::user()->kat_user)}}" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-eye"></i></a>
                            @endif
                            <a href="{{url('data-kp/'.$v->id.'/'.Auth::user()->kat_user)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            @if($v->status_kp==0)
                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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