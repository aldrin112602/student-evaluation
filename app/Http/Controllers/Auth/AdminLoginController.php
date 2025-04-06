<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminLoginController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('auth.admin-login'); // Return the admin login view
    }

    // Handle admin login
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Log login attempt for monitoring
        Log::info('Admin Login attempt:', $request->only('username'));

        // Check for hardcoded admin credentials
        if ($request->input('username') === 'admin' && $request->input('password') === 'password123') {
            // Hardcode the admin role to ensure this account always has 'admin' role
            $admin = User::where('username', 'admin')->first();
            if (!$admin) {
                // If the admin doesn't exist, create it
                $admin = User::create([
                    'username' => 'admin',
                    'password' => Hash::make('password123'),
                    'role' => 'admin',
                ]);
            }

            // Log the user in
            Auth::login($admin);
            return redirect()->route('admin.welcome'); // Redirect to the admin dashboard
        }

        // Retrieve the user by username for regular login
        $user = User::where('username', $request->input('username'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Check if the user has 'admin' or 'faculty' role
            if ($user->role === 'admin' || $user->role === 'faculty') {
                // Log the user in
                Auth::login($user);
                return redirect()->route('admin.welcome'); // Redirect to the admin dashboard
            } else {
                // If the user does not have the correct role
                Log::warning('User does not have the correct role for login: ' . $request->input('username'));
                return redirect()->back()->withErrors(['username' => 'You are not authorized to access this page.'])->withInput();
            }
        }

        // Failed login attempt
        Log::warning('Admin Login failed for user: ' . $request->input('username'));
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

     // Handle logout and redirect to admin login page
     public function logout()
     {
         Auth::guard('web')->logout();  // Log out the user
         return redirect()->route('admin.login');  // Redirect to login page
     }
}
