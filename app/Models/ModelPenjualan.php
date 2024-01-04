<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPenjualan extends Model
{
	protected $table = 'tbl_penjualan';
	protected $fillable = ['no_penjualan', 'id_user', 'nama_pelanggan', 'no_telp_pelanggan', 'alamat_pelanggan', 'total', 'diskon', 'subtotal', 'uang', 'kembali'];
}
