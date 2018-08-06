<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_component', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_sub_component')->nullable();
            $table->string('nama_sub_component')->nullable();
            $table->string('category_sub_component')->nullable();
            $table->integer('bobot_sub_component')->nullable()->default(0);
            $table->integer('component_id')->nullable()->default(0);
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
        Schema::dropIfExists('sub_component');
    }
}
