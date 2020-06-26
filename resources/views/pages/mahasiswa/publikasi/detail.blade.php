<div class="row">
    <div class="col-md-5">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-3 text-right">Judul Publikasi</div>
            <div class="col-md-9"><b>{{$publikasi->judul}}</b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-3 text-right">URL Publikasi</div>
            <div class="col-md-9"><b><a href="{{$publikasi->url}}" target="_blank">{{$publikasi->url}}</a></b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-3 text-right">Penulis</div>
            <div class="col-md-9"><b><ul><li>{!!str_replace(';','<li>',substr($publikasi->penulis,0,-1))!!}</ul></b></div>
        </div>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-3 text-right">Status Publikasi</div>
            <div class="col-md-9"><b>
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
            <div class="col-md-3 text-right">Deskripsi</div>
            <div class="col-md-9"><b>{!!$publikasi->deskripsi!!}</b></div>
        </div>
    </div>
    <div class="col-md-7">
        File Publikasi
        <embed src="{{asset('storage/'.$publikasi->file)}}" height="500" type="application/pdf" style="width:100%">
    </div>
</div>