<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_skripsi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_pengajuan')->nullable();
            $table->integer('mahasiswa_id')->default(0);
            $table->string('pembimbing_id')->default(0);
            $table->integer('judul_id')->default(0);
            $table->string('judul')->nullable();
            $table->integer('status')->default(0);
            $table->integer('jenis_id')->default(0);
            $table->datetime('disetujui')->nullable();
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
        Schema::dropIfExists('pengajuan_skripsi');
    }
}
