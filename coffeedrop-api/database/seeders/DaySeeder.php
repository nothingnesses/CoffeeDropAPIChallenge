<?php

namespace Database\Seeders;

use App\Imports\DaysImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DaySeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new DaysImport, public_path('location_data.csv'));
	}
}
