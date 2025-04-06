<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWupAutomateTable extends Migration
{
    public function up()
    {
        Schema::create('wup_automate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->unique(); // Ensure unique if that's required
            $table->string('student_name');
            $table->string('course');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wup_automate');
    }
}
