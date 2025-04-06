<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Migration
{
    public function up()
    {
        DB::table('users')->insert([
            'user_id' => 'admin', // You can set the user ID
            'fullname' => 'Admin User', // Full name for the admin
            'username' => 'admin', // The username
            'email' => 'admin@example.com', // The email
            'password' => Hash::make('password123'), // The password (hash it)
            'role' => 'admin', // Set the role as admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('users')->where('username', 'admin')->delete();
    }
}
