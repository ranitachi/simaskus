<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
            <thead>
                <tr>
                    <th>No</th>
                    <th> Mata Kuliah Spesial </th>
                    <th> Judul </th>
                    <th> Pembimbing </th>
                    <th> Hari/Tanggal<br>Ruang Sidang </th>
                    <th> Penguji </th>
                    <th> Form Nilai </th>
                    {{-- <th> Dokumen Sidang </th> --}}
                </tr>
            </thead>
            
            <tbody>
            @foreach ($pengajuan as $i => $v)
                @php
                    $idpengajuan=$v->id;
                                  @endphp

                        <tr class="odd gradeX">
                            <td>{{(++$i)}}</td>
                            <td>{{$v->jenispengajuan->jenis}}</td>
                            <td>
                                <small><u>Indonesia</u></small><br>
                                <strong>{{$v->judul_ind}}</strong>
                                <br>
                                <small><u>Inggris</u></small><br>
                                <strong>{{$v->judul_eng}}</strong>
                            </td>
                            <td>
                                @if (isset($v->dospem_2->nama))
                                    <small><u>Pembimbing 1</u></small><br>
                                    @if (isset($piv[$v->mahasiswa_id][$v->dospem1]))
                                        @if ($piv[$v->mahasiswa_id][$v->dospem1]->status==1)
                                            <i class="fa fa-check font-blue-steel"></i>
                                        @elseif($piv[$v->mahasiswa_id][$v->dospem1]->status==0)
                                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                        @endif
                                    @endif
                                    <strong>{{$v->dospem_1->nama}}<br></strong>
                                @endif
                                @if (isset($v->dospem_2->nama))
                                    <small><u>Pembimbing 2</u></small><br>
                                    @if (isset($piv[$v->mahasiswa_id][$v->dospem2]))
                                        @if ($piv[$v->mahasiswa_id][$v->dospem2]->status==1)
                                            <i class="fa fa-check font-blue-steel"></i>
                                        @elseif($piv[$v->mahasiswa_id][$v->dospem2]->status==0)
                                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                        @endif
                                    @endif
                                <strong> {{$v->dospem_2->nama}}<br></strong>
                                @endif
                                @if (isset($v->dospem_3->nama))
                                    <small><u>Pembimbing 3</u></small><br>
                                    @if (isset($piv[$v->mahasiswa_id][$v->dospem3]))
                                        @if ($piv[$v->mahasiswa_id][$v->dospem3]->status==1)
                                            <i class="fa fa-check font-blue-steel"></i>
                                        @elseif($piv[$v->mahasiswa_id][$v->dospem3]->status==0)
                                            <i class="fa fa-exclamation-circle font-red-thunderbird"></i>
                                        @endif
                                    @endif
                                    <strong>{{$v->dospem_3->nama}}</strong>
                                @endif
                            </td>
                            <td class="text-left">
                                
                            </td>
                            <td class="text-left">
                                
                            </td>
                            <td class="text-left">
                                @if (count($jadwal)!=0)                           
                                    
                                
                                        <a href="{{url('form-nilai/'.$jadwal[$idpengajuan]->id.'/'.$idpengajuan)}}" style="font-size:10px;" target="_blank"><i class="fa fa-plus-circle"></i> Input Nilai</a><br>
                                        <a href="{{url('form-catatan/'.$jadwal[$idpengajuan]->id.'/'.$idpengajuan)}}" style="font-size:10px;" target="_blank"><i class="fa fa-plus-circle"></i> Input Perbaikan Skripsi</a>
                                    
                                @endif
                            </td>
                            
                            {{-- <td>
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;"><i class="fa fa-download"></i> Undangan Sidang</a>
                                <br>
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Berita Acara Sidang</a>
                                <br>
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Nilai Penguji</a>
                                <br>
                                <a href="#" class="btn btn-xs btn-info" style="font-size:10px;margin-top:5px;"><i class="fa fa-download"></i> Form Catatan Penguji</a>
                                <br>
                            </td> --}}
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