<?php

use App\Models\Job;
use App\Mail\JobPosted;
use App\Jobs\TranslateJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;

Route::get('test', function () {
    $job = Job::first();

    TranslateJob::dispatch($job);

    return 'Dispatched';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

 Route::get('/jobs', [JobController::class, 'index']);
 Route::get('/jobs/create', [JobController::class, 'create']);

 // In order to create a job you have to be signed in.
 Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

 Route::get('/jobs/{job}', [JobController::class, 'show']);

 // In order to edit a job you have to be signed in and be Authurized to edit the job.
 Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
     ->middleware('auth')
     ->can('edit', 'job');

 Route::patch('/jobs/{job}', [JobController::class, 'update']);
 Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

