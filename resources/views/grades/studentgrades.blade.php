@extends('layouts.app')

@section('content')
    <div class="container">

    <div class="content-wrapper p-4 border rounded shadow-sm">

            <!-- Logo -->
            <div class="text-center mb-4">
            <!-- <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;"> -->
        </div>
        <h2 class="mb-4 text-center" style="font-family: 'Bebas Neue', sans-serif;">Student Grades Overview</h2>
        <hr class="my-4"> <!-- Adds spacing above and below the line -->

  <!-- Student Name and ID -->
<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-id" class="ms-3">Student ID: <strong>{{ Auth::user()->user_id }}</strong> </label>
    </div>
</div>
<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-name" class="ms-3">Student Name: <strong> {{ Auth::user()->fullname }}</strong></label>
    </div>
</div>
<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-year" class="ms-3">Year: <strong>{{ $year }}</strong></label>
    </div>
</div>

<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-status" class="ms-3">Status: <strong>{{ $status }}</strong></label>
    </div>
</div>

       <!-- Student Name and ID
<div class="row mb-4 justify-content-center text-center">
    <div class="col-md-4">
        <label for="student-id">Student ID: {{ Auth::user()->user_id }}</label>
         <input type="text" class="form-control text-center" id="student-id" value="{{ Auth::user()->user_id }}" readonly> 
    </div>
    <div class="col-md-4">
        <label for="student-name">Student Name: {{ Auth::user()->fullname }}</label>
         <input type="text" class="form-control text-center" id="student-name" value="{{ Auth::user()->fullname }}" readonly> 
    </div>
</div> -->

@if(session('success'))
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Wait until the document is ready and show the modal if the success message is present
        $(document).ready(function() {
            $('#successModal').modal('show'); // Show the modal

            // Optional: auto-close the modal after 5 seconds
            setTimeout(function() {
                $('#successModal').modal('hide');
            }, 5000); // 5 seconds
        });
    </script>
@endif


        <!-- Buttons to Toggle Grades and Deficiencies Visibility -->
        <div class="text-left mb-4 d-flex align-items-center">
            <!-- Show Grades Button -->
            <button class="btn-circle" id="show-grades-btn">
                <span id="circle-icon" class="circle-icon"></span>
            </button>
            <span id="button-text" class="btn-text">Show Grades</span>

            <!-- Spacer between buttons -->
            <span class="mx-3"></span>

            <!-- Show Deficiencies Button -->
            <button class="btn-circle" id="show-deficiencies-btn">
                <span id="deficiency-circle-icon" class="circle-icon"></span>
            </button>
            <span id="deficiency-button-text" class="btn-text">Show Deficiencies</span>
        </div>

       <!-- All Semesters Container (Initially Hidden) -->
<div id="grades-container" style="display: none;">
    <!-- 1ST YEAR, 1ST SEM -->
    <div class="semester-section">
        <h4>1ST YEAR, 1ST SEM</h4>
        <table class="table table-bordered semester-table">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Prelims</th>
                    <th>Midterms</th>
                    <th>Final Grade</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    @if ($grade->course_code == 'CE 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>INTRODUCTION TO THE BIBLE</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'GEC 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>UNDERSTANDING THE SELF</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </t>
                    @elseif ($grade->course_code == 'GEC 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>PURPOSIVE COMMUNICATION</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITCC 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>INTRODUCTION TO COMPUTING</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITCC 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>COMPUTER PROGRAMMING 1</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITPC 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>SOFTWARE APPLICATIONS</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'NSTP 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>NATIONAL SERVICE TRAINING PROGRAM 1</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'PE 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>PHYSICAL FITNESS</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 1ST YEAR, 2ND SEM -->
    <div class="semester-section">
        <h4>1ST YEAR, 2ND SEM</h4>
        <table class="table table-bordered semester-table">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Prelims</th>
                    <th>Midterms</th>
                    <th>Final Grade</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    @if ($grade->course_code == 'CE 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>EXPERIENCE CHRISTIAN FAITH</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'GEC 4')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>READING IN PHILIPPINE HISTORY</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'GEC 5')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>ARTS APPRECIATION</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'GEE 1')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>LIVING IN THE IT ERA</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITCC 3')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>COMPUTER PROGRAMMING 2</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITPC 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>DISCRETE MATHEMATICS</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'ITPC 3')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>WEB DEVELOPMENT</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'NSTP 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>NATIONAL SERVICE TRAINING PROGRAM 2</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </tr>
                    @elseif ($grade->course_code == 'PE 2')
                    <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                            <td>{{ $grade->course_code }}</td>
                            <td>RHYTHMIC ACTIVITIES</td>
                            <td>{{ $grade->prelims_grade ?? '' }}</td>
                            <td>{{ $grade->midterms_grade ?? '' }}</td>
                            <td>{{ $grade->final_grade ?? '' }}</td>
                            <td>{{ $grade->remarks ?? '' }}</td>
                        </t>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 2ND YEAR, 1ST SEM -->
<div class="semester-section">
    <h4>2ND YEAR, 1ST SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
        <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'CE 3X')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SOCIAL TRANSFORMATION</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'GEC 6')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SCIENCE TECHNOLOGY AND SOCIETY</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'GEC 7')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>ETHICS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'GEE 2')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>PHILIPPINE POPULAR CULTURE</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITCC 4')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>DATA STRUCTURES AND ALGORITHMS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITCC 5')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>APPLICATION DEVELOPMENT AND EMERGING TECHNOLOGIES</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 4')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>HUMAN COMPUTER INTERACTION</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 5')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>OPERATING SYSTEM</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 6')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SOCIAL ISSUES AND PROFESSIONAL PRACTICE</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'PE 3')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INDIVIDUAL/ DUAL SPORTS AND GAMES</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<!-- 2ND YEAR, 2ND SEM -->
<div class="semester-section">
    <h4>2ND YEAR, 2ND SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'GEC 8')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>THE CONTEMPORARY WORLD</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'GEE 3')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>GENDER AND SOCIETY</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITCC 6')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INFORMATION MANAGEMENT 1</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 10')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>3D MODELING & GAME DEVELOPMENT</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 7')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>OBJECT ORIENTED PROGRAMMING</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 8')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>PLATFORMS TECHNOLOGIES</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 9')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>FUNDAMENTALS OF ACCOUNTING</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'PE 4')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>TEAM SPORTS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'RIZAL')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>RIZAL'S LIFE, WORKS & WRITINGS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'STAT 1X')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>PROBABILITY AND STATISTICS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- 3RD YEAR, 1ST SEM -->
<div class="semester-section">
    <h4>3RD YEAR, 1ST SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'ITPC 11')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INFORMATION MANAGEMENT 2</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 12')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>DATA COMM AND NETWORKING 1</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 13')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SYSTEM ANALYSIS AND DESIGN</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 14')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INTRO TO DIGITAL LOGIC DESIGN & CONSUMER ELECTRONICS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 15')
                <tr
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>METHODS OF RESEARCH IN COMPUTING & TECHNOPRENEURSHIP</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 1')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 1</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 2')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 2</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- 3RD YEAR, 2ND SEM -->
<div class="semester-section">
    <h4>3RD YEAR, 2ND SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'ITPC 16')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>DATA COMM AND NETWORKING 2</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 17')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INFORMATION ASSURANCE AND SECURITY 1</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 18')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SYSTEM INTEGRATION AND ARCHITECTURE</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 19')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>FUNDAMENTALS OF DATA WAREHOUSING AND DATA MINING</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 20')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INTERNET OF THINGS</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 21')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>CAPSTONE PROJECT 1</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 3')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 3</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<!-- 3RD YEAR, SUMMER -->
<div class="semester-section">
    <h4>3RD YEAR, SUMMER</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'ITPC 22')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INTEGRATIVE PROGRAMMING AND TECHNOLOGIES</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 23')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>INFORMATION ASSURANCE AND SECURITY 2</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 4')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 4</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<!-- 4TH YEAR, 1ST SEM -->
<div class="semester-section">
    <h4>4TH YEAR, 1ST SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'ITPC 24')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>CAPSTONE PROJECT 2</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 25')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>SYSTEM ADMINISTRATION AND MAINTENANCE</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPC 26')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>QUANTITATIVE METHODS (INCL. MODELLING & SIMULATION)</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 5')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 5</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 6')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 6</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @elseif ($grade->course_code == 'ITPE 7')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PROFESSIONAL ELECTIVE 7</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<!-- 4TH YEAR, 2ND SEM -->
<div class="semester-section">
    <h4>4TH YEAR, 2ND SEM</h4>
    <table class="table table-bordered semester-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Prelims</th>
                <th>Midterms</th>
                <th>Final Grade</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                @if ($grade->course_code == 'OJT (IT)')
                <tr 
                            @if ($grade->remarks == 'Passed') 
                                style="background-color: #C2FFC7;" 
                            @elseif ($grade->remarks == 'Dropped') 
                                style="background-color: #FF4545;" 
                            @else 
                                style="background-color: #FCF596;" 
                            @endif
                        >
                        <td>{{ $grade->course_code }}</td>
                        <td>IT PRACTICUM (520 HOURS)</td>
                        <td>{{ $grade->prelims_grade ?? '' }}</td>
                        <td>{{ $grade->midterms_grade ?? '' }}</td>
                        <td>{{ $grade->final_grade ?? '' }}</td>
                        <td>{{ $grade->remarks ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

</div>


<!-- Deficiencies Container (Initially Hidden) -->
<div id="deficiencies-container" style="display: none;">
    <h4>Deficiency Courses</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Course Code</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">Semester and Academic Year</th>
            </tr>
        </thead>
        <tbody>
            
            <!-- Example: Add rows here if necessary -->
            @foreach ($grades as $grade)
                @if (in_array($grade->remarks, ['Lacking Requirement', 'Incomplete', 'Failed', 'Dropped'])) <!-- Show deficiency courses based on remarks -->
                    <tr>
                        <td class="text-center">{{ $grade->course_code }}</td>
                        <td class="text-center">{{ $grade->remarks }}</td>
                        <td class="text-center">{{$grade->sem_AY}} </td>

                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    
    
    @if(auth()->user()->role === 'student')

    {{-- display files --}}
    <div class="d-flex align-items-center justify-content-start gap-2 px-3" style="overflow: auto;">
        @foreach ($files as $file)
            
                <img src="{{ asset($file->image) }}" alt="{{ $file->name }}" class="img-fluid mb-3" style="max-width: 300px; object-fit: cover;">
            
        @endforeach
    </div>
    <!-- Upload Completion Form Button -->
    <div style="text-align: left; margin-top: 20px;">
        <button type="button" class="btn btn-warning btn-lg" style="padding: 12px 20px; font-size: 16px;" data-toggle="modal" data-target="#uploadModal">
            <i class="fas fa-upload" style="margin-right: 10px;"></i> Upload Completion Form
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success" id="successAlert">
        {{ session('success') }}
    </div>

    <script>
        // After 3 seconds, hide the success alert
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000); // 3000ms = 3 seconds
    </script>
@endif

<style>
    /* Position the alert in the top-right corner */
    #successAlert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050; /* Make sure it's above other content */
        padding: 10px 20px;
        max-width: 300px;
        border-radius: 5px;
        opacity: 1;
        transition: opacity 0.5s ease;
    }
</style>


    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Completion Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for Image Upload and Name -->
                    <form action="{{ route('grades.help.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Completion Form/Subject Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Need Help Button with Icon -->
    <div style="text-align: left; margin-top: 20px;">
        <a href="javascript:void(0);" onclick="showHelp()" class="btn btn-primary btn-lg" style="padding: 12px 20px; font-size: 16px;">
            <i class="fas fa-question-circle" style="margin-right: 10px;"></i> Need Help?
        </a>
    </div>
@endif


<!-- Help Modal (Pop-up) -->
<div id="help-modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border-radius: 8px; padding: 30px; z-index: 1000; max-width: 600px; width: 90%; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); animation: fadeIn 0.3s;">
    <h5 style="text-align: center; color: #444; font-size: 20px; margin-bottom: 20px; font-family: 'Arial', sans-serif;">Step-by-Step Procedure</h5>

    <!-- Buttons for different deficiency types -->
    <div style="display: flex; justify-content: space-around; margin-bottom: 20px;">
        <button class="btn btn-info btn-sm" onclick="showSteps('lacking')">Lacking Requirement</button>
        <button class="btn btn-info btn-sm" onclick="showSteps('noPermit')">No Permit</button>
        <button class="btn btn-info btn-sm" onclick="showSteps('dropped')">Dropped</button>
        <button class="btn btn-info btn-sm" onclick="showSteps('inc')">Incomplete (INC)</button>
        <button class="btn btn-info btn-sm" onclick="showSteps('noExam')">No Exam</button>
        <button class="btn btn-info btn-sm" onclick="showSteps('failed')">Failed</button> <!-- Added Failed Button -->
    </div>

    <!-- Area where steps will be displayed -->
    <div id="modal-steps" style="color: #555; font-size: 16px;">
        <p>Please select a deficiency type above to see the corresponding steps.</p>
    </div>

    <div style="text-align: center;">
        <button onclick="closeHelp()" class="btn btn-danger btn-sm">Close</button>
    </div>
</div>

<!-- Overlay to dim background when modal is open -->
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999; animation: fadeInOverlay 0.3s;"></div>
  
</div>

    </div>

    </div>
    <!-- JavaScript to Toggle Visibility and Button State -->
    <script>
        function resetButtonState() {
            document.getElementById('show-grades-btn').classList.remove('filled');
            document.getElementById('show-deficiencies-btn').classList.remove('filled');
            document.getElementById('circle-icon').classList.remove('filled');
            document.getElementById('deficiency-circle-icon').classList.remove('filled');
            document.getElementById('grades-container').style.display = 'none';
            document.getElementById('deficiencies-container').style.display = 'none';
            document.getElementById('button-text').textContent = 'Show Grades';
            document.getElementById('deficiency-button-text').textContent = 'Show Deficiencies';
        }

        document.getElementById('show-grades-btn').addEventListener('click', function() {
            resetButtonState();
            var gradesContainer = document.getElementById('grades-container');
            var circleIcon = document.getElementById('circle-icon');
            var buttonText = document.getElementById('button-text');
            gradesContainer.style.display = 'block';
            this.classList.add('filled');
            circleIcon.classList.add('filled');
            buttonText.textContent = 'Hide Grades';
        });

        document.getElementById('show-deficiencies-btn').addEventListener('click', function() {
            resetButtonState();
            var deficienciesContainer = document.getElementById('deficiencies-container');
            var deficiencyCircleIcon = document.getElementById('deficiency-circle-icon');
            var deficiencyButtonText = document.getElementById('deficiency-button-text');
            deficienciesContainer.style.display = 'block';
            this.classList.add('filled');
            deficiencyCircleIcon.classList.add('filled');
            deficiencyButtonText.textContent = 'Hide Deficiencies';
        });

        function showHelp() {
        // Show the help modal and overlay with fade-in effect
        document.getElementById('help-modal').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function closeHelp() {
        // Hide the help modal and overlay with fade-out effect
        document.getElementById('help-modal').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showSteps(deficiencyType) {
        let stepsContent = '';

        // Set the content based on the deficiency type
        switch(deficiencyType) {
            case 'lacking':
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Review your academic record for the missing requirement(s).</li>
                        <li><strong>Step 2:</strong> Consult with your academic advisor to determine the necessary steps to fulfill the requirement.</li>
                        <li><strong>Step 3:</strong> Complete the required coursework or project to meet the requirement.</li>
                        <li><strong>Step 4:</strong> Submit the necessary documentation to the registrar or department.</li>
                    </ul>
                `;
                break;
            case 'noPermit':
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Ensure that all prerequisites and administrative requirements are met.</li>
                        <li><strong>Step 2:</strong> Contact the registrar or department to clarify the permit issue.</li>
                        <li><strong>Step 3:</strong> Complete any required forms or processes to obtain the necessary permit.</li>
                    </ul>
                `;
                break;
            case 'dropped':
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Verify the reason why the course was dropped (e.g., academic or personal reasons).</li>
                        <li><strong>Step 2:</strong> If necessary, contact your professor or advisor for more information.</li>
                        <li><strong>Step 3:</strong> If you wish to retake the course, check for re-enrollment options and deadlines.</li>
                    </ul>
                `;
                break;
            case 'inc':
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Review the conditions for the Incomplete grade, which might include additional assignments or exams.</li>
                        <li><strong>Step 2:</strong> Contact your instructor to clarify the steps needed to complete the course.</li>
                        <li><strong>Step 3:</strong> Submit the completed work or attend the required exam before the deadline.</li>
                    </ul>
                `;
                break;
            case 'noExam':
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Review the course schedule to confirm the exam was missed or not scheduled.</li>
                        <li><strong>Step 2:</strong> Contact the instructor to inquire about options for taking a makeup exam.</li>
                        <li><strong>Step 3:</strong> Follow the required procedure to reschedule the exam or complete an alternative assessment.</li>
                    </ul>
                `;
                break;
            case 'failed':  // Added the "Failed" case
                stepsContent = `
                    <ul>
                        <li><strong>Step 1:</strong> Review your performance in the course and identify areas of improvement.</li>
                        <li><strong>Step 2:</strong> Meet with your professor to discuss your grade and get feedback.</li>
                        <li><strong>Step 3:</strong> Consider retaking the course or attending extra tutorials if needed.</li>
                        <li><strong>Step 4:</strong> Submit any necessary re-application or re-enrollment forms if you wish to retake the course.</li>
                    </ul>
                `;
                break;
            default:
                stepsContent = `<p>Please select a deficiency type to view the corresponding steps.</p>`;
        }

        // Display the steps in the modal
        document.getElementById('modal-steps').innerHTML = stepsContent;
    }    
    </script>

    <!-- CSS for Circular Buttons and Animation (same as before) -->
    <style>
          @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInOverlay {
        from { background-color: rgba(0, 0, 0, 0); }
        to { background-color: rgba(0, 0, 0, 0.5); }
    }
    /* Style for the notebook-like text area */
    .notebook-lines {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: "Courier New", Courier, monospace; /* Monospace font for better line alignment */
        font-size: 14px;
        line-height: 1.5;
        background: linear-gradient(to bottom, #f4f4f4 50%, #fff 50%); /* Light lines for notebook effect */
        background-size: 100% 20px; /* Space between lines */
        background-repeat: repeat-y;
        resize: none; /* Disable resizing */
    }

    /* Optional: Add some space for the note container */
    .note-container {
        margin-top: 20px;
    }

    /* Label styling */
    .note-container label {
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }

    .content-wrapper {
    border: 1px solid #ddd; /* Border around the entire content */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
    background-color: #fff; /* Background color inside the rectangle */
}
</style>

@endsection
