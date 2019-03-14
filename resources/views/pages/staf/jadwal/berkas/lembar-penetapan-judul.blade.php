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
                            <td style="text-align:center"><h2>NILAI DOSEN PEMBIMBING</h2></td>
                        </tr> 
                    </table>
                    <hr>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                
                    
                    <div align="justify">
                        Setelah melalui proses sidang SKRIPSI pada tanggal {{tgl_indo($jadwal->tanggal)}}, Maka kepada saudara :
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
                                    
                                    <td style="width:200px;">Jenjang</td>
                                    <td>:</td>
                                    <td>{{strtoupper($pengajuan->mahasiswa->programstudi->nama_program_studi)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                        Diwajibkan mengubah dan memasukan judul ke SIAK NG dalam bahasa Indonesia dan Inggris dengan benar dan tepat sesuai aran dari pembimbing dalam waktu 1 (satu) hari sejak tanggal penetapan sidang dilaksanakan.
                    </div>
                    
                </div>
                
            </td>
        </tr>
    </table>
                    <table border="0" width="100%">
                        <tr>
                            
                            <td width="60%">&nbsp;</td>
                            <td align="left">
                                Depok, __________________<br>
                                Dosen Penguji,<br><br><br><br><br><u>{{$pembimbing[0]->dosen->nama}}</u><br>NIP. {{$pembimbing[0]->dosen->nip}}</td>
                        </tr>
                    </table>
                    <div class="pisah">&nbsp;</div>

    </body>