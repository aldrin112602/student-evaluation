<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Show the login form
    public function create()
    {
        return view('auth.login');
    }

    // Handle login
    public function store(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Redirect to the dashboard on success
            return redirect()->intended('dashboard')->with('success', 'Welcome back!');
        }

        // Redirect back with an error message if login fails
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

    // Handle logout
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
