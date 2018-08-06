<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
            @if (Auth::user()->kat_user==0)
                <a href="javascript:loadform(-1)" id="sample_editable_1_new" class="btn btn-xs sbold green"> Tambah Data
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
                    <th> Kode </th>
                    <th> Departemen </th>
                    {{-- <th> Pimpinan</th> --}}
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
            @php
                $no=1;
            @endphp
            @foreach ($dept as $i => $v)
            @if (Auth::user()->kat_user!=0)
                @if (Auth::user()->staf_user->departemen_id==$v->id)
                    <tr class="odd gradeX">
                        <td>{{($no++)}}</td>
                        <td>{{$v->code}}</td>
                        <td>{{$v->nama_departemen}}</td>
                        <td>
                            <div style="width:80px;">
                                <a href="javascript:loadform({{$v->id}})" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>    
                @endif
            @else
                
                <tr class="odd gradeX">
                    <td>{{($no++)}}</td>
                    <td>{{$v->code}}</td>
                    <td>{{$v->nama_departemen}}</td>
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