<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tokens/index', function (Request $request) {
	return \App\Models\User::find($request->query('user_id'))
		->createToken($request->query('name'))
		->accessToken;
});

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:api');
