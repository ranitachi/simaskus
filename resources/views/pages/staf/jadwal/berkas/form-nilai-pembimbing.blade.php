<body onload="window.print()">
<style type="text/css" media="print">
	@page {size: auto; margin: 0;}
	div.hidden {display: none}
    *{
        font-size:14px;
    }
    .pisah {page-break-before: always;border:0px !important;}
</style>
<div>&nbsp;</div>
@foreach ($pembimbing as $item)
    

    <table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" width="100%">
        <tr> 
            <td valign="top" class="main" style="font-family: arial">
                <table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="head" width="95%">
                    <tr>
                        <td colspan="3" class="head">
                            <table border="0" align="left" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="main" width='100%'>
                                <tr>
                                    <td width="50%" rowspan="2" align="left"><img src="https://online.civil.ui.ac.id/assets/images/logoUIFakultasTeknik.jpg"></td>
                                    <td align="right">
                                        <font size="1">Gedung Dekanat Fakultas Teknik<br />Kampus UI Depok 16424<br />T. 62.21.7863504, 7863505, 78888430<br />F. 62.21.7270050<br />E. humas@eng.ui.ac.id<br />www.eng.ui.ac.id</font>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div>&nbsp;</div>
                <div style="padding: 0px 50px 0px;">
                    <table width="100%">
                        <tr>
                            <td style="text-align:center"><h2>NILAI DOSEN PEMBIMBING</h2></td>
                        </tr> 
                    </table>
                    <hr>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                
                    
                    <div align="justify">
                        <div style="padding: 10px 15px 0px; width: 94%">
                            <table>
                                <tr>
                                    
                                    <td style="width:200px;">Nama Mahasiswa</td>
                                    <td>:</td>
                                    <td>{{strtoupper($pengajuan->mahasiswa->nama)}}</td>
                                </tr>
                                <tr>
                                    
                                    <td style="width:200px;">Nomor Mahasiswa</td>
                                    <td>:</td>
                                    <td>{{strtoupper($pengajuan->mahasiswa->npm)}}</td>
                                </tr>
                                <tr>
                                    
                                    <td style="width:200px;">Judul Skripsi</td>
                                    <td>:</td>
                                    <td>{{strtoupper($pengajuan->judul_ind)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                    
                    </div>
                
                    <div>&nbsp;</div>
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
                                                <th class="text-left" style=";padding:3px;text-align:left !important;padding-left:20px;width:40%">
                                                    {{$v->nama_component}}
                                                </th>
                                                <th class="text-center" style="width:20%;padding:3px;;text-align:center"> 
                                                    : _______________
                                                </th>
                                                <th class="text-center" style="width:100px;;padding:3px;text-align:center;">
                                                    x {{ $v->bobot_penguji }} %
                                                    
                                                </th>
                                                <th class="text-center"style="width:20%;padding:3px;;text-align:center"> 
                                                    = ______________
                                                </th>
                                            </tr>
                                        @endforeach
                                        <tr>
                                        <th class="text-left" style=";padding:3px;text-align:left !important;padding-left:20px;width:40%">
                                                NILAI TOTAL
                                                </th>
                                                <th class="text-center" style="padding:3px;;text-align:center" colspan="3"> 
                                                    : _________________________________________________
                                                </th>
                                                
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
                </div>
                
            </td>
        </tr>
    </table>
                    <table border="0" width="100%">
                        <tr>
                            
                            <td width="60%">&nbsp;</td>
                            <td align="left">
                                Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                                Dosen Penguji,<br><br><br><br><br><u>{{$item->dosen->nama}}</u><br>NIP. {{$item->dosen->nip}}</td>
                        </tr>
                    </table>
                    <div class="pisah">&nbsp;</div>
    @endforeach
    </body>