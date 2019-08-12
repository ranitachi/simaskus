<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pivot_penguji', function (Blueprint $table) {
            $table->integer('mahasiswa_id')->default(0)->nullable();
            $table->integer('pengajuan_id')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pivot_penguji', function (Blueprint $table) {
            // $table->drop('mahasiswa_id');
            // $table->drop('pengajuan_id');
        });
    }
}
