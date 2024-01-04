<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ModelPembelian, ModelProduk, ModelPemasok};
use DataTables;

class ControllerPembelian extends Controller{
    public function index(){
        $produk = ModelProduk::all();
        $pemasok = ModelPemasok::all();
        $data = ModelPembelian::all();
        if (Request()->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('kode', function($ko){
                $ko = $ko->produk->kode_produk;

                return $ko;
            })
            ->addColumn('nama', function($nm){
                $nm = $nm->produk->nama_produk;

                return $nm;
            })
            ->addColumn('tanggal', function($tgl){
                $tgl = date('d/m/Y', strtotime($tgl->created_at));

                return $tgl;
            })
            ->addColumn('action', function($row){

               $btn = '<a href="javascript:void(0)" title="Detail" class="detail btn btn-primary btn-sm" onclick="get('."'".$row->id."'".')"><i class="fas fa-eye"></i></a>';

               $btn = $btn.' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="del('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

               return $btn;
           })
            ->rawColumns(['nama', 'kode', 'tanggal', 'action'])
            ->make(true);
        }
        return view('transaksi.pembelian.index', compact('produk', 'pemasok'));
    }

    public function store(Request $request){
        $this->_validate();

        ModelPembelian::updateOrCreate(['id' => $request->id],
            ['id_produk' => $request->produk,
            'id_pemasok' => $request->pemasok,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga,
            'subtotal' => $request->subtotal]);

        ModelProduk::where('id', $request->produk)->increment('stok_produk', $request->jumlah);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id){
        $data = ModelPembelian::where('tbl_pembelian.id', $id)
            ->join('tbl_produk', 'tbl_produk.id', '=', 'tbl_pembelian.id_produk')
            ->join('tbl_pemasok', 'tbl_pemasok.id', '=', 'tbl_pembelian.id_pemasok')
            ->select('tbl_pembelian.*', 'tbl_produk.kode_produk', 'tbl_produk.nama_produk', 'tbl_pemasok.nama_pemasok')->first();
        echo json_encode($data);
    }

    public function destroy($id){
        $pembelian = ModelPembelian::findOrFail($id);
        $id_produk = $pembelian->id_produk;
        $jumlah = $pembelian->jumlah;
        ModelProduk::where('id', $id_produk)->decrement('stok_produk', $jumlah);
        $pembelian->delete();

        echo json_encode(["status" => TRUE]);
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(Request()->produk == ''){
            $data['inputerror'][] = 'produk';
            $data['error_string'][] = 'Pilih produk';
            $data['status'] = FALSE;
        }

        if(Request()->pemasok == ''){
            $data['inputerror'][] = 'pemasok';
            $data['error_string'][] = 'Pilih pemasok';
            $data['status'] = FALSE;
        }

        if(Request()->jumlah == ''){
            $data['inputerror'][] = 'jumlah';
            $data['error_string'][] = 'Jumlah tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->harga == ''){
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}
