<?php

namespace App\Http\Controllers;

use App\nurse_contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class NurseContractController extends Controller
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
                $this->data = nurse_contract::with(['nurses', 'nurse_sessions'])->where('contract_id', $request->contract_id)->paginate($paginate);
            } else {
                $this->data = nurse_contract::paginate($paginate);
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
                'nurse_id' => 'required',
                'nurse_session_id' => 'required',
                'contract_id' => 'required',
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'nurse_id' => $request->get('nurse_id'),
                'nurse_session_id' => $request->get('nurse_session_id'),
                'contract_id' => $request->get('contract_id')
            ];

            $this->data = nurse_contract::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = nurse_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = nurse_contract::where('id', $id)->update($request->all());

            $this->data = nurse_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = nurse_contract::find($id);
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
