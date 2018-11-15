<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformasiKPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_k_p', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul')->nullable();
            $table->string('isi')->nullable();
            $table->string('status')->nullable();
            $table->integer('departemen_id')->nullable()->default(0);
            $table->integer('grup_id')->nullable()->default(0);
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
        Schema::dropIfExists('informasi_k_p');
    }
}
