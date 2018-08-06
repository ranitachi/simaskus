<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotSetujuSidangsTable extends Migration
{
    public function up()
    {
        Schema::create('pivot_setuju_sidang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosen_id')->default(0);
            $table->integer('mahasiswa_id')->default(0);
            $table->string('jenis_bimbingan')->nullable();
            $table->integer('pengajuan_id')->default(0);
            $table->string('status')->defaul(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pivot_setuju_sidang');
    }
}
