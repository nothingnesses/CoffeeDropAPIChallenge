<?php

namespace App\Imports;

use App\Models\Day;
use App\Models\Location;
use App\Models\Postcode;
use App\Models\Time;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LocationsImport implements ToCollection, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param \Illuminate\Support\Collection $rows
	 */
	public function collection(Collection $rows) {
		$get_time_id = fn($time) => Time::firstOrCreate(['time' => $time])->getKey();
		$now = Carbon::now();
		foreach ($rows as $row) {
			optional(
				$row['postcode'] ?? null,
				fn($postcode) => optional(
					Week::firstOrCreate(
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
								function ($day) use ($now, $get_time_id) {
									$day_name = strtolower(
										$now
											->next($day)
											->dayName
									);
									return optional(
										$row["open_{$day_name}"] ?? null,
										fn($open_time) => optional(
											$row["closed_{$day_name}"] ?? null,
											fn($closed_time) => optional(
												Day::firstOrCreate([
													'day' => $day,
													'open_time_id' => $get_time_id($open_time),
													'closed_time_id' => $get_time_id($closed_time),
												])->getKey(),
												fn($day_model) => ["day_{$day}" => $day_model]
											)
										)
									) ?? [];
								}
							)
							->all()
					),
					fn($week) => Location::firstOrCreate([
						'postcode_id' => Postcode::firstOrCreate(
							['postcode' => preg_replace('/\s+/', '', strtoupper($postcode))]
						)->getKey(),
						'week_id' => $week->getKey(),
					])
				)
			);
		}
	}
}
