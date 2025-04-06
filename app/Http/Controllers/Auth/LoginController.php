<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Return the login view for the user
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Log login attempt for monitoring
        Log::info('Login attempt:', $request->only('username'));

        // Retrieve the user by username
        $user = \App\Models\User::where('username', $request->input('username'))->first();

        if ($user) {
            // Check if the password matches either hashed or plain text
            if (Hash::check($request->input('password'), $user->password) || $user->password === $request->input('password')) {
                // Check if the user has the 'student' role
                if ($user->role === 'student') {
                    // Log the user in
                    Auth::login($user);
                    Log::info('Login successful for student: ' . $request->input('username'));

                    // Redirect to the intended page, defaulting to dashboard
                    return redirect()->intended('dashboard')->with('success', 'Welcome back!');
                } else {
                    // If the user is not a student, deny access
                    Log::warning('Login failed for non-student user: ' . $request->input('username'));
                    return redirect()->back()->withErrors(['username' => 'You are not authorized to access this page.'])->withInput();
                }
            }
        }

        // Failed login attempt
        Log::warning('Login failed for user: ' . $request->input('username'));
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        // Log out the authenticated user
        Auth::logout();

        // Invalidate the session to ensure the user cannot access protected routes
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear the session from the user's browser (prevent back button access)
        $response = redirect('/')->with('success', 'You have been logged out.');

        // Add headers to prevent browser cache for authenticated pages
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}
