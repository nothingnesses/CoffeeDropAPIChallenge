<?php

namespace App\Http\Controllers;

use App\Models\BusinessHours;
use App\Models\Day;
use App\Models\Postcode;
use App\Models\Time;
use Illuminate\Http\Request;
use JustSteveKing\LaravelPostcodes as LP;

class BusinessHoursController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(BusinessHours $businessHours) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(BusinessHours $businessHours) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, BusinessHours $businessHours) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(BusinessHours $businessHours) {
		//
	}

	/**
	 * Returns the address and opening times of the nearest CoffeeDrop location.
	 *
	 * @param string $postcode The postcode to find the nearest CoffeeDrop location for.
	 */
	public function get_nearest_location(string $postcode) {
		$postcode_data = LP\Facades\Postcode::getPostcode($postcode);
		$coordinates = new \Helpers\Coordinates($postcode_data->latitude, $postcode_data->longitude);
		$nearest_postcode_id = null;
		$nearest_postcode_distance = null;
		foreach (Postcode::all() as $value) {
			$stored_coordinates = new \Helpers\Coordinates($value->latitude, $value->longitude);
			$distance = \Helpers\get_spherical_distance($coordinates, $stored_coordinates);
			if ($nearest_postcode_id === null || $nearest_postcode_distance > $distance) {
				$nearest_postcode_id = $value->id;
				$nearest_postcode_distance = $distance;
			}
		}
		$nearest_postcode = Postcode::find($nearest_postcode_id);
		$business_hours = $nearest_postcode->business_hours;
		$opening_times = $business_hours
			->filter(fn($value) => $value->opening_time_id !== null)
			->mapWithKeys(
				fn($value) => [
					Day::find($value->day_id)->day => Time::find($value->opening_time_id)->time
				]
			);
		$closing_times = $business_hours
			->filter(fn($value) => $value !== null && $value->closing_time_id !== null)
			->mapWithKeys(
				fn($value) => [
					Day::find($value->day_id)->day => Time::find($value->closing_time_id)->time
				]
			);
		return [
			'postcode' => $nearest_postcode->postcode,
			'opening_times' => $opening_times,
			'closing_times' => $closing_times,
		];
	}
}
