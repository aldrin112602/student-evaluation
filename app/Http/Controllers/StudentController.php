<?php

// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function verify($userId)
    {
        // Check if the ID exists in the wup_automate table (student)
        $student = DB::table('wup_automate')
            ->where('student_id', $userId)
            ->where('course', 'BSIT')  // Assuming this is for BSIT students
            ->first();

        // // Check if the ID exists in the faculty table
        // $faculty = DB::table('faculty')
        //     ->where('faculty_id', $userId)
        //     ->first();

        if ($student) {
            // Return the student data and role as 'student'
            return response()->json([
                'valid' => true,
                'user_id' => $student->student_id,
                'fullname' => $student->student_name,
                'role' => 'student'
            ]);
        // } elseif ($faculty) {
        //     // Return the faculty data and role as 'faculty'
        //     return response()->json([
        //         'valid' => true,
        //         'user_id' => $faculty->faculty_id,
        //         'fullname' => $faculty->faculty_name,
        //         'role' => 'faculty'
        //     ]);
        } else {
            // If neither student nor faculty is found, return an error
            return response()->json([
                'valid' => false,
                'message' => 'Student not found.'
            ]);
        }
    }

    
}
