<?php

namespace Database\Seeders;

use App\Imports\TimesImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class TimeSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new TimesImport, public_path('location_data.csv'));
	}
}
