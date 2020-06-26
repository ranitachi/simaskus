<div class="row">
    <div class="col-md-5">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Nama Mahasiswa</div>
            <div class="col-md-8">NPM : <b>{{$publikasi->mahasiswa->npm}}</b> : <b>{{$publikasi->mahasiswa->nama}}</b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Departemen</div>
            <div class="col-md-8"><b>{{$publikasi->mahasiswa->departemen->nama_departemen}}</b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Program Studi</div>
            <div class="col-md-8"><b>{{$publikasi->mahasiswa->programstudi->nama_program_studi}}</b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Judul Publikasi</div>
            <div class="col-md-8"><b>{{$publikasi->judul}}</b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">URL Publikasi</div>
            <div class="col-md-8"><b><a href="{{$publikasi->url}}" target="_blank">{{$publikasi->url}}</a></b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Penulis</div>
            <div class="col-md-8"><b><ul><li>{!!str_replace(';','<li>',substr($publikasi->penulis,0,-1))!!}</ul></b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Status Publikasi</div>
            <div class="col-md-8"><b>
                @if ($publikasi->status==1)
                    <a href="#" class="btn btn-xs btn-info"><i class="fa fa-check"></i> Di Setujui</a>
                @else
                    @if ($publikasi->acc_dep==1)
                        <a href="#" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Sudah Di ACC Pimpinan Departemen</a><br>
                        <a href="#" class="btn btn-xs btn-info"><i class="fa fa-exclamation-circle"></i> Menunggu Di ACC Manajer Akademik</a>
                    @else
                        <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-exclamation-circle"></i> Pengajuan</a>
                    @endif
                @endif        
            </b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-4 text-right" style="font-size:11px;">Deskripsi</div>
            <div class="col-md-8"><b>{!!$publikasi->deskripsi!!}</b></div>
        </div>
    </div>
    <div class="col-md-7">
        File Publikasi
        <embed src="{{asset('storage/'.$publikasi->file)}}" height="500" type="application/pdf" style="width:100%">
    </div>
</div>