<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            @if ($pengajuan->count()==0)
                
            <div class="btn-group pull-right">
                <a href="{{url('pengajuan-s3/-1')}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            @endif
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Tanggal Pengajuan </th>
                    <th> Mata Kuliah Spesial </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Status </th>
                    {{-- <th> Bimbingan </th> --}}
                    <th> <div style="width:70px;">#</div> </th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                @endphp
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{tgl_indo2($v->created_at)}}</td>
                    <td>{{$v->jenispengajuan->jenis}}</td>
                    <td>
                        <small><u>Indonesia</u></small><br>
                        <strong>{{$v->judul_ind}}</strong>
                        <br>
                        <small><u>Inggris</u></small><br>
                        <strong>{{$v->judul_eng}}</strong>
                    </td>
                    <td>
                        @php
                            $p_bimbingan=\App\Model\PivotBimbingan::where('mahasiswa_id',Auth::user()->id_user)->with('dosen')->where('judul_id',$v->id)->orderBy('keterangan','desc')->get();
                        @endphp
                        @foreach ($p_bimbingan as $key=>$item)
                            @if (isset($item->dosen->nama))
                                <small><u>{{$item->keterangan}}</u></small><br>
                                   @if ($item->status==1)
                                        <i class="fa fa-check font-blue-steel"></i>
                                    @elseif($item->status==0)
                                        <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                    @endif
                                
                                <strong>{{$item->dosen->nama}}<br></strong>
                            @endif
                        @endforeach
                       
                    </td>
                    <td>
                        {!! $v->status_pengajuan == 0 ? '<span class="label label-info label-sm">Belum Di Verifikasi</span>' : ($v->status_pengajuan == 1 ? '<span class="label label-success label-sm">Di Setujui</span>' : '<span class="label label-danger label-sm">Tidak Disetujui</span>')!!}
                    </td>
                    {{-- <td class="text-center"> --}}
                            {{-- @if ($st_pbb==1) --}}
                                {{-- <a href="{{url('pengajuan-detail-disertasi/'.$v->id.'#tab_5_2')}}" class="btn btn-xs btn-primary" title="Input Bimbingan"><i class="fa fa-eye"></i></a> --}}
                            {{-- @endif --}}
                        
                    {{-- </td> --}}
                    <td>
                        <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"> Tombol Aksi
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="{{url('pengajuan-detail-disertasi/'.$v->id)}}" title="Lihat Detail"><i class="fa fa-eye"></i> Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{url('pengajuan-detail-disertasi/'.$v->id.'#tab_5_2')}}" title="Input Bimbingan"><i class="fa fa-eye"></i> Data Bimbingan</a>
                                            {{-- <a href="javascript:hapus({{$v->id}})" title="Hapus"><i class="fa fa-trash"></i> Hapus</a> --}}
                                        </li>
                                        
                                    </ul>
                                </div>
                        
                            
                                
                            
                            {{-- <a href="{{url('pengajuan/'.$v->id)}}" class="btn btn-xs btn-primary" title=""><i class="fa fa-edit"></i></a> --}}
                            
                        
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