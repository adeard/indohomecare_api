<?php

namespace App\Http\Controllers;

use App\contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Api;

class ContractController extends Controller
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

            $contract = contract::with(['pjs', 'patients', 'users']);

            if ($request->start && $request->end) {
                if (is_numeric($request->start)) {
                    $start = date('Y-m-d', $request->start);
                } else {
                    $start = date('Y-m-d');
                }

                if (is_numeric($request->end)) {
                    $end = date('Y-m-d', $request->end);
                } else {
                    $end = date('Y-m-d');
                }

                $contract->whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59']);
            }

            if ($request->start_no && $request->end_no) {
                $contract->whereBetween('created_at', [$request->start_no.' 00:00:00', $request->end_no.' 23:59:59']);
            }

            if ($request->pj_id) {
                $contract->where('pj_id', $request->pj_id);
            }

            if ($request->patient_id) {
                $contract->where('patient_id', $request->patient_id);
            }
            
            if ($request->contract_no) {
                $contract->where('contract_no', $request->contract_no);
            }

            $this->data = $contract->paginate($paginate);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                // 'pj_id' => 'required',
                // 'patient_id' => 'required',
                'created_by' => 'required',
                'contract_no' => 'required',
                'status' => 'required'
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                // 'pj_id' => $request->get('pj_id'),
                // 'patient_id' => $request->get('patient_id'),
                'created_by' => $request->get('created_by'),
                'contract_no' => $request->get('contract_no'),
                'status' => $request->get('status')
            ];

            $this->data = contract::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = contract::with(['users'])->find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = contract::where('id', $id)->update($request->all());

            $this->data = contract::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = contract::find($id);

                $this->data =  $id;
            }
        }catch(\Exception $e){
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }
}
