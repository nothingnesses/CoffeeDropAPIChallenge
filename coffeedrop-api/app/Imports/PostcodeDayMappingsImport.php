<?php

namespace App\Imports;

use App\Models\Day;
use App\Models\Postcode;
use App\Models\PostcodeDayMapping;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostcodeDayMappingsImport implements ToCollection, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param \Illuminate\Support\Collection $rows
	 */
	public function collection(Collection $rows) {
		foreach ($rows as $row) {
			if (isset($row['postcode']) && $row['postcode'] !== '') {
				$postcode_id = Postcode::query()
					->where('postcode', $row['postcode'])
					->get()
					->first()
					->id;
				$get_day_id = fn($day) => Day::query()
					->where('day', $day)
					->get()
					->first()
					->id;
				foreach ($row as $key => $value) {
					if (
						$value !== ''
						&& (
							$key === 'open_monday'
							|| $key === 'open_tuesday'
							|| $key === 'open_wednesday'
							|| $key === 'open_thursday'
							|| $key === 'open_friday'
							|| $key === 'open_saturday'
							|| $key === 'open_sunday'
						)
					) {
						PostcodeDayMapping::firstOrCreate([
							'postcode_id' => $postcode_id,
							'day_id' => match ($key) {
								'open_monday' => $get_day_id('Monday'),
								'open_tuesday' => $get_day_id('Tuesday'),
								'open_wednesday' => $get_day_id('Wednesday'),
								'open_thursday' => $get_day_id('Thursday'),
								'open_friday' => $get_day_id('Friday'),
								'open_saturday' => $get_day_id('Saturday'),
								'open_sunday' => $get_day_id('Sunday'),
								// This shouldn't match.
								default => 0,
							},
						]);
					}
				}
			}
		}
	}
}
