<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="javascript:loadform(-1)" id="sample_editable_1_new" class="btn btn-sm sbold btn-primary"> Tambah Data
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
                    <th> Tanggal / Waktu</th>
                    <th> Hari</th>
                    <th> Keperluan </th>
                    <th> Status </th>
                    <th> Tombol Aksi </th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{$no}}</td>
                        <td> 
                            {{tgl_indo2($item->start_date)}} - {{$item->start_time}} 
                            <br>
                            s.d.
                            <br>
                            {{tgl_indo2($item->end_date)}} - {{$item->end_time}} 
                        </td>
                        <td> {{hari(date('D',strtotime($item->start_date)))}} 
                            <br>
                            s.d.
                            <br>
                            {{hari(date('D',strtotime($item->start_date)))}}</td>
                        <td> {{$item->keterangan}} </td>
                        <td> 
                        @if ($item->status==1)
                            <span class="label label-sm label-success"><i class="fa fa-check"></i> Aktif</span>
                        @else
                            <span class="label label-sm label-info"><i class="fa fa-exclamation-triangle"></i> Tidak Aktif</span>
                        @endif </td>
                        <td> 
                            <div style="width:80px;">
                                <a href="javascript:loadform({{$item->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:hapus({{$item->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </div> 
                        </td>
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