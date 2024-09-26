<?php

namespace App\Imports;

use App\Models\Postcode;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostcodesImport implements ToModel, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row) {
		return optional(
			$row['postcode'] ?? null,
			fn($postcode) => Postcode::firstOrCreate([
				'postcode' => preg_replace('/\s+/', '', strtoupper($postcode)),
			])
		);
	}
}
