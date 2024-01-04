<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPembelian extends Model
{
	protected $table = 'tbl_pembelian';
	protected $fillable = ['id_produk', 'id_pemasok', 'jumlah', 'harga_satuan', 'subtotal'];

	public function produk(){
		return $this->belongsTo('App\Models\ModelProduk', 'id_produk');
	}

	public function pemasok(){
		return $this->belongsTo('App\Models\ModelPemasok', 'id_pemasok');
	}
}
