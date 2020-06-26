<body onload="window.print()">
<style type="text/css" media="print">
	@page {size: auto; margin: 0;}
	div.hidden {display: none}
    
    table th,table td
    {
        font-size:11px !important;
    }
</style>
@foreach ($grup as $item)
    

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
            <div style="width:100%;text-align:center;"><H2>EVALUASI KERJA PRAKTEK</H2></div>
            <div style="padding: 0px 50px 0px;">
                <table width="100%">
                    <tr>
                        <td colspan="4">Mahasiswa Fakultas Teknik Universitas Indonesia di bawah ini :</td>
                    </tr>
                    <tr>
                    
                        <td width="200px">Nama Mahasiswa</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td><b>{{isset($item->mahasiswa->nama) ? $item->mahasiswa->nama : '______________________'}}</b></td>
                        
                    </tr>
                    <tr>
                    
                        <td width="200px">Nomor Pokok Mahasiswa</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td><b>{{isset($item->mahasiswa->npm) ? $item->mahasiswa->npm : '______________________'}}</b></td>
                        
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
                
            <table border="1" cellpadding="3" cellspacing="0" width="100%" style="line-height:15px;">
                <tr>
                    <tr>
                        <th class="text-center"> No</th>
                        <th class="text-center"> Materi Penilaian</th>
                        <th class="text-center" colspan="5"> Nilai Rata-rata</th>
                        <th class="text-center"> Keterangan</th>
                    </tr>
                </tr>
                @php
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
                        <td style="text-align:center">A</td>
                        <td style="text-align:center">B</td>
                        <td style="text-align:center">C</td>
                        <td style="text-align:center">D</td>
                        <td style="text-align:center">E</td>
                        <td></td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
                <tr>
                    <th colspan="8"><i>B. Diisi Oleh Pihak Departemen Elektro FTUI</i></th>
                </tr>
                @php
                    $no=1;
                @endphp
                @foreach ($penilaian['departemen'] as $k => $v)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$v}}</td>
                        <td style="text-align:center">A</td>
                        <td style="text-align:center">B</td>
                        <td style="text-align:center">C</td>
                        <td style="text-align:center">D</td>
                        <td style="text-align:center">E</td>
                        <td></td>
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
            </table>
                <table border="0" width="100%">
                    <tr>
                        <td align="left" style="vertical-align: top;width:33%">
                            <br><br>Ketua {{$departemen->nama_departemen}},<br />Fakultas Teknik Universitas Indonesia<br><br><br><br><br>
                            <u>{{$pimpinan['ketua-departemen']->dosen->nama}}</u>
                            <br>NIP. {{$pimpinan['ketua-departemen']->dosen->nip}}
                        </td>
                        <td align="left" style="vertical-align: top;width:33%">
                            <br><br>Mengetahui/Menyetujui<br>Penganggung Jawa/Pembimbing Utama<br><br><br><br><br>
                            @if (isset($pembimbing['dosen']))
                                <u>{{$pembimbing['dosen'][0]->dosen->nama}}</u>
                                <br>NIP. {{$pembimbing['dosen'][0]->dosen->nip}}
                            @else
                                _____________________________
                            @endif
                        </td>
                        <td align="left" style="vertical-align: top;width:33%;">
                            <br>Depok, {{tgl_indo(date('Y-m-d'))}}<br>
                            <br>Pembimbing Harian<br><br><br><br><br>
                            @if (isset($pembimbing['lapangan']))
                                <u>{{$pembimbing['lapangan'][0]->nama}}</u>
                            @else
                                _____________________________
                            @endif
                        </td>    
                    </tr>
                </table>
            <div style="width:100%;text-align:left;">
                <br>
            Keterangan : <br>
                                    1. Berilah Tanda Silang (X) atau Hitamkan Kolom Nilai Yang Dipilih<br>
                                    2. A = Sangat Baik, B = Baik, C = Cukup, D = Kurang, E = Sangat Kurang<br>
                                    3. Kehadiran : A = 76-100%, B = 66-75%, C=50-65%, D=40-50%, E=0-30%
            </div>
        </td>
    </tr>
</table>
@endforeach
</body>