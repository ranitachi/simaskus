
        <div style="">
            <div class="portlet light portlet-fit portlet-datatable bordered">
            <h3 style="text-align:center">
                @if (count($uji)!=0)
                    NILAI DOSEN PENGUJI
                @else
                    NILAI DOSEN PEMBIMBING
                @endif
            </h3>
            
            <form action="{{url('simpan-nilai')}}" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                {{ csrf_field() }}
                @if (count($uji)!=0)
                    <input type="hidden" name="penilai" value="penguji">
                @else    
                    <input type="hidden" name="penilai" value="pembimbing">
                    @endif
                <input type="hidden" name="idjadwal" value="{{$idjadwal}}">
                <input type="hidden" name="idpengajuan" value="{{$idpengajuan}}">
                <div class="portlet-body">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Nama Mahasiswa</div>
                        <div class="col-md-9">: <b>{{$pengajuan->mahasiswa->nama}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">NPM</div>
                        <div class="col-md-9">: <b>{{$pengajuan->mahasiswa->npm}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Judul Indonesia</div>
                        <div class="col-md-9">: <b>{{$pengajuan->judul_ind}}</b></div>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">Judul Inggris</div>
                        <div class="col-md-9">: <b>{{$pengajuan->judul_eng}}</b></div>
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
                                    @php
                                        $hurufmutu='';
                                        $total=0;
                                    @endphp
                                    @foreach ($penilaian as $k => $v)
                                        @php
                                            if(isset($n[$v->c_id]))
                                            {
                                                $nilai_angka=$n[$v->c_id]->nilai_angka;
                                                $subtotal=$n[$v->c_id]->subtotal;
                                                $hurufmutu=$n[$v->c_id]->huruf;
                                                $total=$n[$v->c_id]->total;
                                            }
                                            else
                                            {
                                                $subtotal=$nilai_angka=0;
                                            }
                                        @endphp
                                        <tr>
                                            <th class="text-left" style="text-align:left !important;padding-left:20px;">
                                                {{$v->nama_component}}
                                            </th>
                                            <th class="text-center" style="width:20%"> 
                                                <input type="number" min="0" max="100" name="nilai_angka[{{$v->c_id}}]" class="form-control input-circle" placeholder="" value="{{$nilai_angka}}" id="nilai_angka_{{$k}}" onkeyup="hitung(this.value,{{$k}})" style="text-align:center;" onblur="cek(this.value,{{$k}})">
                                            </th>
                                            <th class="text-center" style="width:100px;">
                                                x {{count($uji)!=0 ? $v->bobot_penguji : $v->bobot_component}} %
                                                <input type="hidden" id="persen_{{$k}}" value="{{count($uji)!=0 ? $v->bobot_penguji : $v->bobot_component}}" name="persen[{{$v->c_id}}]">
                                            </th>
                                            <th class="text-center"style="width:20%"> 
                                                <input type="number" min="0" max="100" id="total_{{$k}}" name="subtotal[{{$v->c_id}}]" class="form-control input-circle jlh" placeholder=""  readonly style="text-align:center;" value="{{$subtotal}}">
                                            </th>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th style="text-align:right;" colspan="3">
                                            T O T A L
                                            <br><br><br>
                                            HURUF MUTU
                                        </th>
                                        {{-- <th style="text-align:right;"> --}}
                                            {{-- <input type="text" id="subtotal" name="total" class="form-control input-circle" placeholder="" value="" readonly style="text-align:center;"> --}}
                                        {{-- </th> --}}
                                        <th style="text-align:right;">
                                            <input type="text" id="total" name="total" class="form-control input-circle" placeholder=""  readonly style="text-align:center;" value="{{$total}}">
                                            <br>
                                            <input type="text" id="huruf" name="huruf" class="form-control input-circle" placeholder="" readonly style="text-align:center;"  value="{{$hurufmutu}}">
                                        </th>
                                        <input type="hidden" name="id_dosen" value="{{Auth::user()->id_user}}">
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="col-md-4">
                            <h5>Kriteria Penilaian :</h5>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-8"></div>
                            </div>
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
@include('include.script')
<script>
    function simpan(jadwal_id,pengajuan_id)
    {
        //alert(jadwal_id+'=='+pengajuan_id)
        $('#simpan-nilai').submit();
    }
    function hitung(val,x)
    {
        var persen = parseFloat($('#persen_'+x).val());
        var n=(val * persen) /100;
        $('#total_'+x).val(n);
        hitungjlh();
    }
    function cek(val,x)
    {
        var n=parseFloat(val);
        if(n>100)
        {
            alert('Nilai Yang Di Input Melebihi Batas Maksimal');
            $('#nilai_angka_'+x).val(0);
            $('#nilai_angka_'+x).focus();
            $('#total_'+x).val(0);
        }
        else if(n<0)
        {
            alert('Nilai Yang Di Input Dibawah Batas Minimal');
            $('#nilai_angka_'+x).val(0);
            $('#nilai_angka_'+x).focus();
            $('#total_'+x).val(0);
        }
    }
    function hitungjlh()
    {
        var total=0;
        $('input.jlh').each(function(i){
            if($(this).val()=='')
                var n=0;
            else
                var n = parseFloat($(this).val());
            
            total+=n;
        });
        $('#total').val(total.toFixed(2));

        if(total>=85)
            var huruf='A';
        else if(total<85 && total>=80)
            var huruf='A-';
        else if(total<80 && total>=75)
            var huruf='B+';
        else if(total<75 && total>=70)
            var huruf='B';
        else if(total<70 && total>=65)
            var huruf='B-';
        else if(total<65 && total>=60)
            var huruf='C+';
        else if(total<60 && total>=55)
            var huruf='C';
        else if(total<55 && total>=50)
            var huruf='C-';
        else if(total<50 && total>=40)
            var huruf='D';
        else if(total<40)
            var huruf='E';

        $('#huruf').val(huruf);
    }
</script>