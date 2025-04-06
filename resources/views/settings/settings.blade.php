@extends('layouts.app')

@section('content')

<div class="container">
    <div class="settings-form p-5 rounded shadow-lg bg-white">
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

            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Form Fields -->
                <div class="row mb-4 align-items-center">

                    <!-- Form Fields -->
                    <div class="col-md-8">
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
                    <div class="col-md-4 d-none d-md-block">
                        <div class="parallelogram-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid parallelogram-shape">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary custom-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('change-password-toggle').addEventListener('change', function() {
        var passwordFields = document.getElementById('password-fields');
        var currentPasswordField = document.getElementById('current-password-field');
        
        if (this.checked) {
            passwordFields.style.display = 'block';
            currentPasswordField.style.display = 'block';  // Show the current password field
        } else {
            passwordFields.style.display = 'none';
            currentPasswordField.style.display = 'none';  // Hide the current password field
        }
    });

    document.getElementById('current_password').addEventListener('input', function() {
        var currentPassword = this.value;
        var passwordFields = document.getElementById('password-fields');
        var passwordInput = document.getElementById('password');
        var passwordConfirmationInput = document.getElementById('password_confirmation');
        var currentPasswordMessage = document.getElementById('current-password-message');
        var currentPasswordValidMessage = document.getElementById('current-password-valid-message');
        
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
                passwordInput.disabled = false;
                passwordConfirmationInput.disabled = false;
                currentPasswordMessage.style.display = 'none';
                currentPasswordValidMessage.style.display = 'inline';
            } else {
                passwordInput.disabled = true;
                passwordConfirmationInput.disabled = true;
                currentPasswordValidMessage.style.display = 'none';
                currentPasswordMessage.style.display = 'inline';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('password').addEventListener('input', function() {
        var password = this.value;
        var passwordConfirmation = document.getElementById('password_confirmation').value;
        var passwordConfirmationMessage = document.getElementById('password-confirmation-message');
        var passwordConfirmationValidMessage = document.getElementById('password-confirmation-valid-message');

        if (password !== passwordConfirmation) {
            passwordConfirmationMessage.style.display = 'inline';
            passwordConfirmationValidMessage.style.display = 'none';
        } else {
            passwordConfirmationMessage.style.display = 'none';
            passwordConfirmationValidMessage.style.display = 'inline';
        }
    });

    document.getElementById('password_confirmation').addEventListener('input', function() {
        var password = document.getElementById('password').value;
        var passwordConfirmation = this.value;
        var passwordConfirmationMessage = document.getElementById('password-confirmation-message');
        var passwordConfirmationValidMessage = document.getElementById('password-confirmation-valid-message');

        if (password !== passwordConfirmation) {
            passwordConfirmationMessage.style.display = 'inline';
            passwordConfirmationValidMessage.style.display = 'none';
        } else {
            passwordConfirmationMessage.style.display = 'none';
            passwordConfirmationValidMessage.style.display = 'inline';
        }
    });
</script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7fa;
    }

    .settings-form {
        border-radius: 12px;
        background-color: #fff;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .form-control.custom-input {
        height: 50px;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control.custom-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .settings {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        color: #333;
    }

    .btn.custom-btn {
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
    }

    .btn.custom-btn:hover {
        background-color: #0056b3;
    }

    .parallelogram-container {
        overflow: hidden;
        position: relative;
    }

    .parallelogram-shape {
        width: 100%;
        transform: skewX(-20deg);
        transform-origin: center center;
    }

    @media (max-width: 768px) {
        .col-md-8 {
            width: 100%;
        }

        .col-md-4 {
            display: none;
        }
    }

    hr {
        border-top: 2px solid #007bff;
    }
</style>

@endsection
