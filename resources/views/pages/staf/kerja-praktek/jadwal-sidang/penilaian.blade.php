@extends('layouts.master')
@section('title')
    <title>Penilaian Kerja Praktek :: SIMA-sp</title>
@endsection

@section('konten')
        <div class="page-content">
       
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('beranda')}}">Beranda</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Penilaian Kerja Praktek</span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Penilaian
            <small>Kerja Praktek</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="">
            <div class="row" id="loader">
                <div class="col-md-10 text-center" style="position:fixed;">
                    <center>
                        <img src="{{asset('img/loading-bl-blue.gif')}}">
                    </center>
                </div>
            </div>
            <div id="data">
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        {{-- <li class="active">
                            <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true"> Evaluasi Kerja Praktek </a>
                        </li> --}}
                        <li>
                            <a href="#tab_1_1_1" data-toggle="tab"> Form Penilaian Kerja Praktek </a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1_1">
                            {{-- materipenilaiainKP --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Keterangan : <br>
                                    1. A = Sangat Baik, B = Baik, C = Cukup, D = Kurang, E = Sangat Kurang<br>
                                    2. Kehadiran : A = 76-100%, B = 66-75%, C=50-65%, D=40-50%, E=0-30%</span>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('cetak-evaluasi-kp/'.$id)}}" target="_blank" class="btn btn-xs btn-success pull-right"><i class="fa fa-print"></i> Cetak Form Evaluasi</a>
                                </div>
                            </div>
                            
                            <form action="{{url('simpan-nilai-staf-kp')}}" class="horizontal-form" id="simpan-nilai" method="POST" style="padding:20px;">
                                {{ csrf_field() }}
                                @foreach ($grup as $item)    
                                    <div class="row" style="border-bottom:1px solid #ddd;padding:10px 0">
                                        <div class="col-md-4">
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-5">Nama Mahasiswa</div>
                                                    <div class="col-md-7">: <b>{{$item->mahasiswa->nama}}</b></div>
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-5">NPM</div>
                                                    <div class="col-md-7">: <b>{{$item->mahasiswa->npm}}</b></div>
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-5">Judul Laporan</div>
                                                    <div class="col-md-7">: <b>{{isset($info['judul-kerja-praktek']) ? $info['judul-kerja-praktek']->judul: ''}}</b></div>
                                                </div>
                                        </div>
                                        <div class="col-md-8">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"> No</th>
                                                            <th class="text-center"> Materi Penilaian</th>
                                                            <th class="text-center" colspan="5"> Nilai Rata-rata</th>
                                                            <th class="text-center"> Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $hurufmutu='';
                                                            $total=0;
                                                            $penilaian=materipenilaiainKP();
                                                        @endphp
                                                        <tr>
                                                            <th colspan="8"><i>A. Diisi Oleh Pihak Perusahaan</i></th>
                                                        </tr>
                                                        @php
                                                            $no=1;
                                                        @endphp
                                                        @foreach ($penilaian['perusahaan'] as $k => $v)
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$v}}</td>
                                                                <td><input type="radio" required name="nilaiperusahaan[{{$idjadwal}}][{{$no}}]" id="nilaiperh_A" value="A">&nbsp;A</td>
                                                                <td><input type="radio" required name="nilaiperusahaan[{{$idjadwal}}][{{$no}}]" id="nilaiperh_B" value="B">&nbsp;B</td>
                                                                <td><input type="radio" required name="nilaiperusahaan[{{$idjadwal}}][{{$no}}]" id="nilaiperh_C" value="C">&nbsp;C</td>
                                                                <td><input type="radio" required name="nilaiperusahaan[{{$idjadwal}}][{{$no}}]" id="nilaiperh_D" value="D">&nbsp;D</td>
                                                                <td><input type="radio" required name="nilaiperusahaan[{{$idjadwal}}][{{$no}}]" id="nilaiperh_E" value="E">&nbsp;E</td>
                                                                <td><input type="text" name="keteranganperusahaan[{{$idjadwal}}]"></td>
                                                            </tr>
                                                            @php
                                                                $no++;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <th colspan="8"><i>B. Diisi Oleh Pihak Departemen FTUI</i></th>
                                                        </tr>
                                                        @php
                                                            $no=1;
                                                        @endphp
                                                        @foreach ($penilaian['departemen'] as $k => $v)
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$v}}</td>
                                                                <td><input type="radio" required name="nilaidepartemen[{{$idjadwal}}][{{$no}}]" id="nilaidept_A" value="A">&nbsp;A</td>
                                                                <td><input type="radio" required name="nilaidepartemen[{{$idjadwal}}][{{$no}}]" id="nilaidept_B" value="B">&nbsp;B</td>
                                                                <td><input type="radio" required name="nilaidepartemen[{{$idjadwal}}][{{$no}}]" id="nilaidept_C" value="C">&nbsp;C</td>
                                                                <td><input type="radio" required name="nilaidepartemen[{{$idjadwal}}][{{$no}}]" id="nilaidept_D" value="D">&nbsp;D</td>
                                                                <td><input type="radio" required name="nilaidepartemen[{{$idjadwal}}][{{$no}}]" id="nilaidept_E" value="E">&nbsp;E</td>
                                                                <td><input type="text" name="keterangandepartemen[{{$idjadwal}}]"></td>
                                                            </tr>
                                                            @php
                                                                $no++;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                                <td colspan="2">Nilai Rata-rata</td>
                                                                <td><span id="rataA"></span></td>
                                                                <td><span id="rataB"></span></td>
                                                                <td><span id="rataC"></span></td>
                                                                <td><span id="rataD"></span></td>
                                                                <td><span id="rataE"></span></td>
                                                                <td></td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </div>       
                                        </div>
                                        <center style="margin-top:10px;">
                                            <div class="form-actions right">
                                                
                                                <button id="simpan" type="submit" class="btn blue" >
                                                    <i class="fa fa-check"></i> Simpan</button>
                                            </div>
                                        </center>
                                @endforeach
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_1_1_2">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
        $('#loader').hide();
    });
</script>
@endsection