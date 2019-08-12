<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopikPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topik_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengajuan_id')->nullable()->default(0);
            $table->integer('dosen_id')->nullable()->default(0);
            $table->string('topik')->nullable();
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
        Schema::dropIfExists('topik_pengajuan');
    }
}
