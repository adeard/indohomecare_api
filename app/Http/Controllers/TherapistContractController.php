<?php

namespace App\Http\Controllers;

use App\therapist_contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class TherapistContractController extends Controller
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
                $this->data = therapist_contract::with(['therapists', 'therapist_sessions'])->where('contract_id', $request->contract_id)->paginate($paginate);
            } else {
                $this->data = therapist_contract::paginate($paginate);
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
                'therapist_id' => 'required',
                'therapist_session_id' => 'required',
                'contract_id' => 'required'
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'therapist_id' => $request->get('therapist_id'),
                'therapist_session_id' => $request->get('therapist_session_id'),
                'contract_id' => $request->get('contract_id'),
            ];

            $this->data = therapist_contract::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = therapist_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = therapist_contract::where('id', $id)->update($request->all());

            $this->data = therapist_contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = therapist_contract::find($id);
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
