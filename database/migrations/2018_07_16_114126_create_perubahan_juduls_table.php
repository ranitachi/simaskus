<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerubahanJudulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perubahan_judul', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengajuan_id')->nullable()->default(0);
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->string('judul_ind')->nullable();
            $table->string('judul_ing')->nullable();
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
        Schema::dropIfExists('perubahan_judul');
    }
}
