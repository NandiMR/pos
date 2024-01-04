<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUnit extends Model
{
	protected $table = 'tbl_unit';
	protected $fillable = ['nama_unit'];

	public function produk(){
		return $this->hasOne('App\Models\ModelProduk');
	}
}
