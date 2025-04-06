<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Student Evaluation System') }}</title>
    <link rel="icon" href="{{ asset(env('APP_FAVICON_PATH')) }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/js/app.js'])
    <style>
        body {
            background-color: grey;
        }
        /* Fixed Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            background-color: #343a40;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #ccc;
        }

        /* Content Styling */
        .content {
            margin-top: 80px;
            margin-left: 250px;
            padding: 20px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px; /* Initial width */
            background-color: white;
            border-right: 3px solid #A9A9A9;
            padding-top: 20px;
            height: 100%;
            overflow-y: auto;
            z-index: 99;
            border-radius: 10px;
            box-shadow: 4px 0px 6px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease-in-out; /* Smooth transition for resizing */
        }

        /* Resizing Handle */
        .sidebar-resize {
            position: absolute;
            top: 0;
            right: -5px; /* Position the resize handle at the right edge */
            width: 10px;
            height: 100%;
            cursor: ew-resize; /* Resize cursor */
            background-color: #ccc;
            border-radius: 5px;
        }

        /* Sidebar links inside rounded "form-like" containers */
        .sidebar .form-link-container {
            background-color: #ffffff;
            border-radius: 25px;
            margin-bottom: 10px;
            padding: 5px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Sidebar links */
        .sidebar .nav-link {
            color: #000000;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            border-radius: 25px;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover effect on sidebar links */
        .sidebar .form-link-container:hover {
            background-color: #b3e5fc;
        }

        .sidebar .nav-link:hover {
            background-color: transparent;
        }

        /* Sidebar icons */
        .sidebar .nav-link i {
            margin-right: 10px;
            color: #000000;
        }

        /* Ensure the sidebar links are not pushed off screen */
        .sidebar .nav-link.logout {
            margin-top: auto;
        }

        /* Adjust the logo size inside the navbar */
        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }

        /* Adjust the page layout for small screens */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                height: auto;
                width: 100%;
                top: 56px;
                left: 0;
            }

            .content {
                margin-left: 0;
                margin-top: 90px;
            }
        }

    </style>

</head>
<body>
    <div class="container-fluid p-0">
        <!-- Top Navigation Bar -->
        @include('layouts.navigation')

        <!-- Sidebar for All Users: Dashboard, Students, Announcements, Evaluators, Grades, and Settings Pages -->
        @if(Request::is('dashboard') ||  Request::is('announcements') || Request::is('grades/studentgrades') || Request::is('settings') || Request::is('admin') || Request::is('faculty/grades') || Request::is('evaluations') )
        <div class="sidebar">
            <div class="sidebar-resize"></div> <!-- Resizing Handle -->
            <nav class="nav flex-column">
                <div class="form-link-container">
                    <a class="nav-link" href="/announcements">
                        <i class="fas fa-bullhorn"></i> Announcements
                    </a>
                </div>
                <div class="form-link-container">
                    <a class="nav-link" href="/grades/studentgrades">
                        <i class="fas fa-clipboard-list"></i> Grades
                    </a>
                </div>
                <!-- Add other sidebar links here -->
                <div class="form-link-container">
                    <a class="nav-link" href="/evaluations">
                        <i class="fas fa-clipboard-list"></i> Evaluations
                    </a>
                </div>
                <div class="form-link-container">
                    <a class="nav-link" href="/settings">
                        <i class="fas fa-cogs"></i> Settings
                    </a>
                </div>
                <div class="form-link-container">
                    <a class="nav-link logout" href="{{ route('login') }}">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </nav>
        </div>
        @endif

        <!-- Main Content Section -->
        <main class="mt-4 @if(Request::is('dashboard') || Request::is('announcements') ||  Request::is('grades/studentgrades') || Request::is('settings') || Request::is('admin') || Request::is('faculty/grades') || Request::is('evaluations')) content @endif">
            @yield('content')
        </main>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Resizing Sidebar Script -->
    <script>
        let sidebar = document.querySelector('.sidebar');
        let resizeHandle = document.querySelector('.sidebar-resize');
        let isResizing = false;

        resizeHandle.addEventListener('mousedown', function (e) {
            isResizing = true;
            document.addEventListener('mousemove', resizeSidebar);
            document.addEventListener('mouseup', stopResizing);
        });

        function resizeSidebar(e) {
            if (isResizing) {
                let newWidth = e.clientX;
                if (newWidth > 150 && newWidth < 400) { // Setting min and max width for sidebar
                    sidebar.style.width = newWidth + 'px';
                }
            }
        }

        function stopResizing() {
            isResizing = false;
            document.removeEventListener('mousemove', resizeSidebar);
            document.removeEventListener('mouseup', stopResizing);
        }
    </script>
</body>
</html>
