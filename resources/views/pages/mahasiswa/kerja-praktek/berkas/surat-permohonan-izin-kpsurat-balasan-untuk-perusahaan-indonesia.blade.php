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
                        <td width="40px">&nbsp;</td>
                        <td>___/UN2.F4.DTS/PDP.04.00/2018</td>
                        <td align="right">Depok, {{tgl_indo(date('Y-m-d'))}}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td colspan="3">Permohonan Izin Untuk Lokasi Tempat Kerja Praktek</td>
                    </tr>
                </table>
            </div>
            <div>&nbsp;</div>
            <div style="padding: 0px 55px 0px;">
                <div>
                    Yth,<br />
                    {{isset($inf['pimpinan-perusahaan-penanggung-jawab']) ? $inf['pimpinan-perusahaan-penanggung-jawab']->isi : '___________________________'}}<br />
                    {{isset($inf['instansiperusahaan']) ? $inf['instansiperusahaan']->isi : '___________________________'}}<br />
                    {{isset($inf['alamat-perusahaan']) ? $inf['alamat-perusahaan']->isi : '___________________________'}}<br /><br />
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    Bersama  ini  kami  memohon kesediaan  Bapak/Ibu, kiranya  kepada mahasiswa kami dapat diberi  kesempatan  dalam melaksanakan kerja praktek (kerja nyata) pada {{isset($inf['nama-pekerjaan']) ? $inf['nama-pekerjaan']->isi.' dibawah naungan' : ''}}  {{isset($inf['instansiperusahaan']) ? $inf['instansiperusahaan']->isi : ''}} selama 150 - 200 jam, untuk dapat memenuhi salah satu persyaratan kurikulum pendidikan di Fakultas Teknik Universitas Indonesia.<br><br>
                    Berikut ini daftar mahasiswa yang akan melakukan Kerja Praktek:
                </div>
                <div>&nbsp;</div>
                <div align="center" style="font-size: 16px;">
                    <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center">Nama</th>
                            <th align="center">NPM</th>
                            <th align="center">Program Studi</th>
                        </tr>
                        @foreach ($grup as $k=>$v)
                            <tr>
                                <td align='center'>{{$v->mahasiswa->nama}}</td>
                                <td align='center'>{{$v->mahasiswa->npm}}</td>
                                <td align='center'>{{$v->mahasiswa->programstudi->nama_program_studi}}</td>       
                            </tr>
                            
                        @endforeach
                    </table>
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    Untuk memudahkan proses monitoring, mahasiswa tersebut diwajibkan mengisi <i>log book</i> untuk mencatat kegiatan mereka selama kerja praktek. Kompetensi yang diharapkan dari kerja praktek ini adalah kemampuan menyelesaikan masalah (problem solving) <i>team work, leadership,</i> disiplin dan etika profesional di dunia kerja.<br><br>
                    Agar tujuan kerja praktek ini tercapai kami sangat mengharapkan bimbingan dari Bapak/Ibu, sehingga pada akhir kegiatan mereka bisa menyusun laporan akhir.<br><br>
                    Demikian yang dapat kami sampaikan. Atas bantuan dan kerjasama Bapak/Ibu kami ucapkan terima kasih.
                </div>
                <br>
                <br>
                <table border="0" width="100%">
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td align="left">Ketua {{$departemen->nama_departemen}},<br />Fakultas Teknik Universitas Indonesia<br><br><br><br><br>
                            @if (isset($pimpinan['ketua-departemen']))
                                @if (isset($dosen[$pimpinan['ketua-departemen']->dosen_id]))
                                    @php
                                        $pimp=$dosen[$pimpinan['ketua-departemen']->dosen_id];
                                    @endphp
                                    <u>{{$pimp->nama}}</u>
                                    <br>
                                    NIP. {{$pimp->nip}}
                                @else
                                _________________________
                                <br>
                                NIP.
                                @endif
                            @else
                                _________________________
                                <br>
                                NIP.
                            @endif
                        </td>
                    </tr>
                </table>	
            </div>
            {{-- <div class="hidden">
                <table width="98%" align="center" border="0" cellspacing="0" cellpadding="6" class="cetak">
                    <tr>
                        <td>&nbsp;
                        </td>
                        <td width="10%">
                            <div align="center"><input type="button" name="cetak" value="Cetak"  onclick="javascript:window.print(); return false;"></div>
                        </td>			
                    </tr>
                </table>
            </div> --}}
        </td>
    </tr>
</table>
</body>
