<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Migration file for `users` table (app/Database/Migrations/xxxx_xx_xx_create_users_table.php)

Schema::create('users', function (Blueprint $table) {
    $table->id(); // This creates the auto-increment primary key (user_id).
    $table->string('username')->unique();
    $table->string('email')->unique();
    $table->string('password');
    $table->string('user_id')->nullable(); // You can make this nullable if you are expecting it to be populated by other fields.
    $table->string('fullname');
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
