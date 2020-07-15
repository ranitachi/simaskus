
<body onload="window.print()">
<style type="text/css" media="print">
	@page {size: auto; margin: 0;}
	div.hidden {display: none}
</style>
<div>&nbsp;</div>
<table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" width="100%">
    <tr> 
        <td valign="top" class="main" style="font-family: arial">
            <table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="head" width="95%">
                <tr>
                    <td colspan="3" class="head">
                        <table border="0" align="left" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="main" width='100%'>
                            <tr>
                                <td width="50%" rowspan="2" align="left"><img src="{{asset('img/logoUIFakultasTeknik.jpg')}}"></td>
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
                <h3 style="text-align:center">DAFTAR HADIR PENGUJI dan PEMBIMBING<br>UJIAN SIDANG<br>{{strtoupper($pengajuan->departemen->nama_departemen)}}</h3>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                
                <div>&nbsp;</div>
                <div align="justify">
                    <div style="padding: 10px 15px 0px; width: 94%">
                        <table>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Hari/Tanggal</td>
                                <td>:</font></td>
                                <td>{{hari($jadwal->hari)}}, {{tgl_indo($jadwal->tanggal)}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Waktu</td>
                                <td>:</td>
                                <td>{{$jadwal->waktu}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Tempat</td>
                                <td>:</td>
                                <td>{{$jadwal->ruangan->lokasi}} - {{$jadwal->ruangan->nama_ruangan}}</td>
                            </tr>
                            <tr>
                                <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Nama Mahasiswa<br>NPM</td>
                                <td>:<br>:</td>
                                <td>
                                    {{$pengajuan->mahasiswa->nama}}&nbsp;&nbsp;&nbsp;&nbsp;<br>
                                    {{$pengajuan->mahasiswa->npm}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                    
                    <div>&nbsp;</div>
                </div>
                <div align="justify">
                    
                </div>
                <div>&nbsp;</div>
                <div align="center">
                    <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center" style="padding:15px;height:35px;">No</font></th>
                            <th align="center" style="padding:15px;height:35px;">Nama</th>
                            <th align="center" style="padding:15px;height:35px;">Status</th>
                            <th align="center" style="padding:15px;height:35px;">Tanda Tangan</th>
                        </tr>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($pembimbing as $idx=>$item)
                            @if ($item->status==1 && $item->status_fix==1)
                                    <tr>
                                        <td align="center" style="padding:15px;height:35px;">{{$no}}</td>
                                        <td align="left" style="padding:15px;height:35px;">{{$item->dosen->nama}}</td>
                                        <td align="left" style="padding:15px;height:35px;">Pembimbing</td>
                                        <td align="left" style="padding:15px;height:35px;"></td>
                                    </tr>
                                @php
                                    $no++;
                                @endphp
                            @endif
                        @endforeach                                             
                        @foreach ($penguji as $idx=>$item)
                            <tr>
                                <td align="center" style="padding:15px;height:35px;">{{$no}}</td>
                                <td align="left" style="padding:15px;height:35px;">{{$item->dosen->nama}}</td>
                                <td align="left" style="padding:15px;height:35px;">Penguji</td>
                                <td align="left" style="padding:15px;height:35px;"></td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach                                             
                    </table>
                </div>
                <div>&nbsp;</div>
                
                
            </div>
            
        </td>
    </tr>
</table>
</body>