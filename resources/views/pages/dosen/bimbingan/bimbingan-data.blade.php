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
                    <th>Bimbingan<br>Ke</th>
                    <th> Tanggal </th>
                    <th> Judul<br>Bimbingan </th>
                    <th> Bimbingan Kepada</th>
                    <th> Isi<br>Bimbingan</th>
                    <th> Status</th>
                    <th> # </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bimbingan as $i => $v)  
                @if ($v->pengajuan_id==$idpengajuan)
                
                    <tr class="odd gradeX">
                        <td>{{($v->bimbingan_ke)}}</td>
                        <td>{{tgl_indo2($v->tanggal_bimbingan)}}</td>
                        <td>{{$v->judul}}</td>
                        <td>{{isset($v->dospem->nama) ? $v->dospem->nama : ''}}</td>
                        <td>{!!$v->deskripsi_bimbingan!!}</td>
                        <td>{!!$v->flag==1 ? '<a  href="#" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Telah Disetujui</a>' : '<a href="#"  class="btn btn-xs btn-info"><i class="fa fa-check"></i> Menunggu Persetujuan</a>'!!}</td>
                        <td>
                            @if ($v->dospem->id==Auth::user()->id_user)
                                <div style="width:110px;">
                                    <a href="javascript:setujui({{$v->id}},{{$v->mahasiswa_id}})" class="btn btn-xs btn-primary"><i class="fa fa-check"></i></a>
                                    <a href="javascript:tolak({{$v->id}},{{$v->mahasiswa_id}})" class="btn btn-xs btn-info"><i class="fa fa-ban"></i></a>
                                    <a href="javascript:hapus({{$v->id}},{{$v->mahasiswa_id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            @endif
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