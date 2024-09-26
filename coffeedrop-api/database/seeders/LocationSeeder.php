<?php

namespace Database\Seeders;

use App\Imports\LocationsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class LocationSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new LocationsImport, public_path('location_data.csv'));
	}
}
