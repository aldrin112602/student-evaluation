<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';  // Explicitly specify the table name

    protected $fillable = [
        'user_id',
        'file_name'
    ];
}
