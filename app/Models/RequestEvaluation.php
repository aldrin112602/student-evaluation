<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEvaluation extends Model
{
    use HasFactory;

    // If needed, specify the table name explicitly
    protected $table = 'request_evaluations';  // Make sure the table name matches your actual table name in the database

    // If the 'status' column is used, you can define it in your model as fillable, if applicable:
    protected $fillable = ['user_id', 'status', 'created_at'];
}
