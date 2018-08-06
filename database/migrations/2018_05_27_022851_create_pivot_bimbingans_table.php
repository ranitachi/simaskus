<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotBimbingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_bimbingan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosen_id')->default(0);
            $table->integer('mahasiswa_id')->default(0);
            $table->string('jenis_bimbingan')->nullable();
            $table->integer('judul_id')->default(0);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pivot_bimbingan');
    }
}
