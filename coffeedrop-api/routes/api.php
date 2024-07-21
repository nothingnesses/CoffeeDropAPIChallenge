<?php

use App\Http\Controllers\BusinessHoursController;
use Illuminate\Support\Facades\Route;

Route::get('/get-nearest-location/{postcode}', [BusinessHoursController::class, 'get_nearest_location']);
