@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <!-- Logo Section -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <h1 class="mb-4 text-center">Add Announcement</h1>

    <!-- Card Container -->
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <form action="{{ route('announcements.store') }}" method="POST">
                @csrf

                <!-- Title Field -->
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold text-secondary">Title</label>
                    <input type="text" class="form-control form-control-lg" name="title" id="title" required placeholder="Enter the title of the announcement">
                </div>

                <!-- Date Field -->
                <div class="mb-4">
                    <label for="date" class="form-label fw-bold text-secondary">Date</label>
                    <input type="date" class="form-control form-control-lg" name="date" id="date" required>
                </div>

                <!-- Content Field -->
                <div class="mb-4">
                    <label for="content" class="form-label fw-bold text-secondary">Content</label>
                    <textarea class="form-control form-control-lg" name="content" id="content" rows="5" required placeholder="Write the content of the announcement..."></textarea>
                </div>

                <!-- Button Row -->
                <div class="d-flex justify-content-between">
                    <!-- Cancel Button -->
                    <a href="{{ route('admin.announcements') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>

                    <!-- Save Button -->
                    <button type="submit" class="btn btn-primary btn-lg">Save Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
