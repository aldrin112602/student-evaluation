<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // If your table name is not the plural of the model name, you can specify it explicitly
    protected $table = 'grades';  // Make sure this matches your table name in the database

    // If you're using mass assignment, define which fields are fillable
    protected $fillable = [
        'student_id', 
        'course_code', 
        'course_title', 
        'prelims_grade', 
        'midterms_grade', 
        'final_grade', 
        'remarks'
    ];

    // Define any relationships if needed
}
