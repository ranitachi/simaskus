<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="{{url('staf-admin/-1')}}" id="sample_editable_1_new" class="btn sbold green btn-sm"> Tambah Data
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
                    <th> Level </th>
                    <th> # </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th> NIP </th>
                    <th> Nama </th>
                    <th> Email </th>
                    <th> Telp/HP</th>
                    <th> Departemen </th>
                    <th> Level </th>
                    <th> # </th>
                </tr>
            </tfoot>
            <tbody>
            @foreach ($mhs as $i => $v)
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{$v->nip}}</td>
                    <td>{{$v->nama}}</td>
                    <td>{{$v->email}}</td>
                    <td>{{$v->hp}}</td>
                    <td>{{isset($v->departemen->nama_departemen) ? $v->departemen->nama_departemen : ''}}</td>
                    <td>{!!isset($v->staf->kat_user) ? ($v->staf->kat_user==1 ? '<span class="badge badge-primary badge-roundless">Sekretariat</span>' : '<span class="badge badge-primary badge-roundless">Administrator</span>') : ''!!}</td>
                    <td>
                        <div style="width:80px;">
                            <a href="{{url('staf-admin/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
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