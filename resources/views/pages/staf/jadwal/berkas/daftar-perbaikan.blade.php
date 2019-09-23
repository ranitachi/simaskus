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
                        {{-- <td style="text-align:center"><h2>DAFTAR {{$mahasiswa->programstudi->jenjang=='S1' ? 'SKRIPSI' : ($mahasiswa->programstudi->jenjang=='S2' ? 'TESIS': ($mahasiswa->programstudi->jenjang=='S3' ? 'DISERTASI': ''))}}</h2></td> --}}
                        <td style="text-align:center"><h2>DAFTAR PERBAIKAN</h2></td>
                    </tr>
                </table>
                <hr>
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
                    Telah berlangsung Sidang Ujian {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}} dengan peserta :
                </div>
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
                                
                                <td style="width:200px;">Judul {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}}</td>
                                <td>:</td>
                                <td>{{strtoupper($pengajuan->judul_ind)}}</td>
                            </tr>
                        </table>
                    </div>
                   
                    <div>&nbsp;</div>
                    dinyatakan HARUS menyelesaikan Perbaikan, yaitu :
                    
                    <div style="width:100%;float:left;">
                        <br>
                        @if ($perbaikan->count()!=0)
                            @foreach ($perbaikan as $item)
                                <div class="row" style="width:100%">
                                    <div class="col-md-3" style="width:30%;float:left;padding-left:20px;">{{$item->dosen->nama}}</div>
                                    <div class="col-md-3" style="width:10px;float:left;">:</div>
                                    <div class="col-md-8" style="width:65%;float:left"><b>{{strip_tags($item->perbaikan)}}</b></div>
                                </div>
                            @endforeach

                        @else
                        ______________________________________________________________________________________________<br>
                        ______________________________________________________________________________________________<br>
                        ______________________________________________________________________________________________<br>
                        @endif
                        
                    </div>
                    <div style="width:100%;float:left;">
                        <br>
                        Perbaikan Tersebut harus selesai paling lambat tanggal : {{isset($perbaikan[0]->batas_waktu) ? tgl_indo($perbaikan[0]->batas_waktu) :'__________________'}}
                        
                    </div>
                </div>
               
                <div>&nbsp;</div>
                
                
                
                <table border="0" width="100%">
                    <tr>
                        <td align="left"><br>Dosen Pembimbing <br><br><br><br><br>
                            <u>{{$pembimbing[0]->dosen->nama}}</u><br>NIP. {{$pembimbing[0]->dosen->nip}}</td>
                        <td width="10%">&nbsp;</td>
                        <td align="left">
                            Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                            {{-- Ketua Sidang Ujian {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}},<br><br><br><br><br><u>{{$pembimbing[0]->dosen->nama}} --}}
                            Ketua Sidang Ujian ,<br><br><br><br><br><u>{{$pembimbing[0]->dosen->nama}}
                            </u><br>NIP. {{$pembimbing[0]->dosen->nip}}</td>
                    </tr>
                </table>	
                <div style="border-bottom:2px solid #ddd;">&nbsp;</div>
                <div>
                    <div align="justify">
                   
                        <div style="width:100%;float:left;">
                            <br>
                            
                            {{-- {{$mahasiswa->programstudi->jenjang=='S1' ? 'Skripsi' : ($mahasiswa->programstudi->jenjang=='S2' ? 'Tesis': ($mahasiswa->programstudi->jenjang=='S3' ? 'Disertasi': ''))}} ini telah selesai diperbaiki dengan tugas yang ditetapkan dalam Sidang Ujian {{$mahasiswa->programstudi->jenjang=='S1' ? 'Skripsi' : ($mahasiswa->programstudi->jenjang=='S2' ? 'Tesis': ($mahasiswa->programstudi->jenjang=='S3' ? 'Disertasi': ''))}}. --}}
                            {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}}
                            ini telah selesai diperbaiki dengan tugas yang ditetapkan dalam Sidang Ujian {{(str_replace('Pembimbing','Presentasi',$pengajuan->jenispengajuan->jenis))}}
                        </div>
                         <table border="0" width="100%">
                            <tr>
                                <td align="left"><br>Menyetujui<br>Dosen Pembimbing <br><br><br><br><br>
                                    <u>{{$pembimbing[0]->dosen->nama}}</u><br>NIP. {{$pembimbing[0]->dosen->nip}}</td>
                                <td width="10%">&nbsp;</td>
                                <td align="left">
                                    Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                                    Mahasiswa Ybs,<br><br><br><br><br><u>{{$pengajuan->mahasiswa->nama}}</u><br>NPM. {{$pengajuan->mahasiswa->npm}}</td>
                            </tr>
                        </table>	
                    </div>
                   
                </div>
               
            </div>
            
        </td>
    </tr>
</table>
</body>