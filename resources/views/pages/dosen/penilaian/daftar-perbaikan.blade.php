
        <div style="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <h3 style="text-align:center">
                DAFTAR PERBAIKAN {{strtoupper($pengajuan->jenispengajuan->jenis)}}
            </h3>
            
            <form action="#" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                {{ csrf_field() }}
                <div class="portlet-body">
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">Dengan ini dinyatakan bahwa pada :</div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Hari, Tanggal</div>
                        <div class="col-md-9">: <b>{{hari($jadwal->hari)}}, {{tgl_indo($jadwal->tanggal)}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Waktu</div>
                        <div class="col-md-9">: <b>{{$jadwal->waktu}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Bertempat di</div>
                        <div class="col-md-9">: <b>{{$jadwal->ruangan->nama_ruangan}}</b></div>
                    </div>
                    <hr>
                        <div class="row" style="margin-bottom:5px;">
                            <div class="col-md-12">Telah Berlangsung {{$pengajuan->jenispengajuan->jenis}} dengan pseserta :</div>
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
                        <div class="col-md-2">Judul Indonesia</div>
                        <div class="col-md-9">: <b>{{$pengajuan->judul_ind}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2">Judul Inggris</div>
                        <div class="col-md-9">: <b>{{$pengajuan->judul_eng}}</b></div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">dinyatakan HARUS menyelesaikan Perbaikan, yaitu :</div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">
                            <textarea name="perbaikan[{{$pengajuan->id}}]" class="form-control input-circle" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-12">
                            Perbaikan tersebut harus sudah selesai paling lambat 
                            <div class="input-group input-medium date date-picker" data-date="{{date('d-m-Y')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input type="text" name="start_date" class="form-control input-circle" placeholder="dd-mm-yyyy" value="{{date('d-m-Y')}}">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-actions right">
                            
                            <a id="simpan" class="btn blue" href="javascript:simpan({{$jadwal->jadwal_id}},{{$pengajuan->id}})">
                                <i class="fa fa-check"></i> Simpan</a>
                        </div>
                    </center>
                </div>
            </form>
            </div>
            
        </div>
    </div>
@include('include.script')
<script>
    function simpan(jadwal_id,pengajuan_id)
    {
        alert(jadwal_id+'=='+pengajuan_id)
    }
</script>