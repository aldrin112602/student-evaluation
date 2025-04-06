<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\WupAutomate;  // Import the model for wup_automate table
use App\Models\Faculty;     // Import the model for faculty table
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm(Request $request)
    {
        $role = null;
        $userId = null;
        $fullname = null;

        // Check if a student_id is provided via the request (either as GET parameter or form data)
        if ($request->has('student_id')) {
            $studentId = $request->student_id;

            // Check if the ID exists in wup_automate (Student Table)
            $student = WupAutomate::where('id_number', $studentId)->first();
            if ($student) {
                $role = 'student';
                $userId = $student->id_number; // Assuming 'id_number' is the user ID
                $fullname = $student->full_name; // Assuming 'full_name' is the full name field
            }
            // Check if the ID exists in faculty (Faculty Table)
            $faculty = Faculty::where('id_number', $studentId)->first();
            if ($faculty) {
                $role = 'faculty';
                $userId = $faculty->id_number; // Assuming 'id_number' is the user ID
                $fullname = $faculty->full_name; // Assuming 'full_name' is the full name field
            }
        }

        // Return the registration view with the role, userId, and fullname
        return view('auth.register', compact('role', 'userId', 'fullname'));
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string',  // Role is required
            'user_id' => 'required|string', // User ID is required
            'fullname' => 'required|string|max:255', // Full name is required
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Save the new user to the database
        User::create([
            'user_id' => $request->input('user_id'),
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),  // Role is either 'student' or 'faculty'
        ]);
    
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
    
    public function checkRole($studentId)
    {
        // Check if the ID exists in the wup_automate table (for students)
        if (WupAutomate::where('id_number', $studentId)->exists()) {
            return response()->json(['role' => 'student']); // If student, return student role
        }

        // Check if the ID exists in the faculty table (for faculty)
        if (Faculty::where('id_number', $studentId)->exists()) {
            return response()->json(['role' => 'faculty']); // If faculty, return faculty role
        }

        // If the ID doesn't match either, return null
        return response()->json(['role' => null]);
    }
    public function index()
    {
        // Optional: Check if user is authenticated
        /*
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['login' => 'You must be logged in to access this page.']);
        }
        */

        return view('register'); // Adjust this to the correct path for your dashboard view
    }

    public function verifyUserId($userId)
{
    // Check if the user ID exists in the 'users' table
    $user = User::where('user_id', $userId)->first();

    if ($user) {
        return response()->json([
            'valid' => false,
            'message' => 'This student ID is already registered with an account.'
        ]);
    } else {
        // Check if the student ID is valid (exists in the 'wup_automate' table)
        $student = WupAutomate::where('student_id', $userId)->first();

        if ($student && $student->course == 'BSIT') {
            return response()->json([
                'valid' => true,
                'user_id' => $student->student_id,
                'fullname' => $student->student_name,
                'role' => 'student'
            ]);
        } else {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid student ID or course is not BSIT.'
            ]);
        }
    }
}

}
