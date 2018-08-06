<div class="page-content">                        
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('beranda')}}">Beranda</a>
                <i class="fa fa-circle"></i>
            </li>
           
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Khusus
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="note note-info">
        @if (Auth::user()->kat_user==1)
            <p>Selamat Datang <b>{{Auth::user()->name}}</b> Di Halaman Sekretariat</p>
        @elseif(Auth::user()->kat_user==2)
            <p>Selamat Datang <b>{{Auth::user()->name}}</b> Di Halaman Dosen</p>
        @elseif(Auth::user()->kat_user==3)
            <p>Selamat Datang <b>{{Auth::user()->name}}</b> Di Halaman Mahasiswa</p>
        @elseif(Auth::user()->kat_user==0)
            <p>Selamat Datang <b>{{Auth::user()->name}}</b> Di Halaman Admin</p>
        @endif
    </div>
</div>