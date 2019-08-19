<body onload="window.print()">
<style type="text/css" media="print">
	@page {size: auto; margin: 0;}
	div.hidden {display: none}
    *{
        font-size:14px;
    }
</style>
@foreach ($grup as $item)
@php
    $KP=\App\Model\KerjaPraktek::where('mahasiswa_id',$item->mahasiswa_id)->where('departemen_id',$dept_id)->first();
@endphp
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
                        <td style="text-align:center"><h2>BERITA ACARA PRESENTASI KERJA PRAKTEK</h2></td>
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
                                <td>{{$jadwal->hari}}, {{tgl_indo($jadwal->tanggal)}}</td>
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
                    Telah berlangsung Sidang Ujian Skripsi dengan peserta :
                </div>
                
                <div align="justify">
                    <div style="padding: 10px 15px 0px; width: 94%">
                        <table>
                            <tr>
                                
                                <td style="width:200px;">Nama Mahasiswa</td>
                                <td>:</td>
                                <td>{{strtoupper($item->mahasiswa->nama)}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">Nomor Mahasiswa</td>
                                <td>:</td>
                                <td>{{strtoupper($item->mahasiswa->npm)}}</td>
                            </tr>
                            <tr>
                                
                                <td style="width:200px;">Judul Kerja Praktek</td>
                                <td>:</td>
                                <td>{{isset($info['judul-kerja-praktek']) ? strtoupper($info['judul-kerja-praktek']->judul) : ''}}</td>
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
                        <td align="left"><br>Ketua {{$departemen->nama_departemen}},<br />Fakultas Teknik Universitas Indonesia<br><br><br><br><br>
                            <u>{{$pimpinan['ketua-departemen']->dosen->nama}}</u>
                            <br>NIP. {{$pimpinan['ketua-departemen']->dosen->nip}}</td>
                        <td width="10%">&nbsp;</td>
                        <td align="left" style="vertical-align: top">
                            Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                            {{-- Ketua Sidang Ujian Skripsi,<br><br><br><br><br><u>{{$penguji[0]->dosen->nama}}</u><br>NIP. {{$penguji[0]->dosen->nip}}</td> --}}
                    </tr>
                </table>	
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="justify">
                    <div style="padding: 10px 15px 0px; width: 100%">
                        Mengetahui Tim Penguji :
                        <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center" style="padding:5px 10px;height:30px;">No</font></th>
                            <th align="center" style="padding:5px 10px;height:30px;">Nama Penguji</th>
                            <th align="center" style="padding:5px 10px;height:30px;">Nilai</th>
                            <th align="center" style="padding:5px 10px;height:30px;">Tanda Tangan</th>
                        </tr>
                        <tr>
                            <td align="center" style="padding:5px 10px;height:30px;">#</td>
                            <td align="left" style="padding:5px 10px;height:30px;">Nilai Rata-rata Perusahaan (4x....A + 3x....B + 2x....C + )/9</td>
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                        </tr>
                        @foreach ($penguji as $idx=>$item)
                            <tr>
                                <td align="center" style="padding:5px 10px;height:30px;">{{++$idx}}</td>
                                <td align="left" style="padding:5px 10px;height:30px;">{{$item->dosen->nama}}</td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>
                            </tr>
                        @endforeach     
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Total</td>  
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>  
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Minus</td>  
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>  
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Akhir</td>  
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>  
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Rata-rata</td> 
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td>   
                        </tr>                                        
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;Nilai Akhir (Dengan Huruf)</td>   
                            <td align="left" style="padding:5px 10px;height:30px;"></td>
                                <td align="left" style="padding:5px 10px;height:30px;"></td> 
                        </tr>                                        
                    </table>
                    </div>
                    <br>
                    <div><small><br>Keterangan : <br>* Nilai Minus : Buku Cuma 1 (-1), Belum Ada Cap (-1), Nilai Perusahaan tidak ada (-2), Tidak ada Ttd (-1)</small></div>
                    
                    <div>&nbsp;</div>
                </div>
            </div>
            
        </td>
    </tr>
</table>
@endforeach
</body>