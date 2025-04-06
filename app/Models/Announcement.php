<?php

namespace App\Models;  // Ensure the correct namespace is used

use Illuminate\Database\Eloquent\Model;  // Import the Model class

class Announcement extends Model
{
    // Set the table name if it's not the plural form of the model (optional)
    // protected $table = 'announcements';

    // Define which attributes can be mass-assigned
    protected $fillable = ['title', 'date', 'content', 'archived'];

    // If you want to use timestamps (created_at and updated_at), you can enable them here
    // public $timestamps = true;  // This is the default, so you don't usually need to define it unless it's false

    // If the column names for created_at and updated_at are different, you can customize them:
    // const CREATED_AT = 'creation_date';  // Example, if your timestamps have custom column names
    // const UPDATED_AT = 'last_update';
}
