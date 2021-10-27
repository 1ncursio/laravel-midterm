<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['prefix' => '/subjects', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');

    Route::get('/create', [SubjectController::class, 'create'])->name('subjects.create');

    Route::get('/edit/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');

    Route::patch('/{subject}', [SubjectController::class, 'update'])->name('subjects.update');

    Route::post('/', [SubjectController::class, 'store'])->name('subjects.store');

    Route::delete('/{subject}', [SubjectController::class, 'destroy'])->name('subjects.delete');

    // 수강신청
    Route::post('/{subject}/user', [SubjectController::class, 'storeUser'])->name('subjects.storeUser');

    // 수강신청 취소
    Route::delete('/{subject}/user', [SubjectController::class, 'destroyUser'])->name('subjects.deleteUser');

    Route::get('/{subject}', [SubjectController::class, 'show'])->name('subjects.show');

    // 내가 신청한 과목
    // Route::get('/{subject}/user', [SubjectController::class, 'indexUserSubjects'])->name('classes.index');
});

Route::group(['prefix' => '/classes', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // 내가 신청한 과목
    Route::get('/', [ClassController::class, 'index'])->name('classes.index');
});
