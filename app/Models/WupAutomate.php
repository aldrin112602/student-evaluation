<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WupAutomate extends Model
{
    use HasFactory;

    protected $table = 'wup_automate'; // Specify the table name if it's not the plural form of the model name

    protected $fillable = [
        'student_id',
        'student_name',
        'course',
        'year',
        'status',
    ];
}
