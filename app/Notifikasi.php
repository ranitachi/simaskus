<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletese;

class Notifikasi extends Model
{
    use SoftDeletese;
    protected $table ='notifikasi';
    protected $fillable = ['title','from','to','seen','flag_active','pesan','created_at','updated_at','deleted_at'];
}
