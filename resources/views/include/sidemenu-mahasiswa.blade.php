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
<li class="nav-item  {{Request::path()=='notifikasi' ? 'active' : ''}}">
    <a href="{{url('notifikasi')}}" class="nav-link nav-toggle">
        <i class="fa fa-bell font-white"></i>
        <span class="title">Notifikasi</span>
    </a>
    
</li>
<li class="heading">
    <h3 class="uppercase">Menu</h3>
</li>
<li class="nav-item {{Request::path()=='profil' ? 'active' : ''}}">
    <a href="{{url('/profil')}}" class="nav-link nav-toggle">
        <i class="fa fa-user font-white"></i>
        <span class="title">Profil</span>
    </a>
</li>
@if (Auth::user()->flag==1)
@php
    $mhs=\App\Model\Mahasiswa::where('id',Auth::user()->id_user)->with('programstudi')->first();
    // dd($mhs);
@endphp
@if (strpos($mhs->programstudi->nama_program_studi,'S1')!==false)
<li class="nav-item {{strpos(Request::url(),'pengajuan')!==false || strpos(Request::url(),'data-bimbingan-mhs')!==false || strpos(Request::url(),'jadwal-sidang')!==false || strpos(Request::url(),'daftar-sidang')!==false  ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Pengajuan</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='pengajuan' ? 'active' : ''}}">
            <a href="{{url('pengajuan')}}" class="nav-link ">
                <span class="title">Pengajuan Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='data-bimbingan-mhs' ? 'active' : ''}}">
            <a href="{{url('data-bimbingan-mhs')}}" class="nav-link ">
                <span class="title">Data Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='daftar-sidang' ? 'active' : ''}}">
            <a href="{{url('daftar-sidang')}}" class="nav-link ">
                <span class="title">Pengajuan Sidang</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='jadwal-sidang' ? 'active' : ''}}">
            <a href="{{url('jadwal-sidang')}}" class="nav-link ">
                <span class="title">Jadwal Sidang</span>
            </a>
        </li>
    </ul>
</li>
@endif
@if (strpos($mhs->programstudi->nama_program_studi,'S2')!==false)
<li class="nav-item {{strpos(Request::url(),'pengajuan-tesis')!==false || strpos(Request::url(),'jadwal-sidang-tesis')!==false || strpos(Request::url(),'daftar-sidang-tesis')!==false  ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Pengajuan Tesis</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='pengajuan-tesis' ? 'active' : ''}}">
            <a href="{{url('pengajuan')}}" class="nav-link ">
                <span class="title">Data Pengajuan Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='daftar-sidang-tesis' ? 'active' : ''}}">
            <a href="{{url('daftar-sidang')}}" class="nav-link ">
                <span class="title">Data Pengajuan Sidang</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='jadwal-sidang-tesis' ? 'active' : ''}}">
            <a href="{{url('jadwal-sidang')}}" class="nav-link ">
                <span class="title">Jadwal Sidang</span>
            </a>
        </li>
        
    </ul>
</li>
@endif
@if (strpos($mhs->programstudi->nama_program_studi,'S3')!==false)
<li class="nav-item {{strpos(Request::url(),'pengajuan-disertasi')!==false || strpos(Request::url(),'jadwal-sidang-disertasi')!==false || strpos(Request::url(),'daftar-sidang-tesis')!==false  ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-th-large font-white"></i>
        <span class="title">Pengajuan Disertasi</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='pengajuan-disertasi' ? 'active' : ''}}">
            <a href="{{url('pengajuan')}}" class="nav-link ">
                <span class="title">Data Pengajuan Bimbingan</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='daftar-sidang-disertasi' ? 'active' : ''}}">
            <a href="{{url('daftar-sidang')}}" class="nav-link ">
                <span class="title">Data Pengajuan Sidang</span>
            </a>
        </li>
        <li class="nav-item  {{Request::path()=='jadwal-sidang-disertasi' ? 'active' : ''}}">
            <a href="{{url('jadwal-sidang')}}" class="nav-link ">
                <span class="title">Jadwal Sidang</span>
            </a>
        </li>
        
    </ul>
</li>
@endif
<li class="nav-item {{strpos(Request::url(),'data-kp')!==false   ? 'active' : ''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ul font-white"></i>
        <span class="title">Kerja Praktek</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  {{Request::path()=='data-kp' ? 'active' : ''}}">
            <a href="{{url('data-kp')}}" class="nav-link ">
                <span class="title">Pengajuan Kerja Praktek</span>
            </a>
        </li>
        {{-- <li class="nav-item  ">
            <a href="form_controls_md.html" class="nav-link ">
                <span class="title">Tambah KP Baru</span>
            </a>
        </li> --}}
        <li class="nav-item  ">
            <a href="form_validation.html" class="nav-link ">
                <span class="title">Jadwal Sidang Kerja Praktek</span>
            </a>
        </li>
    </ul>
</li>

{{-- <li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ul font-white"></i>
        <span class="title">Matakuliah Proyek</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="form_controls.html" class="nav-link ">
                <span class="title">Data Daftar Pengajuan</span>
            </a>
        </li>
         <li class="nav-item  ">
            <a href="form_controls_md.html" class="nav-link ">
                <span class="title">Tambah Pengajuan Baru</span>
            </a>
        </li> 
        <li class="nav-item  ">
            <a href="form_validation.html" class="nav-link ">
                <span class="title">Jadwal Matakuliah Proyek</span>
            </a>
        </li>
    </ul>
</li> --}}
    
@endif
</ul>