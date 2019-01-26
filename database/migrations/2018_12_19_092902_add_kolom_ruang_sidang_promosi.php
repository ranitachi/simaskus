<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKolomRuangSidangPromosi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_ruangan', function (Blueprint $table) {
            $table->integer('ruang_sidang_promosi')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_ruangan', function (Blueprint $table) {
            $table->dropColumn('ruang_sidang_promosi');
        });
    }
}
