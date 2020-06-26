<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * status :
     * 0 - pengajuan
     * 1 - disetujui
     * 
     */
    public function up()
    {
        Schema::create('hasil_sidang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id')->nullable()->default(0);
            $table->integer('jenis_id')->nullable()->default(0);
            $table->integer('jadwal_id')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->integer('acc_dep')->nullable()->default(0);
            $table->integer('acc_mandik')->nullable()->default(0);
            $table->double('nilai')->nullable()->default(0);
            $table->string('huruf_mutu')->nullable();
            $table->text('catatan')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('hasil_sidang');
    }
}
