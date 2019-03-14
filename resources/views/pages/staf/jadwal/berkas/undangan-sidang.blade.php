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
                <table width="100%">
                    <tr>
                        <td width="70px">Nomor</td>
                        <td width="4px">:</td>
                        <td width="90px">&nbsp;</td>
                        <td>/UN2.F4.DTS/PDP.04.00/2018</td>
                        <td align="right">{{date('d')}} {{getBulan(date('n'))}}, {{date('Y')}}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td colspan="3">Undangan {{str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis)}} </td>
                    </tr>
                </table>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>
                    Yth,<br />
                        @foreach ($penguji as $item)
                            {{$item->dosen->nama}}<br>
                        @endforeach                   
                        di tempat
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    Sehubungan dengan adanya ujian kerja praktek, dengan ini kami mengharapkan kehadiran Bapak/Ibu sebagai dewan penguji. Adapun mahasiswa tersebut adalah sebagai berikut:
                </div>
                <div>&nbsp;</div>
                <div align="center">
                    <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center">Nama</font></th>
                            <th align="center">NPM</th>
                            <th align="center">Program Studi</th>
                        </tr>
                        <tr>
                            
                            <td align='center'>{{$mahasiswa->nama}}</td>
                            <td align='center'>{{$mahasiswa->npm}}</td>                        
                            <td align='center'>{{$mahasiswa->programstudi->nama_program_studi}}</td>
                        </tr>
                    </table>
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    Ujian akan dilaksanakan pada:
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
                                <td>{{$jadwal->ruangan->nama_ruangan}} : {{$jadwal->ruangan->lokasi}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                    Demikian yang dapat kami sampaikan, atas kesediaan dan kerjasamanya, kami ucapkan terimakasih.
                    <div>&nbsp;</div>
                </div>
                <table border="0" width="100%">
                    <tr>
                        <td width="50%">&nbsp;</td>
                        <td align="left">Ketua {{$departemen->nama_departemen}},<br />Fakultas Teknik Universitas Indonesia<br><br><br><br><br><u>{{$pimpinan['ketua-departemen']->dosen->nama}}</u><br>NIP. {{$pimpinan['ketua-departemen']->dosen->nip}}</td>
                    </tr>
                </table>	
                
            </div>
            
        </td>
    </tr>
</table>
</body>