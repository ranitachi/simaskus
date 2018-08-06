<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use SoftDeletes;
    protected $table='component';
    protected $fillable=['code_component','nama_component','category_component','bobot_component','bobot_penguji','bobot_pembimbing_lapangan','module_id','created_at','updated_at'];

    function module()
    {
        return $this->belongsTo('App\Model\Module','module_id');
    }
}
