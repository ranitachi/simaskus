<div class="row" style="padding:0px 20px;">
    <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            @if ($ketua==1)
                @if ($det->status_kp!=10)
                    <div class="btn-group pull-right">
                        <a href="javascript:editkelompok({{$idgrup}})" id="edit-kelompok" class="btn sbold green"> Edit
                            <i class="fa fa-edit"></i>
                        </a>                
                    </div>
                @endif
                <div class="btn-group pull-right">
                    <a href="javascript:simpankelompok({{$idgrup}})" id="save-kelompok" class="btn sbold blue" style="display:none"> Simpan
                        <i class="fa fa-save"></i>
                    </a>                
                </div>
            @endif
        </div>  
</div>
<div id="data-kelompok">    
    <form role="form" class="form-horizontal">
        <div class="form-body">
            @if (isset($grupkp[0]->nama_kelompok))
                @if (strpos($grupkp[0]->nama_kelompok,'no-grup')!==true)                
                    <div class="form-padding form-group form-md-line-input has-success">
                        <label class="col-md-3 control-label" for="form_control_1">Nama Grup</label>
                        <div class="col-md-9" style="padding-top:6px;">
                        
                            {{$grupkp[0]->nama_kelompok}}
                        
                        </div>
                    </div>
                @endif
            @else
                Belum Menentukan Grup. - <a data-style="default" data-container="body" data-original-title="Klik Jika Tidak Memiliki Grup" title="Klik Untuk Menambah Grup" href="{{url('data-kp-grup/'.$det->id.'/'.$det->mahasiswa_id.'/-1')}}" class="btn btn-info btn-xs tooltips"><i class="fa fa-plus-circle"></i> Tambah Grup</a> -
                <a data-style="default" data-container="body" data-original-title="Klik Jika Tidak Memiliki Grup" title="Klik Jika Tidak Memiliki Grup" href="{{url('no-grup/'.$det->id.'/'.$det->mahasiswa_id.'/-1')}}" class="btn btn-primary btn-xs tooltips"><i class="fa fa-hand-pointer-o"></i> Klik Jika Tidak Ada Grup</a>
            @endif
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-3 control-label" for="form_control_1">Ketua Kelompok</label>
                <div class="col-md-9" style="padding-top:6px;">
                   
                    @foreach ($grupkp as $item)
                        @if ($item->kategori=='ketua')
                            <i class="fa fa-user"></i>&nbsp;{{$item->mahasiswa->nama}}
                        @endif
                    @endforeach
                   
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-3 control-label" for="form_control_1">Anggota Kelompok</label>
                <div class="col-md-9" style="padding-top:6px;">
                    
                    @foreach ($grupkp as $item)
                        @if ($item->kategori=='anggota')
                            <i class="fa fa-user"></i>&nbsp;{{$item->mahasiswa->nama}}
                            @if ($ketua==1)
                                 <a href="javascript:hapusanggota({{$item->id}},'tab_1_1_5')" class="font-red-thunderbird">    
                                <i class="fa fa-trash"></i></a>
                            @endif    
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </form>
</div>
<div id="form-kelompok" style="display:none">    
    <form role="form" class="form-horizontal" action="{{url('anggota-kelompok-proses/'.$idgrup.'/-1')}}" method="post" id="kelompok-simpan">
        <div class="form-body">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="kat_user" value="{{$kat_user}}">
            <input type="hidden" name="url" value="tab_1_1_5">
            <input type="hidden" name="dept_id" value="{{$dept_id}}">
            <div class="form-group form-md-line-input has-success" id="title_1">
                @if (isset($grupkp[0]->nama_kelompok))
                  @if (strpos($grupkp[0]->nama_kelompok,'no-grup')!==true)
                        <label class="col-md-2 control-label" for="form_control_1">Nama Grup</label>
                        <div class="col-md-5">
                            <input type="text" id="nama_grup" name="nama_grup" class="form-control" value="{{$grupkp[0]->nama_kelompok}}" placeholder="Nama Grup (Wajib Diisi)" value="" required>
                        </div>
                        <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                  @endif
                @else
                    
                @endif
                @foreach ($grupkp as $index=>$item)
                    @if ($item->kategori=='ketua')
                       <label class="col-md-2 control-label" for="form_control_1">Ketua</label>
                        <div class="col-md-5">
                            <select class="bs-select form-control has-success"  data-placeholder="Pilih Ketua Kelompok" id="anggota_1" name="ketua">
                                <option value="-1">- Pilih -</option>
                                @foreach ($anggota as $mhs)
                                    @if ($item->mahasiswa_id==$mhs->mahasiswa_id)
                                        <option value="{{$mhs->mahasiswa_id}}" selected>{{$mhs->mahasiswa->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                    @elseif ($item->kategori=='anggota')
                       <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                        <div class="col-md-5">
                            <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                                <option value="-1">- Pilih -</option>
                                @foreach ($anggota as $mhs)
                                    @if ($item->mahasiswa_id==$mhs->mahasiswa_id)
                                        <option value="{{$mhs->mahasiswa_id}}" selected>{{$mhs->mahasiswa->nama}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                    @endif
                @endforeach
                <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                <div class="col-md-5">
                    <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $mhs)
                            @if (isset($mhs->mahasiswa->nama))
                                <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                <div class="col-md-5">
                    <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $mhs)
                            @if (isset($mhs->mahasiswa->nama))
                                <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                <div class="col-md-5">
                    <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $mhs)
                            @if (isset($mhs->mahasiswa->nama))
                                <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 <div class="form-actions">
                    <a href="javascript:simpankelompok({{$idgrup}})" class="btn blue pull-right" id="tambah-field" style="margin-right:20px;">Simpan&nbsp;<i class="fa fa-save"></i> </a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
   
    function editkelompok(idgrup)
    {
        $('#edit-kelompok').css('display','none');
        $('#save-kelompok').css('display','inline');
        $('#data-kelompok').hide();
        $('#form-kelompok').css('display','inline');
    }
</script>
<style>
.form-padding
{
    padding-top:0px !important;
}
</style>