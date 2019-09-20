<div class="row" style="padding:0px 20px;">
    <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
           @if (count($jadwal)!=0)
            <div class="btn-group pull-right">
                <a href="javascript:editsidang({{$idgrup}})" id="edit-sidang" class="btn sbold green"> Edit
                        <i class="fa fa-edit"></i>
                    </a>                
                </div>
                
                <div class="btn-group pull-right">
                    <a href="javascript:simpansidang({{$idgrup}})" id="save-sidang" class="btn sbold blue" style="display:none"> Simpan
                            <i class="fa fa-save"></i>
                        </a>                
                </div>
            @else
                <div class="btn-group pull-right">
                    <a href="javascript:simpansidang({{$idgrup}})" id="save-sidang" class="btn sbold blue" style=""> Simpan
                            <i class="fa fa-save"></i>
                        </a>                
                </div>
            @endif
        </div>
    
</div>
@php
    // dd($jadwal);
@endphp
<div id="data-sidang" style="{{(count($jadwal)==0 ? 'display:none !important' : 'display:inline')}}">    
    <form role="form" class="form-horizontal">
        <div class="form-body">
            <div class="form-padding form-group form-md-line-input has-success">
                <div class="col-md-12" style="padding-top:6px;">
                    <h4>Jadwal Sidang Kerja Praktek</h4>
                </div>
            </div>
            
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Tanggal <i class="fa fa-calendar"></i></label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{count($jadwal)!=0 ? tgl_indo($jadwal[$idgrup][0]->tanggal) : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Waktu <i class="fa fa-clock-o"></i>
                </label>
                <div class="col-md-8" style="padding-top:6px;">
                    @if (count($jadwal)==0)
                        -
                    @else
                        {{$jadwal[$idgrup][0]->waktu}} WIB
                    @endif
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Ruangan <i class="fa fa-home"></i></label>
                <div class="col-md-8" style="padding-top:6px;">
                    @if (count($jadwal)==0)
                        -
                    @else
                        {{$ruangan[$jadwal[$idgrup][0]->ruangan_id]->nama_ruangan}}
                    @endif
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Penguji <i class="fa fa-users"></i></label>
                <div class="col-md-8" style="padding-top:6px;">
                    <ul style="padding-left:8px !important;margin-left:8px !important;">
                        
                        @php
                            
                            $x=0;
                        @endphp
                        @foreach ($penguji_kp as $item)
                            <li>{{$item->dosen->nama}}</li>
                            @php
                                $dos_uji[$item->dosen->id]=$item->dosen->id;
                                $x++;
                            @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Cetak Surat Undangan Sidang</label>
                <div class="col-md-8">
                     <a target="_blank" href="{{url('cetak-berkas/'.$idgrup.'/'.$kat_user.'/'.str_slug('Cetak Undangan Sidang'))}}"  class="btn btn-sm btn-primary btn-circle"><i class="fa fa-print"></i> Print</a>
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
        </div>
            
    </form>
</div>
@php
    // dd($dos_uji);
    // if(count($jadwal)==0)
    if(isset($jadwal[$idgrup]))
    {
        $d=$jadwal[$idgrup][0];
        $idjadwal=$d->jadwal_id.'__'.$idgrup;
    }
    else
        $idjadwal=-1;
@endphp
<div id="form-sidang" style="{{(count($jadwal)==0 ? 'display:inline' : 'display:none')}}">
 
    <form role="form" class="form-horizontal" action="{{url('jadwal-sidang-kp-simpan/one/'.$idjadwal.'/'.$id.'/submit')}}" method="post" id="sidang-simpan">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
        <input type="hidden" name="kat_user" value="{{$kat_user}}">
        <input type="hidden" name="url" value="tab_1_1_2">
        <input type="hidden" name="dept_id" value="{{$dept_id}}">
        <input type="hidden" name="idgrup" value="{{$idgrup}}">
        <div class="form-body">
            
         
            @php
                
                $tanggal=date('d-m-Y');
                $waktu=$ruangan_id=$statuspublish='';
                if(isset($jadwal[$idgrup]))
                {
                    $d=$jadwal[$idgrup][0];
                    $tanggal=date('d-m-Y',strtotime($d->tanggal));
                    $waktu=$d->waktu;
                    $ruangan_id=$d->ruangan_id;
                    $status_publish=$det->publish_date;
                }
            @endphp
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Tanggal</label>
                <div class="col-md-3">
                    <div class="input-group input-medium date date-picker" data-date="{{$tanggal}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="tanggal" id="date_awal"  class="form-control" placeholder="dd-mm-yyyy" value="{{$tanggal}}">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>    
            </div>
            <div class="form-group form-md-line-input has-success" id="title_1">
                    <label class="col-md-4 control-label" for="form_control_1">Waktu</label>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="waktu" id="waktu" placeholder="HH:MM" value="{{$waktu}}">
                    </div>
                </div>
            <div class="form-group form-md-line-input has-success" id="title_1">
                    
                    <label class="col-md-4 control-label" for="form_control_1">Ruangan </label>
                    <div class="col-md-5">
                        <select class="bs-select form-control has-success"  data-placeholder="Pilih Ruangan" id="anggota_1" name="ruangan">
                            <option value="-1">- Pilih -</option>
                            @foreach ($ruangan as $dsn)
                                @if ($ruangan_id==$dsn->id)
                                    <option value="{{$dsn->id}}" selected="selected">{{$dsn->nama_ruangan}}</option>
                                @else
                                    <option value="{{$dsn->id}}">{{$dsn->nama_ruangan}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div> 
            @php
                $dospem=array();
                if (isset($pemb['dosen']))  
                {
                    if(count($pemb['dosen'])!=0)
                    {
                        foreach ($pemb['dosen'] as $idx=>$item)
                        {
                            $dospem[$idx]=$idx;
                        }
                    }
                }
                $dos_uji=array();
            @endphp
            @for ($x=0;$x<3;$x++)
                <div class="form-group form-md-line-input has-success" id="title_1">
                
                    <label class="col-md-4 control-label" for="form_control_1">Penguji {{$x+1}} </label>
                    <div class="col-md-5">
                        <select class="bs-select form-control has-success"  data-placeholder="Pilih Penguji" id="anggota_1" name="penguji[]">
                            <option value="-1">- Pilih -</option>
                            @foreach ($dosen as $idx=>$dsn)
                                    @if (in_array($dsn->id,$dospem))
                                        <option value="{{$dsn->id}}" selected="selected">{{$dsn->nama}}</option>
                                        @php
                                            unset($dospem[$dsn->id]);
                                        @endphp
                                    @else
                                        <option value="{{$dsn->id}}">{{$dsn->nama}}</option>
                                    @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div> 
                
            @endfor
            <div class="form-group form-md-line-input has-success" id="title_1">
                    
                    <label class="col-md-4 control-label" for="form_control_1">Status Publish </label>
                    <div class="col-md-2">
                        <select class="bs-select form-control has-success"  data-placeholder="Status" id="anggota_1" name="publish">
                            <option value="-1">- Pilih -</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div> 
            <div id="title_wrap" style="padding-bottom:40px;">&nbsp;</div>
            
        </div>
       
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <a href="javascript:simpansidang({{$idgrup}})" class="btn blue pull-right" id="tambah-field" style="margin-right:25px;">Simpan&nbsp;<i class="fa fa-save"></i> </a>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function editsidang(idgrup)
    {
        $('#edit-sidang').css('display','none');
        $('#save-sidang').css('display','inline');
        $('#data-sidang').hide();
        $('#form-sidang').css('display','inline');
    }
    
</script>
<style>
.form-padding
{
    padding-top:0px !important;
}
</style>