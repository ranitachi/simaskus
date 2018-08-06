<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class IzinDosen extends Model
{
    use SoftDeletes;
    protected $table='izin_dosen';
}
