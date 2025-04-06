@extends('layouts.admin')

<section class="gradient-form" style="position: relative;">
  <div class="background-overlay"></div> <!-- Overlay for opacity effect -->
  <div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-xl-8 col-lg-10 col-md-12 col-12">
        <div class="card rounded-3 shadow-lg border-0">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-4 p-md-5">
                <div class="text-center mb-2">  <!-- Reduced margin between elements -->
                  <img src="{{ asset('images/logo.jpg') }}" class="w-25 mb-3" alt="Logo">
                  <h4 class="mt-3 mb-2 pb-1 text-dark">Admin/Faculty Login</h4>  <!-- Reduced margin here -->
                </div>
                <form method="POST" action="{{ route('admin.login') }}">
                  @csrf
                  <p class="text-center text-dark mb-2">Please login to your admin account</p>  <!-- Reduced margin here -->

                  @if ($errors->any())
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                      <strong>Error!</strong>
                      <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <div class="form-outline mb-4">
                  <label class="form-label" for="username">Username</label>

                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}" required autocomplete="username" autofocus 
                           placeholder="Enter your username here">
                    @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password" placeholder="Enter your password here">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button type="submit" class="btn btn-warning btn-block mb-3" style="font-size: 1.25rem; padding: 5px 75px; width: auto; border-radius: 30px;">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Custom CSS -->
<style>
  /* Page Styles */
  body, html {
    height: 100%;
    font-family: 'Roboto', sans-serif;
  }

  .gradient-form {
    height: 100vh;
    position: relative;
    overflow: hidden;
  }

  /* Background image and opacity effect */
  .background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('images/wesleyan.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    opacity: 0.5; /* Adjust opacity here for transparency */
    z-index: -1; /* Ensure the overlay stays behind the content */
  }

  /* Form Container Styling */
  .card {
    border-radius: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Margin at the top */
    margin-bottom: 20px; /* Margin at the bottom */
    width: 75%; /* Make the card wider for landscape */
    max-width: 900px; /* Set a max width for better control */
    margin-left: auto;
    margin-right: auto;
  }

  .form-outline input {
    border-radius: 1rem;
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 1rem;
  }

  .form-outline input:focus {
    border-color: #f39c12;
    box-shadow: 0 0 8px rgba(243, 156, 18, 0.7);
  }

  .form-label {
    font-weight: bold;
    font-size: 1.1rem;
  }

  /* Error Alert Styling */
  #error-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    width: auto;
    padding: 15px;
    border-radius: 10px;
    font-size: 16px;
    background-color: #e74c3c;
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  #error-alert strong {
    font-weight: bold;
  }

  #error-alert ul {
    margin: 0;
  }

  #error-alert li {
    list-style-type: none;
  }

  /* Button Styling */
  .btn-warning {
    background-color: #f39c12;
    color: white;
    font-size: 1.25rem;
    padding: 15px 30px;
    border-radius: 50px;
    width: 100%;
    transition: background-color 0.3s;
  }

  .btn-warning:hover {
    background-color: #e67e22;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .card {
      padding-top: 20px;
      padding-bottom: 20px;
      width: 95%; /* Adjust card width on smaller screens */
    }
    .form-outline input {
      padding: 12px;
    }
  }
</style>
