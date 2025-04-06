<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  // Import Auth for logged-in user
use App\Models\Grade;  // Import the Grade model
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Log;  // For logging purposes
use App\Models\WupAutomate;

class StudentGradeController extends Controller
{
    // Method to show grades based on student ID (either passed in the route or the logged-in user)
    public function show(Request $request, $studentId = null, $studentName = null)
    {
        // If no studentId is provided in the route, use the logged-in user's student ID
        $studentId = $studentId ?? auth()->user()->user_id;
        // If no studentName is provided in the route, use the logged-in user's name
        $studentName = $studentName ?? auth()->user()->fullname;

        // Query the grades table for the specific student using Eloquent
        $grades = Grade::where('student_id', $studentId)->get();

        // Pass the grades data and student info to the view
        return view('grades.studentgrades', compact('grades', 'studentId', 'studentName'));
    }

    // Method to show grades for the logged-in user (can be used in different routes)
    public function showGrades() 
    {
        // Get the logged-in user's student ID and name
        $studentId = Auth::user()->user_id;
        $studentName = Auth::user()->fullname;

        // Query the grades table for the specific student by student_id
        $grades = Grade::where('student_id', $studentId)->get();

 // Query the wup_automate table to get the year and status for the student
 $studentDetails = WupAutomate::where('student_id', $studentId)->first();

 // Check if student details are found
 if ($studentDetails) {
     // Fetch the year and status from the record
     $year = $studentDetails->year;  // 'year' column from wup_automate table
     $status = $studentDetails->status;  // 'status' column from wup_automate table
 } else {
     // If no record is found, set default values
     $year = 'Not available';
     $status = 'Not available';
 }

 // Pass the grades data to the view
        return view('grades.studentgrades', compact('grades', 'studentId', 'studentName', 'year', 'status'));
    }

    // Method to show grades for faculty based on student ID and student name
    public function showFacultyGrades($studentId, $studentName)
    {
        // Example: Retrieve grades for the student from the database
        $grades = Grade::where('student_id', $studentId)->get();

        // Pass the student grades and details to the view
        return view('grades.faculty', compact('grades', 'studentId', 'studentName'));
    }

    // Method to save notes for a student (existing functionality)
    public function saveNote(Request $request)
    {
        // Validate the input (you can customize validation)
        $request->validate([
            'note' => 'required|string|max:255',
            'title' => 'required|string|max:255',  // Validate title input
            'results' => 'required|string|max:255',  // Validate the results input
            'recommendations' => 'required|string|max:255',
            'advise' =>  'required|string|max:255',
        ]);

        // Fetch user_id from the users table using the authenticated user
        $user = Auth::user();  
        $userId = $user->user_id;  // Assuming user_id is the correct column in users table
        $evaluatedBy = $user->fullname;  // Get the full name of the logged-in user
        $studentName = session('student_name'); // Assuming student_name is stored in the session

        // Log the user_id to debug
        \Log::info('User ID: ' . $userId);  // Use Laravel's log to output user_id for debugging

        // Create a new note
        $note = new Note();
        $note->student_name = $studentName;  // Save the student name
        $note->evaluated_by = $evaluatedBy;  // Save the evaluator's full name
        $note->student_id = session('student_id');  // Assuming student_id is in session
        $note->user_id = $userId;  // Use user_id fetched from the users table
        $note->title = $request->input('title');  // Save the title input
        $note->note = $request->input('note');
        $note->advise = $request->input('advise');
        $note->results = $request->input('results');  // Save the results input
        $note->recommendations = $request->input('recommendations');  // Save the results input

        $note->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Note saved successfully!');
    }

    public function getStudentYearAndStatus($studentId)
    {
        // Query the wup_automate table using Eloquent
        $studentDetails = WupAutomate::where('student_id', $studentId)->first();

        // Check if the student was found
        if ($studentDetails) {
            // Return the year and status
            return response()->json([
                'year' => $studentDetails->year,
                'status' => $studentDetails->status,
            ]);
        } else {
            // If the student is not found, return an error response
            return response()->json([
                'error' => 'Student not found.',
            ], 404);
        }
    }
}
