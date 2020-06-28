<?php

namespace App\Http\Controllers;

use App\medic_tool_session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class MedicToolSessionController extends Controller
{
    public function __construct()
    {
        $this->status   = "true";
        $this->data     = [];
        $this->errorMsg = null;
    }

    public function index(Request $request) {
        try {
            $paginate = ($request->has('limit'))?$request->limit:10;

            $this->data = medic_tool_session::with(['medic_tools'])->paginate($paginate);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'medic_tool_id' => 'required',
                'name' => 'required',
                'price' => 'required',
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'medic_tool_id' => $request->get('medic_tool_id'),
                'name' => $request->get('name'),
                'price' => $request->get('price'),
            ];

            $this->data = medic_tool_session::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = medic_tool_session::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = medic_tool_session::where('id', $id)->update($request->all());

            $this->data = medic_tool_session::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function getMedicTools($medic_tool_id = null) {
        try {
            $this->data = medic_tool_session::all()->where('medic_tool_id', $medic_tool_id);
        } catch (\Exception $e) {
            $this->status = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = medic_tool_session::find($id);

                $this->data =  $id;
            }
        }catch(\Exception $e){
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }
}
