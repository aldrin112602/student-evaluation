<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'note_id'); // 'note_id' is the foreign key in 'evaluations' table
    }
    
    use HasFactory;

    protected $fillable = [
        'student_name',
        'evaluated_by',
        'student_id',
        'user_id',
        'note',
        'advise',
        'results',
        'recommendations',
    ];

    public $timestamps = true; // This will automatically manage created_at and updated_at
}



