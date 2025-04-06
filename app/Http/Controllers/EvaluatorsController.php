<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash; // Include Hash facade
use App\Models\User; // Use the User model
use Illuminate\Http\Request;

class EvaluatorsController extends Controller
{
    // Show all evaluators (Faculty role)
    public function index()
    {
        // Fetch users with the 'faculty' role only
        $evaluators = User::where('role', 'faculty')->get(); // Get all users where role is 'faculty'

        return view('evaluators.evaluators', compact('evaluators'));
    }

    // Store a new evaluator (Faculty)
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|unique:users,user_id',
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Store the password as plain text first, and hash it before storing
        $password = $request->password;
        $hashedPassword = Hash::make($password); // Hash the password before storing

        // Create the evaluator (faculty) user
        User::create([
            'user_id' => $request->user_id,
            'fullname' => $request->fullname,
            'username' => $request->username,
            // 'email' => $request->email,
            'password' => $hashedPassword, // Store the hashed password
            'original_password' => $password, // Store the original password to display later
            'role' => 'faculty', // Set the user role to 'faculty'
        ]);

        return redirect()->route('evaluators.index')->with('success', 'Evaluator added successfully.');
    }
}
