<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Optional: Check if user is authenticated
        /*
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['login' => 'You must be logged in to access this page.']);
        }
        */

        return view('dashboard'); // Adjust this to the correct path for your dashboard view
    }
}
