@extends('layouts.app')

@section('content')
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-4 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-8">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6 d-flex align-items-center" 
                            style="background-image: url('{{ asset('images/wesleyan.jPg') }}'); background-size: cover; background-position: center;">
                        </div>

                        <div class="col-lg-6">
                            <div class="card-body p-md-4 mx-md-3">
                                <div class="text-center">
                                    <img src="{{ asset('images/logo.jpg') }}" 
                                         style="width: 150px;" alt="logo">
                                    <h4 class="mt-1 mb-4 pb-1">Student Evaluation System</h4>
                                    <h5 class="mb-3">Register</h5>
                                </div>

                                <!-- Display Success and Error Messages -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- ID Number (pre-filled from the modal) -->
                                    <div class="form-outline mb-3">
                                        <label for="user_id_field" class="form-label">ID Number</label>
                                        <input type="text" class="form-control" id="user_id_field" name="user_id" value="{{ old('user_id', $userId) }}" readonly>
                                    </div>

                                    <!-- Full Name (pre-filled from the modal) -->
                                    <div class="form-outline mb-3">
                                        <label for="fullname_field" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullname_field" name="fullname" value="{{ old('fullname', $fullname) }}" readonly>
                                    </div>

                                    <!-- Username -->
                                    <div class="form-outline mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" placeholder="Enter your username here" class="form-control" id="username" name="username" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-outline mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email"  placeholder="Enter your email address here" class="form-control" id="email" name="email" required>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-outline mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" placeholder="Enter your password" class="form-control" id="password" name="password" required>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-outline mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" placeholder="Re-enter your password" class="form-control" id="confirm_password" name="password_confirmation" required>
                                    </div>

                                    <!-- Role (Hidden Field) -->
                                    <input type="hidden" name="role" id="role" value="{{ old('role', $role) }}" required>

                                    <!-- Role Selection (Visually Hidden, but Submitted with Form) -->
                                    <div class="mb-3" style="display: none;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role_student" value="student" 
                                                {{ old('role', $role) == 'student' ? 'checked' : '' }} 
                                                disabled>
                                            <label class="form-check-label" for="role_student">Student</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role_faculty" value="faculty" 
                                                {{ old('role', $role) == 'faculty' ? 'checked' : '' }} 
                                                disabled>
                                            <label class="form-check-label" for="role_faculty">Faculty</label>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center pt-1 mb-4 pb-1">
                                        <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                style="font-size: 1.1rem; padding: 12px 25px; width: 80%; max-width: 350px;">
                                            Register
                                        </button>
                                    </div>
                                </form>
                                <!-- Go Back to Login Button -->
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="btn btn-link">Go Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const studentIdField = document.getElementById('user_id_field');
        const fullnameField = document.getElementById('fullname_field');
        const roleStudent = document.getElementById('role_student');
        const roleFaculty = document.getElementById('role_faculty');

        // Retrieve values from local storage (or directly passed from backend)
        const userId = localStorage.getItem('userId');
        const fullname = localStorage.getItem('fullname');
        const role = localStorage.getItem('role');

        // If values exist, fill the fields
        if (userId) {
            studentIdField.value = userId;
        }
        if (fullname) {
            fullnameField.value = fullname;
        }

        if (role === 'student') {
            roleStudent.checked = true;
            roleFaculty.checked = false;
            document.getElementById('role').value = 'student'; // Set the hidden field to student
        }
        if (role === 'faculty') {
            roleFaculty.checked = true;
            roleStudent.checked = false;
            document.getElementById('role').value = 'faculty'; // Set the hidden field to faculty
        }

        // Clear local storage after use
        localStorage.removeItem('userId');
        localStorage.removeItem('fullname');
        localStorage.removeItem('role');
    });
</script>

@endsection
