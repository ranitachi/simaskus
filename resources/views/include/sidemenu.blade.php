<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
<li class="sidebar-toggler-wrapper hide">
    <div class="sidebar-toggler">
        <span></span>
    </div>
</li>
<li class="sidebar-search-wrapper">
    <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
        <a href="javascript:;" class="remove">
            <i class="icon-close"></i>
        </a>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <a href="javascript:;" class="btn submit">
                    <i class="icon-magnifier"></i>
                </a>
            </span>
        </div>
    </form>
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
<li class="nav-item  {{(strpos(Request::path(),'departemen')!==false || strpos(Request::path(),'bidangkhusus')!==false || strpos(Request::path(),'programstudi') !==false) ? 'active' : ''}}">
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
        {{-- <li class="nav-item  {{Request::path()=='bidangkhusus-admin' ? 'active' : ''}}">
            <a href="{{url('bidangkhusus-admin')}}" class="nav-link ">
                <span class="title">Bidang Kekhususan</span>
            </a>
        </li> --}}
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
                <span class="title">Daftar Mahasiswa</span>
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
                <span class="title">Daftar Dosen</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'dosen-admin/')!==false ? 'active' : ''}}">
            <a href="{{url('dosen-admin/-1')}}" class="nav-link ">
                <span class="title">Tambah Dosen Baru</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{strpos(Request::path(),'staf')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users font-white"></i>
        <span class="title">Data Staf</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::path()=='staf-admin' ? 'active' : ''}}">
            <a href="{{url('staf-admin')}}" class="nav-link ">
                <span class="title">Daftar Staf</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'staf-admin/')!==false ? 'active' : ''}}">
            <a href="{{url('staf-admin/-1')}}" class="nav-link ">
                <span class="title">Tambah Staf Baru</span>
            </a>
        </li>
    </ul>
</li>
{{-- <li class="nav-item {{strpos(Request::path(),'user-admin')!==false ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users font-white"></i>
        <span class="title">Data Admin</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::path()=='user-admin' ? 'active' : ''}}">
            <a href="{{url('user-admin')}}" class="nav-link ">
                <span class="title">Daftar Admin</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'user-admin/')!==false ? 'active' : ''}}">
            <a href="{{url('user-admin/-1')}}" class="nav-link ">
                <span class="title">Tambah Admin Baru</span>
            </a>
        </li>
    </ul>
</li> --}}
<li class="nav-item {{strpos(Request::path(),'master')!==false ? 'active' : ''}} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-list font-white"></i>
        <span class="title">Master Data</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{strpos(Request::path(),'jenispengajuan')!==false ? 'active' : ''}} ">
            <a href="{{url('master-jenispengajuan')}}" class="nav-link ">
                <span class="title">Data Mata Kuliah Spesial</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'syaratpengajuan')!==false ? 'active' : ''}} ">
            <a href="{{url('master-syaratpengajuan')}}" class="nav-link ">
                <span class="title">Syarat Pengajuan</span>
            </a>
        </li>
        <li class="nav-item  {{strpos(Request::path(),'ruangan')!==false ? 'active' : ''}} ">
            <a href="{{url('master-ruangan')}}" class="nav-link ">
                <span class="title">Data Ruangan</span>
            </a>
        </li>
        {{-- <li class="nav-item  {{strpos(Request::path(),'jenjang')!==false ? 'active' : ''}} ">
            <a href="{{url('jenjang')}}" class="nav-link ">
                <span class="title">Data Jenjang</span>
            </a>
        </li> --}}
    </ul>
</li>
</ul>