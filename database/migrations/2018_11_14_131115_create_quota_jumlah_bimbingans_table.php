<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotaJumlahBimbingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quota_jumlah_bimbingan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departemen_id')->nullable()->default(0);
            $table->string('level')->nullable();
            $table->integer('minimal')->nullable()->default(0);
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
        Schema::dropIfExists('quota_jumlah_bimbingan');
    }
}
