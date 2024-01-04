<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePenjualanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penjualan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_penjualan');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->string('unit');
            $table->integer('harga_jual');
            $table->integer('harga_beli');
            $table->integer('qty');
            $table->integer('diskon_produk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_penjualan_detail');
    }
}
