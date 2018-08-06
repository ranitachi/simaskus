<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TahunAjaran extends Model
{
    use SoftDeletes;
    protected $table='tahun_ajaran';
}
