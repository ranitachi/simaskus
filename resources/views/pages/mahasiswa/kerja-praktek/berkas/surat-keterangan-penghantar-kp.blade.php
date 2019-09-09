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
            <div style="padding: 0px 50px 0px;">
                <table width="100%">
                    <tr>
                    
                        <td width="70px"><u>Nomor</u><br><i>Ref. No.</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td>___/UN2.F4.DTS/PDP.04.01/2018</td>
                        <td align="right">Depok, {{tgl_indo(date('Y-m-d'))}}</td>
                    </tr>
                </table>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="center"><b><u>SURAT KETERANGAN MAHASISWA</u></b><br><i>TO WHOM IT MAY CONCERN</i></div>
                <p style="text-align:justify;">
                        {{-- Departemen Teknik Sipil--}}Departemen {{$departemen->nama_departemen}} Universitas Indonesia, dengan ini menerangkan bahwa mahasiswa tersebut dibawah ini:<br>
                        <i>Civil Engineering Department, Faculty of Engineering, Universitas Indonesia, hereby certified that:</i>
                </p>
                <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                    <tr align='center'>
                        <th align="center"><u>Nama</u><br /><i>Name</i></th>
                        <th align="center"><u>NPM</u><br /><i>Student Number</i></th>
                        <th align="center"><u>Program Studi</u><br /><i>Program</i></th>
                    </tr>
                    @if ($code_grup!=-1)                        
                        @foreach ($grup as $item)
                            <tr>
                                <td align="center">{{$item->mahasiswa->nama}}</td>
                                <td align="center">{{$item->mahasiswa->npm}}</td>
                                <td align="center">{{$prodi[$item->mahasiswa->program_studi_id]->nama_program_studi}}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($det as $item)
                            <tr>
                                <td align="center">{{$item->mahasiswa->nama}}</td>
                                <td align="center">{{$item->mahasiswa->npm}}</td>
                                <td align="center">{{$prodi[$item->mahasiswa->program_studi_id]->nama_program_studi}}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div>&nbsp;</div>
                <p style="text-align:justify;">
                    Adalah benar mahasiswa {{$departemen->nama_departemen}} Fakultas Teknik Universitas Indonesia Kampus Universitas Indonesia, Depok, Jawa Barat.<br>
                    <i>are students of {{departemeninggris(str_slug($departemen->nama_departemen))}}, Faculty of Engineering, Universitas Indonesia.</i><br><br>
                    Surat keterangan ini diberikan untuk mencari lokasi kerja praktek.<br>
                    <i>This letter is made for the purpose to find the location of internship.</i><br><br>
                    Demikian surat keterangan ini dibuat, kepada yang bersangkutan harap mengetahuinya.<br>
                    <i>Hence, it is made in order to be utilized properly</i><br><br>
                </p>
                <table border="0" width="100%">
                    <tr>
                        <td width="40%">&nbsp;</td>
                        <td align="left"><u>Sekretaris {{$departemen->nama_departemen}} FTUI,</u><br><i>Secretary Department<br>{{departemeninggris(str_slug($departemen->nama_departemen))}} Faculty of Engineering,</i><br><br><br><br><br>
                        @if (isset($pimpinan['sekretaris-departemen']))
                            @if (isset($dosen[$pimpinan['sekretaris-departemen']->dosen_id]))
                                @php
                                    $pimp=$dosen[$pimpinan['sekretaris-departemen']->dosen_id];
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