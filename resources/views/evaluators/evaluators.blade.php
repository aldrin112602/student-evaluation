@extends('layouts.admin')

@section('content')
<div class="container">
<div class="content-wrapper p-4 border rounded shadow-sm">

    <!-- Logo Section -->
    <div class="text-center mb-5">
  
    <h2 class="mt-3" style="border-bottom: 2px solid grey; font-family: 'Bebas Neue', sans-serif;">Evaluators</h2> <!-- Added border-bottom -->
</div>

   <!-- Success Message -->
@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>

    <style>
        /* Position the success alert in the top-right corner */
        #success-alert {
            position: fixed;
            top: 20px;      /* Space from the top */
            right: 20px;    /* Space from the right */
            z-index: 9999;  /* Ensure it's on top of other content */
            width: auto;    /* Optional: Adjust the width as needed */
            padding: 15px;  /* Add padding for spacing */
            border-radius: 10px; /* Rounded corners */
            font-size: 16px; /* Font size for readability */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            transition: opacity 0.5s ease; /* Smooth fade-out effect */
            opacity: 1; /* Initially visible */
        }

        /* Styling for success message color */
        #success-alert {
            background-color: #4CAF50;
            color: white;
        }

        /* Optional: Slightly rounded corners for a more modern look */
        #success-alert strong {
            font-weight: bold;
        }
    </style>

    <script>
        // Wait for the page to fully load before executing the script
        window.onload = function() {
            // Set a timeout to hide the alert after 1.5 seconds
            setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                    // Apply fade effect by reducing opacity and then hiding it
                    alert.style.opacity = '0'; // Fade out the alert
                    setTimeout(function() {
                        alert.style.display = 'none'; // Hide the alert after fade-out completes
                    }, 500); // Wait 0.5 seconds for the fade-out effect to complete
                }
            }, 1500); // 1500 milliseconds = 1.5 seconds
        };
    </script>
@endif

    <!-- Search Bar -->
    <div class="d-flex justify-content-start mb-4">
        <div class="input-group" style="max-width: 350px;">
            <span class="input-group-text bg-light" id="searchIcon"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" id="search" placeholder="Search by Faculty ID" onkeyup="filterEvaluators()" aria-label="Search Evaluators">
        </div>
    </div>

    <!-- Add Evaluator Button -->
    @if(auth()->user()->role === 'admin')
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addEvaluatorModal">
            <i class="fas fa-plus-circle"></i> Add Evaluator
        </button>
    </div>
    @endif

    <!-- Evaluators Table -->
    <div class="table-responsive shadow-lg rounded bg-white p-3">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th> ID Number</th>
                    <th> Evaluator/Faculty Name</th>
                    <th> Login Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluators as $evaluator)
                    <tr>
                        <td>{{ $evaluator->user_id }}</td>
                        <td>{{ $evaluator->fullname }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $evaluator->id }}">
                                <i class="fas fa-eye"></i> View
                            </button>

                            <!-- Modal for Viewing Evaluator Details -->
                            <div class="modal fade" id="viewDetailsModal{{ $evaluator->id }}" tabindex="-1" aria-labelledby="viewDetailsModalLabel{{ $evaluator->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewDetailsModalLabel{{ $evaluator->id }}">Evaluator Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>ID Number:</strong> {{ $evaluator->user_id }}</p>
                                            <p><strong>Full Name:</strong> {{ $evaluator->fullname }}</p>
                                            <p><strong>Username:</strong> {{ $evaluator->username }}</p>
                                            <p><strong>Password:</strong>
                                                @if($evaluator->original_password)
                                                    {{ $evaluator->original_password }} <!-- Display original password -->
                                                @else
                                                    Not set
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding Evaluator -->
    <div class="modal fade" id="addEvaluatorModal" tabindex="-1" aria-labelledby="addEvaluatorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEvaluatorModalLabel">Add New Evaluator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('evaluators.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Faculty ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Faculty Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div> -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="password" name="password" required>
                                <button type="button" class="btn btn-secondary" id="generatePasswordBtn">Generate</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Evaluator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Function for filtering evaluators based on Faculty ID or Name
function filterEvaluators() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("evaluatorsTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        if (td.length > 0) {
            var facultyId = td[0].textContent || td[0].innerText; // Faculty ID
            var facultyName = td[1].textContent || td[1].innerText; // Faculty Name
            
            // Check if either Faculty ID or Faculty Name matches the search filter
            if (facultyId.toUpperCase().indexOf(filter) > -1 || facultyName.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
    // Function for generating a random password
    function generatePassword(length = 12) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }

    // Generate password on button click
    document.getElementById('generatePasswordBtn').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const generatedPassword = generatePassword(12);  // Generate 12-character random password
        passwordField.value = generatedPassword;
    });
</script>

@endsection
