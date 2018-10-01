<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidangKekhususansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_kekhususan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_bidang')->nullable();
            $table->integer('prodi_id')->default(0)->nullable();
            $table->integer('flag')->default(0)->nullable();
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
        Schema::dropIfExists('bidang_kekhususan');
    }
}
