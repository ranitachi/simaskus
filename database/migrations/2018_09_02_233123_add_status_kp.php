<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusKp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kerja_praktek', function (Blueprint $table) {
            $table->integer('status_kp')->default(0)->nullable();
            $table->string('balasan_surat')->default("")->nullable();
            $table->string('surat_pernyataan_selesai')->default("")->nullable();
            $table->date('publish_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kerja_praktek', function (Blueprint $table) {
            //
        });
    }
}
