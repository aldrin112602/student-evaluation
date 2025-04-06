@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="content-wrapper p-5 border rounded shadow-lg bg-light">

        <!-- Title Section -->
        <div class="text-center mb-4">
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 2.5rem; font-weight: 600;">Students</h2>
        </div>

        <hr class="my-4 border-top border-primary">

        <!-- Search Bar -->
        <div class="mb-4 d-flex justify-content-start">
            <div class="input-group w-50">
                <span class="input-group-text bg-primary text-white">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" id="searchBar" placeholder="Search for students..." onkeyup="filterStudents()">
            </div>
        </div>

        <!-- Tab Buttons for Pending, Completed, and All -->
        <div class="mb-4">
            <ul class="nav nav-pills" id="statusTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="allTab" href="javascript:void(0);" onclick="filterByStatus('all')">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pendingTab" href="javascript:void(0);" onclick="filterByStatus('pending')">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completedTab" href="javascript:void(0);" onclick="filterByStatus('completed')">Completed</a>
                </li>
            </ul>
        </div>

        <!-- Students Table -->
        <div class="table-responsive shadow-lg rounded bg-white p-3">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Evaluate</th>
                    </tr>
                </thead>
                <tbody id="studentsTable">
                    @foreach($bsitStudents as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td class="text-center">
                            <!-- Status display as colored circle -->
                            @if ($student->evaluation_status == 'pending')
                                <span class="badge rounded-circle bg-warning" style="width: 20px; height: 20px; display: inline-block;"></span>
                                <span class="status-text">Pending</span>
                            @elseif ($student->evaluation_status == 'completed')
                                <span class="badge rounded-circle bg-success" style="width: 20px; height: 20px; display: inline-block;"></span>
                                <span class="status-text">Completed</span>
                            @elseif ($student->evaluation_status == 'none')
                                <span class="badge rounded-circle bg-secondary" style="width: 20px; height: 20px; display: inline-block;"></span>
                                <span class="status-text">None</span>
                            @else
                                <span class="badge rounded-circle bg-light" style="width: 20px; height: 20px; display: inline-block;"></span>
                                <span class="status-text">Unknown</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary" onclick="openModal('{{ $student->student_id }}', '{{ $student->student_name }}')">
                                <i class="bi bi-check-circle"></i> Evaluate
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Confirmation Modal for Evaluation -->
        <div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="evaluationModalLabel">Confirm Evaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark text-white">
                        <div id="studentDetails" class="mb-4"></div>
                        <form id="evaluationForm" action="{{ route('evaluate') }}" method="GET">
                            <input type="hidden" name="student_id" id="modalStudentId">
                            <input type="hidden" name="student_name" id="modalStudentName">
                        </form>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" id="proceedBtn" class="btn btn-success" style="display: none;" onclick="proceedEvaluation()">Proceed Evaluation</button>
                            <button type="button" id="cancelBtn" class="btn btn-danger" style="display: none;" onclick="cancelEvaluation()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Open modal and set student details
    function openModal(studentId, studentName) {
        document.getElementById("modalStudentId").value = studentId;
        document.getElementById("modalStudentName").value = studentName;
        const studentDetailsDiv = document.getElementById("studentDetails");
        studentDetailsDiv.innerHTML = `<p>Are you sure you want to evaluate this student?</p>
                                      <p><strong>Student ID:</strong> ${studentId}</p>
                                      <p><strong>Student Name:</strong> ${studentName}</p>`;
        // Show buttons
        document.getElementById("proceedBtn").style.display = "inline-block";
        document.getElementById("cancelBtn").style.display = "inline-block";
        var modal = new bootstrap.Modal(document.getElementById('evaluationModal'));
        modal.show();
    }

    // Filter students by search bar
    function filterStudents() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchBar");
        filter = input.value.toUpperCase();
        table = document.getElementById("studentsTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }

    // Function to filter students by their evaluation status
    function filterByStatus(status) {
        const rows = document.querySelectorAll('#studentsTable tr');
        
        rows.forEach(row => {
            const studentStatus = row.querySelector('td:nth-child(3)').innerText.trim().toLowerCase();
            if (status === 'all' || studentStatus === status) {
                row.style.display = '';  // Show row
            } else {
                row.style.display = 'none';  // Hide row
            }
        });

        updateActiveTab(status);
    }

    // Function to update active tab class
    function updateActiveTab(status) {
        document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));

        if (status === 'all') {
            document.getElementById('allTab').classList.add('active');
        } else if (status === 'pending') {
            document.getElementById('pendingTab').classList.add('active');
        } else if (status === 'completed') {
            document.getElementById('completedTab').classList.add('active');
        }
    }

    // Proceed with evaluation
    function proceedEvaluation() {
        const studentId = document.getElementById("modalStudentId").value;
        const studentName = document.getElementById("modalStudentName").value;
        var modal = bootstrap.Modal.getInstance(document.getElementById('evaluationModal'));
        modal.hide();

        // Store student details and redirect
        fetch("{{ route('store.student.details') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ student_id: studentId, student_name: studentName })
        })
        .then(response => response.json())
        .then(data => {
            window.location.href = "{{ route('faculty.grades') }}";
        });
    }

    // Cancel evaluation
    function cancelEvaluation() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('evaluationModal'));
        modal.hide();
    }
</script>

@endsection

<style>
    .content-wrapper {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .table-custom {
        border-radius: 10px;
        background-color: #fff;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .table-custom th, .table-custom td {
        border: none;
        padding: 15px;
        font-size: 1rem;
        color: #333;
    }

    .table-custom th {
        background-color: #f1f3f5;
        color: #495057;
    }

    .table-custom tbody tr:hover {
        background-color: #e9ecef;
        transform: scale(1.02);
        transition: all 0.2s ease;
    }

    .btn-primary {
        border-radius: 30px;
        font-size: 1rem;
    }

    .btn-outline-primary {
        border-radius: 30px;
        font-size: 1rem;
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .modal-header {
        background-color: #343a40; /* Black background */
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .modal-body {
        background-color: #343a40; /* Black background */
        color: white;
        padding: 20px;
    }

    .modal-footer .btn {
        border-radius: 30px;
    }

    .input-group-text {
        border-radius: 10px 0 0 10px;
    }

    .input-group input {
        border-radius: 0 10px 10px 0;
    }
</style>
