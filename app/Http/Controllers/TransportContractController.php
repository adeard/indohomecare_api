<?php

namespace App\Http\Controllers;

use App\transport_contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class TransportContractController extends Controller
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
                $this->data = transport_contract::with(['transport_times'])->where('contract_id', $request->contract_id)->paginate($paginate);
            } else {
                $this->data = transport_contract::paginate($paginate);
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
                'contract_id' => 'required',
                'transport_time_id' => 'required',
                'distance' => 'required',
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'contract_id' => $request->get('contract_id'),
                'transport_time_id' => $request->get('transport_time_id'),
                'distance' => $request->get('distance')
            ];

            $this->data = transport_contract::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = transport_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = transport_contract::where('id', $id)->update($request->all());

            $this->data = transport_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = transport_contract::find($id);

                $this->data =  $id;
            }
        }catch(\Exception $e){
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }
}
