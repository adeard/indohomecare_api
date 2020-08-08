<?php

namespace App\Http\Controllers;

use App\therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api;

class TherapistController extends Controller
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

            if ($request->therapist_type_id) {
                $this->data = therapist::with(['therapist_type'])->where('therapist_type_id', $request->therapist_type_id)->paginate($paginate);
            } else {
                $this->data = therapist::with(['therapist_type'])->paginate($paginate);
            }

            // $this->data = therapist::paginate($paginate);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'therapist_type_id' => 'required'
            ]);

            if($validator->fails())
                return response()->json($validator->errors(), 400);

            $data_post = [
                'name' => $request->get('name'),
                'therapist_type_id' => $request->get('therapist_type_id')
            ];

            $this->data = therapist::create($data_post);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function detail($id = null) {
        try {
            $this->data = therapist::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function update(Request $request, $id) {
        try {
            $update = therapist::where('id', $id)->update($request->all());

            $this->data = therapist::find($id);
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 200);
    }

    public function delete($id = null) {
        try{
            if(!empty($id)){
                $Obj = therapist::find($id);
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
