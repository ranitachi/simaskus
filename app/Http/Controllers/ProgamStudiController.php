<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MasterDepartemen;
use App\Model\ProgamStudi;
class ProgamStudiController extends Controller
{
    public function by_dept($id_dept)
    {
        $get=ProgamStudi::where('departemen_id',$id_dept)->get();
        echo '<select class="bs-select form-control has-success" data-placeholder="Pilih Program Studi" name="program_studi" id="program_studi">
                <option value="-1">-Pilih Program Studi-</option>';
        foreach($get as $k => $v)
        {
            echo '<option value="'.$v->id.'">'.$v->nama_program_studi.'</option>';
        }       
        echo '</select>';
    }
}
