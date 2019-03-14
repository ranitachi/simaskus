<div class="row" style="padding:0px 20px;">
    <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            @if ($ketua==1)
                <div class="btn-group pull-right">
                    <a href="javascript:editkelompok({{$idgrup}})" id="edit-kelompok" class="btn sbold green"> Edit
                        <i class="fa fa-edit"></i>
                    </a>                
                </div>
            
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
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-3 control-label" for="form_control_1">Ketua Kelompok</label>
                <div class="col-md-9" style="padding-top:6px;">
                    
                    @foreach ($grupkp as $item)
                        
                        @if ($item->kategori=='ketua')
                            <i class="fa fa-user"></i>&nbsp;{{$item->mahasiswa->nama}}
                                <a href="javascript:hapusanggota({{$item->id}},'tab_1_1_5')" class="font-red-thunderbird">    
                                <i class="fa fa-trash"></i></a>
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
                                 <a href="javascript:hapusanggota({{$item->id}},'tab_1_1_5')" class="font-red-thunderbird">    
                                <i class="fa fa-trash"></i></a>
                           
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
                                <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                <div class="col-md-5">
                    <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $mhs)
                                <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                <label class="col-md-2 control-label" for="form_control_1">Anggota</label>
                <div class="col-md-5">
                    <select class="bs-select form-control has-success"  data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $mhs)
                            <option value="{{$mhs->mahasiswa_id}}">{{$mhs->mahasiswa->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
            </div>
        </div>
         <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
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