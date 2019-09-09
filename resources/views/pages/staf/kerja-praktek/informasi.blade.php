<div class="row" style="padding:0px 20px;">
    <div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
                <a href="javascript:edit({{$idgrup}})" id="edit" class="btn sbold green"> Edit
                    <i class="fa fa-edit"></i>
                </a>                
            </div>
        
            <div class="btn-group pull-right">
                <a href="javascript:simpaninfo({{$idgrup}})" id="save" class="btn sbold blue" style="display:none"> Simpan
                    <i class="fa fa-save"></i>
                </a>                
            </div>
        </div>
    
</div>
<div id="data-info">    
    <form role="form" class="form-horizontal">
        <div class="form-body">
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Anggota Kelompok</label>
                <div class="col-md-8" style="padding-top:6px;">
                    <ul style="margin:0px;padding:0px 0px 0px 20px;">
                    @foreach ($grupkp as $item)
                        @if (isset($item->mahasiswa->nama))
                            <li>{{$item->mahasiswa->nama}}</li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Judul Kerja Praktek</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['judul-kerja-praktek']) ? $info['judul-kerja-praktek']->isi : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Instansi/Perusahaan</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['instansiperusahaan']) ? $info['instansiperusahaan']->isi : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Alamat Perusahaan</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['alamat-perusahaan']) ? $info['alamat-perusahaan']->isi : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Pimpinan Perusahaan / Penanggung Jawab</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['pimpinan-perusahaan-penanggung-jawab']) ? $info['pimpinan-perusahaan-penanggung-jawab']->isi : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Dept./Divisi/Seksi</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['deptdivisiseksi']) ? $info['deptdivisiseksi']->isi : '-'}}
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Periode</label>
                <div class="col-md-8" style="padding-top:6px;">
                    <span class="font-blue"><i class="fa fa-calendar"></i>&nbsp;{!!isset($info['periode-awal']) ? $info['periode-awal']->isi.'</span> s.d.' : '-'!!} 
                   <span class="font-blue"><i class="fa fa-calendar"></i>&nbsp; {{isset($info['periode-selesai']) ? $info['periode-selesai']->isi : ''}}</span>
                </div>
            </div>
            <div class="form-padding form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Deksripsi</label>
                <div class="col-md-8" style="padding-top:6px;">
                    {{isset($info['deskripsi']) ? $info['deskripsi']->isi : '-'}}
                </div>
            </div>
        </div>
    
        @foreach ($info as $index=>$item)
            @if ($item->status=='tambahan')
                <div class="form-padding form-group form-md-line-input has-success">
                    <label class="col-md-4 control-label" for="form_control_1">{{$item->judul}}</label>
                    <div class="col-md-8" style="padding-top:6px;">
                        {{$item->isi}}
                    </div>
                </div>
            @endif
        @endforeach
            
    </form>
</div>
<div id="form-info" style="display:none">
 
    <form role="form" class="form-horizontal" action="{{url('informasi-kp-proses/'.$idgrup.'/-1')}}" method="post" id="informasi-simpan">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
        <input type="hidden" name="kat_user" value="{{$kat_user}}">
        <input type="hidden" name="url" value="tab_1_1_2">
        <input type="hidden" name="dept_id" value="{{$dept_id}}">
        <div class="form-body">
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Anggota Kelompok</label>
                <div class="col-md-8" style="padding-top:6px;">
                    <ul style="margin:0px;padding:0px 0px 0px 20px;">
                    @foreach ($grupkp as $item)
                        @if (isset($item->mahasiswa->nama))
                            <li>{{$item->mahasiswa->nama}}</li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Judul Kerja Praktek</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Judul Kerja Praktek">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Judul Kerja Praktek" value="{{isset($info['judul-kerja-praktek']) ? $info['judul-kerja-praktek']->isi : ''}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Instansi/Perusahaan</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Instansi/Perusahaan">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Instansi/Perusahaan" value="{{isset($info['instansiperusahaan']) ? $info['instansiperusahaan']->isi : '-'}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Alamat Perusahaan</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Alamat Perusahaan">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Alamat Perusahaan" value="{{isset($info['alamat-perusahaan']) ? $info['alamat-perusahaan']->isi : '-'}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Pimpinan Perusahaan / Penanggung Jawab</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Pimpinan Perusahaan / Penanggung Jawab">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Pimpinan Perusahaan / Penanggung Jawab" value="{{isset($info['pimpinan-perusahaan-penanggung-jawab']) ? $info['pimpinan-perusahaan-penanggung-jawab']->isi : '-'}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Dept./Divisi/Seksi</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Dept./Divisi/Seksi">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Dept./Divisi/Seksi" value="{{isset($info['deptdivisiseksi']) ? $info['deptdivisiseksi']->isi : '-'}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Periode</label>
                <div class="col-md-3">
                    <input type="hidden" name="title_tambahan[]" value="utama__Periode Awal">
                
                    <div class="input-group input-medium date date-picker" data-date="{{date('d-m-Y')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="isi_tambahan[]" id="date_awal"  class="form-control" placeholder="dd-mm-yyyy" value="{{isset($info['periode-awal']) ? $info['periode-awal']->isi : date('d-m-Y')}}">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                
                <div class="col-md-1 text-center">s.d.</div>
                <div class="col-md-3">
                    <input type="hidden" name="title_tambahan[]" value="utama__Periode Selesai">
                    <div class="input-group input-medium date date-picker" data-date="{{date('d-m-Y')}}" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" name="isi_tambahan[]" id="date_selesai"  class="form-control" placeholder="dd-mm-yyyy" value="{{isset($info['periode-selesai']) ? $info['periode-selesai']->isi : date('d-m-Y')}}">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                
            </div>
            <div class="form-group form-md-line-input has-success">
                <label class="col-md-4 control-label" for="form_control_1">Deksripsi</label>
                <div class="col-md-8">
                    <input type="hidden" name="title_tambahan[]" value="utama__Deskripsi">
                    <input type="text" class="form-control" name="isi_tambahan[]" id="form_control_1" placeholder="Deskripsi" value="{{isset($info['deskripsi']) ? $info['deskripsi']->isi : '-'}}">
                </div>
            </div>
            <div class="form-group form-md-line-input has-success" >
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                @foreach ($info as $index=>$item)
                    @if ($item->status=='tambahan')
                       <label class="col-md-4 control-label" for="form_control_1">Judul Informasi</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="form_control_1" name="title_tambahan[]" placeholder="Judul" value="{{$item->judul}}">
                        </div>
                        <div class="col-md-1">&nbsp;</div>
                        <label class="col-md-4 control-label" for="form_control_1">Isi Informasi</label>
                        <div class="col-md-7">
                            <textarea class="form-control" id="form_control_1" name="isi_tambahan[]" placeholder="Isi">{{$item->isi}}</textarea>
                        </div>
                        <div class="col-md-1">&nbsp;</div>
                        <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
                    @endif
                @endforeach

                <label class="col-md-4 control-label" for="form_control_1">Judul Informasi</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="form_control_1" name="title_tambahan[]" placeholder="Judul">
                </div>
                <div class="col-md-1">&nbsp;</div>
                <label class="col-md-4 control-label" for="form_control_1">Isi Informasi</label>
                <div class="col-md-7">
                    <textarea class="form-control" id="form_control_1" name="isi_tambahan[]" placeholder="Isi"></textarea>
                </div>
                <div class="col-md-1">&nbsp;</div>
                <hr class="col-md-12" style="border-bottom:1px solid #ddd;">
            </div>
            <div id="title_wrap"></div>
            
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-10">
                    <button type="button" class="btn blue" id="tambah-field" onclick="addfields()"><i class="fa fa-plus-circle"></i> Tambah Form</button>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <a href="javascript:simpaninfo({{$idgrup}})" class="btn blue pull-right" id="tambah-field">Simpan&nbsp;<i class="fa fa-save"></i> </a>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function edit(idgrup)
    {
        $('#edit').css('display','none');
        $('#save').css('display','inline');
        $('#data-info').hide();
        $('#form-info').css('display','inline');
    }
    
</script>
<style>
.form-padding
{
    padding-top:0px !important;
}
</style>