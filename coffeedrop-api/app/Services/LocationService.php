<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class LocationService {
	public static function denormalise(Builder $query): Builder {
		$days = collect(
			[
				Carbon::SUNDAY,
				Carbon::MONDAY,
				Carbon::TUESDAY,
				Carbon::WEDNESDAY,
				Carbon::THURSDAY,
				Carbon::FRIDAY,
				Carbon::SATURDAY
			]
		);
		$day_ids_string = $days
			->map(fn($day) => "day_{$day}_id")
			->join(',');
		$now = Carbon::now();
		return $query
			->select(
				[
					'locations.id',
					'postcode_id',
					'week_id'
				]
			)
			->with(
				[
					'postcode:id,postcode',
					"week:id,{$day_ids_string}",
					...$days
						->map(
							fn($day) => strtolower(
								$now
									->next($day)
									->dayName
							)
						)
						->flatMap(
							fn($day) => [
								"week.{$day}:id,opening_time_id,closing_time_id",
								"week.{$day}.opening_time:id,time",
								"week.{$day}.closing_time:id,time"
							]
						)
						->all()
				]
			);
	}
}
