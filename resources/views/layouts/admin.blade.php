<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Student Evaluation System') }} - Admin Dashboard</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/js/app.js'])

    <style>
        /* Layout Styles */
        body, html {
            height: 100%;
            margin: 0;
        }

        /* Wrapper for Sidebar and Content */
        .wrapper {
            display: flex;
            height: 100vh; /* Full height */
            padding-top: 56px; /* Ensure content does not overlap with navbar */
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #ccc;
            position: fixed;
            top: 56px; /* Adjust sidebar to start just below the navbar */
            left: 0;
            height: calc(100% - 56px); /* Adjust height to avoid overlap with navbar */
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1);
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: #ccc;
            padding: 12px 20px;
            font-size: 18px;
            text-decoration: none;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #495057;
            color: #fff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Content Styles */
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Account for sidebar width */
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Ensures navbar stays on top of other elements */
        }

        /* Display the sidebar and navbar when authenticated */
        @auth
            .sidebar, .navbar {
                display: block;
            }
        @endauth

        /* Full screen login page */
        .gradient-form {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2c3e50;
        }

        /* Apply styling to show sidebar and navbar only when not on the login page */
        @if (Request::is('admin/login'))
            .sidebar, .navbar {
                display: none !important;
            }
        @endif
    </style>
</head>

<body>
    @auth
        <!-- Navbar visible on authenticated pages -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo on the left side -->
        <img src="/images/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
        
        <!-- Title text -->
        <h1 class="navbar-brand">Student Evaluation System</h1>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <!-- Logout link for authenticated users (moved to sidebar now) -->
                </li>
            </ul>
        </div>
    </div>
</nav>

    @endauth

    <div class="wrapper">
        @auth
            <!-- Sidebar visible on authenticated pages -->
            <div class="sidebar">
                <nav class="nav flex-column">
                    <!-- Admin can see all the links -->
                    @if (auth()->user()->role == 'admin')
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('admin.announcements') }}">
                            <i class="fas fa-bullhorn"></i> Announcement
                        </a>
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="fas fa-user-graduate"></i> Students
                        </a>
                       
                        <a class="nav-link" href="{{ route('evaluators.index') }}">
                            <i class="fas fa-users-cog"></i> Evaluators
                        </a>
                        <a class="nav-link" href="{{ route('admin.settings') }}">
                            <i class="fas fa-cogs"></i> Settings
                        </a>
                    @elseif (auth()->user()->role == 'faculty')
                        <!-- Faculty has limited access -->
                        <a class="nav-link" href="{{ route('admin.announcements') }}">
                            <i class="fas fa-bullhorn"></i> Announcement
                        </a>
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="fas fa-user-graduate"></i> Evaluation
                        </a>

                        
                        <a class="nav-link" href="{{ route('admin.settings') }}">
                            <i class="fas fa-cogs"></i> Settings
                        </a>
                    @endif
                    
                    <!-- Logout button for both Admin and Faculty -->
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link text-danger bg-transparent border-0">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>

                </nav>
            </div>
        @endauth

        <div class="content">
            @guest
                <!-- Login form content for guests -->
                @yield('content')
            @endguest

            @auth
                <!-- Content for authenticated users -->
                @yield('content')
            @endauth
        </div>
    </div>

    <!-- At the bottom of your layouts.admin blade file, right before closing </body> -->
  
  <!-- Bootstrap 5 JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

    <!-- Include JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
