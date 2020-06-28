<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
<li class="sidebar-toggler-wrapper hide">
    <div class="sidebar-toggler">
        <span></span>
    </div>
</li>

<li class="nav-item start ">
    <a href="{{route('beranda')}}" class="nav-link">
        <i class="icon-home"></i>
        <span class="title">Beranda</span>
    </a>
   
</li>

<li class="nav-item {{Request::path()=='profil' ? 'active' : ''}}">
    <a href="{{url('profil-staf')}}" class="nav-link nav-toggle">
        <i class="fa fa-user font-white"></i>
        <span class="title">Profil</span>
    </a>
</li>
@if (Auth::user()->flag==1)
<li class="nav-item  {{Request::path()=='notifikasi' ? 'active' : ''}}">
    <a href="{{url('notifikasi')}}" class="nav-link nav-toggle">
        <i class="fa fa-bell font-white"></i>
        <span class="title">Notifikasi</span>
    </a>
</li>
<li class="nav-item  {{Request::path()=='pesan' ? 'active' : ''}}">
    <a href="{{url('pesan')}}" class="nav-link nav-toggle">
        <i class="fa fa-envelope font-white"></i>
        <span class="title">Kirim Pesan</span>
    </a>
</li>
<li class="nav-item  {{Request::path()=='staf-publikasi-ilmiah' ? 'active' : ''}}">
        <a href="{{url('staf-publikasi-ilmiah')}}" class="nav-link nav-toggle">
            <i class="fa fa-book font-white"></i>
            <span class="title">Publikasi Ilmiah</span>
        </a>    
    </li>
<li class="heading">
    <h3 class="uppercase">Pengajuan</h3>
</li>
<li class="nav-item  {{strpos(Request::url(),'data-pengajuan')!==false || strpos(Request::url(),'data-bimbingan')!==false || strpos(Request::url(),'data-pengajuan-sidang')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Pengajuan</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='data-pengajuan'  ? 'active' : ''}}">
            <a href="{{url('data-pengajuan')}}" class="nav-link ">
                <span class="title">Pengajuan Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::url(),'data-bimbingan')!==false || strpos(Request::url(),'data-pengajuan-detail')!==false ? 'active' : ''}}">
            <a href="{{url('data-bimbingan')}}" class="nav-link ">
                <span class="title">Data Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::url(),'data-pengajuan-sidang')!==false  ? 'active' : ''}}">
            <a href="{{url('data-pengajuan-sidang/1')}}" class="nav-link ">
                <span class="title">Pengajuan Sidang</span>
            </a>
        </li>
        {{-- <li class="nav-item {{ strpos(Request::url(),'data-jadwal')!==false ? 'active' : ''}} ">
            <a href="{{url('data-jadwal/2')}}" class="nav-link ">
                {{-- <i class="fa fa-th-list font-white"></i> 
                <span class="title">Jadwal Sidang</span>
            </a>
        </li> --}}
    </ul>
</li>
<li class="nav-item  {{strpos(Request::url(),'data-kp')!==false || strpos(Request::url(),'data-jadwal-kp')!==false || strpos(Request::url(),'data-grup-kp')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Kerja Praktek</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{strpos(Request::url(),'data-kp')!==false  ? 'active' : ''}}">
            <a href="{{url('data-kp')}}" class="nav-link ">
                <span class="title">Pengajuan Kerja Praktek</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::url(),'data-grup-kp')!==false  ? 'active' : ''}}">
            <a href="{{url('data-grup-kp')}}" class="nav-link ">
                <span class="title">Data Grup Kerja Praktek</span>
            </a>
        </li>
        <li class="nav-item  {{Request::url()=='data-jadwal-kp'  ? 'active' : ''}}">
            <a href="{{url('data-jadwal-kp')}}" class="nav-link ">
                <span class="title">Jadwal Sidang</span>
            </a>
        </li>
        
    </ul>
</li>
<li class="nav-item  {{strpos(Request::url(),'data-jadwal')!==false ? 'active' : ''}} ">
    <a href="{{url('data-jadwal/2')}}" class="nav-link ">
        <i class="fa fa-calendar font-white"></i>
        <span class="title">Jadwal Sidang</span>
    </a>
</li>

{{-- <li class="heading">
    <h3 class="uppercase">Jadwal</h3>
</li> --}}
{{-- <li class="nav-item {{ Request::url()=='data-jadwal' ? 'active' : ''}} ">
    <a href="{{url('data-jadwal/2')}}" class="nav-link ">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Sidang Skripsi/Tesis/Disertasi</span>
    </a>
</li> --}}
{{-- <li class="nav-item {{ strpos(Request::url(),'data-jadwal/kp')!==false ? 'active' : ''}} ">
    <a href="{{url('data-jadwal/kp')}}" class="nav-link ">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Sidang Kerja Praktek</span>
    </a>
</li> --}}
<li class="heading">
    <h3 class="uppercase">Laporan</h3>
</li>
<li class="nav-item  {{strpos(Request::path(),'rekap')!==false ? 'active' : ''}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Laporan Rekapitulasi</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{strpos(Request::path(),'rekap-penguji-staf')!==false  ? 'active' : ''}}">
            <a href="{{url('rekap-penguji-staf')}}" class="nav-link ">
                <span class="title">Penguji</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='rekap-pembimbing-staf'  ? 'active' : ''}}">
            <a href="{{url('rekap-pembimbing-staf')}}" class="nav-link ">
                <span class="title">Pembimbing</span>
            </a>
        </li>
        
    </ul>
</li>
<li class="heading">
    <h3 class="uppercase">Data</h3>
</li>
<li class="nav-item  {{(Request::path()=='departemen-admin' || strpos(Request::path(),'bidangkhusus')!==false || strpos(Request::path(),'programstudi') !==false) || strpos(Request::path(),'pimpinan-departemen')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-home font-white"></i>
        <span class="title">Data Departemen</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='departemen-admin' ? 'active' : ''}}">
            <a href="{{url('departemen-admin')}}" class="nav-link ">
                <span class="title">Departemen</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='programstudi-admin' ? 'active' : ''}}">
            <a href="{{url('programstudi-admin')}}" class="nav-link ">
                <span class="title">Program Studi</span>
            </a>
        </li>
        <li class="nav-item {{Request::path()=='pimpinan-departemen' ? 'active' : ''}}">
            <a href="{{url('pimpinan-departemen')}}" class="nav-link ">
                <span class="title">Data Pimpinan</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{strpos(Request::path(),'mahasiswa')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users font-white"></i>
        <span class="title">Data Mahasiswa</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::path()=='mahasiswa-admin' ? 'active' : ''}}">
            <a href="{{url('mahasiswa-admin')}}" class="nav-link ">
                <span class="title">Data Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'mahasiswa-admin/')!==false ? 'active' : ''}}">
            <a href="{{url('mahasiswa-admin/-1')}}" class="nav-link ">
                <span class="title">Tambah Mahasiswa Baru</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{strpos(Request::path(),'dosen')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users font-white"></i>
        <span class="title">Data Dosen</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::path()=='dosen-admin' ? 'active' : ''}}">
            <a href="{{url('dosen-admin')}}" class="nav-link ">
                <span class="title">Data Dosen</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'dosen-admin/')!==false ? 'active' : ''}}">
            <a href="{{url('dosen-admin/-1')}}" class="nav-link ">
                <span class="title">Tambah Dosen Baru</span>
            </a>
        </li>
        <li class="nav-item {{Request::path()=='izin-dosen' ? 'active' : ''}}">
            <a href="{{url('izin-dosen')}}" class="nav-link nav-toggle">
                <span class="title">Izin Dosen</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  {{strpos(Request::path(),'ruangan')!==false ? 'active' : ''}} ">
    <a href="{{url('master-ruangan')}}" class="nav-link ">
        <i class="fa fa-gear font-white"></i>
        <span class="title">Data Ruangan</span>
    </a>
</li>
<li class="nav-item  {{strpos(Request::path(),'jenispengajuan')!==false ? 'active' : ''}} ">
    <a href="{{url('master-jenispengajuan')}}" class="nav-link ">
        <i class="fa fa-gear font-white"></i>
        <span class="title">Data Jenis Mata Kuliah Spesial</span>
    </a>
</li>
<li class="nav-item  {{strpos(Request::path(),'kalender-akademik')!==false ? 'active' : ''}} ">
    <a href="{{url('kalender-akademik')}}" class="nav-link ">
        <i class="fa fa-calendar font-white"></i>
        <span class="title">Kalender Akademik</span>
    </a>
</li>
<li class="nav-item {{strpos(Request::path(),'quota')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users font-white"></i>
        <span class="title">Quota</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{strpos(Request::path(),'quota-bimbingan')!==false ? 'active' : ''}} ">
            <a href="{{url('quota-bimbingan')}}" class="nav-link ">
                
                <span class="title">Quota Mahasiswa Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'quota-penguji')!==false ? 'active' : ''}} ">
            <a href="{{url('quota-penguji')}}" class="nav-link ">
                <span class="title">Quota Jumlah Penguji</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'quota-pembimbing')!==false ? 'active' : ''}} ">
            <a href="{{url('quota-pembimbing')}}" class="nav-link ">
                <span class="title">Quota Jumlah Pembimbing</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'minimal-bimbingan')!==false ? 'active' : ''}} ">
            <a href="{{url('minimal-bimbingan')}}" class="nav-link ">
                <span class="title">Jumlah Minimal Proses Bimbingan</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item  {{(Request::path()=='kategori-penilaian' || strpos(Request::path(),'komponen-penilaian')!==false || strpos(Request::path(),'subkomponen') !==false) ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Kriteria Penilaian</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{strpos(Request::path(),'kategori-penilaian')!==false ? 'active' : ''}} ">
            <a href="{{url('kategori-penilaian')}}" class="nav-link ">
                <span class="title">Kategori</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'komponen-penilaian')!==false ? 'active' : ''}} ">
            <a href="{{url('komponen-penilaian')}}" class="nav-link ">
                <span class="title">Komponen</span>
            </a>
        </li>
        {{-- <li class="nav-item  {{strpos(Request::path(),'subkomponen')!==false ? 'active' : ''}} ">
            <a href="{{url('subkomponen')}}" class="nav-link ">
                <span class="title">Sub Komponen</span>
            </a>
        </li> --}}
        
    </ul>
</li>
{{-- <li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Pengajuan Seminar</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="components_date_time_pickers.html" class="nav-link ">
                <span class="title">Daftar Pengajuan</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="components_color_pickers.html" class="nav-link ">
                <span class="title">Jadwal Seminar</span>
            </a>
        </li>
        
    </ul>
</li> --}}

{{-- <li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Pengajuan Tesis</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="form_controls.html" class="nav-link ">
                <span class="title">Daftar Pengajuan</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="form_validation.html" class="nav-link ">
                <span class="title">Jadwal Sidang Tesis</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ul font-white"></i>
        <span class="title">Pengajuan Kerja Praktek</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="form_controls.html" class="nav-link ">
                <span class="title">Daftar Kerja Praktek</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="form_validation.html" class="nav-link ">
                <span class="title">Jadwal Kerja Praktek</span>
            </a>
        </li>
    </ul>
</li> --}}
@endif
</ul>