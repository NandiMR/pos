<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ModelProduk, ModelUnit};
use DataTables;

class ControllerProduk extends Controller
{
    public function index()
    {
        $data = ModelProduk::all();
        $unit = ModelUnit::all();
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
                $btn = '<a href="javascript:void(0)" title="Edit" class="edit btn btn-primary btn-sm" onclick="get('."'".$row->id."'".')"><i class="fas fa-edit"></i></a>';

                $btn = $btn.' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="del('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

                return $btn;
            })
            ->rawColumns(['harga', 'unit', 'action'])
            ->make(true);
        }
        return view('produk.data.index', compact('unit'));
    }

    public function store(Request $request)
    {
        $this->_validate();

        ModelProduk::updateOrCreate(['id' => $request->id],
            ['kode_produk' => $request->kode,
            'nama_produk' => $request->nama,
            'id_unit' => $request->unit,
            'harga_produk_beli' => $request->harga_beli,
            'harga_produk_jual' => $request->harga_jual,
            'stok_produk' => 0]);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $data = ModelProduk::where('id', $id)->first();
        echo json_encode($data);
    }

    public function destroy($id)
    {
        $data = ModelProduk::findOrFail($id)->delete();
        echo json_encode($data);
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(Request()->kode == ''){
            $data['inputerror'][] = 'kode';
            $data['error_string'][] = 'Kode tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->nama == ''){
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->unit == ''){
            $data['inputerror'][] = 'unit';
            $data['error_string'][] = 'Pilih Unit';
            $data['status'] = FALSE;
        }

        if(Request()->harga_beli == ''){
            $data['inputerror'][] = 'harga_beli';
            $data['error_string'][] = 'Harga beli tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->harga_jual == ''){
            $data['inputerror'][] = 'harga_jual';
            $data['error_string'][] = 'Harga jual tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}
