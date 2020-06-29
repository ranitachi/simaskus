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
                        <td style="text-align:center"><h3>BERITA ACARA SIDANG UJIAN {{strtoupper(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}}</h3></td>
                    </tr>
                </table>
                <hr>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="justify">
                    Dengan ini menyatakan bahwa pada :
                    <div style="padding: 10px 15px 0px; width: 94%">
                        <table>
                            <tr>
                                
                                <td style="width:200px;">Hari/Tanggal</td>
                                <td>:</td>
                                <td>{{hari($jadwal->hari)}}, {{tgl_indo($jadwal->tanggal)}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">Waktu</td>
                                <td>:</td>
                                <td>{{$jadwal->waktu}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">Bertempat di</td>
                                <td>:</td>
                                <td>{{$jadwal->ruangan->lokasi}} - {{$jadwal->ruangan->nama_ruangan}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                    Telah berlangsung Sidang Ujian {{str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis)}} dengan peserta :
                </div>
                
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
                    <div style="width:100%;float:left">
                        <div style="width:150px;float:left;">dinyatakan</div><div style="width:5px;float:left;">: </div><div style="float:left;">____________________ dengan nilai _____________________</div>
                    </div>
                    <div style="width:100%;float:left;padding-top:20px;">
                        <div style="width:150px;float:left;">dengan catatan</div><div style="width:5;float:left;">: </div><div style="float:left;">____________________________________________________</div>
                        <div>&nbsp;</div>
                    </div>
                </div>
               
                <div>&nbsp;</div>
                
                
                
                <table border="0" width="100%">
                    <tr>
                        <td align="left"><br>Ketua {{$pengajuan->departemen->nama_departemen}},<br />Fakultas Teknik Universitas Indonesia<br><br><br><br><br>
                            <u>{{$pimpinan['ketua-departemen']->dosen->nama}}</u>
                            <br>NIP. {{$pimpinan['ketua-departemen']->dosen->nip}}</td>
                        <td width="10%">&nbsp;</td>
                        <td align="left">
                            Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                            Ketua Sidang Ujian Skripsi,<br><br><br><br><br><u>
                                @if (isset($pembimbing[0]->dosen))
                                    {{$pembimbing[0]->dosen->nama}}</u><br>NIP. {{$pembimbing[0]->dosen->nip}}
                                @endif
                            </td>
                    </tr>
                </table>	
                <div>&nbsp;</div>
                <div align="justify">
                    <div style="padding: 5px 15px 0px; width: 100%">
                        Mengetahui Tim Penguji :
                        <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center" style="padding:5px 10px;height:35px;">No</font></th>
                            <th align="center" style="padding:5px 10px;height:35px;">Nama Penguji</th>
                            <th align="center" style="padding:5px 10px;height:35px;">Nilai</th>
                            <th align="center" style="padding:5px 10px;height:35px;">Tanda Tangan</th>
                        </tr>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($pembimbing as $idx=>$item)
                             @if (isset($item->dosen->nama)) 
                                <tr>
                                    <td align="center" style="padding:5px 10px;height:35px;">{{$no}}</td>
                                    <td align="left" style="padding:5px 10px;height:35px;">{{$item->dosen->nama}}</td>
                                    <td align="left" style="padding:5px 10px;height:35px;"></td>
                                    <td align="left" style="padding:5px 10px;height:35px;"></td>
                                </tr>
                            @endif
                            @php
                                $no++;
                            @endphp
                        @endforeach     
                        @foreach ($penguji as $idx=>$item)
                            @if (isset($item->dosen->nama)) 
                                <tr>
                                    <td align="center" style="padding:5px 10px;height:35px;">{{$no}}</td>
                                    <td align="left" style="padding:5px 10px;height:35px;">{{$item->dosen->nama}}</td>
                                    <td align="left" style="padding:5px 10px;height:35px;"></td>
                                    <td align="left" style="padding:5px 10px;height:35px;"></td>
                                </tr>
                            @endif
                            @php
                                $no++;
                            @endphp
                        @endforeach     
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Total</td>  
                            <td align="left" style="padding:5px 10px;height:35px;"></td>
                                <td align="left" style="padding:5px 10px;height:35px;"></td>  
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Rata-rata</td> 
                            <td align="left" style="padding:5px 10px;height:35px;"></td>
                                <td align="left" style="padding:5px 10px;height:35px;"></td>   
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Akhir (Dengan Huruf)</td>   
                            <td align="left" style="padding:5px 10px;height:35px;"></td>
                                <td align="left" style="padding:5px 10px;height:35px;"></td> 
                        </tr>                                        
                    </table>
                    </div>
                    <div>&nbsp;</div>
                    
                    <div>&nbsp;</div>
                </div>
            </div>
            
        </td>
    </tr>
</table>
</body>