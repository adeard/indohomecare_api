<?php

namespace App\Http\Controllers;

use App\view_statistic_by_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Api;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->status   = "true";
        $this->data     = [];
        $this->errorMsg = null;
    }
    
    public function status(Request $request) {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start) 
                $start = date('Y-m-d', $request->start);
            if ($request->end) 
                $end = date('Y-m-d', $request->end);

            $this->data = view_statistic_by_status::whereBetween('date', [$start, $end])->get();
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }
}