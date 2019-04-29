<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="javascript:loadform(-1,{{$id}})" id="sample_editable_1_new" class="btn btn-xs sbold green"> Tambah Data
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
                    <th>  Module </th>
                    <th> Code Component </th>
                    <th> Nama Component </th>
                    <th> Bobot <br>Pembimbing</th>
                    <th> Bobot <br>Penguji</th>
                    <th> Bobot Pembimbing<br> Lapangan</th>
                    
                    <th> # </th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $no=1;
                @endphp
            @foreach ($component as $i => $v)
                @if ($id==-1)
                    <tr class="odd gradeX">
                        <td>{{($no)}}</td>
                        <td>{{$v->module->jenis->jenis}} - {{$v->module->nama_module}}</td>
                        <td class="text-center">{{$v->code_component}}</td>
                        <td>{{$v->nama_component}}</td>
                        <td class="text-center">
                        @if ($v->bobot_component!=0)
                            <span class="badge badge-primary badge-round">{{$v->bobot_component}} %</span></td>
                        @endif
                        <td class="text-center">
                            @if ($v->bobot_penguji!=0)
                            <span class="badge badge-primary badge-round">{{$v->bobot_penguji}} %</span></td>
                        @endif
                        </td>
                        <td class="text-center">
                            @if ($v->bobot_pembimbing_lapangan!=0)
                            <span class="badge badge-primary badge-round">{{$v->bobot_pembimbing_lapangan}} %</span></td>
                        @endif
                        </td>
                        
                        <td>
                            <div style="width:80px;">
                                <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @else
                    @if ($id==$v->module->jenis_id)
                        <tr class="odd gradeX">
                            <td>{{($no)}}</td>
                            <td>{{$v->module->jenis->jenis}} - {{$v->module->nama_module}}</td>
                            <td class="text-center">{{$v->code_component}}</td>
                            <td>{{$v->nama_component}}</td>
                            <td class="text-center">
                            @if ($v->bobot_component!=0)
                                <span class="badge badge-primary badge-round">{{$v->bobot_component}} %</span></td>
                            @endif
                            <td class="text-center">
                                @if ($v->bobot_penguji!=0)
                                <span class="badge badge-primary badge-round">{{$v->bobot_penguji}} %</span></td>
                            @endif
                            </td>
                            <td class="text-center">
                                @if ($v->bobot_pembimbing_lapangan!=0)
                                <span class="badge badge-primary badge-round">{{$v->bobot_pembimbing_lapangan}} %</span></td>
                            @endif
                            </td>
                            
                            <td>
                                <div style="width:80px;">
                                    <a href="javascript:loadform({{$v->id}},{{$v->module->jenis_id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
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