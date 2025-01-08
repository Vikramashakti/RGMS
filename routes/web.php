<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\ResearchGrantController;
use App\Http\Controllers\ProjectMilestoneController;
use App\Http\Controllers\ProjectMemberController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routes for academicians
Route::resource('academicians', AcademicianController::class);

// Resource routes for research grants
Route::resource('researchGrants', ResearchGrantController::class);

// Resource routes for project milestones
Route::resource('projectMilestones', ProjectMilestoneController::class);

// Resource routes for project members
Route::resource('projectMembers', ProjectMemberController::class);


require __DIR__.'/auth.php';
