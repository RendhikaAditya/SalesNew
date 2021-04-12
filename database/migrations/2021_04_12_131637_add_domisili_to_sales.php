<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDomisiliToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('id_provinsi')->after('password');
            $table->integer('id_kota')->after('id_provinsi');
            $table->integer('id_kecamatan')->after('id_kota');
            $table->integer('id_kelurahan')->after('id_kecamatan');
        });
    }
}
