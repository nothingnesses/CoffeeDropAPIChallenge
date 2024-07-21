<?php

namespace App\Imports;

use App\Models\Postcode;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use JustSteveKing\LaravelPostcodes as LP;

class PostcodesImport implements ToModel, WithHeadingRow, SkipsOnError {
	use SkipsErrors;

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row) {
		if (empty($row['postcode'])) {
			return null;
		} else {
			$postcode_data = LP\Facades\Postcode::getPostcode($row['postcode']);
			return new Postcode([
				'postcode' => $row['postcode'],
				'latitude' => $postcode_data->latitude,
				'longitude' => $postcode_data->longitude,
			]);
		}
	}
}
