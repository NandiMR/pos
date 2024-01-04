<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPemasok extends Model
{
	protected $table = 'tbl_pemasok';
	protected $fillable = ['nama_pemasok', 'no_telp_pemasok', 'alamat_pemasok', 'keterangan'];
}
