<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerbaikanSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_skripsi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jadwal_id')->nullable()->default(0);
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->integer('pembimbing_id')->nullable()->default(0);
            $table->text('perbaikan')->nullable();
            $table->date('batas_waktu')->nullable();
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
        Schema::dropIfExists('perbaikan_skripsi');
    }
}
