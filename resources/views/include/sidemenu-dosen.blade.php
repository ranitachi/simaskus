<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
<li class="sidebar-toggler-wrapper hide">
    <div class="sidebar-toggler">
        <span></span>
    </div>
</li>
<li class="sidebar-search-wrapper">
    &nbsp;
</li>
<li class="nav-item start ">
    <a href="{{route('beranda')}}" class="nav-link">
        <i class="icon-home"></i>
        <span class="title">Beranda</span>
    </a>
   
</li>
<li class="heading">
    <h3 class="uppercase">Menu</h3>
</li>
<li class="nav-item {{Request::path()=='profil' ? 'active' : ''}}">
    <a href="{{url('profil-dosen')}}" class="nav-link nav-toggle">
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
<li class="nav-item  {{strpos(Request::url(),'bimbingan')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Bimbingan</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='pengajuan-bimbingan' ? 'active' : ''}}">
            <a href="{{url('pengajuan-bimbingan')}}" class="nav-link ">
                <span class="title">Pengajuan Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='daftar-bimbingan' || strpos(Request::url(),'bimbingan-detail')!==false ? 'active' : ''}}">
            <a href="{{url('daftar-bimbingan')}}" class="nav-link ">
                <span class="title">Data Bimbingan</span>
            </a>
        </li>
        {{-- <li class="nav-item  {{Request::path()=='sidang-bimbingan' ? 'active' : ''}}">
            <a href="{{url('sidang-bimbingan')}}" class="nav-link ">
                <span class="title">Jadwal Sidang Bimbingan</span>
            </a>
        </li> --}}
    </ul>
</li>

{{-- <li class="nav-item  {{strpos(Request::url(),'pengajuan-sidang')!==false ? 'active' : (strpos(Request::url(),'jadwal-sidang-dosen')!==false ? 'active' : '')}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Pengajuan Seminar/Skripsi/Tesis</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='pengajuan-sidang' ? 'active' : ''}}">
            <a href="{{url('pengajuan-sidang')}}" class="nav-link ">
                <span class="title">Data Pengajuan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='jadwal-sidang-dosen' ? 'active' : ''}}">
            <a href="{{url('jadwal-sidang-dosen')}}" class="nav-link ">
                <span class="title">Jadwal Sidang</span>
            </a>
        </li>
    </ul>
</li> --}}
<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ul font-white"></i>
        <span class="title">Kerja Praktek</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('data-kp')}}" class="nav-link ">
                <span class="title">Data Kerja Praktek</span>
            </a>
        </li>
        {{-- <li class="nav-item  ">
            <a href="form_controls_md.html" class="nav-link ">
                <span class="title">Tambah KP Baru</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item  ">
            <a href="{{url('data-jadwal-kp')}}" class="nav-link ">
                <span class="title">Jadwal Sidang Kerja Praktek</span>
            </a>
        </li> --}}
    </ul>
</li>
<li class="heading">
    <h3 class="uppercase">Penilaian</h3>
</li>
<li class="nav-item  {{strpos(Request::path(),'penilaian')!==false ? 'active' : ''}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Penilaian</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='penilaian'  ? 'active' : ''}}">
            <a href="{{url('penilaian')}}" class="nav-link ">
                <span class="title">Penguji</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='penilaian-pembimbing'  ? 'active' : ''}}">
            <a href="{{url('penilaian-pembimbing')}}" class="nav-link ">
                <span class="title">Pembimbing</span>
            </a>
        </li>
        
    </ul>
</li>
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
        <li class="nav-item  {{strpos(Request::path(),'rekap-penguji')!==false  ? 'active' : ''}}">
            <a href="{{url('rekap-penguji')}}" class="nav-link ">
                <span class="title">Penguji</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='rekap-pembimbing'  ? 'active' : ''}}">
            <a href="{{url('rekap-pembimbing')}}" class="nav-link ">
                <span class="title">Pembimbing</span>
            </a>
        </li>
        
    </ul>
</li>
<li class="heading">
    <h3 class="uppercase">Izin</h3>
</li>
<li class="nav-item {{Request::path()=='izin-dosen' ? 'active' : ''}}">
    <a href="{{url('izin-dosen')}}" class="nav-link nav-toggle">
        <i class="fa fa-user font-white"></i>
        <span class="title">Izin Dosen</span>
    </a>
</li>
@endif
</ul>