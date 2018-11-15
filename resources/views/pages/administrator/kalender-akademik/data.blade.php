<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Departemen </th>
                    <th> Kegiatan </th>
                    <th> Tanggal</th>
                    <th> Keterangan</th>
                    <th> Status Sidang</th>
                    <th> Kategori Khusus</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($kalender as $i => $v)
                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>{{$dept->nama_departemen}}</td>
                    <td>{{$v->kegiatan}}</td>
                    <td>{{tgl_indo2($v->start_date)}} - {{tgl_indo2($v->end_date)}}</td>
                    <td>{{$v->keterangan}}</td>
                    <td>{!!$v->status_sidang==1 ? '<span class="badge badge-primary badge-roundless"> Ya </span>' : '<span class="badge badge-danger badge-roundless"> Tidak </span>'!!}</td>
                    <td>{{ucwords(str_replace('-',' ',$v->kategori_khusus))}}</td>
                    <td>
                        <div style="width:80px;">
                            <a href="{{url('kalender-akademik/'.$v->tahunajaran_id.'/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="javascript:hapus({{$v->tahunajaran_id}},{{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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