<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBimbingan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tanggal_bimbingan')->nullable();
            $table->integer('bimbingan_ke')->nullable()->default(0);
            $table->string('judul')->nullable();
            $table->integer('dospem_id')->nullable()->default(0);
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->integer('flag')->nullable()->default(0);
            $table->string('deskripsi_bimbingan')->nullable();
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
        Schema::dropIfExists('bimbingan');
    }
}
