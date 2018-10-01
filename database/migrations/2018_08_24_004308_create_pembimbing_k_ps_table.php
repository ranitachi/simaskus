<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembimbingKPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbing_k_p', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosen_id')->nullable()->default(0);
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->integer('departemen_id')->nullable()->default(0);
            $table->integer('grup_id')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->string('kategori')->nullable();
            $table->string('nama')->nullable();
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
        Schema::dropIfExists('pembimbing_k_p');
    }
}
