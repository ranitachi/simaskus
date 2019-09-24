<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPublikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publikasi', function (Blueprint $table) {
            $table->text('deskripsi')->nullable();
            $table->integer('acc_dep')->nullable()->default(0);
            $table->integer('acc_mandik')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publikasi', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('acc_dep');
            $table->dropColumn('acc_mandik');
            
        });
    }
}
