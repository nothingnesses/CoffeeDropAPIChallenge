<?php

namespace App\Imports;

use App\Models\Time;
use Carbon\Carbon;
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
		$headings = collect($rows[0] ?? [])
			->keys()
			->skip(1);
		foreach ($rows as $row) {
			foreach ($row as $key => $value) {
				if (!empty($value) && $headings->contains($key)) {
					Time::firstOrCreate(['time' => new Carbon($value)]);
				}
			}
		}
	}
}
