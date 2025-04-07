<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RequestEvaluation;  // Import the RequestEvaluation model

class StudentsController extends Controller
{
    public function students()
    {
        // Fetch BSIT students from the wup_automate table
        $bsitStudents = DB::table('wup_automate')
            ->select('student_id', 'student_name')
            ->where('course', 'BSIT')
            ->get();

        // Loop through students and fetch their evaluation status
        foreach ($bsitStudents as $student) {
            // Fetch evaluation status for each student
            $evaluationStatus = RequestEvaluation::where('user_id', $student->student_id)->first();
            
            // Attach the evaluation status to the student object
            $student->evaluation_status = $evaluationStatus ? $evaluationStatus->status : 'none';  // Default to 'none' if no status
        }
        

        // Pass the students to the view located in students/index.blade.php
        return view('students.index', compact('bsitStudents'));
    }

    public function evaluators()
    {
        return view('evaluators.evaluators');
    }

    
}
