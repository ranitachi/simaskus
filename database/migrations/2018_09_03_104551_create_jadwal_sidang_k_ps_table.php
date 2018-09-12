<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalSidangKPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_sidang_k_p', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_grup')->nullable();
            $table->string('nama')->nullable();
            $table->integer('ruangan_id')->default(0);
            $table->integer('departemen_id')->default(0);
            $table->string('tanggal')->nullable();
            $table->time('waktu')->nullable();
            $table->string('hari')->nullable();
            $table->string('jenis_jadwal')->nullable();
            $table->string('staf_id')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_sidang_k_p');
    }
}
