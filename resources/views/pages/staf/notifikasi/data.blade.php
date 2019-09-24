
<table class="table table-striped table-bordered table-hover" id="sample_1">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Dari</th>
            <th>Pesan</th>
            <th>Status</th>
            <th>#</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($notif as $idx=>$item)      
        @php
            $st=trim(strtok($item->pesan,':'));
            $pesan = str_replace($st.' :','',$item->pesan);
            if(strtolower($st)=='mahasiswa')
                $us=\App\Model\Users::where('id_user',$item->from)->where('kat_user',3)->first();
            elseif(strtolower($st)=='dosen')
                $us=\App\Model\Users::where('id_user',$item->from)->where('kat_user',2)->first();
            else
                $us=\App\Model\Users::where('id_user',$item->from)->where('kat_user',1)->first();
            // echo $us->id;
        @endphp
        @if ($us)
        <tr>
            <td class="text-center">{{++$idx}}</td>
            <td>{{tgl_indo($item->created_at)}}</td>
            <td>
                <div style="width:150px;font-weight:bold">
                    @if ($us->kat_user==0)
                        Administrator
                    @elseif($us->kat_user==1)
                        {{$us->staf->nama}}<br> (Sekretariat)
                    @elseif($us->kat_user==2)
                        @if (isset($us->dosen->nama))
                            {{$us->dosen->nama}}<br> (Dosen)
                        @endif
                    @elseif($us->kat_user==3)
                        @if (isset($us->mahasiswa->nama))
                            {{$us->mahasiswa->nama}}<br> (Mahasiswa)
                        @endif
                    @endif    
                </div>
            </td>
            <td>{!!$pesan!!}</td>
            <td>{!!$item->flag_active==0 ? '<span class="badge badge-primary badge-roundless"> Sudah Dibaca </span>' : '<span class="badge badge-danger badge-roundless"> Belum Dibaca </span>'!!}</td>
            <td>
                <div style="width:70px;">
                    <a href="{{url('notifikasi/'.$item->id)}}" class="btn btn-xs btn-primary tooltips" title="Detail Notifikasi" data-original-title="Detail Notifikasi" data-container="body" data-placement="bottom"><i class="fa fa-eye"></i></a>
                    @if ($item->flag_active==1)
                        <a href="javascript:notifikasibaca({{$item->id}},0)" class="btn btn-xs btn-success tooltips" title="Tandai Sudah Baca" data-original-title="Tandai Sudah Baca" data-container="body" data-placement="bottom"><i class="fa fa-check-square-o"></i></a>                    
                    @else
                        <a href="javascript:notifikasibaca({{$item->id}},1)" class="btn btn-xs btn-danger tooltips" title="Tandai Belum Di Baca" data-original-title="Tandai Belum Di Baca" data-container="body" data-placement="bottom"><i class="fa fa-ban"></i></a>                    
                    @endif
                </div>
            </td>
        </tr>
        @endif
    @endforeach

    </tbody>
</table>
<style>
    .table td{
        font-size:11px;
    }
</style>