<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'evaluator_id',
        'evaluation_title',
        'evaluation_date'
    ];

    // Define the relationship with the Note model (notes table)
    public function note()
    {
        return $this->belongsTo(Note::class, 'student_id', 'student_id'); // Link based on student_id
    }
}
