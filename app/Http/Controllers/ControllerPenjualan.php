<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ModelPelanggan, ModelProduk, ModelKeranjang, ModelPenjualan, ModelPenjualanDetail};
use DataTables;
use Auth;

class ControllerPenjualan extends Controller
{
    public function index(){
    	$no_penjualan = date('dmy').time();
    	$pelanggan = ModelPelanggan::all();

    	return view('transaksi.penjualan.index', compact('no_penjualan', 'pelanggan'));
    }

    public function get_pelanggan(){
        $pelanggan = ModelPelanggan::where('nama_pelanggan', Request()->pelanggan)->first();
        echo json_encode($pelanggan);
    }

    public function produk(){
    	$data = ModelProduk::all();
    	if (Request()->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('harga', function($ha){
                $ha = 'Rp. '.number_format($ha->harga_produk_jual);

                return $ha;
            })
            ->addColumn('unit', function($ka){
                $ka = $ka->unit->nama_unit;

                return $ka;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Select" class="select btn btn-primary btn-sm" onclick="select('."'".$row->id."'".')"><i class="fas fa-check-circle"></i></a>';

                return $btn;
            })
            ->rawColumns(['harga', 'unit', 'action'])
            ->make(true);
        }
    }

    public function keranjang($id){
    	$produk = ModelProduk::findOrFail($id);
        $keranjang = ModelKeranjang::where('id_produk', $id)->where('id_user', Auth::user()->id)->first();
        $stok = $produk->stok_produk;
        $qty = Request()->qty;

        if ($qty <= $stok) {
            if ($keranjang) {
                $qty_lama = $keranjang->qty;
                $qty_baru = $qty_lama + $qty;
                $update_qty = [
                    'qty' => $qty_baru,
                    'total' => $qty_baru * $keranjang->harga

                ];
                ModelKeranjang::where('id_produk', $id)->update($update_qty);
                ModelProduk::where('id', $id)->decrement('stok_produk', $qty);

                echo json_encode(["status" => TRUE]);
            } else {
                ModelKeranjang::create([
                    'id_produk' => $produk->id,
                    'id_user' => Auth::user()->id,
                    'harga' => $produk->harga_produk_jual,
                    'qty' => $qty,
                    'diskon' => 0,
                    'total' => $produk->harga_produk_jual * $qty
                ]);

                ModelProduk::where('id', $produk->id)->decrement('stok_produk', $qty);

                echo json_encode(["status" => TRUE]);
            }
        } else {
            echo json_encode(["status" => FALSE]);
        }
    }

    public function keranjang_produk(){
        $data = ModelKeranjang::where('id_user', Auth::user()->id)->get();

        $tampil = '';
        $no = 1;
        if ($data->isEmpty()) {
            $tampil .= '
            <tr>
            <td colspan="8" style="text-align: center;"> Tidak ada data </td>
            </tr>
            ';
        } else {
            foreach ($data as $d) {
                $tampil .= '
                <tr>
                <td>'.$no++.'</td>
                <td>'.$d->produk->kode_produk.'</td>
                <td>'.$d->produk->nama_produk.'</td>
                <td>'.$d->harga.'</td>
                <td>'.$d->qty.'</td>
                <td>'.$d->diskon.'</td>
                <td id="total_keranjang">'.$d->total.'</td>
                <td>
                <a href="javascript:void(0)" title="Edit" class="edit btn btn-primary btn-sm" onclick="get('."'".$d->id."'".')"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0)" title="Hapus" class="hapus btn btn-danger btn-sm" onclick="del('."'".$d->id."'".')"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
                ';
            }
        }

        return $tampil;
    }

    public function get_keranjang($id){
        $data = ModelKeranjang::where('tbl_keranjang.id', $id)
        ->join('tbl_produk', 'tbl_produk.id', '=', 'tbl_keranjang.id_produk')
        ->select('tbl_keranjang.*', 'tbl_produk.kode_produk', 'tbl_produk.nama_produk')
        ->first();
        echo json_encode($data);
    }

    public function edit_keranjang(){
        $id = Request()->id_edit;
        $qty = Request()->qty_edit;
        $diskon = Request()->diskon_edit;
        $total = Request()->total_edit;
        $keranjang = ModelKeranjang::findOrFail($id);
        $id_produk = $keranjang->id_produk;
        $produk = ModelProduk::findOrFail($id_produk);

        if ($qty <= $produk->stok_produk) {
            if ($qty <= $keranjang->qty) {
                $stok = $keranjang->qty - $qty;
                ModelProduk::where('id', $keranjang->id_produk)->increment('stok_produk', $stok);
            } else {
                $stok = $qty - $keranjang->qty;
                ModelProduk::where('id', $keranjang->id_produk)->decrement('stok_produk', $stok);
            }

            $edit = [
                'qty' => $qty,
                'diskon' => $diskon,
                'total' => $total,
            ];

            ModelKeranjang::where('id', $id)->update($edit);

            echo json_encode(["status" => TRUE]);
        } else {
            echo json_encode(["status" => FALSE]);
        }
    }

    public function hapus($id){
        $keranjang = ModelKeranjang::findOrFail($id);
        ModelProduk::where('id', $keranjang->id_produk)->increment('stok_produk', $keranjang->qty);
        $keranjang->delete();
        echo json_encode(["status" => TRUE]);
    }

    public function proses(){
        $keranjang = ModelKeranjang::where('id_user', Auth::user()->id)
        ->join('tbl_produk', 'tbl_produk.id', '=', 'tbl_keranjang.id_produk')
        ->join('tbl_unit', 'tbl_unit.id', '=', 'tbl_produk.id_unit')
        ->select('tbl_keranjang.*', 'tbl_produk.kode_produk', 'tbl_produk.nama_produk', 'tbl_unit.nama_unit', 'tbl_produk.harga_produk_beli')
        ->get();

        $id_penjualan = ModelPenjualan::create([
            'no_penjualan' => Request()->no_penjualan,
            'id_user' => Auth::user()->id,
            'nama_pelanggan' => Request()->pelanggan,
            'no_telp_pelanggan' => Request()->telp,
            'alamat_pelanggan' => Request()->alamat,
            'total' => Request()->total,
            'diskon' => Request()->diskon,
            'subtotal' => Request()->subtotal,
            'uang' => Request()->uang,
            'kembali' => Request()->kembali,
        ]);

        foreach ($keranjang as $k) {
            ModelPenjualanDetail::create([
                'id_penjualan' => $id_penjualan->id,
                'kode_produk' => $k->kode_produk,
                'nama_produk' => $k->nama_produk,
                'unit' => $k->nama_unit,
                'harga_jual' => $k->harga,
                'harga_beli' => $k->harga_produk_beli,
                'qty' => $k->qty,
                'diskon_produk' => $k->diskon
            ]);
        }

        $this->reset();
        echo json_encode(["status" => TRUE, "no_penjualan" => Request()->no_penjualan]);
    }

    public function reset(){
        $keranjang = ModelKeranjang::where('id_user', Auth::user()->id);
        foreach ($keranjang->get() as $k) {
            ModelProduk::where('id', $k->id_produk)->increment('stok_produk', $k->qty);
        }
        $keranjang->delete();
    }

    public function laporan(){
        $data = ModelPenjualan::all();
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

        return view('transaksi.penjualan.laporan');
    }

    public function get_laporan($id){
        $data = ModelPenjualan::where('no_penjualan', $id)->first();
        echo json_encode($data);
    }

    public function detail($id){
        $penjualan = ModelPenjualan::where('tbl_penjualan.no_penjualan', $id)
        ->join('users', 'users.id', '=', 'tbl_penjualan.id_user')
        ->select('tbl_penjualan.*', 'users.name')
        ->first();
        $id = $penjualan->id;
        $penjualan_detail = ModelPenjualanDetail::where('id_penjualan', $id)->get();

        return view('transaksi.penjualan.detail', compact('penjualan', 'penjualan_detail'));
    }

    public function cetak($id){
        $penjualan = ModelPenjualan::where('tbl_penjualan.no_penjualan', $id)
        ->join('users', 'users.id', '=', 'tbl_penjualan.id_user')
        ->select('tbl_penjualan.*', 'users.name')
        ->first();
        $id = $penjualan->id;
        $penjualan_detail = ModelPenjualanDetail::where('id_penjualan', $id)->get();

        return view('transaksi.penjualan.cetak', compact('penjualan', 'penjualan_detail'));
    }
}
