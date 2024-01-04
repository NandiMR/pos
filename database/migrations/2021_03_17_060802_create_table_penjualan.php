<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('no_penjualan');
            $table->integer('id_user');
            $table->string('nama_pelanggan')->nullable();
            $table->string('email_pelanggan')->nullable();
            $table->string('no_telp_pelanggan')->nullable();
            $table->integer('total');
            $table->integer('diskon');
            $table->integer('subtotal');
            $table->integer('uang');
            $table->integer('kembali');
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
        Schema::dropIfExists('tbl_penjualan');
    }
}
