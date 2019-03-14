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
                        <td width="70px">Ref</td>
                        <td width="4px">:</td>
                        <td width="40px">&nbsp;</td>
                        <td>___/UN2.F4.DTS/PDP.04.00/2018</td>
                        <td align="right">02 September, 2018</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>:</td>
                        <td colspan="3">Permissions for the Internship Location</td>
                    </tr>
                </table>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>
                    To,<br />
                    {{isset($inf['pimpinan-perusahaan-penanggung-jawab']) ? $inf['pimpinan-perusahaan-penanggung-jawab']->isi : '___________________________'}}<br />
                    {{isset($inf['instansiperusahaan']) ? $inf['instansiperusahaan']->isi : '___________________________'}}<br />
                    {{isset($inf['alamat-perusahaan']) ? $inf['alamat-perusahaan']->isi : '___________________________'}}<br /><br />
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    Dear Sir/Madam,<br /><br />
                    Herewith we would like to invoke your sincerity to give an opportunity for our student to conduct a practical training at one of your construction project. The training is part of the curriculum requirements of the undergraduate program in {{departemeninggris($departemen->nama_departemen)}}, Faculty of Engineering, Universitas Indonesia. The curriculum requires students to spend about 150 – 200 hours at the project which is equivalent to 3 credits. Following are list of the students that will be taking part at your project:
                </div>
                <div>&nbsp;</div>
                <div align="center">
                    <table border="1" align="left" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                        <tr align='center'>
                            <th align="center">Name</th>
                            <th align="center">Student Number</th>
                            <th align="center">Programm</th>
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
                </div>
                <div>&nbsp;</div>
                <div align="justify">
                    In order to achieve a good working experience, problem solving, leadership, teamwork and to make a good final report they should fill in the log book to record their activities. And we also would like to ask for your assistance throughout all technical and administrative process during this training.<br><br>
                    Thank you very much for your kind cooperation.
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                </div>
                <br>
                <br>
                <table border="0" width="100%">
                    <tr>
                        <td width="55%">&nbsp;</td>
                        <td align="left">Yours faithfully,<br><br><br><br><br>
                            @if (isset($pimpinan['ketua-departemen']))
                                @if (isset($dosen[$pimpinan['ketua-departemen']->dosen_id]))
                                    @php
                                        $pimp=$dosen[$pimpinan['ketua-departemen']->dosen_id];
                                    @endphp
                                    <b>{{$pimp->nama}}</b>
                                    <br>Head of {{departemeninggris($departemen->nama_departemen)}}

                                @else
                                <b>_________________________</b><br>
                                Head of _________________________________
                                @endif
                            @else
                                <b>_________________________</b><br>
                                Head of _________________________________
                                
                            @endif
                            <br />Faculty of Engineering<br />Universitas Indonesia<br />UI Campus Depok
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