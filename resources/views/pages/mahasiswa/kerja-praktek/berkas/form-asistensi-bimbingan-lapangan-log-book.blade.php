<!DOCTYPE html>
<html>
<head>
	<title>Load PDF</title>
    <style>
    body {
    /* background: rgb(204,204,204);  */
    margin:0px !important;
    padding:0px !important;
    }
    page {
    background: white;
    display: block;
    margin: 0 auto;
    /* margin-bottom: 0.1cm; */
    }
    page[size="A4"] {  
    width: 21cm;
    height: 29.7cm; 

    }
   
    ol
    {
        list-style-type:initial;
    }
    ol li
    {
        padding:5px 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size:14px;
    }
    ul li
    {
        padding:5px 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-size:14px;
    }

        @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }
    }
    .break
    {
        page-break-after: always;
    }
    </style>
</head>
<body>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <div style="width:100%;text-align:center;padding:0px;padding-top:30%;margin:0px; !important">
                <h1 style="font-family: Arial, Helvetica, sans-serif;margin:0px !important;">BUKU REKAM KINERJA<br>KERJA PRAKTEK (KP)</h1>
                <h3 style="font-family:Lucida Sans;width:70%;margin:50px auto 0 auto;border:1px solid;padding:20px;">
                    {{strtoupper($departemen->nama_departemen)}}<br>
                    FAKULTAS TEKNIK UNIVERSITAS INDONESIA
                </h3>
        </div>
    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h1 style="text-align:center;">REKAM KINERJA KERJA PRAKTEK</h1>
        <table style="width:65%;border:0px;margin:50px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align:left">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Periode Kegiatan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$periode}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Dosen Pembimbing</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['dosen']))
                        @foreach ($pembimbing['dosen'] as $item)
                            {{$item->dosen->nama}}<br>
                        @endforeach
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
            <tr>
                <td style="text-align:left">Pembimbing Lapangan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['lapangan']))
                        {{$pembimbing['lapangan'][0]->nama}}
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
        </table>
        <p style="width:100%;text-align:center;margin:150px auto 50px auto;height:400px;">
            {{-- <img src="{{public_path('img/logoft.jpg')}}" style="height:200px;width:auto;margin:50px auto 0 auto"/> --}}
            <img src="{{storage_path('app/logoft.jpg')}}" style="height:200px;width:auto;margin-bottom:100px;"/>
        </p>
        <h2 style="width:100%;text-align:center;padding-top:400px;font-family:Arial, Helvetica, sans-serif">{{strtoupper($departemen->nama_departemen)}}<br>FAKULTAS TEKNIK UNIVERSITAS INDONESIA<BR>{{date('Y')}}</h2>
        

    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h1 style="text-align:center;">DATA PRIBADI</h1>
        <table style="width:85%;border:1px solid #111;margin:10px auto 0 auto;font-size:12px;font-family:Arial, Helvetica, sans-serif;" border="1" cellpadding="2">
            <tr>
                <td>Nama Lengkap</td>
                <td>{{$mhs->nama}}</td>
                <td rowspan="5" style="text-align:center">
                    @if (isset(Auth::user()->foto))
                        @if (Auth::user()->foto!='')   
                            
                            <img src="{{storage_path('app/'.Auth::user()->foto)}}" style="height:150px;width:auto">
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>{{$mhs->tempat_lahir}} / {{isset($mhs->tanggal_lahir) ? tgl_indo($mhs->tanggal_lahir) : ''}}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>{{$mhs->programstudi->nama_program_studi}}</td>
            </tr>
            <tr>
                <td>HP/Telp</td>
                <td>{{$mhs->hp}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$mhs->email}}</td>
            </tr>
            <tr>
                <td colspan="3" style="padding:20px;text-align:center"><b>INFORMASI PEKERJAAN / PROYEK</b></td>
            </tr>
            @if (isset($inf['instansiperusahaan']))                
                <tr>
                    <td style="padding:10px;text-align:left">{{$inf['instansiperusahaan']->judul}}</td>
                    <td colspan="2" style="padding:10px;text-align:left">{{$inf['instansiperusahaan']->isi}}</td>
                </tr>
            @endif
            @if (isset($inf['pimpinan-perusahaan-penanggung-jawab']))                
                <tr>
                    <td style="padding:10px;text-align:left">{{$inf['pimpinan-perusahaan-penanggung-jawab']->judul}}</td>
                    <td colspan="2" style="padding:10px;text-align:left">{{$inf['pimpinan-perusahaan-penanggung-jawab']->isi}}</td>
                </tr>
            @endif
            @if (isset($inf['deptdivisiseksi']))                
                <tr>
                    <td style="padding:10px;text-align:left">{{$inf['deptdivisiseksi']->judul}}</td>
                    <td colspan="2" style="padding:10px;text-align:left">{{$inf['deptdivisiseksi']->isi}}</td>
                </tr>
            @endif
            @if (isset($inf['nama-pekerjaan']))                
                <tr>
                    <td style="padding:10px;text-align:left">{{$inf['nama-pekerjaan']->judul}}</td>
                    <td colspan="2" style="padding:10px;text-align:left">{{$inf['nama-pekerjaan']->isi}}</td>
                </tr>
            @endif
            @foreach ($inf as $item)
                @if ($item->status=='tambahan')
                    <tr>
                        <td style="padding:10px;text-align:left">{{$item->judul}}</td>
                        <td colspan="2" style="padding:10px;text-align:left">{{$item->isi}}</td>
                    </tr>
                @endif
            @endforeach
            @if (isset($inf['deskripsi']))                
                <tr>
                    <td style="padding:10px;text-align:left">{{$inf['deskripsi']->judul}}</td>
                    <td colspan="2" style="padding:10px;text-align:left">{{$inf['deskripsi']->isi}}</td>
                </tr>
            @endif
        </table>
    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">PROFILE MUTU SARJANA TEKNIK (OUTCOMES) - ABET ENGINEERING CRITERIA</h4>
        <div style="width:90%;margin:0 auto;">
            <ol>
                <li>Kemampuan menerapkan pengetahuan matematika, ilmu pengetahuan, & enjinering.</li>
                <li>Kemampuan merancang serta melaksanakan eksperimen termasuk menganalisis dan menafsirkan data/hasil uji.</li>
                <li>Kemampuan merancang suatu sistem komponen, proses dan metode untuk memenuhi kebutuhan yang diinginkan.</li>
                <li>Kemampuan mengidentifikasi, memformulasikan, dan memecahkan permasalahan enjinering.</li>
                <li>Kemampuan berperan atau berfungsi dalam tim kerja multidisiplin.</li>
                <li>Pemahaman terhadap tanggungjawab dan etik profesi.</li>
                <li>Kemampuan berkomunikasi secara efektif.</li>
                <li>Pemahaman terhadap dampak dari penyelesaian enjinering dalam konteks sosio-kultural dan global.</li>
                <li>Kesadaran terhadap kebutuhan serta kemampuan untuk memenuhinya melalui proses belajar sepanjang hayat (life long learning).</li>
                <li>Pengetahuan terhadap permasalahan mutakhir.</li>
                <li>Kemampuan menggunakan teknik-teknik, ketrampilan, dan peralatan modern yang diperlukan dalam praktek enjinering.</li>
            </ol>
        </div>

    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">PROFILE PETUNJUK PENGISIAN REKAM KINERJA</h4>
        <div style="width:90%;margin:0 auto;padding-top:50px;padding-left:20px;text-align:justify;font-family:Arial">
            <p><i>Masyarakat Industri butuh Sarjana Teknik yang ”mampu” bekerja, bukannya sekedar ”tahu” bagaimana bekerja</i></p>
            <p>
                Budayakan disiplin untuk senantiasa ”mencatat apa yang telah atau sedang dilakukan, serta benar melaksanakan semua apa yang ditulis sebelumnya” sehingga dapat terbangun kinerja keswadayaan yang bersendikan keyakinan terhadap kapasitas pribadi untuk “mampu kerja”.
            </p>
            <ul>
                <li><b>Lembar A</b> merupakan rencana kegiatan kerja praktek yang akan dilakukan tiap minggunya dan diisi oleh mahasiswa setelah berdiskusi dengan dosen pembimbing dan pembimbing lapangan.</li>
                <li><b>Lembar B</b> merupakan rencana kegiatan kerja praktek yang akan dilakukan tiap minggunya dan diisi oleh mahasiswa setelah berdiskusi dengan dosen pembimbing dan pembimbing lapangan.merupakan rekam kinerja harian yang diisi oleh mahasiswa dan diparaf oleh pembimbing lapangan. Pada lembar ini, mahasiswa diharuskan untuk              menuliskan apa saja yang dilakukan selama satu hari penuh di lokasi proyek dan informasi/pengetahuan baru yang diperoleh.</li>
                <li><b>Lembar C</b> merupakan lembar supervisi mingguan yang diisi oleh pembimbing lapangan. Mahasiswa diharuskan untuk memberikan lembaran ini setiap minggu kepada pembimbing lapangan untuk segera diisi dan dipegang oleh mahasiswa sebagai feedback mingguan untuk perbaikan di minggu berikutnya.</li>
                <li><b>Lembar D</b> merupakan lembar akhir kinerja mahasiswa yang diisi dan ditandatangani oleh pembimbing lapangan serta diketahui oleh pimpinan proyek. Mahasiswa diharuskan untuk memberikan lembaran ini kepada pembimbing lapangan di akhir kerja praktek untuk diisi.</li>
                <li><b>Lembar A</b>, <b>B</b> dan <b>C</b> bisa diperbanyak sesuai dengan kebutuhan.</li>
            </ol>
        </div>

    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><u>RENCANA KEGIATAN KERJA PRAKTEK (LEMBAR A)</u></h4>
        <table style="width:90%;border:0px;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align:left;width:30%">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Dosen Pembimbing</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['dosen']))
                        @foreach ($pembimbing['dosen'] as $item)
                            {{$item->dosen->nama}}<br>
                        @endforeach
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
            <tr>
                <td style="text-align:left">Pembimbing Lapangan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['lapangan']))
                        {{$pembimbing['lapangan'][0]->nama}}
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
        </table>
        <table style="width:90%;border:1px solid #111;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;" border="1px">
            <tr>
                <th style="padding:15px 0px;">MINGGU KE-</th>
                <th style="padding:15px 0px;">URAIAN RENCANA KEGIATAN</th>
            </tr>
            @for ($i = 0; $i < 6; $i++)
                <tr>
                    <th style="height: 100px;">&nbsp;</th>
                    <th style="height: 100px;">&nbsp;</th>
                </tr>
            @endfor
        </table>
    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><u>REKAM KINERJA HARIAN (LEMBAR B)</u></h4>
        <table style="width:90%;border:0px;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align:left;width:30%">Minggu Ke</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">______________ dari _______________</td>
            </tr>
            <tr>
                <td style="text-align:left;width:30%">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Pembimbing Lapangan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['lapangan']))
                        {{$pembimbing['lapangan'][0]->nama}}
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
        </table>
        <table style="width:90%;border:1px solid #111;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;" border="1px">
            <tr>
                <th style="padding:15px 0px;">TANGGAL</th>
                <th style="padding:15px 0px;">URAIAN KEGIATAN</th>
                <th style="padding:15px 0px;">PARAF <BR>PEMBIMBING <BR>LAPANGAN</th>
            </tr>
            <tr>
                <th style="height: 600px;">&nbsp;</th>
                <th style="height: 600px;">&nbsp;</th>
                <th style="height: 600px;">&nbsp;</th>
            </tr>
           
        </table>
    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><u>REKAM KINERJA HARIAN (LEMBAR B)</u></h4>
        <table style="width:90%;border:0px;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align:left;width:30%">Minggu Ke</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">______________ dari _______________</td>
            </tr>
            <tr>
                <td style="text-align:left;width:30%">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Pembimbing Lapangan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['lapangan']))
                        {{$pembimbing['lapangan'][0]->nama}}
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
        </table>
        <table style="width:90%;border:1px solid #111;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;" border="1px">
            <tr>
                <th style="padding:15px 0px;">TANGGAL</th>
                <th style="padding:15px 0px;">URAIAN KEGIATAN</th>
                <th style="padding:15px 0px;">PARAF <BR>PEMBIMBING <BR>LAPANGAN</th>
            </tr>
            <tr>
                <th style="height: 600px;">&nbsp;</th>
                <th style="height: 600px;">&nbsp;</th>
                <th style="height: 600px;">&nbsp;</th>
            </tr>
           
        </table>
    </page>
    
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><u>LEMBAR SUPERVISI MINGGUAN (LEMBAR C)</u></h4>
        <table style="width:90%;border:0px;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align:left;width:30%">Minggu Ke</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">______________ dari _______________</td>
            </tr>
            <tr>
                <td style="text-align:left;width:30%">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            <tr>
                <td style="text-align:left">Pembimbing Lapangan</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">
                    @if (isset($pembimbing['lapangan']))
                        {{$pembimbing['lapangan'][0]->nama}}
                    @else
                        ___________________________
                    @endif    
                </td>
            </tr>
            <tr>
                <td style="text-align:left">PARAF</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">_________________________</td>
            </tr>
        </table>
        <table style="width:90%;border:1px solid #111;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;" border="1px">
            <tr>
                <th style="padding:15px 0px;">URAIAN TUNTUNAN</th>
            </tr>
            <tr>
                <td style="height: 200px;vertical-align:top;font-size:12px;">1. ATTITUDE (SIKAP & PERILAKU KERJA):</td>
            </tr>
            <tr>
                <td style="height: 200px;vertical-align:top;font-size:12px;">2. SKILL (KETRAMPILAN):</td>
            </tr>
            <tr>
                <td style="height: 200px;vertical-align:top;font-size:12px;">3. KNOWLEDGE (PENGETAHUAN):</td>
            </tr>
           
        </table>
    </page>
    <page size="A4" style="padding:0px; margin:0px;width:100% !important;height:900px;">
        <h4 style="text-align:center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><u>LEMBAR EVALUASI AKHIR KINERJA MAHASISWA (LEMBAR D)</u></h4>
        <table style="width:90%;border:0px;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            
            <tr>
                <td style="text-align:left;width:30%">Nama Mahasiswa</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->nama}}</td>
            </tr>
            <tr>
                <td style="text-align:left">NPM</td>
                <td style="text-align:left;width:1%">:</td>
                <td style="text-align:left">{{$mhs->npm}}</td>
            </tr>
            
        </table>
        <table style="width:90%;border:1px solid #111;margin:30px auto 0 auto;font-family:Arial, Helvetica, sans-serif;" border="1px">

            <tr>
                <td style="height: 150px;vertical-align:top;font-size:12px;">(coret yang tidak perlu)<br><br>
                    1. ATTITUDE (SIKAP & PERILAKU KERJA): Sangat Baik / Baik / Cukup / Kurang / Sangat Kurang <br>
                    2. SKILL (KETRAMPILAN): Sangat Baik / Baik / Cukup / Kurang / Sangat Kurang<br>
                    3. KNOWLEDGE (PENGETAHUAN): Sangat Baik / Baik / Cukup / Kurang / Sangat Kurang
                </td>
            </tr>
            <tr>
                <td style="height: 200px;vertical-align:top;font-size:12px;">PESAN UNTUK MAHASISWA:</td>
            </tr>
            <tr>
                <td style="height: 200px;vertical-align:top;font-size:12px;">REKOMENDASI UNTUK INSTITUSI:</td>
            </tr>
           
        </table>
        <table style="width:90%;border:0px;margin:20px auto 0 auto;font-family:Arial, Helvetica, sans-serif;">
            
            <tr>
                <td style="text-align:left;width:100%" colspan="2">___________, _____________________________</td>
            </tr>
            <tr>
                <td style="text-align:center;width:50%"><br><br>Pimpinan Proyek
                <br><br><br><br><br>
                (________________________________)
                </td>
                <td style="text-align:center;width:50%"><br><br>Pembimbing Lapangan
                <br><br><br><br><br>
                @if (isset($pembimbing['lapangan']))
                        <u>( {{$pembimbing['lapangan'][0]->nama}} )</u>
                    @else
                        (________________________________)
                    @endif
                
                </td>
            </tr>
            
        </table>
    </page>

</body>
</html>
