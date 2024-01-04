<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelPelanggan;
use DataTables;

class ControllerPelanggan extends Controller{
    public function index(){
        $data = ModelPelanggan::all();
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

        return view('pelanggan.index');
    }

    public function store(Request $request){
        $this->_validate();

        ModelPelanggan::updateOrCreate(['id' => $request->id],
            ['nama_pelanggan' => $request->nama,
            'email_pelanggan' => $request->email,
            'no_telp_pelanggan' => $request->telp,
            'alamat_pelanggan' => $request->alamat]);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id){
        $data = ModelPelanggan::where('id', $id)->first();
        echo json_encode($data);
    }

    public function destroy($id){
        $data = ModelPelanggan::findOrFail($id)->delete();
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

        if(Request()->email == ''){
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email tidak boleh kosong';
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

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}
