<form action="#" class="horizontal-form" id="form-departemen" method="POST">
    {{ csrf_field() }}
    @if ($id!=-1)
        {{ method_field('PATCH') }}
    @endif
    <div class="form-body">
       
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
               <div class="form-group has-success">
                    <label class="control-label">Anggota Kelompok</label>
                    <select class="bs-select form-control has-success" multiple="multiple" data-placeholder="Pilih Anggota Kelompok" id="anggota_1" name="anggota[]">
                        <option value="-1">- Pilih -</option>
                        @foreach ($anggota as $item)
                        @if (isset($item->mahasiswa->nama))
                                @if (Auth::user()->id_user!=$item->mahasiswa_id)
                                    <option value="{{$item->mahasiswa_id}}">{{$item->mahasiswa->nama}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
</form>
<script>
    $('.bs-select').select2({'width':'100%'});
</script>
<style>
    #anggota_1_chosen,.select2-selection
    {
        width:100% !important;
    }
</style>