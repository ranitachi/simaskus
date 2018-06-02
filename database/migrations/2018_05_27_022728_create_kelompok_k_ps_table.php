<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokKPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_k_ps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('nama_kelompok')->nullable();
            $table->string('lokasi_kp')->nullable();
            $table->integer('pembimbing_id')->default(0);
            $table->integer('departemen_id')->default(0);
            $table->string('kategori')->nullable();
            $table->integer('mahasiswa_id')->default(0);
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
        Schema::dropIfExists('kelompok_k_ps');
    }
}
