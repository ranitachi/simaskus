<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_id')->default(0);
            $table->float('ipk_terakhir')->nullable()->default(0);
            $table->integer('jumlah_sks_lulus')->nullable()->default(0);
            $table->text('topik_diajukan')->nullable();
            $table->text('bidang')->nullable();
            $table->string('skema')->nullable();
            $table->text('judul_ind')->nullable();
            $table->text('judul_eng')->nullable();
            $table->text('deskripsi_rencana')->nullable();
            $table->text('abstrak_ind')->nullable();
            $table->text('abstrak_eng')->nullable();
            $table->integer('pengambilan_ke')->default(0);
            $table->integer('mahasiswa_id')->default(0);
            $table->integer('dospem1')->default(0);
            $table->integer('dospem2')->default(0);
            $table->integer('dospem3')->default(0);
            $table->integer('dosen_ketua')->default(0);
            $table->integer('pembimbing_sebelumnya')->default(0);
            $table->text('alasan_mengulang')->nullable();
            $table->integer('status_pengajuan')->default(0);
            $table->integer('departemen_id')->default(0);
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
        Schema::dropIfExists('pengajuan');
    }
}
