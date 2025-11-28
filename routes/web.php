<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReserveCarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UploadCarController;
use App\Http\Controllers\OwnerRequestController;

/** only for my home page */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

/** car listings view */
Route::get('/reservecars', [\App\Http\Controllers\ReserveCarController::class, 'index'], function () {
    return view('reservecars.index');
});


/**when I wanna see specific car listing */
Route::get('/reservecars/{reservecar}', [\App\Http\Controllers\ReserveCarController::class, 'show'], function () {
    return view('reservecars.index');
});


/**to chekc or edit my booking */
Route::get('/mybookings', [\App\Http\Controllers\ReservationController::class, 'mybookings'])->middleware('auth')->name('mybookings');

Route::post('/reservations', [\App\Http\Controllers\ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

Route::patch('/reservations/{id}/cancel', [\App\Http\Controllers\ReservationController::class, 'cancel'])->middleware('auth')->name('reservations.cancel');


/**approve or check received rental request */
Route::get('/requests', [\App\Http\Controllers\OwnerRequestController::class, 'index'])->middleware('auth')->name('requests.index');

Route::post('/requests/{reservation}/approve', [\App\Http\Controllers\OwnerRequestController::class, 'approve'])->middleware('auth')->name('requests.approve');

Route::post('/requests/{reservation}/reject', [\App\Http\Controllers\OwnerRequestController::class, 'reject'])->middleware('auth')->name('requests.reject');

/** leave a review function */
Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

/**upload or edit my own car listed */
Route::get('/uploadcar', [\App\Http\Controllers\UploadCarController::class, 'index'])->middleware('auth')->name('uploadcar');

Route::post('/uploadcar', [\App\Http\Controllers\UploadCarController::class, 'store'])->middleware('auth')->name('cars.store');

Route::get('/uploadcar/{car}/edit', [\App\Http\Controllers\UploadCarController::class, 'edit'])->middleware('auth')->name('cars.edit');

Route::put('/uploadcar/{car}', [\App\Http\Controllers\UploadCarController::class, 'update'])->middleware('auth')->name('cars.update');

Route::delete('/uploadcar/{car}', [\App\Http\Controllers\UploadCarController::class, 'destroy'])->middleware('auth')->name('cars.destroy');


/**system did it no idea */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';