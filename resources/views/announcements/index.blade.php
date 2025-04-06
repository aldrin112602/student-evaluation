@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-wrapper p-4 rounded shadow-sm">
        <!-- Success Message -->
        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
            <style>
                #success-alert {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    padding: 15px;
                    border-radius: 10px;
                    font-size: 16px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    opacity: 1;
                    background-color: #4CAF50;
                    color: white;
                    transition: opacity 0.5s ease;
                }
            </style>
            <script>
                window.onload = function() {
                    setTimeout(function() {
                        var alert = document.getElementById('success-alert');
                        if (alert) {
                            alert.style.opacity = '0';
                            setTimeout(function() {
                                alert.style.display = 'none';
                            }, 500);
                        }
                    }, 1500);
                };
            </script>
        @endif

        <!-- Add Announcement Button -->
        @if(auth()->user()->role === 'admin')
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle"></i> Add Announcement
                </a>
            </div>
        @endif

        <!-- Announcements Table -->
        <div class="table-responsive shadow-lg rounded bg-white p-3">
            <table class="table table-hover table-striped">
                <thead class="table-primary">
                    <!-- Announcements Title -->
                    <h1 class="text-center mb-3 title" style="font-size: 1.5rem; font-family: 'Bebas Neue', sans-serif; text-decoration: underline;">
                        Announcements
                    </h1>
                    <hr class="my-4">
                    <tr>
                        <th style="width: 25%;" class="text-center">Title</th>
                        <th style="width: 15%;" class="text-center">Date</th>
                        <th style="width: 40%;" class="text-center">Content</th>
                        @if(auth()->user()->role === 'admin')
                            <th style="width: 20%;" class="text-center">Actions</th>
                        @endif
                        @if(auth()->user()->role == 'student')
                            <th style="width: 20%;" class="text-center">Request</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr class="announcement-row" data-id="{{ $announcement->id }}">
                            <td class="text-center">{{ $announcement->title }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($announcement->date)->format('M d, Y') }}</td>
                            <td class="text-center">{{ $announcement->content }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td class="text-center">
                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1" title="Delete">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            @endif
                            @if(auth()->user()->role == 'student')
                                <td class="text-center">
                                    @php
                                        $existingRequest = DB::table('request_evaluations')
                                            ->where('announcement_id', $announcement->id)
                                            ->where('user_id', auth()->user()->user_id)
                                            ->first();
                                    @endphp

                                    @if($existingRequest && $existingRequest->status == 'pending')
                                        <span class="btn btn-warning disabled">Pending</span>
                                    @elseif(!$existingRequest)
                                        <form action="{{ route('announcements.request', $announcement->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="button" class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#requestModal" data-announcement-id="{{ $announcement->id }}">
                                                <i class="fas fa-paper-plane"></i> Request
                                            </button>
                                        </form>
                                    @else
                                        <span class="btn btn-success disabled">Completed</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Request -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Request Evaluation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Check if there are any grades with issues -->
                @if($gradesWithIssues->isNotEmpty())
                    <p>There are the following course(s) with deficiencies:</p>
                    <ul id="grades-list">
                        <!-- Dynamic list of course codes will be populated here -->
                        @foreach($gradesWithIssues as $grade)
                            <li>{{ $grade->course_code }} - {{ $grade->remarks }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Don't have a course with deficiencies.</p>
                @endif
                <!-- Informational message below -->
                <hr>
                <p style="color: #17a2b8;">
                    <i class="fas fa-info-circle"></i> 
                    If you don't have deficiency subjects, or if you have uploaded the completion form already, you can submit your request for evaluation.
                </p>
            </div>

            <div class="modal-footer">
                <!-- Upload Completion Form Button -->
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('grades.studentgrades') }}'">
                    Upload Completion Form
                </button>
                
                <!-- Form for submitting the request -->
                <form action="{{ route('announcements.request', $announcement->id) }}" method="POST" id="request-form">
                    @csrf
                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // When the modal is shown, check if there are grades with issues
        $('#requestModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var announcementId = button.data('announcement-id'); // Get the announcement ID from the button
            
            // Set the value of the hidden input field with the announcement ID
            var form = $(this).find('form');
            form.find('#announcement_id').val(announcementId); // Correctly set the ID value

            // If there are grades with issues, populate the modal's body with the course codes
            var gradesWithIssues = @json($gradesWithIssues); // Pass the grades data to JS

            var modalBody = $(this).find('.modal-body');
            modalBody.empty(); // Clear any previous data
            
            if (gradesWithIssues.length > 0) {
                modalBody.append('<p>There are the following course(s) with deficiencies:</p>');
                var ul = $('<ul></ul>');
                gradesWithIssues.forEach(function(grade) {
                    ul.append('<li>' + grade.course_code + ' - ' + grade.remarks + '</li>');
                });
                modalBody.append(ul);
            } else {
                modalBody.append('<p>Dont have deficiency subjects.</p>');
            }
        });
    });
</script>
@endsection
