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
                                    Gedung Dekanat Fakultas Teknik<br />Kampus UI Depok 16424<br />T. 62.21.7863504, 7863505, 78888430<br />F. 62.21.7270050<br />E. humas@eng.ui.ac.id<br />www.eng.ui.ac.id
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div>&nbsp;</div>
            <div style="width:100%;text-align:center;"><H3>Log Pelaksanaan Kerja Praktek</H3></div>
            <div style="padding: 0px 50px 0px;">
                <table width="100%">
                    <tr>
                        <td colspan="4">Mahasiswa Fakultas Teknik Universitas Indonesia di bawah ini :</td>
                    </tr>
                    <tr>
                    
                        <td width="200px">Nama Mahasiswa</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td><b>{{isset($mhs->nama) ? $mhs->nama : '______________________'}}</b></td>
                        
                    </tr>
                    <tr>
                    
                        <td width="200px">Nomor Pokok Mahasiswa</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td><b>{{isset($mhs->npm) ? $mhs->npm : '______________________'}}</b></td>
                        
                    </tr>
                    <tr>
                        <td colspan="4">Melakukan Kerja Praktek Pada :</td>
                    </tr>
                </table>
            <div style="border:1px solid #111;padding:10px;">
                <table  cellpadding="0" cellspacing="0" width="100%" style="line-height:20px;">
                    <tr>
                        <td width="200px">Instansi / Perusahaan</td>
                        <td width="6px">:</td>
                        <td><b>{{isset($inf['instansiperusahaan']) ? $inf['instansiperusahaan']->isi : ''}}</b></td>
                    </tr>
                    <tr>
                        <td width="200px">Dept./Divisi / Seksi</td>
                        <td width="6px">:</td>
                        <td><b>{{isset($inf['deptdivisiseksi']) ? $inf['deptdivisiseksi']->isi : ''}}</b></td>
                    </tr>
                    <tr>
                        <td width="200px">Periode (Tgl-Bln-Thn)</td>
                        <td width="6px">:</td>
                        <td>
                            <b>{{isset($inf['periode-awal']) ? $inf['periode-awal']->isi : ''}}</b> s.d. 
                            <b>{{isset($inf['periode-selesai']) ? $inf['periode-selesai']->isi : ''}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="200px" style="vertical-align:top;">Pembimbing</td>
                        <td width="6px" style="vertical-align:top;">:</td>
                        <td>
                            <b>
                                @if (isset($pembimbing['dosen']))
                                    @foreach ($pembimbing['dosen'] as $item)
                                        - {{$item->dosen->nama}}<br>
                                    @endforeach
                                @endif
                            </b>
                        </td>
                    </tr>
                    @if (isset($pembimbing['lapangan']))
                    <tr>
                        <td width="200px" style="vertical-align:top;">Pembimbing Lapangan</td>
                        <td width="6px" style="vertical-align:top;">:</td>
                        <td>
                            <b>{{$pembimbing['lapangan'][0]->nama}}</b>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td width="200px">Tema Kegiatan</td>
                        <td width="6px">:</td>
                        <td><b>{{isset($inf['judul-kerja-praktek']) ? $inf['judul-kerja-praktek']->isi : ''}}</b></td>
                    </tr>
                </table>
            </div>
                <div>&nbsp;</div>
                
            <table border="1" cellpadding="0" cellspacing="0" width="100%" style="line-height:20px;">
                <tr>
                    <th style="width:40px">No</th>
                    <th style="width:100px">Tanggal</th>
                    <th style="">Kegiatan</th>
                    <th style="width:150px">TTD Pembimbing</th>
                </tr>
                @for ($i = 0; $i < 20; $i++)
                    <tr>
                        <td style="padding:2px;width:40px">&nbsp;</td>
                        <td style="padding:2px;width:100px">&nbsp;</td>
                        <td style="padding:2px;">&nbsp;</td>
                        <td style="padding:2px;width:150px">&nbsp;</td>
                    </tr>
                @endfor
            </table>
            <div style="width:100%;text-align:left;">*Jika Tidak Cukup, Lanjutkan pada kertas lain</div>
        </td>
    </tr>
</table>

</body>