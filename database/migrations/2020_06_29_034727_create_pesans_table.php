<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idform')->nullable()->default(0);
            $table->integer('id_user_dari')->nullable()->default(0);
            $table->integer('id_user_untuk')->nullable()->default(0);
            $table->integer('status_baca')->nullable()->default(0);
            $table->integer('status_pesan')->nullable()->default(0); //0.draft, 1.kirim
            $table->string('dari')->nullable();
            $table->string('untuk')->nullable();
            $table->string('judul')->nullable();
            $table->text('pesan')->nullable();
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
        Schema::dropIfExists('pesans');
    }
}
