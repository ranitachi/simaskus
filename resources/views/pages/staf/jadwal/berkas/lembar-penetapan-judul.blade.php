<body onload="window.print()">
<style type="text/css" media="print">
	@page {size: auto; margin: 0;}
	div.hidden {display: none}
    *{
        font-size:13px;
    }
</style>
<div>&nbsp;</div>
<table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" width="100%">
    <tr> 
        <td valign="top" class="main" style="font-family: arial">
            <table border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" class="head" width="95%">
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
                        <td style="text-align:center"><h2>
                            LEMBAR PENETAPAN JUDUL
                            {{-- {{$mahasiswa->programstudi->jenjang=='S1' ? 'SKRIPSI' : ($mahasiswa->programstudi->jenjang=='S2' ? 'TESIS': ($mahasiswa->programstudi->jenjang=='S3' ? 'DISERTASI': ''))}} --}}
                        </h2></td>
                    </tr>
                </table>
                <hr>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="justify">
                    Setelah melalui proses sidang {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}}
                    {{-- {{$mahasiswa->programstudi->jenjang=='S1' ? 'SKRIPSI' : ($mahasiswa->programstudi->jenjang=='S2' ? 'TESIS': ($mahasiswa->programstudi->jenjang=='S3' ? 'DISERTASI': ''))}}  --}}
                    pada Tanggal {{tgl_indo($jadwal->tanggal)}}. Maka kepada Saudara:
                   
                </div>
                
                <div align="justify">
                    <div style="padding: 10px 15px 0px; width: 94%">
                        <table>
                            <tr>
                                
                                <td style="width:200px;">Nama</td>
                                <td>:</td>
                                <td>{{strtoupper($pengajuan->mahasiswa->nama)}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">NPM</td>
                                <td>:</td>
                                <td>{{strtoupper($pengajuan->mahasiswa->npm)}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">Jenjang</td>
                                <td>:</td>
                                <td>{{$mahasiswa->programstudi->nama_program_studi}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                    <div style="width:100%;float:left">
                        Diwajibkan mengubah dan memasukan judul ke SIAK NG dalam Bahasa Indonesia dan Bahasa Inggris dengan benar dan tepat sesuai saran dari pembimbing dalam waktu 1 (satu) hari sejak tanggal penetapan sidang dilaksanakan.
                    </div>
                    <div>&nbsp;</div>
                    <div style="width:100%;float:left">
                        Adapun judul perbaikin adalah sebagai berikut :
                    </div>
                    
                    <div style="width:100%;float:left;line-height:35px;">
                        1. Bahasa Indonesia<br>
                        @if ($judul)
                            <u><h3>{{$judul->judul_ind}}</h3></u>
                        @else
                            ______________________________________________________________________________________________<br>
                            ______________________________________________________________________________________________<br>
                            ______________________________________________________________________________________________<br>
                        @endif
                        <br>
                        2. Bahasa Inggris<br>
                        @if ($judul)
                            <u><h3>{{$judul->judul_ing}}</h3></u>
                        @else
                            ______________________________________________________________________________________________<br>
                            ______________________________________________________________________________________________<br>
                            ______________________________________________________________________________________________<br>
                        @endif
                    </div>
                </div>
               
                <div>&nbsp;</div>
                
                
                
                <table border="0" width="100%">
                    <tr>
                        
                        <td align="left">
                            Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                            Ketua Sidang Ujian,<br><br><br><br><br><u>
                                @if (isset($pembimbing[0]->dosen))
                                    {{$pembimbing[0]->dosen->nama}}</u><br>NIP. {{$pembimbing[0]->dosen->nip}}
                                @endif
                            </td>
                    </tr>
                </table>	
                <div>&nbsp;</div>
                <div>

                    Keterangan:<br>
                    1. Ditanda tangani setelah mahasiswa menunjukan buku/revisi final<br>
                    2. Diserahkan ke departemen bersama berkas kelengkapan dokumen lainnya
                </div>
               
            </div>
            
        </td>
    </tr>
</table>
</body>