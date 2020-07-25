<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_no')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_no')->nullable();
            $table->text('description')->nullable();
            $table->integer('contract_status_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_requests');
    }
}
