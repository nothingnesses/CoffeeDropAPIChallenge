<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(LocationRequest $request) {
		if ($request->has('nearest-to-postcode')) {
			return new LocationResource(
				Location::scope_nearest_to_postcode($request->query('nearest-to-postcode'))
					->scope_denormalise()
					->first()
			);
		}
		return 'todo';
	}
}
