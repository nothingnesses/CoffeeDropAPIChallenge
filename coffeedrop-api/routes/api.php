<?php

use App\Http\Controllers\BusinessHoursController;
use App\Http\Controllers\CashbackController;
use Illuminate\Support\Facades\Route;

Route::get('/get-nearest-location/{postcode}', [BusinessHoursController::class, 'get_nearest_location']);
Route::post('/create-new-location', [BusinessHoursController::class, 'create_new_location']);
Route::post('/calculate-cashback', [CashbackController::class, 'calculate_cashback']);
