@extends('layouts.admin')

@section('content')
    <!-- Admin Dashboard Content -->
    <div class="container-fluid py-5">
        <h1 class="text-center mb-5 display-4">Admin Dashboard</h1>
        
        <div class="row g-4">
            <!-- Dashboard Stats -->
            <div class="col-lg-4 col-md-6">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon bg-primary text-white rounded-circle p-3 me-3">
                                <i class="fas fa-user-graduate fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Total Students</h5>
                                <p class="card-text fs-4 fw-bold">{{ isset($totalStudents) ? $totalStudents : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <a href="{{ route('students.index') }}" class="btn btn-primary btn-lg">Go to Students</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon bg-success text-white rounded-circle p-3 me-3">
                                <i class="fas fa-user-tie fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Total Evaluators</h5>
                                <p class="card-text fs-4 fw-bold">{{ isset($totalEvaluators) ? $totalEvaluators : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <a href="{{ route('evaluators.index') }}" class="btn btn-success btn-lg">Go to Evaluators</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon bg-warning text-white rounded-circle p-3 me-3">
                                <i class="fas fa-bullhorn fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Total Announcements</h5>
                                <p class="card-text fs-4 fw-bold">{{ isset($totalAnnouncements) ? $totalAnnouncements : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <a href="{{ route('admin.announcements') }}" class="btn btn-warning btn-lg">Go to Announcements</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <div class="card shadow border-0 rounded-3 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Student Performance</h5>
            
            <div class="row">
                <!-- Main Content with Tabs -->
                <div class="col-lg-8">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="performanceTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pie-chart-tab" data-bs-toggle="tab" data-bs-target="#pie-chart" type="button" role="tab" aria-controls="pie-chart" aria-selected="true">
                                Pie Chart Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="grade-summary-tab" data-bs-toggle="tab" data-bs-target="#grade-summary" type="button" role="tab" aria-controls="grade-summary" aria-selected="false">
                                Grade Remarks Summary by Course
                            </button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content mt-3" id="performanceTabsContent">
                        <!-- Pie Chart Overview Tab -->
                        <div class="tab-pane fade show active" id="pie-chart" role="tabpanel" aria-labelledby="pie-chart-tab">
                            <div class="d-flex justify-content-center align-items-center">
                                <canvas id="gradesPieChart" width="300" height="300"></canvas>
                            </div>
                        </div>

                        <!-- Grade Remarks Summary by Course Tab -->
                        <div class="tab-pane fade" id="grade-summary" role="tabpanel" aria-labelledby="grade-summary-tab">
                            <h5 class="fw-bold">Grade Remarks Summary by Course</h5>
                            @if ($remarksSummary->isNotEmpty())
                                <ul class="list-group list-group-flush">
                                    @foreach ($remarksSummary as $summary)
                                        <li class="list-group-item">
                                            <strong>{{ $summary->course_code }}:</strong>
                                            <br>
                                            @if ($summary->incomplete > 0)
                                                There are {{ $summary->incomplete }} students with a grade remark of "Incomplete".
                                            @endif
                                            @if ($summary->lacking_requirement > 0)
                                                There are {{ $summary->lacking_requirement }} students with a grade remark of "Lacking Requirement".
                                            @endif
                                            @if ($summary->failed > 0)
                                                There are {{ $summary->failed }} students with a grade remark of "Failed".
                                            @endif
                                            @if ($summary->no_permit > 0)
                                                There are {{ $summary->no_permit }} students with a grade remark of "No Permit".
                                            @endif
                                            @if ($summary->no_exam > 0)
                                                There are {{ $summary->no_exam }} students with a grade remark of "No Exam".
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No course deficiencies to display.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar with Percentage Details -->
                <div class="col-lg-4">
                    <div class="sticky-top">
                        <h6 class="fw-bold">Grade Remarks Percentages</h6>
                        <p class="fs-5">
                            <strong>Passed:</strong> {{ $passedPercentage }}%<br>
                            <strong>Failed:</strong> {{ $failedPercentage }}%<br>
                            <strong>Incomplete:</strong> {{ $incompletePercentage }}%<br>
                            <strong>Lacking Requirement:</strong> {{ $lackingRequirementPercentage }}%<br>
                            <strong>No Permit:</strong> {{ $noPermitPercentage }}%<br>
                            <strong>No Exam:</strong> {{ $noExamPercentage }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for Pie Chart
        var passedCount = {{ $totalPassed }};
        var failedCount = {{ $totalFailed }};
        var incompleteCount = {{ $totalIncomplete }};
        var lackingRequirementCount = {{ $totalLackingRequirement }};
        var noPermitCount = {{ $totalNoPermit }};
        var noExamCount = {{ $totalNoExam }};

        var totalGrades = passedCount + failedCount + incompleteCount + lackingRequirementCount + noPermitCount + noExamCount;

        // Pie chart data
        var data = {
            labels: ['Passed', 'Failed', 'Incomplete', 'Lacking Requirement', 'No Permit', 'No Exam'],
            datasets: [{
                data: [passedCount, failedCount, incompleteCount, lackingRequirementCount, noPermitCount, noExamCount],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107', '#fd7e14', '#6c757d', '#17a2b8'],
                hoverBackgroundColor: ['#218838', '#c82333', '#e0a800', '#e06c00', '#5a6268', '#117a8b'],
            }]
        };

        // Options for the chart
        var options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        };

        // Create Pie Chart
        var ctx = document.getElementById('gradesPieChart').getContext('2d');
        var gradesPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
@endsection
