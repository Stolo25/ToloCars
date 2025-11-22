<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reservecars', [\App\Http\Controllers\ReserveCarController::class, 'index'], function () {
    return view('reservecars.index');
});

Route::get('/reservecars/{reservecar}', [\App\Http\Controllers\ReserveCarController::class, 'show'], function () {
    return view('reservecars.index');
});