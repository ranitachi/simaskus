<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDepartemensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_departemen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('nama_departemen')->nullable();
            $table->integer('pimpinan_id')->default(0);
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('master_departemen');
    }
}
