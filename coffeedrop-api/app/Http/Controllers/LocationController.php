<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Models\Postcode;
use App\Services\LocationService;
use Clickbar\Magellan\Database\PostgisFunctions\ST;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(LocationRequest $request) {
		if ($request->has('nearest-to-postcode')) {
			return LocationResource::make(
				LocationService::denormalise(
					Location::query()
						->join(
							'postcodes',
							'locations.postcode_id',
							'=',
							'postcodes.id'
						)
						->stOrderBy(
							ST::distanceSpheroid(
								Postcode::firstOrCreate(
									[
										'postcode' => preg_replace(
											'/\s+/',
											'',
											strtoupper($request->query('nearest-to-postcode'))
										)
									]
								)->location,
								'location'
							)
						)
				)
					->take(1)
					->first()
			);
		}
		return 'todo';
	}
}
