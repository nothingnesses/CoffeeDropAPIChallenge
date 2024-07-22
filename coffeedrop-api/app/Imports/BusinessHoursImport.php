<?php

namespace App\Imports;

use App\Models\BusinessHours;
use App\Models\Day;
use App\Models\Postcode;
use App\Models\Time;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessHoursImport implements ToCollection, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param \Illuminate\Support\Collection $rows
	 */
	public function collection(Collection $rows) {
		$get_day_id = fn($day) => Day::query()
			->where('day', $day)
			->first()
			->id;
		$get_time_id = fn($time) => empty($time)
			? NULL
			: Time::query()
				->where('time', $time)
				->first()
				->id;
		$days = collect([
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
			'Sunday'
		])
			->mapWithKeys(
				fn($item) => [
					$item => [
						'day_id' => $get_day_id($item),
						'opening_time_key' => 'open_' . strtolower($item),
						'closing_time_key' => 'closed_' . strtolower($item)
					]
				]
			);
		foreach ($rows as $row) {
			if (!empty($row['postcode'])) {
				foreach ($days as $value) {
					BusinessHours::firstOrCreate([
						'postcode_id' => Postcode::firstOrCreate([
							'postcode' => $row['postcode']
						])->id,
						'day_id' => $value['day_id'],
						'opening_time_id' => $get_time_id($row[$value['opening_time_key']]),
						'closing_time_id' => $get_time_id($row[$value['closing_time_key']]),
					]);
				}
			}
		}
	}
}
