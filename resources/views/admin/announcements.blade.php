@extends('layouts.admin')

@section('content')
<div class="container-fluid px-5 py-4">

    <!-- Announcements Title -->
    <h1 class="text-center mb-4 text-dark" style="font-size: 3rem; font-family: 'Roboto', sans-serif; font-weight: 700;">Announcements</h1>

    <!-- Horizontal Line Separator -->
    <hr class="my-4 border-top border-dark">

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
            width: auto;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s ease;
            opacity: 1;
        }
        #success-alert {
            background-color: #4CAF50;
            color: white;
        }
        #success-alert strong {
            font-weight: bold;
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
        <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus-circle"></i> Add Announcement
        </a>
    </div>
    @endif

    <!-- Announcements Table -->
    <div class="table-responsive shadow-lg rounded bg-white p-3">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Title</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Content</th>
                    @if(auth()->user()->role === 'admin')
                    <th class="text-center">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                <tr>
                    <td class="text-center">{{ $announcement->title }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}</td>
                    <td class="text-center">{{ Str::limit($announcement->content, 50) }}</td>
                    @if(auth()->user()->role === 'admin')
                    <td class="text-center">
                        <!-- Delete Button -->
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Editing Announcement -->
    <div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAnnouncementForm" method="POST" action="{{ route('announcements.update', 'announcement_id') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="editDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="editDate" name="date" required>
                        </div>

                        <div class="mb-3">
                            <label for="editContent" class="form-label">Content</label>
                            <textarea class="form-control" id="editContent" name="content" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
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
        $('#editAnnouncementModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var announcementId = button.data('id');
            var title = button.data('title');
            var date = button.data('date');
            var content = button.data('content');

            var modal = $(this);
            modal.find('#editTitle').val(title);
            modal.find('#editDate').val(date);
            modal.find('#editContent').val(content);

            var actionUrl = '{{ route('announcements.update', ':id') }}'.replace(':id', announcementId);
            modal.find('#editAnnouncementForm').attr('action', actionUrl);
        });
    });
</script>

<style>
    .content-wrapper {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-lg {
        font-size: 1.1rem;
        padding: 0.8rem 1.4rem;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table-dark th, .table-dark td {
        color: #fff;
        background-color: #343a40;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .modal-footer .btn-secondary {
        border-radius: 25px;
    }

    .btn-primary, .btn-danger {
        border-radius: 25px;
    }

    .modal-body .form-label {
        font-weight: 600;
    }

    .modal-body input, .modal-body textarea {
        border-radius: 10px;
        border: 1px solid #ddd;
    }
</style>

@endsection
