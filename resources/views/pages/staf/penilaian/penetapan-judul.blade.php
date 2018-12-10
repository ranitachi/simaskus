
        <div style="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <h3 style="text-align:center">
                LEMBAR PENETAPAN JUDUL {{strtoupper($pengajuan->jenispengajuan->jenis)}}
            </h3>
            
            <form action="{{url('penetapan-judul-staf')}}" class="horizontal-form" id="penetapan-judul" method="POST" style="padding:20px;">
                {{ csrf_field() }}
                @php
                    $penetapan='';
                    if(isset($penp[$pengajuan->id][$pengajuan->mahasiswa_id]))
                    {
                        $penetapan=$penp[$pengajuan->id][$pengajuan->mahasiswa_id];
                    }
                @endphp
                <div class="portlet-body">
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">Setelah melalui proses {{strtoupper($pengajuan->jenispengajuan->jenis)}} pada Tanggal {{tgl_indo($jadwal->tanggal)}}, Maka kepada Saudara :</div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Nama Mahasiswa</div>
                        <div class="col-md-9">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">NPM</div>
                        <div class="col-md-9">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Jenjang</div>
                        <div class="col-md-9">: <b>{{$pengajuan->mahasiswa->programstudi->jenjang}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12"><br>
                        Diwajibkan mengubah dan memasukan judul ke SIAK NG dalam Bahasa Indonesia dan Bahasa Inggris dengan benar dan tepat sesuai saran dari pembimbing dalam waktu 1 (satu) hari sejak tanggal penetapan sidang dilaksanakan.
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12"><br>
                        Adapun judul perbaikin adalah sebagai berikut
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-11">
                            1. Bahasa Indonesia
                           <textarea name="judul_indonesia" class="form-control input-circle" rows="4">{{$penetapan!='' ? str_replace(array('<pre>','</pre>'),'',$penetapan->judul_ind) : ''}}</textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-11">
                            2. Bahasa Inggris
                           <textarea name="judul_inggris" class="form-control input-circle" rows="4">{{$penetapan!='' ? str_replace(array('<pre>','</pre>'),'',$penetapan->judul_ing) : ''}}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="mahasiswa_id" value="{{$pengajuan->mahasiswa_id}}">
                    <input type="hidden" name="jadwal_id" value="{{$jadwal->pj_id}}">
                    <input type="hidden" name="pembimbing_id" value="{{$iddosen}}">
                    <input type="hidden" name="pengajuan_id" value="{{$pengajuan->id}}">
                    {{-- <center>
                        <div class="form-actions right">
                            
                            <a id="simpan" class="btn blue" href="javascript:simpan({{$jadwal->jadwal_id}},{{$pengajuan->id}})">
                                <i class="fa fa-check"></i> Simpan</a>
                        </div>
                    </center> --}}
                </div>
            </form>
            </div>
            
        </div>
    </div>
