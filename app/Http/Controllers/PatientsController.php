<?php

namespace App\Http\Controllers;

use App\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class PatientsController extends Controller
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

            $this->data = patient::with(['pjs'])->paginate($paginate);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'pj_id' => 'required',
                'gender' => 'required',
                'years' => 'required',
                'recomendation_from' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'address' => 'required',
                'attached_tools' => 'required',
                'diagnosis' => 'required',
                'main_complaint' => 'required'
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'fullname' => $request->get('fullname'),
                'pj_id' => $request->get('pj_id'),
                'gender' => $request->get('gender'),
                'years' => $request->get('years'),
                'recomendation_from' => $request->get('recomendation_from'),
                'height' => $request->get('height'),
                'weight' => $request->get('weight'),
                'address' => $request->get('address'),
                'attached_tools' => $request->get('attached_tools'),
                'diagnosis' => $request->get('diagnosis'),
                'main_complaint' => $request->get('main_complaint')
            ];

            $this->data = patient::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = patient::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function getGroupPJ($pj_id = null) {
        try {
            $this->data = patient::all()->where('pj_id', $pj_id);
        } catch (\Exception $e) {
            $this->status = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = patient::where('id', $id)->update($request->all());

            $this->data = patient::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = patient::find($id);
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
