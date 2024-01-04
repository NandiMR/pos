<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelKeranjang extends Model
{
	protected $table = 'tbl_keranjang';
	protected $fillable = ['id_produk', 'id_user', 'harga', 'qty', 'diskon', 'total'];
	public $timestamps = false;

	public function produk(){
		return $this->belongsTo('App\Models\ModelProduk', 'id_produk');
	}
}
