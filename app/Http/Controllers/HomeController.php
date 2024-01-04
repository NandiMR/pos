<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ModelProduk, ModelPelanggan, ModelPemasok, ModelPenjualan, ModelPenjualanDetail};
use DataTables;

class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $pelanggan = ModelPelanggan::count();
        $produk = ModelProduk::count();
        $pemasok = ModelPemasok::count();
        $pendapat_hari = ModelPenjualan::whereDate('created_at', date('Y-m-d'))->sum('subtotal');
        $pendapat_bulan = ModelPenjualan::whereMonth('created_at', date('m'))->sum('subtotal');
        return view('home', compact('pelanggan', 'produk', 'pemasok', 'pendapat_hari', 'pendapat_bulan'));
    }

    public function tampil(){
        $data = ModelPenjualan::whereDate('created_at', date('Y-m-d'))->get();
        if (Request()->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('pelanggan', function($pl){
                $pl = $pl->nama_pelanggan == '' ? 'Umum' : $pl->nama_pelanggan;

                return $pl;
            })
            ->addColumn('subtotal', function($sub){
                $sub = 'Rp. '.number_format($sub->subtotal);

                return $sub;
            })
            ->addColumn('tanggal', function($tg){
                $tg = date('d-m-Y', strtotime($tg->created_at));

                return $tg;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Detail" class="detail btn btn-primary btn-sm" onclick="get('."'".$row->no_penjualan."'".')"><i class="fas fa-eye"></i></a>';

                return $btn;
            })
            ->rawColumns(['pelanggan', 'subtotal', 'tanggal', 'action'])
            ->make(true);
        }
    }
}
