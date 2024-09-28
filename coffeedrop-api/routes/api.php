<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:api');

Route::resource(
	'locations',
	LocationController::class,
	['only' => ['index']]
);
