<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgamStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progam_studis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('nama_program_studi')->nullable();
            $table->integer('departemen_id')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('pimpinan_id')->default(0);
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
        Schema::dropIfExists('progam_studis');
    }
}
