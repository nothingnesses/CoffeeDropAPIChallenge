<?php

namespace App\Imports;

use App\Models\Day;
use App\Models\Time;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WeeksImport implements ToCollection, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param \Illuminate\Support\Collection $rows
	 */
	public function collection(Collection $rows) {
		$get_time_id = fn($time) => Time::firstOrCreate(['time' => $time])->getKey();
		$now = Carbon::now();
		$days = collect([
			Carbon::SUNDAY,
			Carbon::MONDAY,
			Carbon::TUESDAY,
			Carbon::WEDNESDAY,
			Carbon::THURSDAY,
			Carbon::FRIDAY,
			Carbon::SATURDAY,
		])
			->mapWithKeys(
				function ($day) use ($now) {
					$day_string = strtolower(
						$now
							->next($day)
							->dayName
					);
					return [
						$day => [
							'open_time_key' => "open_{$day_string}",
							'closed_time_key' => "closed_{$day_string}"
						]
					];
				}
			);
		foreach ($rows as $row) {
			Week::firstOrCreate(
				$days
					->mapWithKeys(
						fn($keys, $day) => optional(
							$row[$keys['open_time_key']] ?? null,
							fn($open_time) => optional(
								$row[$keys['closed_time_key']] ?? null,
								fn($closed_time) => optional(
									Day::firstOrCreate([
										'day' => $day,
										'open_time_id' => $get_time_id($open_time),
										'closed_time_id' => $get_time_id($closed_time),
									])->getKey(),
									fn($day_model) => ["day_{$day}" => $day_model]
								)
							)
						) ?? []
					)
					->all()
			);
		}
	}
}
