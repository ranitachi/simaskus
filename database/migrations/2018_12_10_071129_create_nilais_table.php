<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('penilai')->nullable();
            $table->integer('jadwal_id')->nullable()->default(0);
            $table->integer('pengajuan_id')->nullable()->default(0);
            $table->integer('nilai_angka')->nullable()->default(0);
            $table->float('persen')->nullable()->default(0);
            $table->integer('subtotal')->nullable()->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->char('huruf')->nullable();
            $table->integer('komponen_id')->nullable()->default(0);
            $table->integer('dosen_id')->nullable()->default(0);
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
        Schema::dropIfExists('nilai');
    }
}
