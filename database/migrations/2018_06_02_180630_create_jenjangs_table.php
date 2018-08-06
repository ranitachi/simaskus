<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenjang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenjang')->nullable();
            $table->string('desc')->nullable();
            $table->integer('flag_active')->default(0);
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
        Schema::dropIfExists('jenjang');
    }
}
