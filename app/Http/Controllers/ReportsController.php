<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Api;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->status   = "true";
        $this->data     = [];
        $this->errorMsg = null;
    }

    public function nurses(Request $request) {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start)
                $start = date('Y-m-d', $request->start);
            if ($request->end)
                $end = date('Y-m-d', $request->end);

            $result = DB::select("
                SELECT 
                    `nurse_categories`.`name` AS 'permintaan_jasa',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `nurse_contracts` ON `nurse_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `nurses` ON `nurses`.`id` = `nurse_contracts`.`nurse_id` WHERE `nurses`.`nurse_category_id` = `nurse_categories`.`id` AND `contracts`.`contract_status_id` = 1 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_draft',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `nurse_contracts` ON `nurse_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `nurses` ON `nurses`.`id` = `nurse_contracts`.`nurse_id` WHERE `nurses`.`nurse_category_id` = `nurse_categories`.`id` AND `contracts`.`contract_status_id` = 2 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_deal',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `nurse_contracts` ON `nurse_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `nurses` ON `nurses`.`id` = `nurse_contracts`.`nurse_id` WHERE `nurses`.`nurse_category_id` = `nurse_categories`.`id` AND `contracts`.`contract_status_id` = 3 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_done',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `nurse_contracts` ON `nurse_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `nurses` ON `nurses`.`id` = `nurse_contracts`.`nurse_id` WHERE `nurses`.`nurse_category_id` = `nurse_categories`.`id` AND `contracts`.`contract_status_id` = 4 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_no_response',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `nurse_contracts` ON `nurse_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `nurses` ON `nurses`.`id` = `nurse_contracts`.`nurse_id` WHERE `nurses`.`nurse_category_id` = `nurse_categories`.`id` AND `contracts`.`contract_status_id` = 5 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_cancel'
                FROM `nurse_categories`;
            ");

            $this->data = $result;
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function medicTools(Request $request)
    {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start)
                $start = date('Y-m-d', $request->start);
            if ($request->end)
                $end = date('Y-m-d', $request->end);

            $result = DB::select("
                SELECT
                    `medic_tools`.`name` AS 'permintaan_jasa',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `medic_tool_contracts` ON `medic_tool_contracts`.`contract_id` = `contracts`.`id` WHERE `medic_tools`.`id` = `medic_tool_contracts`.`medic_tool_id` AND `contracts`.`contract_status_id` = 1 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_draft',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `medic_tool_contracts` ON `medic_tool_contracts`.`contract_id` = `contracts`.`id` WHERE `medic_tools`.`id` = `medic_tool_contracts`.`medic_tool_id` AND `contracts`.`contract_status_id` = 2 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_deal',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `medic_tool_contracts` ON `medic_tool_contracts`.`contract_id` = `contracts`.`id` WHERE `medic_tools`.`id` = `medic_tool_contracts`.`medic_tool_id` AND `contracts`.`contract_status_id` = 3 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_done',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `medic_tool_contracts` ON `medic_tool_contracts`.`contract_id` = `contracts`.`id` WHERE `medic_tools`.`id` = `medic_tool_contracts`.`medic_tool_id` AND `contracts`.`contract_status_id` = 4 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_no_response',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `medic_tool_contracts` ON `medic_tool_contracts`.`contract_id` = `contracts`.`id` WHERE `medic_tools`.`id` = `medic_tool_contracts`.`medic_tool_id` AND `contracts`.`contract_status_id` = 5 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_cancel'
                FROM `medic_tools`;
            ");

            $this->data = $result;
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function therapists(Request $request)
    {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start)
                $start = date('Y-m-d', $request->start);
            if ($request->end)
                $end = date('Y-m-d', $request->end);

            $result = DB::select("
                SELECT
                    `therapist_types`.`name` AS 'permintaan_jasa',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `therapist_contracts` ON `therapist_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `therapists` ON `therapists`.`id` = `therapist_contracts`.`therapist_id` WHERE `therapists`.`therapist_type_id` = `therapist_types`.`id` AND `contracts`.`contract_status_id` = 1 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_draft',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `therapist_contracts` ON `therapist_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `therapists` ON `therapists`.`id` = `therapist_contracts`.`therapist_id` WHERE `therapists`.`therapist_type_id` = `therapist_types`.`id` AND `contracts`.`contract_status_id` = 2 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_deal',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `therapist_contracts` ON `therapist_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `therapists` ON `therapists`.`id` = `therapist_contracts`.`therapist_id` WHERE `therapists`.`therapist_type_id` = `therapist_types`.`id` AND `contracts`.`contract_status_id` = 3 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_done',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `therapist_contracts` ON `therapist_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `therapists` ON `therapists`.`id` = `therapist_contracts`.`therapist_id` WHERE `therapists`.`therapist_type_id` = `therapist_types`.`id` AND `contracts`.`contract_status_id` = 4 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_no_response',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `therapist_contracts` ON `therapist_contracts`.`contract_id` = `contracts`.`id` INNER JOIN `therapists` ON `therapists`.`id` = `therapist_contracts`.`therapist_id` WHERE `therapists`.`therapist_type_id` = `therapist_types`.`id` AND `contracts`.`contract_status_id` = 5 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_cancel'
                FROM `therapist_types`
            ");

            $this->data = $result;
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function transports(Request $request)
    {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start)
                $start = date('Y-m-d', $request->start);
            if ($request->end)
                $end = date('Y-m-d', $request->end);

            $result = DB::select("
                SELECT
                    `transport_times`.`name` AS 'permintaan_jasa',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `transport_contracts` ON `transport_contracts`.`contract_id` = `contracts`.`id` WHERE `transport_contracts`.`transport_time_id` = `transport_times`.`id` AND `contracts`.`contract_status_id` = 1 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_draft',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `transport_contracts` ON `transport_contracts`.`contract_id` = `contracts`.`id` WHERE `transport_contracts`.`transport_time_id` = `transport_times`.`id` AND `contracts`.`contract_status_id` = 2 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_deal',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `transport_contracts` ON `transport_contracts`.`contract_id` = `contracts`.`id` WHERE `transport_contracts`.`transport_time_id` = `transport_times`.`id` AND `contracts`.`contract_status_id` = 3 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_done',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `transport_contracts` ON `transport_contracts`.`contract_id` = `contracts`.`id` WHERE `transport_contracts`.`transport_time_id` = `transport_times`.`id` AND `contracts`.`contract_status_id` = 4 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_no_response',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` INNER JOIN `transport_contracts` ON `transport_contracts`.`contract_id` = `contracts`.`id` WHERE `transport_contracts`.`transport_time_id` = `transport_times`.`id` AND `contracts`.`contract_status_id` = 5 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_cancel'
                FROM `transport_times`
            ");

            $this->data = $result;
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }

    public function events(Request $request)
    {
        try {
            $start = date('Y-m-d');
            $end = date('Y-m-d');

            if ($request->start)
                $start = date('Y-m-d', $request->start);
            if ($request->end)
                $end = date('Y-m-d', $request->end);

            $result = DB::select("
                SELECT 
                    `event_contracts`.`event_name` AS 'permintaan_jasa',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` WHERE `contracts`.`id` = `event_contracts`.`contract_id` AND `contracts`.`contract_status_id` = 1 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_draft',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` WHERE `contracts`.`id` = `event_contracts`.`contract_id` AND `contracts`.`contract_status_id` = 2 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_deal',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` WHERE `contracts`.`id` = `event_contracts`.`contract_id` AND `contracts`.`contract_status_id` = 3 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_done',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` WHERE `contracts`.`id` = `event_contracts`.`contract_id` AND `contracts`.`contract_status_id` = 4 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_no_response',
                    (SELECT COUNT(`contracts`.`id`) FROM `contracts` WHERE `contracts`.`id` = `event_contracts`.`contract_id` AND `contracts`.`contract_status_id` = 5 AND DATE(`contracts`.`created_at`) BETWEEN '".$start."' AND '".$end."') AS 'status_cancel'
                FROM `event_contracts`;
            ");

            $this->data = $result;
        } catch (\Exception $e) {
            $this->status   = "false";
            $this->errorMsg = $e->getMessage();
        }

        return response()->json(Api::format($this->status, $this->data, $this->errorMsg), 201);
    }
}