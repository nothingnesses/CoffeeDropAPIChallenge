<?php

use App\Http\Controllers\CashbackController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
	Route::get('/user', function (Request $request) {
		return $request->user();
	});

	Route::resource(
		'locations',
		LocationController::class,
		['only' => ['index', 'store']]
	);

	Route::resource(
		'cashbacks',
		CashbackController::class,
		['only' => ['index', 'store']]
	);
});
