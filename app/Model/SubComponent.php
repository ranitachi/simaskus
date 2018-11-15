<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubComponent extends Model
{
    use SoftDeletes;
    protected $table='sub_component';
    protected $fillable=['code_sub_component','nama_sub_component','category_sub_component','bobot_sub_component','nilai_min','nilai_max','huruf_mutu','component_id','created_at','updated_at'];

    function komponen()
    {
        return $this->belongsTo('App\Model\Component','component_id');
    }
}
