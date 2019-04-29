@extends('layouts.master')
@section('title')
    <title>Beranda :: SIMA-sp</title>
    <link href="{{asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('konten')
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
    <h1 class="page-title"> Sistem Informasi Mata Kuliah Spesial</h1>
    <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            @php
                                                $staf=\App\Model\Staf::where('id',Auth::user()->id_user)->first();
                                                $dept_id=$staf->departemen_id;
                                                $mhs=\App\Model\Mahasiswa::where('departemen_id',$dept_id)->with('programstudi')->get();
                                                // dd($mhs);
                                                $mahasiswa=array();
                                                foreach($mhs as $k => $v)
                                                {
                                                    $mahasiswa[$v->id]=$v;
                                                }
                                            @endphp
                                            <span data-counter="counterup" data-value="{{$mhs->count()}}">{{$mhs->count()}} Orang</span>
                                        </div>
                                        <div class="desc"> Jumlah Mahasiswa Aktif </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                    <div class="number">
                                         @php
                                                $dosen=\App\Model\Dosen::where('departemen_id',$dept_id)->get();
                                                $dos=array();
                                                foreach($dosen as $k => $v)
                                                {
                                                    $dos[$v->id]=$v;
                                                }
                                                // dd($mhs);
                                        @endphp
                                        <span data-counter="counterup" data-value="{{$dosen->count()}}">{{$dosen->count()}} Orang</span></div>
                                    <div class="desc"> Jumlah Dosen </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            @php
                                                $prodi=\App\Model\ProgamStudi::where('departemen_id',$dept_id)->get();
                                            @endphp
                                            <span data-counter="counterup" data-value="{{$prodi->count()}}">{{$prodi->count()}}</span>
                                        </div>
                                        <div class="desc"> Jumlah Program Studi </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                    <div class="visual">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number"> 
                                        @php
                                            $jadwal=\App\Model\Jadwal::join('pivot_jadwal','jadwals.id','=','pivot_jadwal.jadwal_id')
                                                ->where('jadwals.departemen_id',$dept_id)
                                                ->where('pivot_jadwal.status',0)
                                                ->where('pivot_jadwal.ruangan_id','!=',0)
                                                ->orderBy('jadwals.tanggal')
                                                ->with('ruangan')
                                                ->get();
                                            
                                            echo $jadwal->count();
                                        @endphp     

                                        </div>
                                        <div class="desc">Jadwal Sidang Bulan {{date('F')}}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-hide hide"></i>
                        <span class="caption-subject font-hide bold uppercase">Jadwal Sidang Terdekat</span>
                    </div>
                    <div class="actions">
                        <div class="portlet-input input-inline">
                            <div class="input-icon right">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body" id="">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal & Waktu<br>Sidang</th>
                                <th>Mahasiswa</th>
                                <th>Pembimbing</th>
                                <th>Penguji</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $pengajuan=\App\Model\Pengajuan::all();
                                $peng=array();
                                foreach($pengajuan as $k =>$v)
                                {
                                    $peng[$v->id][$v->mahasiswa_id]=$v;
                                }
                                $pemb=\App\Model\PivotBimbingan::all();
                                $pmb=$pnj=array();
                                foreach ($pemb as $k => $v) {
                                    $pmb[$v->judul_id][$v->dosen_id]=$v;
                                }
                                $peng=\App\Model\PivotPenguji::all();
                                foreach ($peng as $k => $v) {
                                    $pnj[$v->pengajuan_id][$v->penguji_id]=$v;
                                }
                            @endphp
                            @foreach ($jadwal as $no=> $item)
                                {{-- @if ($item->tanggal>=date('Y-m-d')) --}}
                                    
                                
                                <tr>
                                    <td class="text-center">{{$no+1}}</td>
                                    <td class="text-center">
                                    Tanggal : {{tgl_indo($item->tanggal)}}    <br>
                                    Waktu : {{($item->waktu)}}    <br>
                                    </td>
                                    <td>
                                        NPM : {{$mahasiswa[$item->mahasiswa_id]->npm}}
                                        <br>
                                        {{$mahasiswa[$item->mahasiswa_id]->nama}}
                                        <br>
                                        {{$mahasiswa[$item->mahasiswa_id]->programstudi->nama_program_studi}}
                                    </td>
                                    <td>
                                        @foreach ($pmb[$item->judul_id] as $dsn_id => $itm)
                                            <div style="border-bottom:3px;border-bottom:1px solid #ccc;">{{$dos[$dsn_id]->nama}}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($pnj[$item->judul_id] as $penguji_id=> $itm)
                                            <div style="border-bottom:3px;border-bottom:1px solid #ccc;">{{$dos[$penguji_id]->nama}}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$item->ruangan->nama_ruangan}}
                                    </td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-hide hide"></i>
                        <span class="caption-subject font-hide bold uppercase">To Do List</span>
                    </div>
                    <div class="actions">
                        <div class="portlet-input input-inline">
                            <div class="input-icon right">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body" id="">
                    <div class="todo-tasklist">
                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                            <a href="{{url('kalender-akademik')}}">
                                <div class="todo-tasklist-item-title"> Input Kalender Akademik </div>
                                <div class="todo-tasklist-item-text"> Silahkan Input Jadwal Kalender Akademik </div>
                                <div class="todo-tasklist-controls pull-left">
                                    <span class="todo-tasklist-badge badge badge-roundless">Urgent</span>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script>
    
</script>
<style>
.table th,.table td
{
    font-size:11px !important;
}
.table th
{
    text-align:center !important;
    background: #eee !important;
    vertical-align:middle !important;
}
</style>
@endsection