<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="{{url('skripsi-pengajuan/-1')}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
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
                    <th> Tanggal Pengajuan </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Status </th>
                    <th> # </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th> Tanggal Pengajuan </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Status </th>
                    <th> # </th>
                </tr>
            </tfoot>
            <tbody>
            @foreach ($pengajuan as $i => $v)
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div style="width:80px;">
                            <a href="{{url('skripsi-pengajuan/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
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