<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_professions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->nullable();
            $table->integer('contrac_period_id')->nullable();
            $table->string('last_education')->nullable();
            $table->string('photo_upload')->nullable();
            $table->string('ktp_upload')->nullable();
            $table->string('diploma_upload')->nullable();
            $table->string('str_upload')->nullable();
            $table->string('certificate_upload')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('contract_start_date')->nullable();
            $table->string('contract_end_date')->nullable();
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
        Schema::dropIfExists('candidate_professions');
    }
}
