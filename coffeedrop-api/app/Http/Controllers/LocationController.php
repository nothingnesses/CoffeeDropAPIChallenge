<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Day;
use App\Models\Location;
use App\Models\Postcode;
use App\Models\Time;
use App\Models\Week;
use Carbon\Carbon;

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

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(LocationRequest $request) {
		$request_parsed = $request->all();
		$get_time_id = fn($time) => Time::firstOrCreate(['time' => $time])->getKey();
		$now = Carbon::now();
		$location = Location::firstOrCreate([
			'postcode_id' => Postcode::firstOrCreate(['postcode' => optional(
				$request_parsed['postcode'] ?? null,
				fn($postcode) => preg_replace('/\s+/', '', strtoupper($postcode))
			)])->getKey(),
			'week_id' => Week::firstOrCreate(
				collect([
					Carbon::SUNDAY,
					Carbon::MONDAY,
					Carbon::TUESDAY,
					Carbon::WEDNESDAY,
					Carbon::THURSDAY,
					Carbon::FRIDAY,
					Carbon::SATURDAY,
				])
					->mapWithKeys(
						fn($day) => [
							$day => strtolower(
								$now
									->next($day)
									->dayName
							)
						]
					)
					->filter(fn($day_name) => !empty($request_parsed['opening_times'][$day_name]))
					->mapWithKeys(
						fn($day_name, $day) => ["day_{$day}" => Day::firstOrCreate([
							'day' => $day,
							'open_time_id' => $get_time_id($request_parsed['opening_times'][$day_name] ?? null),
							'closed_time_id' => $get_time_id($request_parsed['closing_times'][$day_name] ?? null),
						])->getKey()]
					)
					->all()
			)->getKey()
		]);
		return new LocationResource(
			Location::query()
				->where('locations.id', $location->getKey())
				->scope_denormalise()
				->first()
		);
	}
}
