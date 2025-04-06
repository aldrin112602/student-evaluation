<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletionForm extends Model
{
    use HasFactory;

    // Add the 'fillable' property to allow mass assignment
    protected $fillable = ['student_id','name', 'image'];
}

