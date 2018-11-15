<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluasiACCSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_a_c_c_sidang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengajuan_id')->nullable()->default(0);
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->integer('dept_id')->nullable()->default(0);
            $table->integer('dosen_id')->nullable()->default(0);
            $table->integer('component_id')->nullable()->default(0);
            $table->string('nilai')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('evaluasi_a_c_c_sidang');
    }
}
