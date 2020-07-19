<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewStatisticByService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_statistic_by_service AS
            SELECT
                DATE( created_at ) AS date,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    nurse_contracts a 
                WHERE
                    DATE(a.created_at) = DATE(contracts.created_at)  
                ) AS nurse_service,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    medic_tool_contracts b 
                WHERE
                    DATE(b.created_at) = DATE(contracts.created_at)  
                ) AS medic_tool_service,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    therapist_contracts c 
                WHERE
                    DATE(c.created_at) = DATE(contracts.created_at)  
                ) AS therapist_service,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    event_contracts d 
                WHERE
                    DATE(d.created_at) = DATE(contracts.created_at)  
                ) AS event_service,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    transport_contracts e 
                WHERE
                    DATE(e.created_at) = DATE(contracts.created_at)  
                ) AS transport_service
            FROM
                contracts 
            GROUP BY
                date "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_statistic_by_service");
    }
}
