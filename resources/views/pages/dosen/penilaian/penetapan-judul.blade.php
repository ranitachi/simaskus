
        <div style="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <h3 style="text-align:center">
                LEMBAR PENETAPAN JUDUL {{strtoupper($pengajuan->jenispengajuan->jenis)}}
            </h3>
            
            <form action="#" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                {{ csrf_field() }}
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
                        <div class="col-md-9">: <b>{{$pengajuan->judul_ind}}</b></div>
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
                           <textarea name="judul_indonesia[{{$pengajuan->id}}]" class="form-control input-circle" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-11">
                            2. Bahasa Inggris
                           <textarea name="judul_inggris[{{$pengajuan->id}}]" class="form-control input-circle" rows="4"></textarea>
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