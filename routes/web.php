<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEvaluatorController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\EvaluatorsController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\StudentGradeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminEvaluationController;
use App\Http\Controllers\AdminAnnouncementsController;


// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Route for the welcome page (choose role page)
Route::get('/welcome', function () {
    return view('welcome'); // or whatever view you named
});

Route::get('/admin/welcome', [AdminDashboardController::class, 'welcome'])->name('admin.welcome');


// Admin Login Routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
// Admin Logout Route
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Verify Student ID 
Route::get('/api/verify/{userId}', [StudentController::class, 'verify']);

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Route (Protected by 'auth' middleware)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::put('{id}/archive', [AdminController::class, 'archive'])->name('archive');
        
        // Admin Dashboard Route (Protected by Auth Middleware)
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

    // Students Routes
    Route::get('/students', [StudentsController::class, 'students'])->name('students.index');

    // Evaluators Routes
    Route::get('/evaluators', [EvaluatorsController::class, 'index'])->name('evaluators.index');
    Route::get('/evaluators/create', [EvaluatorsController::class, 'create'])->name('evaluators.create');
    Route::post('/evaluators', [EvaluatorsController::class, 'store'])->name('evaluators.store');
    Route::put('/evaluators/{id}/archive', [EvaluatorsController::class, 'archive'])->name('evaluators.archive');

    // Announcements Routes
    Route::resource('announcements', AnnouncementsController::class);
    Route::put('announcements/{id}/archive', [AnnouncementsController::class, 'archive'])->name('announcements.archive');
    Route::delete('/announcements/{id}', [AnnouncementsController::class, 'destroy'])->name('announcements.destroy');

    //Admin Announcements Route
    Route::get('/admin/announcements', [AdminAnnouncementsController::class, 'index'])->name('admin.announcements');
    
    // Rquest Evaluation
    Route::post('/announcements/{announcement}/request', [AnnouncementsController::class, 'request'])->name('announcements.request');

    // Grades Routes
    Route::get('/grades', [GradesController::class, 'show'])->name('grades.show');
    Route::get('/student/grades', [StudentGradeController::class, 'showGrades']);
    Route::get('/grades/{studentId}/{studentName}', [GradesController::class, 'show'])->name('grades.show');
    Route::get('/grades/faculty/{student_id}/{student_name}', [GradesController::class, 'showFacultyGrades'])->name('grades.faculty');
    Route::post('/store/student/details', [FacultyController::class, 'storeStudentDetails'])->name('store.student.details');
    Route::get('/faculty/grades', [FacultyController::class, 'showGrades'])->name('faculty.grades');
    Route::post('/save-note', [GradesController::class, 'saveNote'])->name('save-note');
    Route::post('/upload-deficiency', [GradesController::class, 'uploadDeficiencyForm'])->name('uploadDeficiency');
    
    // Student Grades route
    Route::get('/grades/studentgrades', [StudentGradeController::class, 'showGrades'])->name(name: 'grades.studentgrades');

    // Student Grades route
    Route::get('/admin/evaluation', [AdminEvaluationController::class, 'index'])->name('admin.evaluation');

    // Evaluation Routes
    Route::get('/evaluate/{student_id}', [StudentEvaluatorController::class, 'evaluate'])->name('evaluate');
    Route::get('/evaluate', [EvaluationController::class, 'evaluate'])->name('evaluate');
    Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluation', [EvaluationController::class, 'showEvaluations'])->name('evaluation.evaluation');
    Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
    Route::delete('/evaluations/{id}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');
    Route::post('/settings/verify-current-password', [SettingsController::class, 'verifyCurrentPassword'])->name('settings.verify_current_password');
    Route::get('/api/verify/{studentId}', [StudentController::class, 'verify'])->name('api.verify');
    
    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

// check if meron na acc
Route::get('/api/verify/{userId}', [RegisterController::class, 'verifyUserId']);

// Route to verify faculty
Route::get('/verify-faculty/{faculty_id}', [FacultyController::class, 'verifyFaculty'])->name('verify.faculty');

// Route to check role during registration
Route::get('/check-role/{studentId}', [RegisterController::class, 'checkRole'])->name('check-role');

Route::get('/admin/students', [AdminController::class, 'showStudents'])->name('admin.students');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Admin Settings Routes d
// Route for the admin settings page
Route::get('/admin/settings', [AdminSettingsController::class, 'edit'])->name('admin.settings');
// Route to handle the update
Route::put('/admin/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
Route::post('/admin/settings/verify-current-password', [AdminSettingsController::class, 'verifyCurrentPassword'])->name('admin.settings.verify_current_password');
// });


// Verify current password in the settings (no change needed for this)
Route::post('/settings/verify-current-password', [SettingsController::class, 'verifyCurrentPassword'])->name('settings.verify_current_password');

// API verification route for students (no change needed for this)
Route::get('/api/verify/{studentId}', [StudentController::class, 'verify'])->name('api.verify');

// Admin Evaluation 
Route::post('/evaluations/{user_id}', [AdminEvaluationController::class, 'store'])->name('evaluations.store');

// Add this route to your routes/web.php
Route::get('/grades/show', [AdminEvaluationController::class, 'showGrades'])->name('grades.show');

Route::delete('/evaluations/delete-and-evaluate/{studentId}', [AdminEvaluationController::class, 'deleteAndEvaluate'])->name('evaluations.deleteAndEvaluate');

Route::post('/save-note', [GradesController::class, 'saveNote'])->name('save-note')->middleware('auth');

Route::post('announcements/{announcement}/request', [AnnouncementsController::class, 'request'])->name('announcements.request');
Route::get('announcements', [AnnouncementsController::class, 'index'])->name('announcements.index');  // Assuming you have an index route for announcements

Route::post('/help/upload', [GradesController::class, 'uploadHelpRequest'])->name('grades.help.upload');


// Add this route to handle the completion action
Route::get('admin/evaluation/complete/{studentId}', [AdminEvaluationController::class, 'completeEvaluation'])->name('evaluation.complete');
