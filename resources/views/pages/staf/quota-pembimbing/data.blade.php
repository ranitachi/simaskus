<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="javascript:loadform(-1)" id="sample_editable_1_new" class="btn btn-sm sbold green"> Tambah Data
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
                    <th> Departemen </th>
                    <th> Level </th>
                    <th> Maksimal Pembimbing</th>
                    <th> Maksimal Pengajuan<br>Pembimbing</th>
                    <th> Keterangan</th>
                    {{-- <th> Pimpinan</th> --}}
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
            @php
                $no=1;
            @endphp
            @foreach ($quota as $i => $v)
                @if (isset($jns[$v->level]))
                    
                
                <tr class="odd gradeX">
                    <td>{{($no++)}}</td>
                    <td>{{$v->departemen->nama_departemen}}</td>
                    <td>{{$jns[$v->level]->keterangan}} - {{$jns[$v->level]->jenis}}</td>
                    <td>{{$v->quota}}</td>
                    <td>{{$v->maksimal}}</td>
                    <td>{{$v->keterangan}}</td>
                    <td>
                        <div style="width:80px;">
                            <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
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