@extends('layouts.admin')

@section('content')
<div class="container">
<div class="content-wrapper p-4 border rounded shadow-sm">

<!-- <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;"> -->

    <h2 class="mb-4 text-center" style="font-family: 'Bebas Neue', sans-serif;">Faculty Grades Overview</h2>
    <hr class="my-4"> <!-- Adds spacing above and below the line -->

    <!-- Display Student ID and Name from the Session
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <label for="student-id" class="text-center">Student ID: <strong>{{ session('student_id') }} </strong> </label>
             <input type="text" class="form-control text-center" id="student-id" value="{{ session('student_id') }}" readonly> 
        </div>
        <div class="col-md-4">
            <label for="student-name" class="text-center">Student Name: <strong>{{ session('student_name') }}</strong></label>
            <input type="text" class="form-control text-center" id="student-name" value="{{ session('student_name') }}" readonly> 
        </div>
    </div> -->


<!-- Student Name and ID -->
<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-id" class="ms-1">Student ID: <strong>{{ $studentId }} </strong></label>
    </div>
</div>

<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-name" class="ms-1">Student Name: <strong>{{ $studentName }}</strong></label>
    </div>
</div>

<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-year" class="ms-1">Year: <strong>{{ $year }}</strong></label>
    </div>
</div>

<div class="row mb-4 justify-content-start">
    <div class="col-md-6">
        <label for="student-status" class="ms-1">Status: <strong>{{ $status  }}</strong></label>
    </div>
</div>


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
        <h4 style="text-align:left;">1st Year, 1st Semester</h4>
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
                        </tr>
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
    <h4 style="text-align:left;">1st Year, 2nd Semester</h4>
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
                    @elseif ($grade->course_code == 'GEE 1/IT ERA')
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
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 2ND YEAR, 1ST SEM -->
<div class="semester-section">
<h4 style="text-align:left;">2nd Year, 1st Semester</h4>
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
<h4 style="text-align:left;">2nd Year, 2nd Semester</h4>
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
<h4 style="text-align:left;">3rd Year, 1st Semester</h4>
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
<h4 style="text-align:left;">3rd Year, 2nd Semester</h4>
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
<h4 style="text-align:left;">3rd Year, Summer</h4>
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
<h4 style="text-align:left;">4th Year, 1st Semester</h4>
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
<h4 style="text-align:left;">4th Year, 2nd Semester</h4>
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
    <!-- Go Back Button
    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        Go Back
    </a> -->

</div>


<!-- Deficiencies Container (Initially Hidden) -->
<div id="deficiencies-container" style="display: none;">
    <h4>Course Deficiency/ies</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Remarks</th>
                <th>Semester and Academic Year</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example: Add rows here if necessary -->
            @foreach ($grades as $grade)
                @if (in_array($grade->remarks, ['Lacking Requirement', 'Incomplete', 'Failed', 'Dropped'])) <!-- Show deficiency courses based on remarks -->
                    <tr>
                        <td>{{ $grade->course_code }}</td>
                        <td>{{ $grade->remarks }}</td>
                        <td>{{$grade->sem_AY}} </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('save-note') }}" method="POST" id="note-form">
    @csrf
    <input type="hidden" name="student_id" value="{{ session('student_id') }}">
    <input type="hidden" name="email" value="{{ $email }}">
    
    <div class="note-container mb-3 " style="text-align: left;">
        <label for="deficiency-note">Deficiency:</label>
        <textarea id="deficiency-note" name="note" rows="6" placeholder="Type your notes here..." class="form-control"></textarea>
    </div>

    <!-- advise -->
    <div class="note-container mb-3 " style="text-align: left;">
        <label for="deficiency-note">Advise:</label>
        <textarea id="advise-note" name="advise" rows="6" placeholder="Type your advise here..." class="form-control"></textarea>
    </div>

     <!-- New Recommendations Section -->
     <div class="note-container mb-3" style="text-align: left;">
        <label for="recommendations-note">Recommendations:</label>
        <textarea id="recommendations-note" name="recommendations" rows="6" placeholder="Type the recommendation here..." class="form-control"></textarea>
    </div>

     <!-- New Results Section -->
     <div class="note-container mb-3" style="text-align: left;">
        <label for="results-note">Results:</label>
        <textarea id="results-note" name="results" rows="6" placeholder="Type the results here..." class="form-control"></textarea>
    </div>
    
    <!-- Buttons (Evaluate and Go Back) in the same line -->
    <div class="d-flex justify-content-start mb-4">
        <!-- Evaluate Button -->
        <button type="submit" class="btn btn-primary me-2">
            Evaluate
        </button>
        
        <!-- Go Back Button -->
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Go Back
        </a>
    </div>
</form>

<!-- Evaluated By -->
<div class="row mb-4 text-left">
    <div class="col-md-4">
        <label for="evaluated-by">Evaluated By: <strong>{{ Auth::user()->fullname }}</strong></label>
        <!-- <input type="text" class="form-control" id="evaluated-by" value="{{ Auth::user()->fullname }}" readonly> -->
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
        

       
    </script>

    <!-- CSS for Circular Buttons and Animation (same as before) -->
    <style>
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

