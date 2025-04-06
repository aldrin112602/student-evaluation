<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;

    // Make sure 'archived' is fillable
    protected $fillable = ['user_id', 'fullname', 'department', 'archived', 'username', 'password'];

    // Optionally, if you are using $guarded instead of $fillable, do:
    // protected $guarded = ['id'];
}
