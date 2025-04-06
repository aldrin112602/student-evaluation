<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Student Evaluation System</title>

    <!-- Link to Google Fonts for a modern font style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Set up a full-height page with modern design */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #003366, #66ccff); /* Modern gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        /* Container for content with soft shadow and rounded corners */
        .container {
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for contrast */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        /* Header Style */
        .container h4 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 30px;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5); /* Adds depth to text */
            color: #fff;
        }

        /* Flex container for buttons */
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        /* Button Style */
        .btn {
            font-weight: 500;
            font-size: 1.2rem;
            border-radius: 30px;
            padding: 15px 30px;
            width: 80%;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #0066cc; /* Blue color */
            border: none;
            color: white;
        }

        .btn-success {
            background-color: #28a745; /* Green color */
            border: none;
            color: white;
        }

        /* Hover and Active States */
        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* Image styling */
        .logo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        /* Responsive adjustments for small screens */
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            .btn {
                width: 100%;
                font-size: 1.1rem;
                padding: 12px;
            }

            .logo {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>

<!-- Page Content -->
<section class="container">
    <!-- Logo -->
    <img src="{{ asset('images/wesleyanlogo.jpg') }}" alt="Wesleyan University Logo" class="logo">
    <!-- Heading -->
    <h4>Welcome to the Student Evaluation System</h4>
    <p>For the Bachelor of Science in Information Technology at Wesleyan University Philippines</p>
    <!-- Button Container -->
    <div class="button-container">
        <!-- Role Selection Buttons -->
        <a href="{{ route('admin.login') }}" class="btn btn-primary">
            Administrator/Faculty
        </a>

        <a href="{{ route('login') }}" class="btn btn-success">
            Student
        </a>
    </div>
</section>

</body>
</html>
