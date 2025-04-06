<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAnnouncementsController extends Controller
{
    // Display all non-archived announcements
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();

        // Get all announcements that are not archived
        $announcements = Announcement::where('archived', false)->get();
        return view('admin.announcements', compact('announcements'));
    }

    // Show the form to create a new announcement
    public function create()
    {
        return view('admin.announcements');
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
        return redirect()->route('admin.announcements')->with('success', 'Announcement archived successfully.');
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
        return redirect()->route('admin.announcements')->with('success', 'Announcement updated successfully!');
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
}
