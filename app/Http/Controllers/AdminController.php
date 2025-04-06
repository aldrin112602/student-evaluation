<?php

namespace App\Http\Controllers;

use App\Models\Admin;  // Ensure this is imported
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard with a list of admins
    public function index()
    {
        // Fetch all admins from the database
        $admins = Admin::all();  // Make sure this is fetching the data

        // Pass the admins data to the view
        return view('admin.admin', compact('admins'));  // Pass $admins to the view
    }

    // Store a new admin
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'username' => 'required|unique:admins,username|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin
        Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),  // Hash the password
        ]);

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.index')->with('success', 'Admin added successfully!');
    }
    // Archive an admin
    public function archive($id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Toggle the archived status
        $admin->archived = !$admin->archived;
        $admin->save();

        // Redirect back with success message
        return redirect()->route('admin.index')->with('success', 'Admin status updated successfully!');
    }
    
}
