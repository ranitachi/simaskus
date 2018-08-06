<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotDocumentSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_document_sidang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file')->nullable();
            $table->string('type')->nullable();
            $table->integer('pengajuan_id')->default(0);
            $table->integer('mahasiswa_id')->default(0);
            $table->integer('jadwal_id')->default(0);
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
        Schema::dropIfExists('pivot_document_sidang');
    }
}
