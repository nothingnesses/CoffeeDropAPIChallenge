<?php

namespace App\Imports;

use App\Models\Time;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TimesImport implements ToCollection, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param \Illuminate\Support\Collection $rows
	 */
	public function collection(Collection $rows) {
		foreach ($rows as $row) {
			foreach ($row as $key => $value) {
				if (
					$value !== null
					&& $value !== ''
					&& (
						$key === 'open_monday'
						|| $key === 'open_tuesday'
						|| $key === 'open_wednesday'
						|| $key === 'open_thursday'
						|| $key === 'open_friday'
						|| $key === 'open_saturday'
						|| $key === 'open_sunday'
						|| $key === 'closed_monday'
						|| $key === 'closed_tuesday'
						|| $key === 'closed_wednesday'
						|| $key === 'closed_thursday'
						|| $key === 'closed_friday'
						|| $key === 'closed_saturday'
						|| $key === 'closed_sunday'
					)
				) {
					Time::firstOrCreate([
						'time' => $value
					]);
				}
			}
		}
	}
}
