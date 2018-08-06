<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPimpinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pimpinan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosen_id')->default(0);
            $table->integer('departemen_id')->default(0);
            $table->string('jabatan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('master_pimpinan');
    }
}
