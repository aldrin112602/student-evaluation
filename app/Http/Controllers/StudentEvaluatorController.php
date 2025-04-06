<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class StudentEvaluatorController extends Controller
{
    public function index()
    {
        // Fetch evaluators from the 'faculty' table
        $evaluators = Faculty::where('department', 'CECT')->get(); // Adjust query as needed

        // Return the view with evaluators data
        return view('evaluators.evaluators', compact('evaluators'));
    }
    
}

