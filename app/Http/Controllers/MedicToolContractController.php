<?php

namespace App\Http\Controllers;

use App\medic_tool_contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class MedicToolContractController extends Controller
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
            if ($request->contract_id) {
                $this->data = medic_tool_contract::with(['medic_tools', 'medic_tool_sessions'])->where('contract_id', $request->contract_id)->paginate($paginate);
            } else {
                $this->data = medic_tool_contract::paginate($paginate);
            }
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
                'medic_tool_session_id' => 'required',
                'contract_id' => 'required',
                'quantity' => 'required'
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'contract_id' => $request->get('contract_id'),
                'medic_tool_id' => $request->get('medic_tool_id'),
                'medic_tool_session_id' => $request->get('medic_tool_session_id'),
                'quantity' => $request->get('quantity'),
                'total_price' => $request->get('total_price')
            ];

            $this->data = medic_tool_contract::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = medic_tool_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = medic_tool_contract::where('id', $id)->update($request->all());

            $this->data = medic_tool_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = medic_tool_contract::find($id);
                $Obj->delete();

                $this->data =  $id;
            }
        }catch(\Exception $e){
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }
}
