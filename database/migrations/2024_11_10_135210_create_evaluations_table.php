<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('evaluator_id');
            $table->timestamps();

            // You can add foreign key constraints if needed
            // $table->foreign('student_id')->references('id')->on('students');
            // $table->foreign('evaluator_id')->references('id')->on('evaluators');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
