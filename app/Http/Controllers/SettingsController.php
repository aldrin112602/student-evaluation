<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Add this to use Auth for accessing the authenticated user
use Illuminate\Support\Facades\Hash;
class SettingsController extends Controller
{
    public function edit()
    {
        // Get the authenticated user
        $user = Auth::user();  // Get the currently logged-in user

        // Pass the user data to the view
        return view('settings.settings', compact('user'));  // 'user' will be available in the view
    }

    public function update(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Password validation
        ]);

        // Update user details
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);  // Update password if provided
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        // Redirect back to settings with a success message
        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully!');
    }
    public function verifyCurrentPassword(Request $request)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Validate the incoming current_password field
        $request->validate([
            'current_password' => 'required|string',
        ]);

        // Check if the current password matches the stored password
        if (Hash::check($request->current_password, $user->password)) {
            // If password is correct, return a success response
            return response()->json(['success' => true]);
        } else {
            // If password is incorrect, return a failure response
            return response()->json(['success' => false, 'message' => 'Current password is incorrect.']);
        }
    }
    
}
