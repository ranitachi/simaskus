
        <div style="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <h3 style="text-align:center">
                @if (count($uji)!=0)
                    NILAI DOSEN PENGUJI
                @else
                    NILAI DOSEN PEMBIMBING
                @endif
            </h3>
            
            <form action="#" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                {{ csrf_field() }}
                <div class="portlet-body">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-2">Nama Mahasiswa</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-2">NPM</div>
                        <div class="col-md-10">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-2">Judul Indonesia</div>
                        <div class="col-md-10">: <b>{{$pengajuan->judul_ind}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-2">Judul Inggris</div>
                        <div class="col-md-10">: <b>{{$pengajuan->judul_eng}}</b></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                                <thead>
                                    <tr>
                                        <th class="text-center"> Jenis Penilaian</th>
                                        <th class="text-center"> #</th>
                                        <th class="text-center"> %</th>
                                        <th class="text-center"> #</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaian as $k => $v)
                                        <tr>
                                            <th class="text-left" style="text-align:left !important;padding-left:20px;">{{$v->nama_component}}</th>
                                            <th class="text-center" style="width:20%"> <input type="text" id="judul" name="nilai_angka" class="form-control input-circle" placeholder="" value=""></th>
                                            <th class="text-center" style="width:100px;">x {{$v->bobot_penguji}} %</th>
                                            <th class="text-center"style="width:20%"> <input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th style="text-align:right;">T O T A L</th>
                                        <th style="text-align:right;"><input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                                        <th style="text-align:right;">%</th>
                                        <th style="text-align:right;"><input type="text" id="judul" name="total" class="form-control input-circle" placeholder="" value="" readonly></th>
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Kriteria Penilaian :</h5>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-8"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-striped" >
                                <tr>
                                    <th>Batasan Nilai</th>
                                    <th>Huruf</th>
                                    <th>Angka</th>
                                </tr>
                            @php
                                $batasan=array('A'=>'85-100','A-'=>'80-84','B+'=>'75-79','B'=>'70-74','B-'=>'65-69','C+'=>'60-64','C'=>'55-59','C-'=>'50-54','D'=>'40-49','E'=>'00-39');
                            @endphp
                                @foreach ($batasan as $idx => $val)
                                    <tr>
                                        <td></td>
                                        <td class="">{{$idx}}</td>
                                        <td class="">{{$val}}</td>
                                    </tr>
                                @endforeach
                            </table>
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