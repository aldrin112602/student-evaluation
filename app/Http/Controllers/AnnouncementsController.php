<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementsController extends Controller
{
    // Display all non-archived announcements
    public function index()
{
    // Get all announcements that are not archived
    $announcements = Announcement::where('archived', false)->get();

    // Get grades with remarks "Lacking Requirement" or "Failed" for the current student
    $gradesWithIssues = DB::table('grades')
                          ->where('student_id', auth()->user()->user_id)
                          ->whereIn('remarks', ['Lacking Requirement', 'Failed', 'Incomplete', 'No Exam', 'No Permit'])
                          ->get();

    // Pass both the announcements and the grades with issues to the view
    return view('announcements.index', compact('announcements', 'gradesWithIssues'));
}


    // Show the form to create a new announcement
    public function create()
    {
        return view('announcements.create');
    }

    // Store a new announcement in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'content' => 'required|string',
        ]);

        // Create the new announcement
        Announcement::create([
            'title' => $request->title,
            'date' => $request->date,
            'content' => $request->content,
            'archived' => false,  // New announcements are not archived by default
        ]);

        // Redirect to the announcements index with a success message
        return redirect()->route('admin.announcements')->with('success', 'Announcement created successfully.');
    }

    // Archive an existing announcement
    public function archive($id)
    {
        // Find the announcement by ID
        $announcement = Announcement::findOrFail($id);

        // Update the 'archived' status to true
        $announcement->update(['archived' => true]);

        // Redirect to the announcements index with a success message
        return redirect()->route('announcements.index')->with('success', 'Announcement archived successfully.');
    }

    public function update(Request $request, Announcement $announcement)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'content' => 'required|string',
        ]);

        // Update the announcement data
        $announcement->update([
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'content' => $request->input('content'),
        ]);

        // Redirect back to the announcements index with a success message
        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully!');
    }
    
    public function destroy($id)
    {
        // Find the announcement by ID
        $announcement = Announcement::findOrFail($id);

        // Delete the announcement
        $announcement->delete();

        // Redirect back with a success message
        return redirect()->route('admin.announcements')->with('success', 'Announcement deleted successfully.');
    }

    public function request($announcementId)
    {
        // Check if the user is a student
        if (auth()->user()->role != 'student') {
            return redirect()->route('announcements.index')->with('error', 'You are not authorized to make a request.');
        }

        $userId = auth()->user()->user_id;

        // Check if the user has already requested this announcement and its status
        $existingRequest = DB::table('request_evaluations')
                             ->where('announcement_id', $announcementId)
                             ->where('user_id', $userId)
                             ->first();

        if ($existingRequest) {
            if ($existingRequest->status == 'pending') {
                return redirect()->route('announcements.index')->with('error', 'You have already submitted a request for this announcement.');
            }
        }

        // Insert the request into the database with 'pending' status
        DB::table('request_evaluations')->insert([
            'announcement_id' => $announcementId,
            'user_id' => $userId,
            'status' => 'pending', // Set the status to 'pending'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('announcements.index')->with('success', 'Your request has been submitted and is pending approval!');
    }
    
    
}
