<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('announcements', 'archived')) {
            Schema::table('announcements', function (Blueprint $table) {
                $table->tinyInteger('archived')->default(0);
            });
        }
    }
    

public function down()
{
    Schema::table('announcements', function (Blueprint $table) {
        $table->dropColumn('archived');
    });
}

};
