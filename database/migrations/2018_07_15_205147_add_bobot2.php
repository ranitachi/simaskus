<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBobot2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_component', function (Blueprint $table) {
            #$table->integer('nilai_min')->default(0)->nullable();
            #$table->integer('nilai_max')->default(0)->nullable();
            #$table->char('huruf_mutu')->nullable();
            #$table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_component', function (Blueprint $table) {
            //
        });
    }
}
