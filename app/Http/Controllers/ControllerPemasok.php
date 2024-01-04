<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelPemasok;
use DataTables;

class ControllerPemasok extends Controller{
    public function index(){
        $data = ModelPemasok::all();
        if (Request()->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

             $btn = '<a href="javascript:void(0)" title="Edit" class="edit btn btn-primary btn-sm" onclick="get('."'".$row->id."'".')"><i class="fas fa-edit"></i></a>';

             $btn = $btn.' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="del('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

             return $btn;
         })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('pemasok.index');
    }

    public function store(Request $request){
        $this->_validate();

        ModelPemasok::updateOrCreate(['id' => $request->id],
            ['nama_pemasok' => $request->nama,
            'no_telp_pemasok' => $request->telp,
            'alamat_pemasok' => $request->alamat,
            'keterangan' => $request->keterangan]);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id){
        $data = ModelPemasok::findOrFail($id);
        echo json_encode($data);
    }

    public function destroy($id){
        $data = ModelPemasok::findOrFail($id)->delete();
        echo json_encode($data);
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(Request()->nama == ''){
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->telp == ''){
            $data['inputerror'][] = 'telp';
            $data['error_string'][] = 'Telp tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->alamat == ''){
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(Request()->keterangan == ''){
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Keterangan tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}
