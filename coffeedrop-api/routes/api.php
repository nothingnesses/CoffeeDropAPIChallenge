<?php

use App\Http\Controllers\CashbackController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['client']], function () {
	Route::resource(
		'locations',
		LocationController::class,
		['only' => ['index', 'store']]
	);

	Route::resource(
		'cashbacks',
		CashbackController::class,
		['only' => ['store']]
	);
});
