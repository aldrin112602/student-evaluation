<?php

namespace App\Http\Controllers;
use App\Models\Grade;  // Import the Grade model
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Models\WupAutomate;

class FacultyController extends Controller
{
    // Function to toggle the archived status of a faculty member
    public function verifyFaculty($faculty_id)
    {
        // Find the faculty by their ID (from the 'faculty' table)
        $faculty = Faculty::where('faculty_id', $faculty_id)->first();

        // Check if the faculty exists
        if ($faculty) {
            return response()->json(['success' => true, 'name' => $faculty->faculty_name]);
        } else {
            return response()->json(['success' => false, 'message' => 'Faculty not found']);
        }
    }
    // Display the list of evaluators (faculty members)
    public function index()
    {
        // Get all the faculty members
        $facultyList = Faculty::all();  // You can add pagination if needed

        return view('evaluators.evaluators', compact('facultyList'));
    }

    public function storeStudentDetails(Request $request)
    {
        // Store student details in session
        session([
            'student_id' => $request->student_id,
            'student_name' => $request->student_name,
        ]);

        return response()->json(['success' => true]);
    }

 // Display grades for the given student
 public function showGrades(Request $request)
 {
     // Get student ID and name from the session (if session is being used)
     $studentId = $request->input('student_id') ?? session('student_id');
     $studentName = $request->input('student_name') ?? session('student_name');
      
     // Fetch grades for the student
     $grades = Grade::where('student_id', $studentId)->get();
      
     // Fetch the student details from the 'wup_automate' table
     $studentDetails = WupAutomate::where('student_id', $studentId)->first();
 
     // Check if student details are found
     if ($studentDetails) {
         $year = $studentDetails->year;  // 'year' column from wup_automate table
         $status = $studentDetails->status;  // 'status' column from wup_automate table
     } else {
         // If no record is found, set default values
         $year = 'Not available';
         $status = 'Not available';
     }
 
     // Pass the grades, student name, student ID, year, and status to the view
     return view('grades.faculty', compact('grades', 'studentName', 'studentId', 'year', 'status'));
 }
    }
