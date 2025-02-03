<?php

use App\Http\Controllers\CoachController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:student'])->group(
    function () {
        Route::get('/students', [StudentController::class, 'welcome'])->name('students');
        Route::get('/students/resource', [StudentController::class, 'resource']);
        Route::get('/students/articles/{resource_id}', [StudentController::class, 'showArticle'])->name('articles.show');
        Route::get('/students/workoutplan', [StudentController::class, 'workoutplan'])->name('students.workoutplan');
        Route::get('/students/coursedetail/{workoutplan_id}', [StudentController::class, 'coursedetail'])->name('students.coursedetail');
        Route::get('/students/payment', [StudentController::class, 'payment'])->name('students.payment');
        Route::get('/students/progress', [StudentController::class, 'progress'])->name('students.progress');
        Route::get('/students/profile', [StudentController::class, 'index'])->name('profile.indexForstudent');
        Route::get('/students/profile/edit', [StudentController::class, 'edit'])->name('profile.editForstudent');
        Route::post('/students/profile/logout', [StudentController::class, 'logout'])->name('profile.logoutForstudent');
        Route::put('/students/profile', [StudentController::class, 'update'])->name('profile.updateForstudent');
    }
);

Route::middleware(['auth', 'role:coach'])->group(
    function () {
        Route::get('coaches/', [CoachController::class, 'welcome']);
        Route::get('coaches/delete-student/{student}', [CoachController::class, 'deleteStudent'])->name('delete_student');
        Route::get('/coaches/schedule/{student}', [CoachController::class, 'schedule'])->name('coaches.schedule');
        // Route::get('/coaches/progress', [CoachController::class, 'progress'])->name('coaches.progress');
        Route::get('/coaches/resource', [CoachController::class, 'resource']);
        Route::get('/coaches/articles/{resource_id}', [CoachController::class, 'showArticle'])->name('articles.show1');
        Route::get('coaches/report', [CoachController::class, 'report'])->name('coaches.report');
        Route::post('coaches/report', [CoachController::class, 'storeReport'])->name('progress.store');
        Route::get('/coaches/profile', [CoachController::class, 'index'])->name('profile.indexForcoach');
        Route::get('/coaches/profile/edit', [CoachController::class, 'edit'])->name('profile.editForcoach');
        Route::post('/coaches/profile/logout', [CoachController::class, 'logout'])->name('profile.logoutForcoach');
        Route::put('/coaches/profile', [CoachController::class, 'update'])->name('profile.updateForcoach');
    }
);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile/edit',[ProfileController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
//     Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });


require __DIR__ . '/auth.php';
