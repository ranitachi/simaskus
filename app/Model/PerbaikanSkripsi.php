<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerbaikanSkripsi extends Model
{
    use SoftDeletes;
    protected $table='perbaikan_skripsi';
}
