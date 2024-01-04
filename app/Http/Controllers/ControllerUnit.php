<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelUnit;
use DataTables;

class ControllerUnit extends Controller
{
    public function index()
    {
        $data = ModelUnit::all();
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

        return view('produk.unit.index');
    }

    public function store(Request $request)
    {
        $this->_validate();

        ModelUnit::updateOrCreate(['id' => $request->id],
            ['nama_unit' => $request->unit]);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $data = ModelUnit::findOrFail($id);
        echo json_encode($data);
    }

    public function destroy($id)
    {
        $data = ModelUnit::findOrFail($id)->delete();
        echo json_encode($data);
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(Request()->unit == ''){
            $data['inputerror'][] = 'unit';
            $data['error_string'][] = 'Unit tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}
