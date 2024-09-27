<?php

namespace Database\Seeders;

use App\Imports\WeeksImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class WeekSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new WeeksImport, public_path('location_data.csv'));
	}
}
