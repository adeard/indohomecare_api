<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->integer('years')->nullable();
            $table->string('recomendation_from')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->text('address')->nullable();
            $table->text('attached_tools')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('main_complaint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
