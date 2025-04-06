@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to open the modal to add a new admin -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
        Add Admin
    </button>

    <!-- Admins Table -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Archived</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->username }}</td>
                    <td>{{ $admin->archived ? 'Yes' : 'No' }}</td>
                    <td>
                        <!-- Archive Button -->
                        <form action="{{ route('admin.archive', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning">
                                {{ $admin->archived ? 'Unarchive' : 'Archive' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Adding Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
