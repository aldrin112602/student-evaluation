<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    // Show upload form
    public function showUploadForm()
    {
        // Check if the user has uploaded any files
        $files = Storage::files('uploads/completion_forms');  // Path to folder
        return view('upload.form.upload-form', compact('files'));
    }

    // Handle image upload
    public function uploadImage(Request $request)
    {
        // Validate the file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the file
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file in the 'uploads/completion_forms' folder
        $path = $file->storeAs('uploads/completion_forms', $filename);

        // Return to the form with a success message
        return redirect()->route('upload-form.upload.form')->with('success', 'Image uploaded successfully!');
    }
}
