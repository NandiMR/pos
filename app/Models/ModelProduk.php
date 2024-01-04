<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProduk extends Model
{
	protected $table = 'tbl_produk';
	protected $fillable = ['kode_produk', 'nama_produk', 'id_unit', 'harga_produk_beli', 'harga_produk_jual', 'stok_produk'];

	public function unit(){
		return $this->belongsTo('App\Models\ModelUnit', 'id_unit');
	}

	public function keranjang(){
		return $this->hasOne('App\Models\ModelKeranjang');
	}
}
