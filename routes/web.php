<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrmasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('silomas');
});

Route::get('/', [HomeController::class, 'showSilomas'])
    ->name('silomas');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Dashboard
// Route::get('/dashboard', [HomeController::class, 'index'])->name('ormas.dashboard');
// Route::get('/dashboard', [HomeController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('ormas.dashboard');

// Middleware untuk profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk Ormas
Route::resource('ormas', OrmasController::class)->middleware('auth');
Route::get('/ormas/{ormas}/resume', [OrmasController::class, 'resume'])->name('ormas.resume');
Route::post('/ormas/{ormas}/submit-to-admin', [OrmasController::class, 'submitToAdmin'])->name('ormas.submitToAdmin');
Route::delete('/ormas/{id}', [OrmasController::class, 'destroy'])->name('ormas.destroy');
Route::post('/ormas/store', [OrmasController::class, 'store'])->name('ormas.store');


require __DIR__.'/auth.php';
