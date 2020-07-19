<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewStatisticByStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_statistic_by_status AS
            SELECT
                DATE( created_at ) AS date,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    contracts a 
                WHERE
                    DATE( a.created_at ) = DATE( contracts.created_at ) 
                    AND a.contract_status_id = 1 
                ) AS draft,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    contracts b 
                WHERE
                    DATE( b.created_at ) = DATE( contracts.created_at ) 
                    AND b.contract_status_id = 2 
                ) AS deal,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    contracts c 
                WHERE
                    DATE( c.created_at ) = DATE( contracts.created_at ) 
                    AND c.contract_status_id = 3 
                ) AS done,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    contracts d 
                WHERE
                    DATE( d.created_at ) = DATE( contracts.created_at ) 
                    AND d.contract_status_id = 4 
                ) AS no_response,
                (
                SELECT
                    COUNT( id ) 
                FROM
                    contracts e 
                WHERE
                    DATE( e.created_at ) = DATE( contracts.created_at ) 
                    AND contracts.contract_status_id = 5 
                ) AS cancel,
                COUNT( id ) AS total 
            FROM
                contracts 
            GROUP BY
                date"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_statistic_by_status");
    }
}
