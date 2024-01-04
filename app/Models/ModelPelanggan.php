<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPelanggan extends Model
{
    protected $table = 'tbl_pelanggan';
    protected $fillable = ['nama_pelanggan', 'email_pelanggan', 'no_telp_pelanggan', 'alamat_pelanggan'];
}
