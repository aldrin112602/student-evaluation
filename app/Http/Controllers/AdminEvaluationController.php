<?php

namespace App\Http\Controllers;

use App\Models\RequestEvaluation; // Import the RequestEvaluation model
use Illuminate\Http\Request;
use App\Models\WupAutomate; // Add this line at the top of your file
use App\Models\Grade; // Add this line at the top of your file
use App\Models\Note;  // Add this line

class AdminEvaluationController extends Controller
{
    public function index()
    {
        // Fetch pending evaluations
        $pendingEvaluations = RequestEvaluation::where('status', 'pending')->get();

        // Fetch completed evaluations
        $completedEvaluations = RequestEvaluation::where('status', 'completed')->get();

        return view('admin.evaluation', compact('pendingEvaluations', 'completedEvaluations'));
    }
    public function showGrades(Request $request)
    {
        // Get student ID from the request or session
        $studentId = $request->input('student_id') ?? session('student_id');

        // Fetch the student details from the 'wup_automate' table based on student ID
        $studentDetails = WupAutomate::where('student_id', $studentId)->first();

        // Check if student details are found
        if ($studentDetails) {
            $studentName = $studentDetails->student_name;  // 'student_name' from wup_automate table
            $year = $studentDetails->year;  // 'year' column from wup_automate table
            $status = $studentDetails->status;  // 'status' column from wup_automate table
        } else {
            // If no record is found, set default values
            $studentName = 'Not available';
            $year = 'Not available';
            $status = 'Not available';
        }

        // Fetch grades for the student
        $grades = Grade::where('student_id', $studentId)->get();

        // Pass the grades, student name, student ID, year, and status to the view
        return view('grades.faculty', compact('grades', 'studentName', 'studentId', 'year', 'status'));
    }

    public function saveNote(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to save notes.');
        }
    
        // Get the authenticated user
        $user = Auth::user();
        $userId = $user->user_id;  // Assuming user_id is the correct column in users table
        $evaluatedBy = $user->fullname;  // Get the full name of the logged-in user
    
        // Check if the user is an admin or faculty
        if (!in_array($user->role, ['admin', 'faculty'])) {
            return redirect()->back()->with('error', 'You do not have permission to save notes.');
        }
    
        // Get student_id from the request (ensure it's passed with the request)
        $studentId = $request->input('student_id');  // Retrieve student_id from the request
    
        // Check if the student_id is provided in the request
        if (!$studentId) {
            return redirect()->back()->with('error', 'Student ID is missing.');
        }
    
        // Get student_name from the session (assumed to be set earlier)
        $studentName = session('student_name', 'Default Student Name');
    
        // Log user and student info for debugging
        \Log::info('User ID: ' . $userId);
        \Log::info('Student Name: ' . $studentName);
        \Log::info('Student ID: ' . $studentId);
    
        // Find the existing note based on student_id
        $note = Note::where('student_id', $studentId)->first();
    
        // If a note already exists for the student_id, update it
        if ($note) {
            $note->note = $request->input('note');
            $note->advise = $request->input('advise');
            $note->results = $request->input('results');
            $note->recommendations = $request->input('recommendations');
            $note->evaluated_by = $evaluatedBy;  // Update the evaluator's name
            $note->save();
    
            return redirect()->back()->with('success', 'Note updated successfully!');
        } else {
            // If no note exists, create a new note for the student
            $note = new Note();
            $note->student_name = $studentName;
            $note->evaluated_by = $evaluatedBy;
            $note->student_id = $studentId;
            $note->user_id = $userId;  // This associates the note with the logged-in user (faculty or admin)
            $note->note = $request->input('note');
            $note->advise = $request->input('advise');
            $note->results = $request->input('results');
            $note->recommendations = $request->input('recommendations');
    
            $note->save();
    
            return redirect()->back()->with('success', 'Note saved successfully!');
        }
    }

    public function completeEvaluation(Request $request, $studentId)
    {
        // Mark the evaluation request as completed
        $evaluationRequest = RequestEvaluation::where('user_id', $studentId)->first();
    
        if ($evaluationRequest) {
            // Update status to completed
            $evaluationRequest->status = 'completed';
            $evaluationRequest->save();  // Save the changes
    
            // Now handle the 'notes' table update
            $note = Note::where('student_id', $studentId)->first();
            
            if ($note) {
                // If there's a note for this student, we update the updated_at timestamp
                $note->updated_at = now();  // Set the current timestamp
                $note->save();  // Save the changes to 'notes' table
            }
        }
    
        // Redirect back to the grades page with a success message
        return redirect()->route('grades.show', ['student_id' => $studentId])->with('success', 'Evaluation completed successfully!');
    }


}
