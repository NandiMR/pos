<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPenjualanDetail extends Model
{
	protected $table = 'tbl_penjualan_detail';
	protected $fillable = ['id_penjualan', 'kode_produk', 'nama_produk', 'unit', 'harga_jual', 'harga_beli', 'qty', 'diskon_produk'];
	public $timestamps = false;
}
