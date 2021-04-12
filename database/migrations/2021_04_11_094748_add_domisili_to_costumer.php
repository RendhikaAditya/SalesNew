<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDomisiliToCostumer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('costumer', function (Blueprint $table) {
            $table->integer('id_provinsi')->after('reset');
            $table->integer('id_kota')->after('id_provinsi');
            $table->integer('id_kecamatan')->after('id_kota');
            $table->integer('id_kelurahan')->after('id_kecamatan');

            // $table->foreign('id_provinsi')->references('id')->on('tbl_provinsi');z
            // $table->foreign('id_kota')->references('id')->on('tbl_kabkot');
            // $table->foreign('id_kecamatan')->references('id')->on('tbl_kecamatan');
            // $table->foreign('id_kelurahan')->references('id')->on('tbl_kelurahan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('costumer', function (Blueprint $table) {
            //
        });
    }
}
