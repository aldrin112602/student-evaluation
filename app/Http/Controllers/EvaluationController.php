<?php

namespace App\Http\Controllers;

use App\Models\Evaluation; // Assuming you have an Evaluation model
use App\Models\Faculty;    // Faculty model
use App\Models\Student;    // Student model
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // To get the currently logged-in user
use DB;

class EvaluationController extends Controller
{
    public function index()
    {
        // Get the logged-in user's role
        $user = Auth::user();
        $role = $user->role;  // Assuming role is stored in the 'role' column of the 'users' table

        // Define the query to fetch evaluations based on user role
        $notesQuery = Note::query();

        // Check the role of the logged-in user
        if ($role == 'admin') {
            // Admin can see all evaluations
            $notes = $notesQuery->get();
        } elseif ($role == 'faculty') {
            // Faculty can only see evaluations where their 'user_id' is the evaluator
            $notes = $notesQuery->where('user_id', $user->user_id)->get();
        } elseif ($role == 'student') {
            // Student can only see evaluations related to their 'student_id'
            $notes = $notesQuery->where('student_id', $user->user_id)->get();
        } else {
            // Default case (in case the role is not recognized)
            $notes = collect();
        }

        return view('evaluation.evaluation', compact('notes'));
    }

    // Your other methods like showEvaluations, evaluate, store, etc.
}
