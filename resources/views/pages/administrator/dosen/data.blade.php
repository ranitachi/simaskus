<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="{{url('dosen-admin/-1')}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> NIP </th>
                    <th> Nama </th>
                    <th> Email </th>
                    <th> Telp/HP </th>
                    <th> Departemen </th>
                    <th style="width:100px;"> Status Akun </th>
                    <th> # </th>
                </tr>
            </thead>
            
            <tbody>
            @php
                $no=1;
            @endphp
            @foreach ($mhs as $i => $v)
                @if (Auth::user()->kat_user!=0)
                    @if (Auth::user()->staf_user->departemen_id==$v->departemen_id)
                        <tr class="odd gradeX">
                            <td>{{($no)}}</td>
                            <td>{{$v->nip}}</td>
                            <td>{{$v->nama}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->hp}}</td>
                            <td>{{isset($v->departemen->nama_departemen) ? $v->departemen->nama_departemen : ''}}</td>
                            <td>
                                @if (isset($us[$v->id]))
                                    @if ($us[$v->id]->flag==0)
                                        <a class="btn btn-xs btn-danger">Belum Aktif</a>
                                        <a href="javascript:verifikasi({{$v->id}})" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Verifikasi"><i class="fa fa-check"></i></a>
                                    @else
                                        <a class="btn btn-xs btn-success">Aktif</a>
                                    @endif    
                                @endif
                            </td>
                            <td>
                                <div style="width:80px;">
                                    <a href="{{url('dosen-admin/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endif
                @else
                
                    <tr class="odd gradeX">
                        <td>{{(++$i)}}</td>
                        <td>{{$v->nip}}</td>
                        <td>{{$v->nama}}</td>
                        <td>{{$v->email}}</td>
                        <td>{{$v->hp}}</td>
                        <td>{{isset($v->departemen->nama_departemen) ? $v->departemen->nama_departemen : ''}}</td>
                        <td>
                            <div style="width:80px;">
                                <a href="{{url('dosen-admin/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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