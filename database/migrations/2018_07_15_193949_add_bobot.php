<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBobot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component', function (Blueprint $table) {
            $table->integer('bobot_penguji')->nullable()->default(0);
            $table->integer('bobot_pembimbing_lapangan')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component', function (Blueprint $table) {
            //
        });
    }
}
