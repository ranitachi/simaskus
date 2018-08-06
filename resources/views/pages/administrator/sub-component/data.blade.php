<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="javascript:loadform(-1)" id="sample_editable_1_new" class="btn btn-xs sbold green"> Tambah Data
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
                    <th> Nama<br>Komponen </th>
                    <th>Kode<br>Komponen </th>
                    <th> Sub<br>Komponen</th>
                    <th> Nilai</th>
                    <th> Keterangan</th>
                    
                    <th> # </th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($subcomponent as $i => $v)
                @if ($id==-1)
                    <tr class="odd gradeX">
                        <td>{{(++$i)}}</td>
                        <td>{{$v->komponen->nama_component}}</td>
                        <td  class="text-center">{{$v->komponen->code_component}}</td>
                        <td>{{$v->nama_sub_component}}</td>
                        <td class="text-center">
                            <div style="width:110px">

                                <span class="badge badge-primary badge-round">{{$v->nilai_min}} - {{$v->nilai_max}}</span>
                                &nbsp;
                                <span class="badge badge-success badge-round">{{$v->huruf_mutu}}</span>
                            </div>
                        </td>   
                        <td>{{$v->keterangan}}</td>
                        <td>
                            <div style="width:80px;">
                                <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @else
                    @if ($id==$v->component_id)
                        <tr class="odd gradeX">
                            <td>{{(++$i)}}</td>
                            <td>{{$v->komponen->nama_component}}</td>
                            <td class="text-center">{{$v->komponen->code_component}}</td>
                            <td>{{$v->nama_sub_component}}</td>
                            <td class="text-center">
                                <div style="width:110px">

                                    <span class="badge badge-primary badge-round">{{$v->nilai_min}} - {{$v->nilai_max}}</span>
                                    &nbsp;
                                    <span class="badge badge-success badge-round">{{$v->huruf_mutu}}</span>
                                </div>
                            </td>   
                            <td>{{$v->keterangan}}</td>
                            <td>
                                <div style="width:80px;">
                                    <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endif
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