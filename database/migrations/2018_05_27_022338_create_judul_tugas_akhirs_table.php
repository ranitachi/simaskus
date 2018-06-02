<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJudulTugasAkhirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judul_tugas_akhir', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('judul')->nullable();
            $table->string('jenis')->nullable();
            $table->integer('dosen_id')->default(0);
            $table->integer('departemen_id')->integer(0);
            $table->string('kategori')->nullable();
            $table->integer('staf_id')->integer(0);
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
        Schema::dropIfExists('judul_tugas_akhir');
    }
}
