<?php  

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Grade;

class AdminDashboardController extends Controller
{
    public function index()
{
    // Get the data to pass to the view
    $totalEvaluators = User::where('role', 'faculty')->count();
    $totalStudents = User::where('role', 'student')->count();  // Adjust if necessary
    $totalAnnouncements = Announcement::count();  // Assuming you have an Announcement model

    // Get counts for all remarks: Passed, Failed, Incomplete, Lacking Requirement, No Permit, No Exam
    $gradesCount = Grade::selectRaw('
        course_code,
        SUM(CASE WHEN remarks = "Passed" THEN 1 ELSE 0 END) AS passed,
        SUM(CASE WHEN remarks = "Failed" THEN 1 ELSE 0 END) AS failed,
        SUM(CASE WHEN remarks = "Incomplete" THEN 1 ELSE 0 END) AS incomplete,
        SUM(CASE WHEN remarks = "Lacking Requirement" THEN 1 ELSE 0 END) AS lacking_requirement,
        SUM(CASE WHEN remarks = "No Permit" THEN 1 ELSE 0 END) AS no_permit,
        SUM(CASE WHEN remarks = "No Exam" THEN 1 ELSE 0 END) AS no_exam
    ')
    ->groupBy('course_code')
    ->get();

    // Calculate total counts for each remark category
    $totalPassed = $gradesCount->sum('passed');
    $totalFailed = $gradesCount->sum('failed');
    $totalIncomplete = $gradesCount->sum('incomplete');
    $totalLackingRequirement = $gradesCount->sum('lacking_requirement');
    $totalNoPermit = $gradesCount->sum('no_permit');
    $totalNoExam = $gradesCount->sum('no_exam');

    // Calculate total number of grades for percentage calculation
    $totalGrades = $totalPassed + $totalFailed + $totalIncomplete + $totalLackingRequirement + $totalNoPermit + $totalNoExam;

    // Calculate percentages
    $passedPercentage = $totalGrades ? round(($totalPassed / $totalGrades) * 100, 2) : 0;
    $failedPercentage = $totalGrades ? round(($totalFailed / $totalGrades) * 100, 2) : 0;
    $incompletePercentage = $totalGrades ? round(($totalIncomplete / $totalGrades) * 100, 2) : 0;
    $lackingRequirementPercentage = $totalGrades ? round(($totalLackingRequirement / $totalGrades) * 100, 2) : 0;
    $noPermitPercentage = $totalGrades ? round(($totalNoPermit / $totalGrades) * 100, 2) : 0;
    $noExamPercentage = $totalGrades ? round(($totalNoExam / $totalGrades) * 100, 2) : 0;

    $remarksSummary = Grade::selectRaw('
    course_code,
    SUM(CASE WHEN remarks = "Failed" THEN 1 ELSE 0 END) AS failed,
    SUM(CASE WHEN remarks = "Incomplete" THEN 1 ELSE 0 END) AS incomplete,
    SUM(CASE WHEN remarks = "Lacking Requirement" THEN 1 ELSE 0 END) AS lacking_requirement,
    SUM(CASE WHEN remarks = "No Permit" THEN 1 ELSE 0 END) AS no_permit,
    SUM(CASE WHEN remarks = "No Exam" THEN 1 ELSE 0 END) AS no_exam
')
->groupBy('course_code')
->get()
->filter(function ($summary) {
    return $summary->failed > 0 || 
           $summary->incomplete > 0 || 
           $summary->lacking_requirement > 0 || 
           $summary->no_permit > 0 || 
           $summary->no_exam > 0;
});
    // Return the view with the data
    return view('admin.dashboard', compact(
        'totalEvaluators', 'totalStudents', 'totalAnnouncements', 'gradesCount',
        'totalPassed', 'totalFailed', 'totalIncomplete', 'totalLackingRequirement', 
        'totalNoPermit', 'totalNoExam', 'passedPercentage', 'failedPercentage', 
        'incompletePercentage', 'lackingRequirementPercentage', 'noPermitPercentage', 'noExamPercentage', 'remarksSummary'
    ));
}

    

    public function welcome()
    {
        // Return the view for the welcome page
        return view('admin.welcome');
    }
}
