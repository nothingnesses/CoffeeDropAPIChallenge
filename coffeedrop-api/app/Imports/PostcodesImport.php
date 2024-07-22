<?php

namespace App\Imports;

use App\Models\Postcode;
use JustSteveKing\LaravelPostcodes\Facades\Postcode as FacadesPostcode;
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
		return (empty($row['postcode']))
			? null
			: Postcode::create([
				'postcode' => $row['postcode'],
			]);
	}
}
