@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; 
background-image: url('{{ asset('images/bg.jpg') }}'); 
background-size: cover; 
background-position: center; 
background-attachment: fixed; 
position: relative;">

    <!-- Overlay to darken background for readability -->
    <div class="position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>

    <!-- Centered Row Section -->
    <div class="row text-center shadow-lg rounded p-5" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 15px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); position: relative; align-items: center; transition: transform 0.3s ease-in-out;">
        
        <!-- Wesleyan Logo (Left Side) -->
        <div class="col-md-4 mb-4 d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/wesleyanlogo.jpg') }}" alt="Wesleyan Logo" class="img-fluid logo-animation" style="width: 120px; height: 120px; object-fit: contain; border: 3px solid #118B50; transition: transform 0.3s ease-in-out;">
        </div>

        <!-- Main Text Section (Center) -->
        <div class="col-md-4 mb-4 d-flex justify-content-center align-items-center">
            <div>
                <h1 class="display-4 text-primary font-weight-bold mb-3 animate__animated animate__fadeIn" style="font-family: 'Arial', sans-serif; animation-duration: 1s;">Student Evaluation System</h1>
                <p class="lead text-secondary" style="font-size: 1.2rem; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">For the Bachelor of Science in Information Technology at Wesleyan University Philippines</p>
                <p class="text-muted" style="font-size: 1.1rem; animation-duration: 1s; animation-delay: 1s; animation-name: fadeInUp;">Manage student evaluations, view reports, and more. You have full access to all administrative features.</p>
            </div>
        </div>

        <!-- BSIT Logo (Right Side) -->
        <div class="col-md-4 mb-4 d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="BSIT Logo" class="img-fluid logo-animation" style="width: 120px; height: 120px; object-fit: contain; border: 3px solid #007bff; transition: transform 0.3s ease-in-out;">
        </div>
    </div>

</div>

<!-- Additional CSS for Animation -->
<style>
    .logo-animation:hover {
        transform: scale(1.1);
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
    }

    /* FadeInUp Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate__fadeIn {
        animation-name: fadeInUp;
    }
</style>

@endsection
