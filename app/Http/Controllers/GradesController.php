<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  // Import Auth for logged-in user
use App\Models\Grade;  // Import the Grade model
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Form;  // Add this to import the Form model
use Illuminate\Support\Facades\Storage;  // For file storage
use App\Mail\NoteSaved; // Don't forget to import the mailable
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Models\RequestEvaluation;
use App\Models\CompletionForm;

class GradesController extends Controller
{
    // Method to show grades based on student ID from query parameter
    public function show(Request $request)
    {
        // Retrieve the student_id from the query parameters
        $studentId = $request->input('student_id') ?? auth()->user()->user_id;

        // Query the grades table for the specific student using Eloquent
        $grades = Grade::where('student_id', $studentId)->get();


        // Pass the grades data to the view
        return view('grades.grades', compact('grades', 'studentId'));
    }

    // Method to show grades for the logged-in user
    public function showGrades() {
        // Get the logged-in user's student ID
        $studentId = Auth::user()->user_id;

        // Query the grades table for the specific student by student_id
        $grades = Grade::where('student_id', $studentId)->get();

        
        // Pass the grades data to the view
        return view('grades.grades', compact('grades', 'studentId'));
    }
    public function showFacultyGrades($student_id, $student_name)
    {
        // You can fetch data related to the student using the $student_id or $student_name if needed.
        
        return view('grades.faculty', compact('student_id', 'student_name'));
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

        // After saving the note, update the status in request_evaluations table
        $evaluation = RequestEvaluation::where('user_id', $studentId)->first(); // 'user_id' is assumed to be the student_id
        if ($evaluation) {
            $evaluation->status = 'completed'; // Or whatever status you want
            $evaluation->save();
        }

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

        // After saving the note, update the status in request_evaluations table
        $evaluation = RequestEvaluation::where('user_id', $studentId)->first(); // 'user_id' is assumed to be the student_id
        if ($evaluation) {
            $evaluation->status = 'completed'; // Or whatever status you want
            $evaluation->save();
        }

        return redirect()->back()->with('success', 'Note saved successfully!');
    }
}



public function uploadHelpRequest(Request $request)
{

    // Validate the inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    // Get the original image name
    $imageName = $request->file('image')->getClientOriginalName();

    // Store the image in 'public/images' directory and retrieve the path
    $imagePath = $request->file('image')->storeAs('public/images', $imageName);

    // Save the data in the 'completion_forms' table, using the logged-in student's ID
    CompletionForm::create([
        'student_id' => auth()->user()->user_id, // Get the logged-in user's student_id
        'name' => $request->name, // Save the name input from the form
        'image' => $imagePath, // Save the image path
    ]);

    // Redirect back with a success message
    return redirect()->route('grades.studentgrades')->with('success', 'Your completion form has been uploaded successfully!');
}
    }
