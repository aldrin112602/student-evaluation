<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    // Explicitly define the table name
    protected $table = 'faculty';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'faculty_id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'faculty_id', 
        'faculty_name',
        'department',
        'username',
        'password'
    ];

    protected $casts = [
        'faculty_id' => 'string',
    ];


    // Disable automatic timestamps management
    public $timestamps = false;
}
