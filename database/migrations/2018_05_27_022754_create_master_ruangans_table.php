<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ruangan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_ruangan')->nullable();
            $table->string('nama_ruangan')->nullable();
            $table->string('deskripsi')->nullable();
            $table->integer('departemen_id')->default(0);
            $table->string('lokasi')->nullable();
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
        Schema::dropIfExists('master_ruangan');
    }
}
