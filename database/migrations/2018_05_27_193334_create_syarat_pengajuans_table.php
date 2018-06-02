<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyaratPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syarat_pengajuans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('syarat')->nullable();
            $table->integer('pengajuan_id')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('flag')->default(0);
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
        Schema::dropIfExists('syarat_pengajuans');
    }
}
