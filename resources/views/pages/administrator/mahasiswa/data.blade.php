<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="row" style="padding:5px 20px;">

        <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="{{url('mahasiswa-admin/-1')}}" id="sample_editable_1_new" class="btn sbold green"> Tambah Data
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
                    <th> # </th>
                    <th> NPM /<br>Nama</th>
                    <th> Email </th>
                    <th> Departemen /<br> Program Studi </th>
                    <th> Status Akun</th>
                    {{-- <th> Status Mahasiswa</th> --}}
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
                    @if(isset($user[3][$v->id]))
                        <tr class="odd gradeX">
                            <td>{{($no++)}}</td>
                            <td>
                                @if ($user[3][$v->id]->foto!='')
                                    <img alt="" class="img-circle" src="{{asset('storage/'.$user[3][$v->id]->foto)}}" style="height:30px;width:30px;">
                                @else
                                    <img alt="" class="img-circle" src="{{asset('img/mhs.png')}}" style="height:30px;width:30px;">
                                @endif
                            </td>
                            <td>NPM : <b>{{$v->npm}}</b><br>Nama : <b>{{$v->nama}}</b></td>
                            <td>{{$v->email}}</td>
                            <td>Dept : {{isset($v->departemen->nama_departemen) ? $v->departemen->nama_departemen : ''}}<br>
                                
                                PS : {{isset($v->programstudi->nama_program_studi) ? $v->programstudi->nama_program_studi : ''}}</td>
                            <td>
                                {!! $user[3][$v->id]->flag ==1 ? '<span class="badge badge-primary badge-roundless"> Akun Diverifikasi </span>' : '<span class="badge badge-danger badge-roundless"> Belum Diverifikasi </span>'!!}

                                @if ($user[3][$v->id]->flag==0 )
                                    <a href="javascript:verifikasi({{$v->id}})" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Verifikasi"><i class="fa fa-check"></i></a>
                                @endif
                            </td>
                            {{-- <td class="text-center">
                                {!! $v->status_mahasiswa ==1 ? '<span class="badge badge-primary badge-roundless"> Aktif </span>' : ($v->status_mahasiswa==2 ? '<span class="badge badge-info badge-roundless"> Sudah Lulus </span>' : '<span class="badge badge-danger badge-roundless"> Belum Aktif </span>')!!}

                                
                            </td> --}}
                            <td>
                                <div style="width:100px;">
                                    <a href="{{url('mahasiswa-detail/'.$v->id)}}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('mahasiswa-admin/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:hapus({{$v->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endif
            @else

                <tr class="odd gradeX">
                    <td>{{(++$i)}}</td>
                    <td>
                        @if ($user[3][$v->id]->foto!='')
                            <img alt="" class="img-circle" src="{{asset('storage/'.$user[3][$v->id]->foto)}}" style="height:30px;width:30px;">
                        @else
                            <img alt="" class="img-circle" src="{{asset('img/mhs.png')}}" style="height:30px;width:30px;">
                        @endif
                    </td>
                    <td>NPM : <b>{{$v->npm}}</b><br>Nama : <b>{{$v->nama}}</b></td>
                    <td>{{$v->email}}</td>
                    
                    <td>Dept : {{isset($v->departemen->nama_departemen) ? $v->departemen->nama_departemen : ''}}<br>        
                            PS : {{isset($v->programstudi->nama_program_studi) ? $v->programstudi->nama_program_studi : ''}}</td>
                    <td>
                            {!! $user[3][$v->id]->flag ==1 ? '<span class="badge badge-primary badge-roundless"> Akun Diverifikasi </span>' : '<span class="badge badge-danger badge-roundless"> Belum Diverifikasi </span>'!!}

                            @if ($user[3][$v->id]->flag==0 )
                                <a href="javascript:verifikasi({{$v->id}})" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Verifikasi"><i class="fa fa-check"></i></a>
                            @endif
                        </td>
                    <td>
                        <div style="width:100px;">
                            <a href="{{url('mahasiswa-detail/'.$v->id)}}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{url('mahasiswa-admin/'.$v->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
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