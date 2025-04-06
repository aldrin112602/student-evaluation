@extends('layouts.admin')

@section('content')

<div class="container">

    <!-- Settings Form -->
    <div class="content-wrapper p-5 border rounded-lg shadow-lg bg-white">
        <div class="card-body">

            <!-- Form Header -->
            <h1 class="mb-4 settings text-center">Settings</h1>

            <!-- Horizontal Line Separator -->
            <hr class="my-4">

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Form Fields with Logo on the Right -->
                <div class="row mb-4 align-items-center">

                    <!-- Form Fields -->
                    <div class="col-md-9">
                        <!-- Full Name and User ID in one line -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="text" class="form-control custom-input" id="user_id" value="{{ $user->user_id }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control custom-input" id="fullname" value="{{ $user->fullname }}" readonly>
                            </div>
                        </div>

                        <!-- Username and Email in one line -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control custom-input" name="username" id="username" value="{{ $user->username }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control custom-input" name="email" id="email" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <!-- Change Password Option (Checkbox) -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="change-password-toggle">
                            <label class="form-check-label" for="change-password-toggle">Change Password</label>
                        </div>

                        <!-- Current Password Field (Initially Hidden) -->
                        <div id="current-password-field" style="display: none;">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control custom-input" name="current_password" id="current_password">
                                <span id="current-password-message" class="text-danger" style="display:none;">
                                    <i class="fas fa-times-circle"></i> Incorrect Password
                                </span>
                                <span id="current-password-valid-message" class="text-success" style="display:none;">
                                    <i class="fas fa-check-circle"></i> Password is correct
                                </span>
                            </div>
                        </div>

                        <!-- Password and Password Confirmation Fields (Initially Hidden and Disabled) -->
                        <div id="password-fields" style="display: none;">
                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control custom-input" name="password" id="password" disabled>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control custom-input" name="password_confirmation" id="password_confirmation" disabled>
                                <span id="password-confirmation-message" class="text-danger" style="display:none;">
                                    <i class="fas fa-times-circle"></i> Passwords do not match
                                </span>
                                <span id="password-confirmation-valid-message" class="text-success" style="display:none;">
                                    <i class="fas fa-check-circle"></i> Passwords match
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Logo on the Right in Parallelogram Shape -->
                    <div class="col-md-3 d-none d-md-block">
                        <div class="parallelogram-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid parallelogram-shape">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-25 custom-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script to toggle password fields and current password -->
<script>
    document.getElementById('change-password-toggle').addEventListener('change', function() {
        var passwordFields = document.getElementById('password-fields');
        var currentPasswordField = document.getElementById('current-password-field');
        
        // Toggle visibility of password fields and current password field based on checkbox status
        if (this.checked) {
            passwordFields.style.display = 'block';
            currentPasswordField.style.display = 'block';  // Show the current password field
        } else {
            passwordFields.style.display = 'none';
            currentPasswordField.style.display = 'none';  // Hide the current password field
        }
    });

    // Script to check current password and enable/disable password fields
    document.getElementById('current_password').addEventListener('input', function() {
        var currentPassword = this.value;
        var passwordFields = document.getElementById('password-fields');
        var passwordInput = document.getElementById('password');
        var passwordConfirmationInput = document.getElementById('password_confirmation');
        var currentPasswordMessage = document.getElementById('current-password-message');
        var currentPasswordValidMessage = document.getElementById('current-password-valid-message');
        
        // Perform an AJAX request to verify the current password
        fetch('{{ route('settings.verify_current_password') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ current_password: currentPassword })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Enable password fields if the current password is correct
                passwordInput.disabled = false;
                passwordConfirmationInput.disabled = false;
                currentPasswordMessage.style.display = 'none';  // Hide incorrect password message
                currentPasswordValidMessage.style.display = 'inline';  // Show valid password message
            } else {
                // Disable password fields if the current password is incorrect
                passwordInput.disabled = true;
                passwordConfirmationInput.disabled = true;
                currentPasswordValidMessage.style.display = 'none';  // Hide valid password message
                currentPasswordMessage.style.display = 'inline';  // Show incorrect password message
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Script to check if the passwords match
    document.getElementById('password').addEventListener('input', function() {
        var password = this.value;
        var passwordConfirmation = document.getElementById('password_confirmation').value;
        var passwordConfirmationMessage = document.getElementById('password-confirmation-message');
        var passwordConfirmationValidMessage = document.getElementById('password-confirmation-valid-message');

        if (password !== passwordConfirmation) {
            passwordConfirmationMessage.style.display = 'inline';  // Show mismatch message
            passwordConfirmationValidMessage.style.display = 'none';  // Hide match message
        } else {
            passwordConfirmationMessage.style.display = 'none';  // Hide mismatch message
            passwordConfirmationValidMessage.style.display = 'inline';  // Show match message
        }
    });

    document.getElementById('password_confirmation').addEventListener('input', function() {
        var password = document.getElementById('password').value;
        var passwordConfirmation = this.value;
        var passwordConfirmationMessage = document.getElementById('password-confirmation-message');
        var passwordConfirmationValidMessage = document.getElementById('password-confirmation-valid-message');

        if (password !== passwordConfirmation) {
            passwordConfirmationMessage.style.display = 'inline';  // Show mismatch message
            passwordConfirmationValidMessage.style.display = 'none';  // Hide match message
        } else {
            passwordConfirmationMessage.style.display = 'none';  // Hide mismatch message
            passwordConfirmationValidMessage.style.display = 'inline';  // Show match message
        }
    });
</script>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }

    .content-wrapper {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .form-control.custom-input {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-control.custom-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    .settings {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .parallelogram-container {
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .parallelogram-shape {
        width: 100%;
        transform: skewX(-20deg);
    }

    .btn.custom-btn {
        padding: 12px 40px;
        border-radius: 25px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
    }

    .btn.custom-btn:hover {
        background-color: #0056b3;
    }

    .alert.alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    hr {
        border-top: 2px solid #007bff;
    }
</style>

@endsection
