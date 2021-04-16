<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string("id_order");
            $table->string("nama_costumer");
            $table->string("nama_sales");
            $table->string("nama_barang");
            $table->integer("jml_barang");
            $table->date("tgl_order");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_transaksis');
    }
}
