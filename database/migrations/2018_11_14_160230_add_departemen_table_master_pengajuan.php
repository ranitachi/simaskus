<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartemenTableMasterPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_jenis_pengajuan', function (Blueprint $table) {
            $table->integer('departemen_id')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_jenis_pengajuan', function (Blueprint $table) {
            $table->dropColumn('departemen_id');
        });
    }
}
