<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengujiKPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguji_k_p', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pivot_jadwal_id')->default(0)->nullable();
            $table->integer('grup_id')->default(0)->nullable();
            $table->integer('penguji_id')->default(0)->nullable();
            $table->integer('departemen_id')->default(0)->nullable();
            $table->integer('status')->default(0)->nullable();
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
        Schema::dropIfExists('penguji_k_p');
    }
}
