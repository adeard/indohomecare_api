<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateSubtitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_subtitutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id_from')->nullable();
            $table->integer('candidate_id_to')->nullable();
            $table->integer('request_service_session_id')->nullable();
            $table->string('note')->nullable();
            $table->string('subtitution_date')->nullable();
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
        Schema::dropIfExists('candidate_subtitutions');
    }
}
